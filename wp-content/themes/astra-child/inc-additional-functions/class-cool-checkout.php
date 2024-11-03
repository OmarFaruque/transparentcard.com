<?php
/**
 * Extension for wooocommerce Checkout page
 */
class COOL_Checkout{
    protected $selected_sizes;
    protected $wpdb;

    public function __construct(){
        global $wpdb;
        $this->wpdb = $wpdb;

        add_shortcode( 'transparent_registration_form', array($this, 'transparerent_woo_registration_form_callback') );
        add_action( 'woocommerce_before_customer_login_form', array($this, 'transparentcard_woo_registration_form_redirect') );
        add_action( 'wp', array($this, 'transparentcard_woo_registration_form_save_process') );
        add_action( 'woocommerce_checkout_order_review', array($this, 'transparent_checkout_items'), 5 );
        add_action( 'transparentcard_woocommerce_order_item_meta_top', array($this, 'transparent_thankyou_order_item_metathumb'), 5, 3);

        add_filter( 'default_checkout_billing_country', array($this, 'transparent_change_default_checkout_country') );
    }


    /**
     * Redirect to another page
     */
    public function transparentcard_woo_registration_form_redirect(){
        global $validation;
        if(!empty($validation)){
            echo sprintf('<div class="validation-errors"><ul>%s</ul></div>', $validation);
        }
    }



    /**
     * Change default country in checkout page 
     * @return string
     */
    public function transparent_change_default_checkout_country(){
        return 'DE';
    }

    public function transparent_thankyou_order_item_metathumb($item_id, $item, $order){
        ob_start();
        $nbd_item_key = wc_get_order_item_meta( $item_id, '_nbd' );
        $nbu_item_key = wc_get_order_item_meta( $item_id, '_nbu' );
        $img_src = '';

        
        // echo 'imgsrc: ' . $img_src . '<br/>';
        // echo 'productid: ' . $item->get_product_id() . '<br/>';
        
        
        if( $nbd_item_key ){
            $show_design_in_order = nbdesigner_get_option( 'nbdesigner_show_in_order', 'yes' );
            if( ( isset( $item["item_meta"]["_nbd"] ) || isset( $item["item_meta"]["_nbu"] ) ) && $show_design_in_order == 'yes' ){
                $dir = NBDESIGNER_CUSTOMER_DIR . '/' . $nbd_item_key . '/preview';
                // file_exists
                if( isset( $item["item_meta"]["_nbd"] ) && file_exists($dir) ){
                    $images = Nbdesigner_IO::get_list_images($dir);
                    asort( $images );
                    foreach ( $images as $img ){
                        if(!empty($img_src)) break;
                        $img_src    = Nbdesigner_IO::convert_path_to_url( $img ) . '?&t=' . round( microtime( true ) * 1000 );
                    }
                }
            }
        }


        if(empty($img_src)){
            $img_src_attr = wp_get_attachment_image_src( get_post_thumbnail_id( $item->get_product_id() ), 'thumbnail');
            if(is_array($img_src_attr)) $img_src = $img_src_attr[0];
        }
        
        if(!empty($img_src)):
            ?>
                <img src="<?php echo esc_url( $img_src ); ?>" alt="<?php esc_attr_e( 'Individuelles Design', 'transparentcards' ); ?>">
            <?php
        endif;
        
        echo ob_get_clean();
    }

    /**
     * Transparent checkout items
     */
    public function transparent_checkout_items(){
        ob_start(); ?>
			<div class="checkout-cart-items">
                <?php
                    $cart_items = WC()->cart->get_cart();

                    foreach ( $cart_items as $cart_item_key => $cart_item ) {
                        elementor_pro_render_mini_cart_item( $cart_item_key, $cart_item );
                    }
                ?>
            </div>
        <?php echo ob_get_clean();
    }

    /**
     * Process regisration form 
     * 
     */
    public function transparentcard_woo_registration_form_save_process(){
        global $validation;
        
        if (isset($_POST['woocommerce-register-nonce']) && wp_verify_nonce( $_POST['woocommerce-register-nonce'], 'woocommerce-register' ) ) {
            $validation = $this->validateion();
            if(empty($validation)){
                // Process save data
                $username   = $_POST['reg_username'] ?? str_replace(' ', '', $_POST['billing_first_name']);
                $password   = $_POST['password'];
                $email      = sanitize_email( $_POST['billing_email'] ); 

                $billing_first_name = sanitize_text_field( $_POST['billing_first_name']);
                $billing_last_name  = sanitize_text_field( $_POST['billing_last_name']);
                $billing_company  = sanitize_text_field( $_POST['billing_company']);
                $billing_address_1 = sanitize_text_field( $_POST['billing_address_1'] );
                $billing_address_2 = sanitize_text_field( $_POST['billing_address_2'] );
                $billing_postcode = sanitize_text_field( $_POST['billing_postcode'] );
                $billing_city = sanitize_text_field( $_POST['billing_city']);
                $billing_country = sanitize_text_field( $_POST['billing_country']);
                $billing_state = isset($_POST['billing_state']) ? sanitize_text_field( $_POST['billing_state']) : '';
                $billing_phone = sanitize_text_field( $_POST['billing_phone']);

                

                // Create WordPress user.
                $user_id = wp_create_user( $username, $password, $email );

                if ( ! is_wp_error( $user_id ) ) {
                    //save additional data as user meta 
                    $user = new WP_User( $user_id );
                    $user->set_role( 'pending_verification' );

                    // Send verification email
                    send_verification_email($user_id);
                    
                    // WC()->mailer()->get_emails()['WC_Email_Customer_New_Account']->trigger( $user_id, $user->get_user_login(), $password );

                    //Metas 
                    update_user_meta( $user_id, 'billing_first_name', $billing_first_name);
                    update_user_meta( $user_id, 'billing_last_name', $billing_last_name);
                    update_user_meta( $user_id, 'billing_company', $billing_company);
                    update_user_meta( $user_id, 'billing_address_1', $billing_address_1);
                    update_user_meta( $user_id, 'billing_address_2', $billing_address_2);
                    update_user_meta( $user_id, 'billing_postcode', $billing_postcode);
                    update_user_meta( $user_id, 'billing_city', $billing_city);
                    update_user_meta( $user_id, 'billing_country', $billing_country);
                    update_user_meta( $user_id, 'billing_state', $billing_state);
                    update_user_meta( $user_id, 'billing_phone', $billing_phone);

                    $creds = array(
                        'user_login'    => $username,
                        'user_password' => $password,
                        'remember'      => true,
                    );
            
                    // Sign the user on
                    // $userlogin = wp_signon($creds, false);
                    
                    // Optionally, redirect to a specific page
                    // $redirect_to = add_query_arg(array(
                    //     'account_created' => true,
                    //     'need-varification' => true
                    // ), wc_get_checkout_url());
                        
                    wp_die( __('Your account created successfully. Please check your mail for varification process.', 'transparentcard') );
                    $_POST = [];
                    // wp_safe_redirect( esc_url( $redirect_to ), 307 );
                    exit;
                    
                    $userlogin = false;  // For now want avoide auto login
                    if ($userlogin) {
                        // Logini to current user 
                        wp_set_current_user($userlogin->ID); // Set the current user to the new user
                        wp_set_auth_cookie($userlogin->ID, true); // Set the authentication cookies for the user
                        do_action('wp_login', $username, $userlogin);

                        // Ensure WooCommerce sessions are set
                        if (class_exists('WooCommerce')) {
                            WC()->session->set_customer_session_cookie(true);

                            // Trigger the WooCommerce 'new account' email notification
                            WC()->mailer()->get_emails()['WC_Email_Customer_New_Account']->trigger( $user_id, $user->get_user_login(), $password );

                        }
                    }
                }

            }
        }
    }



    public function validateion(){ 
        if(isset($_GET['account_created'])) return '';

        $valiation = '';
        $username   = $_POST['reg_username'] ?? str_replace(' ', '', $_POST['billing_first_name']);

        if(isset($_POST['billing_first_name']) && empty($_POST['billing_first_name']) )
            $valiation .= sprintf('<li>%s</li>', esc_attr__( 'First Name is required', 'transparentcards' ));

        if(isset($_POST['billing_last_name']) && empty($_POST['billing_last_name']) )
            $valiation .= sprintf('<li>%s</li>', esc_attr__( 'Last Name is required', 'transparentcards' ));

        if(isset($_POST['billing_phone']) && empty($_POST['billing_phone']) )
            $valiation .= sprintf('<li>%s</li>', esc_attr__( 'Billing Phone is required', 'transparentcards' ));

        $billing_email_error = false;
        if(isset($_POST['billing_email']) && empty($_POST['billing_email'])){
            $valiation .= sprintf('<li>%s</li>', esc_attr__( 'Email is required', 'transparentcards' ));
            $billing_email_error = true;
        }
        
        if( $billing_email_error == false && isset($_POST['billing_email']) && !filter_var($_POST['billing_email'], FILTER_VALIDATE_EMAIL))
            $valiation .= sprintf('<li>%s</li>', esc_attr__( 'Invalid email format', 'transparentcards' ));

        if(empty($_POST['password']))
            $valiation .= sprintf('<li>%s</li>', esc_attr__( 'Password is required', 'transparentcards' ));

        if(empty($_POST['billing_postcode']))
            $valiation .= sprintf('<li>%s</li>', esc_attr__( 'Postcode is required', 'transparentcards' ));

        if(empty($_POST['billing_address_1']))
            $valiation .= sprintf('<li>%s</li>', esc_attr__( 'Billing address is required', 'transparentcards' ));

        if(empty($_POST['billing_city']))
            $valiation .= sprintf('<li>%s</li>', esc_attr__( 'City is required', 'transparentcards' ));

        if(empty($_POST['billing_country']))
            $valiation .= sprintf('<li>%s</li>', esc_attr__( 'Billing Country is required', 'transparentcards' ));

        if (email_exists( $_POST['billing_email'] ) ) {
            $valiation .= sprintf('<li>%s</li>', esc_attr__( 'User already exist using this email.', 'transparentcards' ));
        }
        if (username_exists($username)) {
            $valiation .= sprintf('<li>%s</li>', esc_attr__( 'Sorry, that username already exists!', 'transparentcards' ));
        }
        

            
        return $valiation;
        
    }

    /**
     * Registratio page for checkout page 
     */
    public function transparerent_woo_registration_form_callback(){
           if ( is_admin() ) return;
           if ( is_user_logged_in() ) return;

           $field = [
                'type' => 'country',
                'label' => 'Country',
                'required' => 1,
                'class' => ['address-field']
            ];


           ob_start();
         
           // NOTE: THE FOLLOWING <FORM></FORM> IS COPIED FROM woocommerce\templates\myaccount\form-login.php
           // IF WOOCOMMERCE RELEASES AN UPDATE TO THAT TEMPLATE, YOU MUST CHANGE THIS ACCORDINGLY
         
           do_action( 'woocommerce_before_customer_login_form' );
           
           $validation = $this->validateion();
           ?>
           
            <div class="woocommerce-billing-fields">
              <form method="post" class="<?php echo !empty($validation) && (isset($_POST['billing_email']) || !is_checkout()) ? 'd-block': 'd-none'; ?> woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?> >
         
                 <?php do_action( 'woocommerce_register_form_start' ); ?>
         
                 <?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
                    <?php woocommerce_form_field( 'reg_username', array( 'type' => 'text', 'label' => esc_attr__( 'Username', 'transparentcards' ), 'required' => 1, 'class' => ['username']), $_POST['reg_username'] ?? '' ); ?>
                 <?php endif; ?>
         

                 <div class="d-flex gap-10">
                    <div class="flex-1">
                        <?php woocommerce_form_field( 'billing_first_name', array( 'type' => 'text', 'label' => esc_attr__( 'First Name', 'transparentcards' ), 'required' => 1, 'class' => ['first-name']),  $_POST['billing_first_name'] ?? ''); ?>
                    </div>
                    <div class="flex-1">
                        <?php woocommerce_form_field( 'billing_last_name', array( 'type' => 'text', 'label' => esc_attr__( 'Last Name', 'transparentcards' ), 'required' => 1, 'class' => ['last-name']), $_POST['billing_last_name'] ?? '' ); ?>
                    </div>
                 </div>
                <div class="d-flex gap-10">
                <div class="flex-1">       
                        <?php woocommerce_form_field( 'billing_email', array( 'type' => 'text', 'label' => esc_attr__( 'E-mail Address', 'transparentcards' ), 'required' => 1, 'class' => ['email-address']), $_POST['billing_email'] ?? '' ); ?>
                    </div>
                    <div class="flex-1">
                        <?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                    <label for="reg_password"><?php esc_html_e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
                                    <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
                                </p>

                            <?php else : ?>

                            <p><?php esc_html_e( 'A password will be sent to your email address.', 'woocommerce' ); ?></p>

                        <?php endif; ?>       
                    </div>
                </div>

                <div class="d-flex billingAdddressField gap-10">
                    <div class="flex-1">
                        <?php woocommerce_form_field( 'billing_address_1', array( 'type' => 'text', 'placeholder' => '', 'label' => esc_attr__( 'Address 1', 'transparentcards' ), 'required' => 1, 'class' => ['billing-address-2']), $_POST['billing_address_1'] ?? '' ); ?>
                    </div>
                    <div class="flex-1">
                        <?php woocommerce_form_field( 'billing_address_2', array( 'type' => 'text', 'placeholder' => '', 'label' => esc_attr__( 'Address 2', 'transparentcards' ), 'required' => 0, 'class' => ['billing-address-2']), $_POST['billing_address_2'] ?? '' ); ?>
                    </div>
                </div>
                <div class="d-flex gap-10">
                    <div class="flex-1">
                        <?php woocommerce_form_field( 'billing_postcode', array( 'type' => 'text', 'label' => __('Post Code'), 'required' => 1, 'class' => ['billing-city']), $_POST['billing_postcode'] ?? '' ); ?>
                    </div>
                    <div class="flex-1">
                        <?php woocommerce_form_field( 'billing_city', array( 'type' => 'text', 'label' => __('Location / City'), 'required' => 1, 'class' => ['billing-city']), $_POST['billing_city'] ?? '' ); ?>
                    </div>
                </div>

                <div class="d-flex gap-10">
                    <div class="flex-1">
                        <?php woocommerce_form_field( 'billing_country', $field, $_POST['billing_country'] ?? '' ); ?>
                    </div>
                    <div class="flex-1">
                        <?php woocommerce_form_field( 'billing_state', array( 'type' => 'country', 'label' => 'Province', 'required' => 0, 'class' => ['address-field']), $_POST['billing_state'] ?? '' ); ?>
                    </div>
                </div>
                <div class="d-flex gap-10">
                    <div class="flex-1">
                        <?php woocommerce_form_field( 'billing_phone', array('type' => 'tel', 'required' => 1, 'label' => __('Telephone', 'transparentcards')), $_POST['billing_phone'] ?? '' ); ?>
                    </div>
                    <div class="flex-1">
                        <?php woocommerce_form_field( 'billing_company', array( 'type' => 'text', 'label' => esc_attr__( 'Company Name', 'transparentcards' ), 'required' => 0, 'class' => ['billing-address-2']), $_POST['billing_company'] ?? '' ); ?>
                    </div>
                    
                </div>
                 
         
                 <?php //do_action( 'woocommerce_register_form' ); ?>
         
                 <p class="woocommerce-FormRow form-row mt-10" style="margin-top:15px;">
                    <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
                    <button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>
                 </p>
         
                 <?php do_action( 'woocommerce_register_form_end' ); ?>
         
              </form>
            </div>
           <?php
          wp_enqueue_script('counry-select-js', get_site_url().'/wp-content/plugins/woocommerce/assets/js/frontend/country-select.min.js', array('jquery'), true);
          return ob_get_clean();
    }
}