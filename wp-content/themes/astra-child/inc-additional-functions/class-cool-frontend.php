<?php
// use NBD_Template_Tag;
class COOL_Frontend extends My_Design_Endpoint{
    protected $selected_sizes;
    protected $wpdb;

    public static $designendpoint = 'my-designs';

    public function __construct(){
        global $wpdb;
        $this->wpdb = $wpdb;

        add_action( 'wp_enqueue_scripts', array($this, 'registerCSS') );
        add_action( 'nbd_extra_css', array($this, 'nbd_extra_css'), 5, 1 );
        add_action( 'nbd_extra_js', array($this, 'nbd_extra_js'), 5, 1 );
        // add_action( 'init', array($this, 'reregister_taxonomy'), 11);       
        add_action( 'wp_loaded', array($this, 'plugin_loaded'), 50 );
    
        // Add sticky add to cart 
        add_action( 'nbo_most_bottom_hook', array($this, 'sticky_product_details_information') );

        // Additional section for nb design 
        add_action('nbd_editor_extra_tab_content', array($this, 'nbdesign_additional_angular_component'), 5, 1);

        // Override dynamic css 
        // add_filter( 'printcart_css_inline', array($this, 'dynamic_css_override'));

        /* Printing information tab */
        add_filter( 'woocommerce_product_tabs', array( $this, 'additional_printing_tab' ) );

        // Add additional taxonoly for design templates 
        add_action( 'nbd_modern_extra_popup', array($this, 'coolcards_additional_taxonomy_controller'), 10, 2 );
        
        add_action( 'nbd_js_config', array( $this, 'coolcards_js_config' ) );

        add_filter( 'nbd_product_info', array( $this, 'template_info' ), 12, 1 );
        
        remove_shortcode( 'nbdesigner_gallery' );

        add_shortcode( 'nbdesigner_gallery', array($this,'nbd_gallery_func') );

        add_action( 'coolcard_gallery_filter', array( $this, 'gallery_tag_filter' ), 0, 10 );

        add_action( 'nbd_modern_extra_stages', array($this, 'remove_template_side_buttons'), 0, 5 );

       
        // add_filter( 'nbd_product_templates', array( $this, 'templates_info' ), 15, 2 );

        

        add_filter( 'litespeed_ucss_per_pagetype', '__return_true' );
        add_filter( "litespeed_media_ignore_remote_missing_sizes", "__return_true" );

        add_action( 'nbd_modern_before_design_wrap', array($this, 'add_additional_transperent_glassy_effect') );

        
        add_action( 'wp_ajax_nbd_get_next_gallery_page', array($this, 'nbd_get_next_gallery_page'), 5);
        add_action( 'wp_ajax_nopriv_nbd_get_next_gallery_page', array($this, 'nbd_get_next_gallery_page'), 5);
        

        add_filter( 'woocommerce_cart_item_remove_link', array($this, 'nbd_customize_cart_item_remove'), 150, 2 );

        // Add additional data to $args in  cart pages
        add_filter( 'woocommerce_quantity_input_args', array($this, 'transparent_additional_parameters'), 10, 2);

        add_filter( 'woocommerce_account_orders_columns', array($this, 'add_account_orders_delivery_date_column'), 10, 1 );

        add_action( 'woocommerce_my_account_my_orders_column_delivery-date', array($this, 'transparentcard_add_deliverydate_value') );

        add_filter( 'nbo_show_edit_option_link_in_cart', '__return_false' ); // Remove edit button from produt title in cart page

        add_filter( 'woocommerce_cart_item_name', '__return_false' ); // Remove edit button from produt title in cart page

        add_action( 'woocommerce_after_cart', array($this, 'script_after_cart_callback') );

        
        add_action( 'wp_footer', array($this, 'transparentcard_cart_refresh_update_qty') ); 

        remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form');
        // remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10 );

        add_action( 'woocommerce_checkout_shipping', 'woocommerce_checkout_coupon_form' );

        add_filter( 'nbd_js_object', array($this, 'nbd_js_object') );

        add_filter( 'woocommerce_account_menu_items', array($this, 'transparentcards_remove_my_account_dashboard') );
        add_action( 'template_redirect', array($this, 'transparentcards_redirect_to_orders_from_dashboard') );

        // remove skip link
        remove_action( 'wp_footer', 'the_block_template_skip_link' );

        add_filter( 'wp_mail_from', array($this, 'transparent_mail_from') );

        add_filter( 'wp_mail_from_name', array($this, 'transparent_mail_from_name') );

        add_filter('query_vars', array($this, 'add_query_vars'), 50);
        add_filter('woocommerce_account_menu_items', array($this, 'remove_mydesign_from_myuAccount'));

        add_filter( 'media_send_to_editor', array($this, 'trnsparent_add_title_attribute_to_images'), 15, 2 ); // Filter image tag to add additional attributes for override Rankmath methods
        add_filter( 'wp_get_attachment_image_attributes', array($this, 'transparent_add_title_attribute_to_featured_images'), 10, 2 );

        add_action('woocommerce_add_to_cart', array($this, 'transparentcard_additional_cart_item_add'), 5, 6);

        add_filter( 'woocommerce_add_cart_item_data', array($this, 'transparentcard_add_cart_item_data'), 80, 3 );

        add_filter( 'woocommerce_get_item_data', array( $this, 'get_item_data' ), 15, 2 );

        add_action( 'woocommerce_checkout_create_order_line_item', array( $this, 'order_line_item' ), 55, 3 );
        
        add_action( 'wp', array($this, 'wp_add_cart_from_templatepage') );

        add_action( 'woocommerce_cart_calculate_fees', array( $this, 'add_cart_fee' ), 1, 1 );

        add_action('woocommerce_before_calculate_totals', array($this, 'transparentcard_set_price_in_cart'), 5, 1);

        
      


        add_action( 'wp_head', function(){


                // $files = get_option( 'ajax_test', array() );
                // $_nbd_item_key = WC()->session->get('nbd_item_key_2720');  

                // echo 'keyis: ' . $_nbd_item_key . '<br/>';

                // echo 'diris <br/><pre>';
                // print_r($files);
                // echo '</pre>';



            
        } );
    }


    /**
     * Set custom price to product unit price for template custom items 
     * 
     * @param object
     * 
     * @return object
     */
    public function transparentcard_set_price_in_cart($cart){
        foreach ($cart->get_cart() as $cart_item) {
            if (isset($cart_item['nbo_unit_price'])) {
                $cart_item['data']->set_price($cart_item['nbo_unit_price']);
            }
        }
    }




    /**
     * Update custom cart post 
     */
    public static function updatecart_item_data($cart_item_key, $product_id, $quantity, $variation_id, $variation, $cart_item_data){
        return self::ajax_post_handler($cart_item_data);
    }

    /** 
     * Add additional charge as service charge 
     * @return init
     * 
     * @param object
     * */
    public function add_cart_fee($cart_object){
        if ( is_array( $cart_object->cart_contents ) ) {
            $fee_name = '';
            $fee_price = 0;
            $tax = false;
            $tax_status = '';
            foreach ( $cart_object->cart_contents as $key => $value ) {

                if(isset($value['nbo_additional_meta']['service_total']) && !empty($value['nbo_additional_meta']['service_total'])){

                    $cart_item_fee  = $value['nbo_additional_meta']['service_total'];
                    $fee_name       = __('Design Service Fee', 'web-to-print-online-designer');
                    $product        = $value["data"];
                    $tax_class      = $product->get_tax_class();
                    $tax_status     = $product->get_tax_status();
                    if ( get_option( 'woocommerce_calc_taxes' ) == "yes" && $tax_status == "taxable" ) {
                        $tax = TRUE;
                    } else {
                        $tax = FALSE;
                    }
                    //$fee_price = $this->cacl_fee_price( $cart_item_fee['value'], $product );
                    $fee_price_temp  = $this->cacl_fee_price( $value['nbo_additional_meta']['service_total'], $product );
                    $fee_price += $fee_price_temp;
                    
                }
            }

            if($fee_price > 0){
                $cart_object->add_fee( $fee_name, $fee_price, $tax, $tax_status );
            }
        }
    }


    public function cacl_fee_price( $price = "", $product = "" ){
        global $woocommerce;
        $taxable    = $product->is_taxable();
        $tax_class  = $product->get_tax_class();
        if ( $taxable ) {
            if ( get_option( 'woocommerce_prices_include_tax' ) === 'yes' ) {
                $tax_rates  = WC_Tax::get_base_tax_rates( $tax_class );
                $taxes      = WC_Tax::calc_tax( $price, $tax_rates, TRUE );
                $price      = WC_Tax::round( $price - array_sum( $taxes ) );
            }
            return $price;
        }
        return $price;
    }


    /**
     * Add cart item from tempalTE PAGE
     */
    public function wp_add_cart_from_templatepage(){
        if ( isset($_POST['custom_upload_nonce']) && wp_verify_nonce($_POST['custom_upload_nonce'], 'custom_upload_action') ) {
            if (!WC()->cart) {
                WC()->cart = new WC_Cart();
            }
                     
            // Nonce is valid, process form data
            $product_id = intval($_POST['product_id']);
            $quantity = intval($_POST['quantity']);
        
            // Add product to cart
            $cart_item_key = WC()->cart->add_to_cart($product_id, $quantity);
            $nbu_item_session = WC()->session->get('nbu_item_key_'.$product_id);

            // Redirect to cart or checkout page
            wp_safe_redirect(wc_get_cart_url());
            exit;
        }
    }


    /**
     * Create order line item if add cart item from template 
     * 
     * @return html
     */
    public function order_line_item($item, $cart_item_key, $values){
        if ( isset( $values['nbo_cus_meta'] ) ) {
            $decimals = nbdesigner_get_option('nbdesigner_number_of_decimals', 2);
            $hide_option_price = nbdesigner_get_option('nbdesigner_hide_option_price_in_order', 'no');
            foreach ($values['nbo_cus_meta']['option_price']['fields'] as $field) {
                if( !isset( $field['published'] ) || $field['published'] == 'y' ){
                    $price = floatval($field['price']) >= 0 ? '+' . wc_price($field['price'], array( 'decimals' => $decimals )) : wc_price($field['price'], array( 'decimals' => $decimals ));
                    if( isset($field['is_upload']) ){
                        if (strpos($field['val'], 'http') !== false) {
                            $file_url = $field['val'];
                        }else{
                            $file_url = Nbdesigner_IO::wp_convert_path_to_url( NBDESIGNER_UPLOAD_DIR . '/' .$field['val'] );
                        }
                        $field['value_name'] = '<a href="' . $file_url . '">' . $field['value_name'] . '</a>';
                    }
                    $post_fix = '';
                    if( isset($field['ind_qty']) ){
                        $post_fix = '<small>'. __('( cart fee )', 'web-to-print-online-designer') .'</small>';
                    }
                    if( isset( $field['fixed_amount'] ) ){
                        $post_fix = '<small>'. __('( for all items )', 'web-to-print-online-designer') .'</small>';
                    }
                    $display_price = $hide_option_price == 'no' ? $price.$post_fix : '';
                    $item->add_meta_data( $field['name'], $field['value_name']. '&nbsp;&nbsp;' . $display_price );
                }
            }
            if( floatval( $values['nbo_cus_meta']['option_price']['discount_price'] ) > 0 ){
                $item->add_meta_data( __('Quantity Discount', 'web-to-print-online-designer'), '-' . wc_price( $values['nbo_cus_meta']['option_price']['discount_price'], array( 'decimals' => $decimals ) ) );      
            }
            $item->add_meta_data('_nbo_option_price', $values['nbo_cus_meta']['option_price']);
        }

        if ( isset( $values['nbo_cus_files'] ) ) {

            // update_option( 'ajax_test', array('ttfiles' => $values['nbo_cus_files']) );

            foreach($values['nbo_cus_files'] as $k => $singleFiles):
                $title = match ($k) {
                     'design_images' => esc_attr( __('Other images in your design') ),
                     'uploaded_files' => esc_attr( __('Uploaded Files') ), 
                     'logo_ideas' => esc_attr( __('Images for use in Design') ), 
                     'logo_file' => esc_attr(__('Logo File')), 
                     default => ucwords( str_replace('_', ' ', $k) )
                };

                $value = [];
                foreach($singleFiles as $singleitem){
                    $url = wp_upload_dir()['baseurl'] . $singleitem['url'];

                    $imgUrl = match ($singleitem['type']) {
                        'application/pdf' => get_stylesheet_directory_uri(  ) . '/assets/img/pdf.png',
                        default => $url,
                    };

                    $value[] = sprintf('<a class="order-img" download href="%s"><img src="%s"/></a>', $url, $imgUrl );                
                }
                
                $item->add_meta_data( $title, implode('', $value));

            endforeach;
        }

        /** Additional meta for hire a designer */
        if(isset($values['nbo_additional_meta'])){
            foreach($values['nbo_additional_meta'] as $s => $singleAdditional){
                if(in_array($s, array('service_total', 'pid') ) ) continue;

                $title = str_replace('_', ' ', $s);
                $title = ucwords($title);

                $singlevalue = match ($s) {
                     'colors' => color_to_html($singleAdditional),
                     'business_category' => selected_business_category($singleAdditional),
                     default  => $singleAdditional,
                };

                $item->add_meta_data( $title, $singlevalue);
            }
        }
    }

    /**
     * Get product item data 
     * @param array 
     * @param array
     * 
     * @return array
     */
    public function get_item_data( $item_data, $cart_item ){

        // update_option( 'oamrtest', $cart_item );
        if ( isset( $cart_item['nbo_cus_meta'] ) ) {
            $hide_zero_price = nbdesigner_get_option('nbdesigner_hide_zero_price');
            $num_decimals = absint( wc_get_price_decimals() );
            if( nbdesigner_get_option('nbdesigner_hide_options_in_cart') != 'yes' ){
                $hide_option_price = nbdesigner_get_option('nbdesigner_hide_option_price_in_cart', 'no');
                $decimals = nbdesigner_get_option('nbdesigner_number_of_decimals', 2);

                
                

                foreach ($cart_item['nbo_cus_meta']['option_price']['fields'] as $field) {
                    if( isset( $field['published'] ) && $field['published'] == 'y' ){
                        $price = floatval($field['price']) >= 0 ? '+' . wc_price( $field['price'], array( 'decimals' =>  $decimals ) ) : wc_price($field['price'], array( 'decimals' => $decimals ));
                        if( $hide_zero_price == 'yes' && round($field['price'], $num_decimals) == 0 ) $price = '';
                        if( isset($field['is_upload']) ){
                            if (strpos($field['val'], 'http') !== false) {
                                $file_url = $field['val'];
                            }else{
                                $file_url = Nbdesigner_IO::wp_convert_path_to_url( NBDESIGNER_UPLOAD_DIR . '/' .$field['val'] );
                            }
                            $field['value_name'] = '<a href="' . $file_url . '">' . $field['value_name'] . '</a>';
                        }
                        $post_fix = '';
                        if( isset($field['ind_qty']) ){
                            $post_fix = '<small>'. __('( cart fee )', 'web-to-print-online-designer') .'</small>';
                        }
                        if( isset( $field['fixed_amount'] ) ){
                            $post_fix = '<small>'. __('( for all items )', 'web-to-print-online-designer') .'</small>';
                        }
                        $item_data[] = array(
                            'name'      => $field['name'],
                            'display'   => $hide_option_price == 'yes' ? $field['value_name'] : $field['value_name']. '&nbsp;&nbsp;' . $price .$post_fix,
                            'hidden'    => false
                        );
                    }
                }

                
            }
        }
        return $item_data;
    }


    /**
     * Add product order meta item
     * 
     * @param array
     * @param init
     * @param init
     */
    public function transparentcard_add_cart_item_data($cart_item_data, $product_id, $variation_id){
        if ( isset($_POST['custom_upload_nonce']) && wp_verify_nonce($_POST['custom_upload_nonce'], 'custom_upload_action') ) {
            $product_id = intval($_POST['product_id']);

            $option_id = get_transient( 'nbo_product_'.$product_id );
            
            $selectedOptions = $_GET['options'];
            $selectedOptions = explode(',', $selectedOptions);

            $_options = NBD_FRONTEND_PRINTING_OPTIONS::get_option( $option_id );
            $options = unserialize( $_options['fields'] );


            
            $nbo_meta = array();
            foreach($selectedOptions as $so):
                $_so = explode('-', $so);
                $_key = array_search($_so[0], array_column($options['fields'], 'id'));
                $nbo_meta['option_price']['fields'][$_so[0]] = array(
                    'name' => $options['fields'][$_key]['general']['title'], 
                    'value_name' => $options['fields'][$_key]['general']['attributes']['options'][$_so[1]]['name'], 
                    'published' => $options['fields'][$_key]['general']['published'] ?? 'y', 
                    'price' => 0, 
                    'is_pp' => 0, 
                    'val' => 0
                );
            endforeach;

            if(isset($_POST['unit_price'])){
                $cart_item_data['nbo_unit_price'] = $_POST['unit_price'];    
            }


            $cart_item_data['nbo_cus_meta'] = $nbo_meta;

        }

        /** Ajax post */
        $cart_item_data = self::ajax_post_handler($cart_item_data);
        

        return $cart_item_data;
    }


    public static function ajax_post_handler($cart_item_data){
        if (isset($_POST['hire_a_designer_nonce']) && wp_verify_nonce($_POST['hire_a_designer_nonce'], 'hire_a_designer_action')) {
            $product_id = intval($_POST['pid']);
            $option_id = get_transient( 'nbo_product_'.$product_id );

            $selectedOptions = $_POST['options'];
            $selectedOptions = explode(',', $selectedOptions);

            $_options = NBD_FRONTEND_PRINTING_OPTIONS::get_option( $option_id );
            $options = unserialize( $_options['fields'] );

            
            if(isset($_POST['unit_price'])){
                $cart_item_data['nbo_unit_price'] = $_POST['unit_price'];    
            }

            $user_id = $_POST['userid'];

            
            $filereturn = array();

            if(isset($cart_item_data['tcu_folder'])){
                $nhkey = str_replace('hire_a_designer_', '', $cart_item_data['tcu_folder']);
            }else{
                $nhkey =  substr(md5(uniqid()),0,5).rand(1,100).time();
                $nhkey = $nhkey . '_' . $user_id;
                $cart_item_data['tcu_folder'] = 'hire_a_designer_' . $nhkey;
            }

            
            if(count($_FILES) > 0){    
                foreach($_FILES as $key => $files){
                    if(!is_array($files['error']) && (int)$files['error'] > 0) continue;

                    $filereturn[$key] = upload_transparent_file_to_directory($files, $nhkey);
                }
            }
            

            $nbo_meta = array();
            foreach($selectedOptions as $so):
                $_so = explode('-', $so);
                $_key = array_search($_so[0], array_column($options['fields'], 'id'));
                $nbo_meta['option_price']['fields'][$_so[0]] = array(
                    'name' => $options['fields'][$_key]['general']['title'], 
                    'value_name' => $options['fields'][$_key]['general']['attributes']['options'][$_so[1]]['name'], 
                    'published' => $options['fields'][$_key]['general']['published'] ?? 'y', 
                    'price' => 0, 
                    'is_pp' => 0, 
                    'val' => 0
                );
            endforeach;





            /** Process additional data */
            $nbo_additional_data = [];

            foreach($_POST as $k => $singlepost){
                if( in_array($k, array( 'action', 'userid', 'quantity', 'options', 'size', '_wp_http_referer', 'pid', 'hire_a_designer_nonce', 'unit_price', 'uploaded_files', 'logo_ideas', 'design_images' )) ) continue;

                if(is_array($singlepost))
                    $singlepost = implode(', ', $singlepost);

                $nbo_additional_data[$k] = $singlepost;
            }
            
            $cart_item_data['nbo_additional_meta'] = $nbo_additional_data;

            $cart_item_data['nbo_cus_meta'] = $nbo_meta;

            if(count($filereturn) > 0)
                $cart_item_data['nbo_cus_files'] = $filereturn;

            $cart_item_data['form_source'] = $_POST['_wp_http_referer'] ?? '';
        }
        return $cart_item_data;
    }

    /**
     * Additional cart item add 
     * 
     */
    public function transparentcard_additional_cart_item_add($cart_item_key, $product_id, $quantity, $variation_id, $variation, $cart_item_data){
        if ( isset($_POST['custom_upload_nonce']) && wp_verify_nonce($_POST['custom_upload_nonce'], 'custom_upload_action') ) {

            if (!WC()->cart) {
                WC()->cart = new WC_Cart();
            }
                  
            
            $nbd_item_cart_key  = ( $variation_id > 0 ) ? $product_id . '_' . $variation_id : $product_id;

            $unique_cart_item_key = md5( microtime() . rand() );
            $nbu_item_session = WC()->session->get('nbu_item_key_cust_'.$nbd_item_cart_key);
            $nbu_item_key = isset($nbu_item_session) ? $nbu_item_session : substr(md5(uniqid()),0,5).rand(1,100).time(); 
            

            WC()->session->set( $cart_item_key. '_nbu', $nbu_item_key );
     

            // if( $nbu_item_session && isset( $_POST['nbd-upload-files'] ) ){
            //     $files = wc_clean( $_POST['nbd-upload-files'] );
            //     $this->update_files_upload( $files, $nbu_item_session );
            // }

             // Get the current cart
            $cart = WC()->cart;

            // Get the cart item
            $cart_item = $cart->get_cart_item($cart_item_key);

            $cart_item['unique_key']   = $unique_cart_item_key;

            if( isset( $nbu_session ) ) $cart_item['nbd_item_meta_ds']['nbu'] = $nbu_session;

            // Update the cart item
            $cart->cart_contents[$cart_item_key] = $cart_item;

            // Save the cart
            WC()->session->set('cart', $cart->cart_contents);

        }



        //** Hire a designer action process */
        if (isset($_POST['hire_a_designer_nonce']) && wp_verify_nonce($_POST['hire_a_designer_nonce'], 'hire_a_designer_action')) {
            $unique_cart_item_key           = md5( microtime() . rand() );

            $cart = WC()->cart;

            // Get the cart item
            $cart_item = $cart->get_cart_item($cart_item_key);


            $cart_item['unique_key']   = $unique_cart_item_key;
            // Update the cart item
            $cart->cart_contents[$cart_item_key] = $cart_item;
            
            // Save the cart
            WC()->session->set('cart', $cart->cart_contents);
        }
    }


    /**
     * File upload
     */
    public function update_files_upload( $files, $nbu_session = '' ){
        if( isset( $_POST['nbu-ignore-update'] ) ) return;
        $files          = explode( '|', $files );
        $path           = NBDESIGNER_UPLOAD_DIR . '/' . $nbu_session;
        $list_files     = Nbdesigner_IO::get_list_files( $path );
        foreach ( $list_files as $file ){
            $filename = basename( $file );
            if( !in_array( $filename, $files ) ){
                unlink( $path . '/' . $filename );
            }
        }
    }


    /**
     * Add additional attribute to img tag 
     * 
     * @access public 
     * @param string
     * @param init
     * @return html
     */
    public function transparent_add_title_attribute_to_featured_images($attr, $attachment = null){
        if ( ! empty( $attachment ) ) {
            $attr['title'] = get_post( $attachment->ID )->post_title;
        }
        
        return $attr;
    }

    /**
     * Customize and add title attribute to img tag
     * 
     * @access public
     * @param string
     * @param init
     * @return html
     */
    public function trnsparent_add_title_attribute_to_images($html, $id){
        $attachment = get_post( $id );
        $title = $attachment->post_title;
      
        return str_replace( '<img', '<img title="' . esc_attr( $title ) . '"', $html );
    }


    /**
     * Remove mydesign from my account page
     * 
     */
    public function remove_mydesign_from_myuAccount($items){
        unset($items[self::$designendpoint]);
        return $items;
    }

    /**
     * Remove my-design menu from
     */
    public function add_query_vars($vars){
        unset($vars['my_designs']);
        return $vars;
    }



    /**
     * Set notification mail from name 
     * 
     * @access public
     * @param string
     */
    public function transparent_mail_from_name($from_name){
        return get_bloginfo( 'name' );
    }

    /**
     * @access public
     * @param string
     * 
     * Re-write wp from email
     */
    public function transparent_mail_from($from_email){
        return get_bloginfo( 'admin_email' );
    }



    /**
     * redirect my-account default page to order menu
     */
    public function transparentcards_redirect_to_orders_from_dashboard(){

        // file upload
        


        if( is_account_page() && empty( WC()->query->get_current_endpoint() ) ){
            wp_safe_redirect( wc_get_account_endpoint_url( 'orders' ) );
            exit;
        }
    }

    /**
     * Remove dashboad and download item from my-account page 
     * @param array
     * @return array
     */
    public function transparentcards_remove_my_account_dashboard($menu_links){
        unset( $menu_links[ 'dashboard' ] );
        unset( $menu_links[ 'downloads' ] );
	    return $menu_links;
    }

    /**
     * Add additional local js variable for product page use 
     * @param array
     * @return array
     */
    public function nbd_js_object($args){

        $paper_orientations = get_terms( 'orientation', 'hide_empty=0' );
        $orientations = array();
        foreach($paper_orientations as $s):
            $orientations[$s->slug] = $s->term_id;
        endforeach;
        $args['orientations'] = $orientations;
        return $args;
    }


    /**
     * Add additional html for show upload popup in template page
     * 
     * @access public 
     * 
     */
    public function coolcard_upload_wrap(){
            $site_url = site_url();
            $pid = $_GET['pid'] ?? 0;
            $variation_id   = 0;

            $settings = get_post_meta( $pid, '_designer_setting', true );
            $settings = unserialize( $settings );


            if ( class_exists( 'SitePress' ) ) {
                $site_url = home_url();
            }
            $is_nbdesign    = get_post_meta( $pid, '_nbdesigner_enable', true ); 

            if($is_nbdesign){
                $product    = wc_get_product( $pid );
                $type       = $product->get_type();
                $option = unserialize( get_post_meta( $pid, '_nbdesigner_option', true ) );

                $src = add_query_arg( array( 'action' => 'nbdesigner_editor_html', 'product_id' => $pid ), $site_url . '/' );
                if( isset( $_GET['variation_id'] ) &&  $_GET['variation_id'] != '' ){
                    $src .= '&variation_id='. absint( $_GET['variation_id'] );
                }
                if( isset( $_GET['nbds-ref'] ) ){
                    $src .= '&reference='. $_GET['nbds-ref'];
                }
                if( isset( $_GET['nbo_cart_item_key'] ) && $_GET['nbo_cart_item_key'] !='' ){
                    $nbd_item_key = WC()->session->get( $_GET['nbo_cart_item_key'] . '_nbd' );
                    if( $nbd_item_key ) {
                        $src .= '&task=edit&nbd_item_key=' . $nbd_item_key . '&cik=' . $_GET['nbo_cart_item_key'];
                    }
                }
                if( $variation_id != 0 ){
                    $src .= '&variation_id='. $variation_id;
                }
                if( $type == 'variable' && isset( $option['bulk_variation'] ) && $option['bulk_variation'] == 1 ){
                    $src .= '&variation_id=0';
                }
                if( isset( $_GET['nbo_cart_item_key'] ) && $_GET['nbo_cart_item_key'] != '' ){
                    $src .= '&nbo_cart_item_key=' . $_GET['nbo_cart_item_key'];
                }

                get_template_part( 'part/upload', 'popup', array('src' => $src, 'pid' => $pid, 'option' => $option, 'settings' => $settings) );
            }

    }


    /**
     * Auto update cart while change 
     */

    public function transparentcard_cart_refresh_update_qty(){
        $nbdesigner_gallery_page_id = nbd_get_page_id( 'gallery' );
        $current_page_id = get_the_ID();
        
        if($nbdesigner_gallery_page_id == $current_page_id)
            $this->coolcard_upload_wrap();
        

        if ( is_cart() || ( is_cart() && is_checkout() ) ) {
            wc_enqueue_js( "
               jQuery('div.woocommerce').on('change', 'select#qty_transparentcard_selection', function(){
                  jQuery('[name=\'update_cart\']').trigger('click');
               });
            " );
         }
    }

    /**
     * JS script after cart page 
     * 
     * @return  script
     * @param null
     */
    public function script_after_cart_callback(){
        ob_start();
        ?>
            <script>
                var openDetails = function($product_id = 0){
                    jQuery(document.body).find('#popup-details-'+$product_id+'.cart-product-details-popup').toggleClass('open');
                }
            </script>
        <?php
        echo ob_get_clean();
    }


    /**
     * Item duplicate
     * 
     * @param array $cart_item
     * @param string $cart_item_key
     * 
     * @return url
     */

    public static function copy_transparent_design($cart_item = array(), $cart_item_key = ""){
        
        $nbd_session = WC()->session->get($cart_item['key'] . '_nbd');

        if( isset($cart_item['nbd_item_meta_ds']) ){
            if( isset($cart_item['nbd_item_meta_ds']['nbd']) ) $nbd_session = $cart_item['nbd_item_meta_ds']['nbd'];
            if( isset($cart_item['nbd_item_meta_ds']['nbu']) ) $nbu_session = $cart_item['nbd_item_meta_ds']['nbu'];
        }


        $orientation = 'horizontal';
        $orientation_value = $cart_item['nbo_meta']['option_price']['fields'];

        $valuearray = array_filter($orientation_value, function($el){
            return ( strpos(strtolower($el['name']), 'orientation') !== false );
        });
        $valuearray = array_values($valuearray);
        if($valuearray){
            $orientation = strtolower($valuearray[0]['value_name']);
        }

        $html = '';
        $html .= '<div class="nbd-cart-copy-order-item nbd-cart-item-copy-Item mt-0" style="margin-top:0; height: 100%;">';
        $html .=    '<a class="button nbd-copy-orderItem duplicate_cart_item" data-orientation="'.$orientation.'" data-design_folder="'.$nbd_session.'" data-item_key="'.$cart_item_key.'"  href="#"><span>' . __('Add new', 'transparentcard') . '</span></a>';
        $html .= '</div>';
        echo $html;
    }


    /**
     * Get nbd edit link
     * 
     * @return link
     * @param cart_item
     * @param string $cart_item_key
     */

    public static function upload_transparent_design($cart_item = array(), $cart_item_key = ""){
        $product_id                     = $cart_item['product_id'];
        $variation_id                   = $cart_item['variation_id'];
        $_enable_upload                 = get_post_meta($product_id, '_nbdesigner_enable_upload', true);
        $_enable_upload_without_design  = get_post_meta($product_id, '_nbdesigner_enable_upload_without_design', true);

        $id = 'nbd' . $cart_item_key;     
        $redirect = is_cart() ? 'cart' : 'checkout';
        $link_create_design = add_query_arg(
            array(
                'task'          => 'new',
                'task2'         => 'add_file',
                'product_id'    => $product_id,
                'variation_id'  => $variation_id,
                'cik'           => $cart_item_key,
                'rd'            => $redirect),
            getUrlPageNBD('create'));
        $link_upload_design = apply_filters('nbu_cart_item_upload_link', $link_create_design, $cart_item, $cart_item_key, $redirect);
        $html .= '<div class="nbd-cart-upload-file nbd-cart-item-upload-file mt-0 h-100" style="margin-top:0; height: 100%;">';
        $html .=    '<a class="button nbd-upload-design" href="' . $link_upload_design . '">' . esc_html__('Design hochladen', 'web-to-print-online-designer') . '</a>';
        $html .= '</div>';
        echo $html;
    }



    /**
     * Get design previw
     * @param array $_cart_item
     * @param string $caart_item_key
     * 
     * @return preview url
     */
    public static function  get_design_preview($cart_item = array(), $cart_item_key = "", $high_resulation = false){
        $src = '';
        if ($cart_item_key ) {

            $nbd_session = WC()->session->get($cart_item_key . '_nbd');

            if(empty($nbd_session))
                $nbd_session = isset($cart_item['nbd_item_meta_ds']) && isset($cart_item['nbd_item_meta_ds']['nbd']) ? $cart_item['nbd_item_meta_ds']['nbd'] : '';
            

            $dir = NBDESIGNER_CUSTOMER_DIR . '/' . $nbd_session;
            if( isset( $nbd_session ) && !empty($nbd_session) && file_exists($dir) ){
                $list   = Nbdesigner_IO::get_list_images( $dir );
                $list   = nbd_sort_file_by_side( $list );
                $list = array_values($list);
                $path = $high_resulation ? $list[0] : $list[1];
                
                $src    = Nbdesigner_IO::convert_path_to_url( $path ) . '?&t=' . round( microtime( true ) * 1000 );
                
            }
        }
        return $src;
    }




    /**
     * Get cart item transparent card orientation
     * 
     * @param array
     * @return string
     */
    public static function get_transparent_card_orientation_by_cart_item($cart_item){
        $orientation = 'horizontal';
        $orientation_value = isset($cart_item['nbo_meta']) ? $cart_item['nbo_meta']['option_price']['fields'] : array();       
        
        $valuearray = array_filter($orientation_value, function($el){
            return ( strpos(strtolower($el['name']), 'orientation') !== false );
        });
       

        $valuearray = array_values($valuearray);
        if($valuearray){
            $orientation = strtolower($valuearray[0]['value_name']);
        }
        return $orientation;
    }



    /**
     * Get nbd edit link
     * 
     * @return link
     * @param cart_item
     * @param string $cart_item_key $title = null, $cart_item = null, $cart_item_key = null 
     */
    public static function get_nbd_edit_link($title = null, $cart_item = array(), $cart_item_key = ""){

        $nbd_session = WC()->session->get($cart_item_key . '_nbd');
        $nbu_session = WC()->session->get($cart_item_key . '_nbu');


        if( isset($cart_item['nbd_item_meta_ds']) ){
            if( isset($cart_item['nbd_item_meta_ds']['nbd']) ) $nbd_session = $cart_item['nbd_item_meta_ds']['nbd'];
            if( isset($cart_item['nbd_item_meta_ds']['nbu']) ) $nbu_session = $cart_item['nbd_item_meta_ds']['nbu'];
        }


        $orientation = self::get_transparent_card_orientation_by_cart_item($cart_item);
        

        // $m_array = preg_grep('/^green\s.*/', $orientation_value);
  
        $_show_design                   = nbdesigner_get_option('nbdesigner_show_in_cart', 'yes');
        $_show_design                   = apply_filters( 'nbd_show_design_section_in_cart', $_show_design, $cart_item );
        $enable_edit_design             = nbdesigner_get_option('nbdesigner_show_button_edit_design_in_cart', 'yes') == 'yes' ? true : false;
        $show_edit_link                 = apply_filters('nbd_show_edit_design_link_in_cart', $enable_edit_design, $cart_item);
        
        $product_id                     = $cart_item['product_id'];
        $variation_id                   = $cart_item['variation_id'];
        $product_id                     = get_wpml_original_id( $product_id );
        $is_nbdesign                    = get_post_meta($product_id, '_nbdesigner_enable', true);

        $_enable_upload                 = get_post_meta( $product_id, '_nbdesigner_enable_upload', false );
        $_enable_upload_without_design  = get_post_meta($product_id, '_nbdesigner_enable_upload_without_design', true);

      
        $_product                       = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
        $product_permalink              = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );            
        if ( $is_nbdesign && $_show_design == 'yes' ) {
            if(strpos($title, 'nbd-custom-dsign nbd-cart-item-design') !== false) return $title;
            if($nbd_session || $nbu_session){
                $html = is_checkout() ? $title . ' &times; <strong>' . $cart_item['quantity'] .'</strong>' : $title;
            }else{
                $html = $title;
            }
            $layout = nbd_get_product_layout( $product_id );

        
           

            if( isset( $nbd_session ) ){
                $id             = 'nbd' . $cart_item_key;
                $redirect       = is_cart() ? 'cart' : 'checkout';
               
                if( $show_edit_link ){

                    $args = array(
                        'task'              => 'edit',
                        'product_id'        => $product_id,
                        'nbd_item_key'      => $nbd_session,
                        'cik'               => $cart_item_key,
                        'view'              => $layout,
                        'rd'                => $redirect, 
                        'source'            => 'cart', 
                        'orientation'       => $orientation, 
                        'trns_nbd_design_id' => $cart_item['nbd_design_id']
                    );

                    $link_edit_design = add_query_arg(
                        $args,
                        getUrlPageNBD('create'));
                    if( $product_permalink ){
                        $att_query = parse_url( $product_permalink, PHP_URL_QUERY );
                        $link_edit_design .= '&'.$att_query;
                    }    
                    if( $layout == 'v' ){
                        $link_edit_design = add_query_arg(
                            array(
                                'nbdv-task'     => 'edit',
                                'task'          => 'edit',
                                'product_id'    => $product_id,
                                'nbd_item_key'  => $nbd_session,
                                'cik'           => $cart_item_key,
                                'rd'            => $redirect),
                            $product_permalink );
                    }
                    if($cart_item['variation_id'] > 0){
                        $link_edit_design .= '&variation_id=' . $cart_item['variation_id'];
                    }
                    // $link_edit_design .= '&source=cart&orientation=' . $orientation . '&trns_nbd_design_id=' . $cart_item['nbd_design_id'];

                    $html .= '<a class="button nbd-edit-design" href="'.$link_edit_design.'"><span>'. esc_html__('Edit design', 'web-to-print-online-designer') .'</span></a>';
                }
            }else if(!isset($cart_item['nbd_item_meta_ds']['nbu']) && !isset($cart_item['nbo_cus_meta'])  && $is_nbdesign && !$_enable_upload_without_design && $show_edit_link ){
                
                // echo 'inside not isset nbu <br/>';

                $id = 'nbd' . $cart_item_key; 
                $redirect = is_cart() ? 'cart' : 'checkout';
                $link_create_design = add_query_arg(
                    array(
                        'task'          => 'new',
                        'task2'         => 'update',
                        'product_id'    => $product_id,
                        'variation_id'  => $variation_id,
                        'cik'           => $cart_item_key,
                        'view'          => $layout,
                        'rd'            => $redirect),
                    getUrlPageNBD('create'));
                if( $layout == 'v' ){
                    $link_create_design = add_query_arg(
                        array(
                            'nbdv-task'     => 'new',
                            'task'          => 'new',
                            'task2'         => 'update',
                            'product_id'    => $product_id,
                            'variation_id'  => $variation_id,
                            'cik'           => $cart_item_key,
                            'view'          => $layout,
                            'rd'            => $redirect),
                        $product_permalink );
                }
                if( $product_permalink ){
                    $att_query = parse_url( $product_permalink, PHP_URL_QUERY );
                    $link_create_design .= '&'.$att_query;
                }
               
                $html .=    '<a class="button nbd-create-design" href="' . $link_create_design . '">'. esc_html__('Add design', 'web-to-print-online-designer') .'</a>';

            }
            if( isset( $nbu_session ) ){
                // echo 'inside not isset nbu session <br/>';
                $id             = 'nbu' . $cart_item_key; 
                $redirect       = is_cart() ? 'cart' : 'checkout';
                $html          .= '<div id="'.$id.'" class="nbd-cart-upload-file nbd-cart-item-upload-file mt-0 h-100">';
                $remove_upload  = is_cart() ? '<a class="remove nbd-cart-item-remove-file" href="#" data-type="upload" data-cart-item="' . $cart_item_key . '">&times;</a>' : '';
                // $html          .= '<p>' . esc_html__('Upload file', 'web-to-print-online-designer') . $remove_upload . '</p>';
                $files          = Nbdesigner_IO::get_list_files( NBDESIGNER_UPLOAD_DIR . '/' . $nbu_session );
                $create_preview = nbdesigner_get_option('nbdesigner_create_preview_image_file_upload');
                $upload_html    = '';
                foreach ( $files as $file ) {
                    $ext        = pathinfo( $file, PATHINFO_EXTENSION );
                    $src        = Nbdesigner_IO::get_thumb_file( pathinfo( $file, PATHINFO_EXTENSION ), '');
                    $file_url   = Nbdesigner_IO::wp_convert_path_to_url( $file );
                    if(  $create_preview == 'yes' && ( $ext == 'png' || $ext == 'jpg' || $ext == 'pdf' ) ){
                        $dir        = pathinfo( $file, PATHINFO_DIRNAME );
                        $filename   = pathinfo( $file, PATHINFO_BASENAME );
                        if( file_exists($dir.'_preview/'.$filename) ){
                            $src = Nbdesigner_IO::wp_convert_path_to_url( $dir.'_preview/'.$filename );
                        }else if( $ext == 'pdf' && file_exists($dir.'_preview/'.$filename.'.jpg' ) ){
                            $src = Nbdesigner_IO::wp_convert_path_to_url( $dir.'_preview/'.$filename.'.jpg' );
                        }else{
                            $src = Nbdesigner_IO::get_thumb_file( $ext, '' );
                        }
                    }else {
                        $src = Nbdesigner_IO::get_thumb_file( $ext, '' );
                    }
                    $upload_html .= '<div class="nbd-cart-item-upload-preview-wrap"><a target="_blank" href='.$file_url.'><img class="nbd-cart-item-upload-preview" src="' . $src . '"/></a><p class="nbd-cart-item-upload-preview-title">'. basename($file).'</p></div>';
                }
                $upload_html = apply_filters('nbu_cart_item_html', $upload_html, $cart_item, $nbu_session);
                // $html .= $upload_html;
                if( $show_edit_link ){
                    $link_reup_design = add_query_arg(
                        array(
                            'task'          => 'reup',
                            'product_id'    => $product_id,
                            'nbu_item_key'  => $nbu_session,
                            'cik'           => $cart_item_key,
                            'rd'            => $redirect),
                        getUrlPageNBD('create'));
                    if($cart_item['variation_id'] > 0){
                        $link_reup_design .= '&variation_id=' . $cart_item['variation_id'];
                    }
                    $link_reup_design = apply_filters( 'nbu_cart_item_reup_link', $link_reup_design, $cart_item, $cart_item_key, $redirect );
                    $html .= '<a class="button nbd-reup-design" href="' . $link_reup_design . '"><span>'. esc_html__('Reupload design', 'web-to-print-online-designer') .'</span></a>';
                }
                $html .= '</div>';
            }else if( $_enable_upload && $show_edit_link && !is_cart()){
                $id = 'nbd' . $cart_item_key;     
                $redirect = is_cart() ? 'cart' : 'checkout';
                $link_create_design = add_query_arg(
                    array(
                        'task'          => 'new',
                        'task2'         => 'add_file',
                        'product_id'    => $product_id,
                        'variation_id'  => $variation_id,
                        'cik'           => $cart_item_key,
                        'rd'            => $redirect),
                    getUrlPageNBD('create'));
                $link_upload_design = apply_filters('nbu_cart_item_upload_link', $link_create_design, $cart_item, $cart_item_key, $redirect);
                $html .= '<div class="nbd-cart-upload-file nbd-cart-item-upload-file mt-0">';
                $html .=    '<a class="button nbd-upload-design" href="' . $link_upload_design . '">' . esc_html__('Design hochladen', 'web-to-print-online-designer') . '</a>';
                $html .= '</div>';
            }else if(isset($cart_item['form_source'])){


                $formSourceUrl = $cart_item['form_source'] ?? '';
                $link_resubmit_requirement = add_query_arg(
                    array(
                        'task'          => 'resubmit',
                        'product_id'    => $product_id,
                        'nbu_item_key'  => $cart_item['tcu_folder'],
                        'cik'           => $cart_item_key,
                        'rd'            => $redirect),
                        $formSourceUrl );

                
                $html .= '<div class="nbd-cart-upload-file nbd-cart-item-upload-file mt-0 h-100">';
                $html .=    '<a class="button nbd-reup-design" href="'. esc_url( $link_resubmit_requirement ) .'"><span>' . esc_html__('Edit Requirement', 'web-to-print-online-designer') . '</span></a>';
                $html .= '</div>';
            }
            $option = unserialize(get_post_meta($product_id, '_nbdesigner_option', true)); 
            if( isset($nbd_session) ) {
                $path = NBDESIGNER_CUSTOMER_DIR . '/' . $nbd_session . '/config.json';
                $config = nbd_get_data_from_json($path);
                if( isset( $config->custom_dimension ) && isset( $config->custom_dimension->price ) ){
                    $nbd_variation_price = $config->custom_dimension->price;
                }
            }
            if( ( ( isset( $nbd_variation_price ) && $nbd_variation_price != 0 ) || $option['extra_price'] ) && ! $option['request_quote'] ){
                $decimals = wc_get_price_decimals();
                $extra_price = $option['extra_price'] ? $option['extra_price'] : 0;
                if( (isset($nbd_variation_price) && $nbd_variation_price != 0) ) {
                    $extra_price = $option['type_price'] == 1 ? wc_price($extra_price + $nbd_variation_price) : $extra_price . ' % + ' . wc_price($nbd_variation_price);
                }else {
                    $extra_price = $option['type_price'] == 1 ? wc_price($extra_price) : $extra_price . '%';
                }
                $html .= '<p id="nbx'.$cart_item_key.'">' . esc_html__('Extra price for design','web-to-print-online-designer') . ' + ' .  $extra_price . '</p>';
            }
            return $html;
        } else {
            return $title;
        }
       
    }

    /**
     * GEt order delivery date after calculate delivery otion and order date
     * 
     * @param init $order_id
     * @return date
     */
    public function get_order_delivery_date($order_id){
        global $nbd_fontend_printing_options;
        $order = wc_get_order( $order_id );
        $items = $order->get_items();
        $date = $order->get_date_paid() ?? $order->get_date_completed();
        $date = $date ?? $order->get_date_created();
        
        $delivery = 0;

        foreach($items as $item){
            if($delivery > 0) break;

            $product_id = $item->get_product_id();
            $selected_delivery = $item->get_meta('Lieferzeitoptionen');
            
            $selected_delivery = substr(strip_tags($selected_delivery), 0, 12);
            

            $option_id = $nbd_fontend_printing_options->get_product_option( $product_id );
           
            if($product_id <= 0) {
                $delivery = 0;
                break;
            }

            $_options = $nbd_fontend_printing_options->get_option( $option_id );
            $fields = $_options ? unserialize($_options['fields']) : array();
            // $delivery_key = array_search('delivery', array_column($fields['fields'], 'nbe_type'));
            $keys = array_keys(array_column($fields['fields'], 'nbe_type'), 'delivery');
            

            $deliveryOption = array_filter($fields['fields'],function($v,$k){
                return isset($v['nbe_type']) && $v['nbe_type'] == 'delivery';
              },ARRAY_FILTER_USE_BOTH); // With latest PHP third parameter is optional.. Available Values:- ARRAY_FILTER_USE_BOTH OR ARRAY_FILTER_USE_KEY  
            
            $deliveryOption = array_values($deliveryOption);
            $deliveryOption = $deliveryOption[0]['general']['attributes']['options'];


            foreach($deliveryOption as $option){
                if(strpos($option['name'], $selected_delivery) !== false){
                    $delivery = (int) $option['delivery'];
                    break;
                }
            }
        }
        return date('d M Y', strtotime($date . '+ '.$delivery.' days') );
    }


    /**
     * Add delivery date column value
     */
    public function transparentcard_add_deliverydate_value($order){  
        $deliverydate = $this->get_order_delivery_date($order->get_id());
        esc_html_e( $deliverydate );
    }

    /**
     * Add additional column in order page in my accoount
     * For add delivery date information
     * 
     * @param array $columns
     */
    public function add_account_orders_delivery_date_column($columns){

        $columns = array_slice($columns, 0, 2, true) + array("delivery-date" => __( 'Delivery Date', 'transparentcard' )) + array_slice($columns, 2, count($columns) - 1, true);
        return $columns;
    }


    /**
     * Add produc Id to additional param in cart items 
     * $args array
     * $product object
     */
    public function transparent_additional_parameters( $args, $product ){
        if (!empty($product)) {
            $args["product_id"] = $product->get_id();
        }
        return $args;
    }


    /**
     * Customize cart item remove link 
     * 
     * @param string
     */
    public function nbd_customize_cart_item_remove($string){
        $string = str_replace(  Astra_Builder_UI_Controller::fetch_svg_icon( 'close', false ), '&times;', $string );
        return $string;
    }


    /**
     * Gallary page next page load on scrool windows
     * Class extension from class.my.design.php
     */

    public function nbd_get_next_gallery_page(){

        

        if (!wp_verify_nonce($_POST['nonce'], 'nbd_update_favourite_template') && NBDESIGNER_ENABLE_NONCE) {
            die('Security error');
        }
        $result['flag'] = 0;
        $page           = absint( $_POST['page'] );
        $row            = absint( $_POST['row'] );
        $total          = absint( $_POST['total'] );
        $limit          = absint( $_POST['limit'] );
        $per_row        = absint( $_POST['per_row'] );
        $url            = esc_url( $_POST['url'] );
        $parts          = parse_url( $_POST['url'] );
        if( isset($parts['query']) ){
            parse_str($parts['query'], $query);
        }else{
            $query = array();
        }
       
        $pid            = isset($query['pid']) ? $query['pid'] : false;
        $cat            = isset($query['cat']) ? $query['cat'] : false;
        $tag            = isset($query['tag']) ? $query['tag'] : '';
        $color          = isset($query['color']) ? $query['color'] : '';
        $search         = isset($query['search']) ? $query['search'] : '';
        $size           = isset($query['size']) ? $query['size'] : '';
        $orientations   = isset($query['orientations']) ? $query['orientations'] : '';
        $corners        = '';
        $search_type    = isset($query['search_type']) ? $query['search_type'] : '';
        $artist_id      = isset($query['id']) ? $query['id'] : false;
        $templates      = $this->nbdesigner_get_templates_by_page( $page, $row, $per_row, $pid, false, $artist_id, $cat, $tag, $color, '', $search, $search_type, false, $size, $corners, $orientations );





        $favourite_templates = $this->get_favourite_templates();
        ob_start();
        if( count( $templates ) ){
            $result['flag'] = 1;
            nbdesigner_get_template('gallery/gallery-item.php', array(
                'templates'             => $templates,
                'current_user_id'       => get_current_user_id(),
                'favourite_templates'   => $favourite_templates
            ));
            $result['items'] = ob_get_clean();
        }
        ob_start();
        nbdesigner_get_template('gallery/pagination.php', array(
            'total' => $total,
            'limit' => $limit,
            'url'   => $url,
            'page'  => $page
        ));
        $result['pagination'] = ob_get_clean();
        wp_send_json($result);
    }


    /**
     * Add additional glass effect in stage
     * 
     * @param null
     */
    public function add_additional_transperent_glassy_effect(){
        ob_start();
        if(isset($_GET['rd'])){?>
            <style>
                .stage-overlay {
                    display: block;
                }
            </style>
            <?php
        }else{
            ?>
                <style>
                    .main .design-wrap{
                        /* background-image: url(<?php //echo get_stylesheet_directory_uri(  ); ?>/assets/img/tut-tut-tut.png); */
                        background-repeat: no-repeat;
                        border-radius: 45px;
                        background-size: cover;
                        background-repeat: no-repeat;
                    }
                    .stage-overlay {
                        display: none;
                    }
                </style>
            <?php 
        }
        echo ob_get_clean();
    }


    /**
     * Add additional js file in nbdesign window / iframe
     */
    public function coolcards_js_config(){
        
        ?>
            NBDESIGNCONFIG.child_assets_url = "<?php echo get_stylesheet_directory_uri(  ); ?>/assets/img";
            NBDESIGNCONFIG.is_backend = "<?php echo (isset($_GET['rd']) && $_GET['rd'] == 'admin_templates') ? true : false; ?>";
            NBDESIGNCONFIG.nbd_process_text = "<?php esc_attr_e( 'Bestellung fortsetzen', 'transparantcards' ); ?>";
        <?php
        
        
        if(isset($_GET['product_id']) && ((isset($_GET['trns_nbd_design_id']) && isset($_GET['source']) ) || (isset($_GET['product_id']) && isset($_GET['reference'])) ) ){
            $selected = false;
            if(isset($_GET['source']) && $_GET['source'] == 'single-product'){
                $selected = true;
            }
            if(isset($_GET['source']) && $_GET['source'] == 'cart'){
                $selected = true;
            }
            if(isset($_GET['reference'])){
                $selected = true;
            }
            $ref = isset($_GET['reference']) ? $_GET['reference'] : $_GET['trns_nbd_design_id'];

            if(isset($_GET['orientation'])){
                $metas = get_post_meta( $_GET['product_id'], '_designer_setting', true );
                $metas = unserialize($metas);

                $real_width = $metas[0]['real_width'] > $metas[0]['real_height'] ? $metas[0]['real_width'] : $metas[0]['real_height'];
                $real_height = $metas[0]['real_width'] > $metas[0]['real_height'] ? $metas[0]['real_height'] : $metas[0]['real_width'];
                $size = $real_width .'x'.$real_height.'-mm';
            }

            if($selected):
            ?>
                NBDESIGNCONFIG.selected_orientation = "<?php echo isset($_GET['orientation']) ? $_GET['orientation'] : $this->_get_template_data( $ref ); ?>";
                NBDESIGNCONFIG.paper_size = "<?php echo isset($_GET['orientation']) ? $size : $this->_get_template_data( $ref, 'paper_size' ); ?>";
            <?php
            endif;
        }
        
    }


    /**
     * Get template part 
     * 
     */
    public function _get_template_data($item_key, $returnItem = ''){
        $query = $this->wpdb->get_row($this->wpdb->prepare("SELECT `paper_sizes`, `corner`, `orientation` FROM {$this->wpdb->prefix}nbdesigner_templates WHERE `folder`=%s", $item_key), OBJECT);

        if(!empty($returnItem)){
            $orientations = get_term_by( 'id', $query->paper_sizes, 'paper_size');
        }else{
            $orientations = get_term_by( 'id', $query->orientation, 'orientation');
        }
        
        return $orientations->slug;
    }




    public function remove_template_side_buttons(){
        ob_start(); ?>
        <div id="removeButton" ng-if="currentStage > 0">
            <button onclick="removeThisSide()" type="submit"><?php _e('Remove', 'coolcards'); ?></button>
        </div>

        <script>
            setTimeout(() => {
                var appElement = document.querySelector('body[ng-app="nbd-app"]');
                var $scope = angular.element(appElement).scope();
                var removeThisSide = function($index = 0){
                    $scope.$$childTail.removeStage($scope.$$childTail.currentStage);
                }
            }, 1000);

        </script>
        <?php echo ob_get_clean();
    }



    /**
     * Additional filter options 
     */
    public function gallery_tag_filter(){
        $term_ids       = isset( $_GET['tag'] ) ? wc_clean( $_GET['tag'] ) : '';
        $colors         = isset( $_GET['color'] ) ? wc_clean( $_GET['color'] ) : '';
        $sizes          = isset( $_GET['size'] ) ? wc_clean( $_GET['size'] ) : '';
        $corners        = isset( $_GET['corners'] ) ? wc_clean( $_GET['corners'] ) : '';
        $orientations   = isset( $_GET['orientations'] ) ? wc_clean( $_GET['orientations'] ) : '';
        $search         = isset( $_GET['search'] ) ? wc_clean( $_GET['search'] ) : '';
        $tags = array();
            
        


        if( $term_ids != '' ){
            $term_ids_arr = explode(',', trim($term_ids));
            foreach ( $term_ids_arr as $term_id ){
                $tag = get_term( $term_id, 'template_tag' );
                $tag->data_type = 'tag';
                if( ! is_wp_error( $tag ) ){
                    $tags[] = $tag;
                }
            }
        }

        if( $sizes != '' ){
            $size_ids_arr = explode(',', trim($sizes));
            foreach ( $size_ids_arr as $term_id ){
                $tag = get_term( $term_id, 'paper_size' );
                $tag->data_type = 'size';
                if( ! is_wp_error( $tag ) ){
                    $tags[] = $tag;
                }
            }
        }

        if( $corners != '' ){
            $corner_ids_arr = explode(',', trim($corners));
            foreach ( $corner_ids_arr as $term_id ){
                $tag = get_term( $term_id, 'paper_corner' );
                $tag->data_type = 'corners';
                if( ! is_wp_error( $tag ) ){
                    $tags[] = $tag;
                }
            }
        }

        if( $orientations != '' ){
            $orientation_ids_arr = explode(',', trim($orientations));
            foreach ( $orientation_ids_arr as $term_id ){
                $tag = get_term( $term_id, 'orientation' );
                $tag->data_type = 'orientations';
                if( ! is_wp_error( $tag ) ){
                    $tags[] = $tag;
                }
            }
        }


        if( $search != '' ){
            ?>
            <span class="nbd-gallery-filter-tag">
                <span class="nbd-filter-tag-name"><?php echo( $search ); ?></span>
                <span class="nbd-filter-tag-remove" data-type="search" >
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M18.984 6.422l-5.578 5.578 5.578 5.578-1.406 1.406-5.578-5.578-5.578 5.578-1.406-1.406 5.578-5.578-5.578-5.578 1.406-1.406 5.578 5.578 5.578-5.578z"></path>
                    </svg>
                </span>
            </span>
            <?php
        }

        $data_type = 'tag';
        if( count( $tags ) ){
            foreach( $tags as $_tag ):
            ?>
            <span class="nbd-gallery-filter-tag">
                <span class="nbd-filter-tag-name"><?php echo( $_tag->name ); ?></span>
                <span class="nbd-filter-tag-remove" data-type="<?php echo $_tag->data_type; ?>" data-value="<?php echo( $_tag->term_id ); ?>">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M18.984 6.422l-5.578 5.578 5.578 5.578-1.406 1.406-5.578-5.578-5.578 5.578-1.406-1.406 5.578-5.578-5.578-5.578 1.406-1.406 5.578 5.578 5.578-5.578z"></path>
                    </svg>
                </span>
            </span>
            <?php
            endforeach;
        }

        if( $colors != '' ){
            $color_arr = explode(',', trim( $colors ));
            foreach ( $color_arr as $_color ):
            ?>
            <span class="nbd-gallery-filter-tag">
                <span class="nbd-filter-color" style="background: #<?php echo( $_color ); ?>;"></span>
                <span class="nbd-filter-tag-remove" data-type="color" data-value="<?php echo( $_color ); ?>">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M18.984 6.422l-5.578 5.578 5.578 5.578-1.406 1.406-5.578-5.578-5.578 5.578-1.406-1.406 5.578-5.578-5.578-5.578 1.406-1.406 5.578 5.578 5.578-5.578z"></path>
                    </svg>
                </span>
            </span>
            <?php
            endforeach;
        }
    }


    /**
     * Function for gallary template shortcode 
     */
    public function nbd_gallery_func($atts, $content = null) {
        if ( is_null( WC()->session ) ) {
            return;
        }


        if(isset( $_GET['action']) && $_GET['action'] == 'hire-a-designer'){
            ob_start();
            nbdesigner_get_template( 'gallery/hire-a-designer.php', array() );
            return ob_get_clean();
        }
        
        if(isset( $_GET['action']) && $_GET['action'] == 'request-for-design-replica'){
            ob_start();
            nbdesigner_get_template( 'gallery/request-for-design-replica-wraper.php', array() );
            return ob_get_clean();
        }

        if(isset( $_GET['action']) && $_GET['action'] == 'submitFile'){
            ob_start();
            nbdesigner_get_template( 'gallery/submit-files.php', array() );
            return ob_get_clean();
        }
        // $mydesign = new My_Design_Endpoint;
        
        $page                   = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; 
        $per_row                = intval( apply_filters( 'nbd_gallery_designs_per_row', 3 ) );
        $row                    = apply_filters( 'nbd_gallery_designs_row', 5 );
        $favourite_templates    = parent::get_favourite_templates();
        $cat                    = (isset($_GET['cat']) && absint($_GET['cat'])) ? absint($_GET['cat']) : 0;
        $pid                    = (isset($_GET['pid']) && absint($_GET['pid'])) ? absint($_GET['pid']) : 0;
        $tag                    = isset( $_GET['tag'] ) ? wc_clean( $_GET['tag'] ) : '';
        $color                  = isset( $_GET['color'] ) ? wc_clean( $_GET['color'] ) : '';
        $size                   = isset( $_GET['size'] ) ? wc_clean( $_GET['size'] ) : '';
        $corners                = isset( $_GET['corners'] ) ? wc_clean( $_GET['corners'] ) : '';
        $orientations           = isset( $_GET['orientations'] ) ? wc_clean( $_GET['orientations'] ) : '';


        $search                 = isset( $_GET['search'] ) ? wc_clean( $_GET['search'] ) : '';
        $search_type            = isset( $_GET['search_type'] ) ? wc_clean( $_GET['search_type'] ) : '';
        $url                    = getUrlPageNBD('gallery');
        if($pid) $url = add_query_arg(array('pid' => $pid), $url);
        if($cat) $url = add_query_arg(array('cat' => $cat), $url);
        if( $tag != '' ){
            $url    = add_query_arg(array('tag' => $tag), $url);
        }
        if( $color != '' ){
            $url    = add_query_arg(array('color' => $color), $url);
        }
        if( $size != '' ){
            $url    = add_query_arg(array('size' => $size), $url);
        }
        if( $corners != '' ){
            $url    = add_query_arg(array('corners' => $corners), $url);
        }
        if( $orientations != '' ){
            $url    = add_query_arg(array('orientations' => $orientations), $url);
        }

        if( $search != '' ){
            $url    = add_query_arg(array('search' => $search), $url);
            if( $search_type != '' ){
                $url    = add_query_arg(array('search_type' => $search_type), $url);
            }
        }

        $atts = shortcode_atts(array(
            'row'                   => $row,
            'per_row'               => $per_row,
            'pagination'            => 'true',
            'url'                   => $url,
            'des'                   => esc_html__( 'Gallery design templates', 'web-to-print-online-designer' ),
            'page'                  => $page,
            'cat'                   => $cat,
            'pid'                   => $pid,
            'color'                 => $color,
            'search'                => $search,
            'search_type'           => $search_type,
            'tag'                   => $tag,
            'favourite_templates'   => $favourite_templates,
            'fts'                   => $this->get_detail_favourite_templates(),
            'templates'             => array(),
            'products'              => nbd_get_products_has_design(),
            'categories'            => $this->get_categories_has_design(),
            'designers'             => $this->get_designers(),
            'total'                 => ( $pid != 0 || ( isset( $atts['pid'] ) && $atts['pid'] != 0 ) ) ? $this->count_total_template( $pid, false, $cat ) : $this->count_total_template( false, false, $cat )
        ), $atts);
        if( $atts['per_row'] > 6 ) $atts['per_row'] = 6;
        $atts['templates']  = $this->nbdesigner_get_templates_by_page( $page, absint($atts['row'] ), absint($atts['per_row'] ), $atts['pid'], false, false, $cat, $tag, $color, '', $search, $search_type, false, $size, $corners, $orientations );
        $atts['total']      = $this->nbdesigner_get_templates_by_page( $page, absint($atts['row'] ), absint($atts['per_row'] ), $atts['pid'], true, false, $cat, $tag, $color, '', $search, $search_type, true, $size, $corners, $orientations );

        


        ob_start();


       
        nbdesigner_get_template( 'gallery/main.php', $atts );
        



        return ob_get_clean();
    }


    /**
     * Get gallary templages 
     * @param $page number
     * @param $row numberr
     * @param $per_row number
     * 
     * @return query data
     */
    public static function nbdesigner_get_templates_by_page( $page = 1, $row = 5, $per_row = 3, $pid = false, $get_all = false, $user_id = false, $cat = false, $tag = '', $color = '', $type = '', $search = '', $search_type = '', $return_total = false, $size = '', $corner = '', $orientation = '' ){
        $listTemplates = array();
        global $wpdb;
        $limit  = $row * $per_row;
        $offset = $limit * ( $page - 1 );
        $sql    = "SELECT p.ID, p.post_title, t.id AS tid, t.name, t.folder, t.product_id, t.variation_id, t.user_id, t.thumbnail, t.type FROM {$wpdb->prefix}nbdesigner_templates AS t";
        $sql   .= " LEFT JOIN {$wpdb->prefix}posts AS p ON t.product_id = p.ID";
        $sql   .= " WHERE t.publish = 1 AND p.post_status = 'publish' AND publish = 1";

        if( $tag != '' ){
            $tag_arr = explode( ',', $tag );
            if( count( $tag_arr ) ){
                $sql .= " AND ( ";
                foreach( $tag_arr as $k => $t ){
                    if( $t != '' ){
                        if( $k == 0 ){
                            $sql .= "( FIND_IN_SET('". $t ."', t.tags) > 0 )";
                        }else{
                            $sql .= " OR ( FIND_IN_SET('". $t ."', t.tags) > 0 )";
                        }
                    }
                }
                $sql .= " )";
            }
        }

        if( $size != '' ){
            $size_arr = explode( ',', $size );
            if( count( $size_arr ) ){
                $sql .= " AND ( ";
                foreach( $size_arr as $k => $t ){
                    if( $t != '' ){
                        if( $k == 0 ){
                            $sql .= "( FIND_IN_SET('". $t ."', t.paper_sizes) > 0 )";
                        }else{
                            $sql .= " OR ( FIND_IN_SET('". $t ."', t.paper_sizes) > 0 )";
                        }
                    }
                }
                $sql .= " )";
            }
        }

        if( $corner != '' ){
            $corner_arr = explode( ',', $corner );
            if( count( $corner_arr ) ){
                $sql .= " AND ( ";
                foreach( $corner_arr as $k => $t ){
                    if( $t != '' ){
                        if( $k == 0 ){
                            $sql .= "( FIND_IN_SET('". $t ."', t.corner) > 0 )";
                        }else{
                            $sql .= " OR ( FIND_IN_SET('". $t ."', t.corner) > 0 )";
                        }
                    }
                }
                $sql .= " )";
            }
        }

        if( $orientation != '' ){
            $orientation_arr = explode( ',', $orientation );
            if( count( $orientation_arr ) ){
                $sql .= " AND ( ";
                foreach( $orientation_arr as $k => $t ){
                    if( $t != '' ){
                        if( $k == 0 ){
                            $sql .= "( FIND_IN_SET('". $t ."', t.orientation) > 0 )";
                        }else{
                            $sql .= " OR ( FIND_IN_SET('". $t ."', t.orientation) > 0 )";
                        }
                    }
                }
                $sql .= " )";
            }
        }
      

        if( $color != '' ){
            $color_arr = explode( ',', $color );
            if( count( $color_arr ) ){
                $sql .= " AND ( ";
                foreach( $color_arr as $k => $c ){
                    if( $c != '' ){
                        if( $k == 0 ){
                            $sql .= "( FIND_IN_SET('". $c ."', t.colors) > 0 )";
                        }else{
                            $sql .= " OR ( FIND_IN_SET('". $c ."', t.colors) > 0 )";
                        }
                    }
                }
                $sql .= " )";
            }
        }

        if( $pid ){
            $sql .= " AND t.product_id = ".$pid;
        }else if( $cat ) {
            $products  = self::get_all_product_design_in_category( $cat );
            if( is_array( $products ) && count( $products ) ){
                $list_product = '';
                foreach ($products as $pro){
                    $list_product .= ','.$pro->ID;
                }
                $list_product = ltrim($list_product, ',');
                $sql .= " AND t.product_id IN ($list_product) ";
            } else {
                return $return_total ? 0 : array();
            }
        }

        if( $search != '' ){
            if( $search_type != 'design' ){
                $args   = array(
                    'role__in'   => array( 'designer', 'administrator', 'shop_manager' ),
                    'meta_query' => array(
                        array(
                            'relation' => 'AND',
                            array(
                                'key'     => 'nbd_sell_design',
                                'value'   => 'on',
                                'compare' => '='
                            ),
                            array(
                                'key'     => 'nbd_artist_name',
                                'value'   => esc_attr( $search ),
                                'compare' => 'LIKE'
                            )
                        )
                    )
                );

                $user_query     = new WP_User_Query( $args );
                $designers      = $user_query->get_results();
                $list_designer  = '';
                foreach ( $designers as $key => $designer ) {
                    $separate = $key > 0 ? ',' : '';
                    $list_designer .= $separate . $designer->ID;
                }

                if( $search_type == 'artist' ){
                    if( $list_designer != '' ){
                        $sql .= " AND t.user_id IN ($list_designer) ";
                    }
                }else{
                    if( $list_designer != '' ){
                        $sql .= " AND ( t.user_id IN ($list_designer) OR t.name LIKE '%$search%' ) ";
                    }else{
                        $sql .= " AND t.name LIKE '%" . $search . "%' ";
                    }
                }
            }else{
                $sql .= " AND t.name LIKE '%" . $search . "%' ";
            }
        }

        //if($pid) $sql .= " AND t.product_id = ".$pid;
        if( $user_id ) $sql .= " AND t.user_id = ".$user_id;
        // $sql .= " ORDER BY t.created_date DESC";

        $orderTemplate = false;
        if(empty($size) && empty($corner) && empty($orientation)){
            $orderTemplate = true;
        }
        if(!empty($size)) $orderTemplate = true;

        if($orderTemplate){
            $orientations = get_term_by( 'slug', 'horizontal', 'orientation' );
            // if($orientations)
            $sql .= " ORDER BY FIELD(t.orientation, '".$orientations->term_id."') DESC";
        }

        if( !$get_all ){
            $sql .= " LIMIT ".$limit." OFFSET ".$offset;
        }

        

        $posts = $wpdb->get_results( $sql, 'ARRAY_A' );
        if( $return_total ) return count( $posts );
        foreach ( $posts as $p ){
            $path_preview = NBDESIGNER_CUSTOMER_DIR .'/'.$p['folder']. '/preview';
            if( $p['thumbnail'] ){
                $image = wp_get_attachment_url( $p['thumbnail'] );
            }else{
                $listThumb = Nbdesigner_IO::get_list_images( $path_preview );
                $image = '';
                if( count( $listThumb ) ){
                    asort( $listThumb );
                    $image = Nbdesigner_IO::wp_convert_path_to_url( reset( $listThumb ) );
                }
            }
            $title = $p['name'] ?  $p['name'] : $p['post_title'];
            $listTemplates[] = array('tid' => $p['tid'], 'id' => $p['ID'], 'title' => $title, 'type' => $p['type'], 'image' => $image, 'folder' => $p['folder'], 'product_id' => $p['product_id'], 'variation_id' => $p['variation_id'], 'user_id' => $p['user_id']);
        }
        return $listTemplates;
    }


    /**
     * Add Additional taxonomony to templates 
     * @param array
     * @return array
     */
    public function template_info($data){
        if(!isset($_REQUEST['nbd_item_key']))
            return $data;

        $nbd_item_key = $_REQUEST['nbd_item_key'];

        $query = $this->wpdb->get_row($this->wpdb->prepare("SELECT `paper_sizes`, `corner`, `orientation` FROM {$this->wpdb->prefix}nbdesigner_templates WHERE `folder`=%s", $nbd_item_key), OBJECT);
        
        if($query){
            $sizes = $query->paper_sizes;
            $data['template']['paper_sizes'] = $sizes;
            $data['template']['corner'] = $query->corner ?? '';
            $data['template']['orientation'] = $query->orientation ?? '';
        }
        
        return $data;

    }



    /**
     * @param string
     * @param array
     */
    public function coolcards_additional_taxonomy_controller($mood, $settings){
        $paper_sizes = get_terms( 'paper_size', 'hide_empty=0' );
        $paper_corners = get_terms( 'paper_corner', 'hide_empty=0' );
        $paper_orientations = get_terms( 'orientation', 'hide_empty=0' );
        
        if(isset($_GET['rd']) && $_GET['rd'] == 'admin_templates'){
        ob_start();  ?>
        <div id="coolcaardsTags" ng-init="coolcardsLoadTaxs()">
            <div class="template-tags template-field-wrap mb-15" ng-if="!coolcards.reload">
                <label class="template-label"><?php esc_html_e('Paper Size','coolcards'); ?></label>
                <div>
                    <?php if ( ! empty( $paper_sizes ) && ! is_wp_error( $paper_sizes ) ): ?>
                    <?php foreach( $paper_sizes as $tag ): ?>
                    <span ng-class="isSelectedSizes( <?php echo( $tag->term_id ); ?> ) ? 'selected' : '' " class="nbd-tag" ng-click="addCoolCardTax( <?php echo( $tag->term_id ); ?>, '<?php echo $_REQUEST['nbd_item_key']; ?>', <?php echo $_REQUEST['product_id']; ?> )"><span><?php echo( $tag->name ); ?></span></span>
                    <?php endforeach; ?>
                    <?php endif; ?>
                    <?php if ( count($paper_sizes) <= 0 ): ?>
                        <a><?php esc_html_e('No ','web-to-print-online-designer'); ?></a>
                    <?php endif; ?>
                </div>
            </div>


            <div class="template-tags template-field-wrap mb-15" ng-if="!coolcards.reload">
                <label class="template-label"><?php esc_html_e('Corner','coolcards'); ?></label>
                <div>
                    <?php if ( ! empty( $paper_corners ) && ! is_wp_error( $paper_corners ) ): ?>
                    <?php foreach( $paper_corners as $corner ): ?>
                    <span ng-class="isSelectedCorner( <?php echo( $corner->term_id ); ?> ) ? 'selected' : '' " class="nbd-tag" ng-click="addCoolCardTax( <?php echo( $corner->term_id ); ?>, '<?php echo $_REQUEST['nbd_item_key']; ?>', <?php echo $_REQUEST['product_id']; ?>, 'paper_corner' )"><span><?php echo( $corner->name ); ?></span></span>
                    <?php endforeach; ?>
                    <?php endif; ?>
                    <?php if ( count($paper_corners) <= 0 ): ?>
                        <a><?php esc_html_e('No ','web-to-print-online-designer'); ?></a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="template-tags template-field-wrap mb-15" ng-if="!coolcards.reload">
                <label class="template-label"><?php esc_html_e('Orientations','coolcards'); ?></label>
                <div>
                    <?php if ( ! empty( $paper_orientations ) && ! is_wp_error( $paper_orientations ) ): ?>
                    <?php foreach( $paper_orientations as $orientation ): ?>
                    <span ng-class="isSelectedOrientation( <?php echo( $orientation->term_id ); ?> ) ? 'selected' : '' " class="nbd-tag" ng-click="addCoolCardTax( <?php echo( $orientation->term_id ); ?>, '<?php echo $_REQUEST['nbd_item_key']; ?>', <?php echo $_REQUEST['product_id']; ?>, 'orientation' )"><span><?php echo( $orientation->name ); ?></span></span>
                    <?php endforeach; ?>
                    <?php endif; ?>
                    <?php if ( count($paper_orientations) <= 0 ): ?>
                        <a><?php esc_html_e('No ','web-to-print-online-designer'); ?></a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- <div id="uploadTemplateThumb" class="template-thumbnail template-tags template-field-wrap mb-15" ng-if="!coolcards.reload">
                <label class="template-label"><?php //esc_html_e('Thumbnail','coolcards'); ?></label>
                <div class="inner-template uploadd">
                    <i class="icon-nbd icon-nbd-add-black"></i>
                </div>
            </div> -->

        </div>

        <?php
        echo ob_get_clean();
        }
    }


    /**
     * Add additional tab in single production page 
     * 
     * @return string
     * @param string
     */
    public function additional_printing_tab($tabs){
        global $post;
        $nbpt_content2 = htmlspecialchars_decode(get_post_meta( $post->ID, '_nbpt_content2', true ));
        $nbpt_content3 = htmlspecialchars_decode(get_post_meta( $post->ID, '_nbpt_content3', true ));
        if ( strlen( $nbpt_content2 ) > 0 ) {
            $nbpt_title2         = get_post_meta($post->ID, '_nbpt_title2', true);
            $tabs['standard_size_chart'] = array(
                'title'    => $nbpt_title2,
                'priority' => 50,
                'callback' => array( $this, 'standard_printing_tab_content' )
            );
        }

        if ( strlen( $nbpt_content3 ) > 0 ) {
            $nbpt_title3         = get_post_meta($post->ID, '_nbpt_title3', true);
            $tabs['coolcard_size_chart'] = array(
                'title'    => $nbpt_title3,
                'priority' => 50,
                'callback' => array( $this, 'coolcard_printing_tab_content' )
            );
        }

        return $tabs;
    }


    /**
     * Display custom product tab content for coolcard
     */
    public function coolcard_printing_tab_content(){
        global $post;
        echo htmlspecialchars_decode(get_post_meta( $post->ID, '_nbpt_content3', true ));
    }

    /**
     * Display custom product tab content
     * 
     */
    public function standard_printing_tab_content(){
       global $post;
       echo htmlspecialchars_decode(get_post_meta( $post->ID, '_nbpt_content2', true ));
    }

    /**
     * Override dynamic css which is syncronoze theme customize
     * @param string 
     * @return string
     */
    public function dynamic_css_override($css){
        $pb_text_hover = printcart_get_options('nbcore_pb_text_hover');
        $body_color = printcart_get_options('nbcore_body_color');
        $pb_bg_hover = printcart_get_options('nbcore_pb_background_hover');
        $pb_bg = printcart_get_options('nbcore_pb_background');
        $button_padding = printcart_get_options('nbcore_button_padding');
        // $heading_family = 'raleway';
        // $heading_weight = '400'; 


        $css .= ".button:hover, .nbd-action-wrap .button:hover, .single-product input[type=submit]:hover {
            color: " . esc_attr($pb_text_hover) . " !important;
        }";
        $css .= ".tabheader .wc-tabs > li.active a{
            color: ".esc_attr($body_color).";
        }";
        $css .= ".button, button{
            background-color: ".esc_attr( $pb_bg ).";
        }";
        $css .=".button:hover, button:hover, input[type=submit]:hover{background-color:".esc_attr($pb_bg_hover).";}";

        $css .= "a.button.wc-backward, a.button, button.woocommerce-Button.button{
            padding-left: " . esc_attr($button_padding) . "px;
            padding-right: " . esc_attr($button_padding) . "px;
        }";


        $body_family_array = array('google', 'Raleway');
        $css .= "
            @font-face {
                font-family: '" . str_replace("fontName:", "", end($body_family_array)). "';            
                ";
                $custom_fonts = NBT_Helper::get_custom_fonts();
                    foreach($custom_fonts as $k => $v){ 
                        if($v[0]){
                            if(strlen(strstr($v[0],$body_family_array[1])) > 0){
                                array_push($body_family_array, $v[1], $v[2],$v[3],$v[4]);;
                            }
                        }
                    }

                $body_custom_font_url = array_slice($body_family_array, 2, 4);
                foreach($body_custom_font_url as $url) {
                    $url_behind = substr(strstr($url, '.'), 1);
                    if(isset($url)){
                        if($url_behind === "eot" ){
                            $css .= "
                            src: url('" . $url . "');";
                        }elseif($url_behind === "ttf"){
                            $css .= "
                            src: url('" . $url . "') format('truetype');
                            ";
                        }elseif($url_behind === "eot?#iefix"){
                            $css .= "
                            src: url('" . $url . "') format('embedded-opentype');
                            ";
                        }else {
                            $css .= "
                            src: url('" . $url . "') format('".$url_behind."');
                            ";
                        }
                    }
                }

                $css .= "
            }
        ";

        $css .= "h1, h2, h3, h4, h5, h6,
        h1 > a, h2 > a, h3 > a, h4 > a, h5 > a, h6 > a,
        .entry-title > a,
        .woocommerce-Reviews .comment-reply-title, *, body {
            font-family: " . esc_attr(end($body_family_array)) . ";}";
        
        return $css;
    }


    /**
     * Create stycki add to cart button with price information 
     * 
     * @return html
     */
    public function sticky_product_details_information(){
        if(!is_product())
            return;
        ob_start(); 
        global $product;
        $product_images = wp_get_attachment_image_src( get_post_thumbnail_id( $product->get_id() ), 'thumbnail' );
        $product_images = $product_images[0] ?? wc_placeholder_img_src('thumbnail');
        

        ?>
        <style>
            div#coolCardStickyCart.sticky-toggle {
                bottom: -105px; 
                right: 0;
            }
            div#coolCardStickyCart.sticky-toggle div#collopse_sticky > div > svg {
                rotate: 180deg;
                transition: all 0.3s;
            }
            
            div#collopse_sticky {
                position: absolute;
                top: 7px;
                left: 7px;
                transition: all 0.5s;
            }
            @media only screen and (max-width: 480px) {
                div#collopse_sticky {
                    top: 19px;
                }
                div#overviewbtn a{
                    padding: 19px 22px;
                }
            }
            div#coolCardStickyCart.sticky-toggle div#collopse_sticky{
                top: -100px;
                left: auto;
                right: 20px;
            }
            div#collopse_sticky svg {
                background-color: #ecff8c;
                padding: 7px;
                border-radius: 50px;
                color: white;
                box-shadow: -2px -2px 0.4em #555;
            }
            div#collopse_sticky svg path{
                fill: var(--bg-first);
            }
            div#coolCardStickyCart.sticky-toggle div#collopse_sticky svg{
                background-color: var(--ast-global-color-0);
            }
            div#coolCardStickyCart.sticky-toggle div#collopse_sticky svg path{
                fill: var(--ast-global-color-hover-0);
            }
            #coolCardStickyCart{
                z-index: 10;
                max-width: 100%; 
                width: 550px;
                transition: all 0.3s;
            }

            
            @media only screen and (min-width: 481px) {
                #coolCardStickyCart > div > div:not(#collopse_sticky):not(#overviewbtn){
                    padding: 10px 115px 10px 0;    
                }    
            }
            @media only screen and (max-width: 480px) {
                #coolCardStickyCart > div > div:not(#collopse_sticky):not(#overviewbtn){
                    padding: 20px 0px 20px 0;    
                }    
            }

            #coolCardStickyCart > div > div:not(#collopse_sticky):not(#overviewbtn){
                display: grid;
                justify-content: space-around;
                align-content: stretch;
                align-items: start;
                justify-items: stretch;
                box-shadow: -1px -1px 0.5em;
                border-radius: 7px 0 0 0;
            }
            #coolCardStickyCart > div > div:not(#collopse_sticky):not(#overviewbtn) > div:last-child{
                display: grid;
                grid-template-columns: auto auto;
                align-items: baseline;
                justify-items: center;
                justify-content: center;
                align-content: center;
                gap: 20px;
            }

            div#coolCardStickyCart img {
                border-radius: 500px;
                max-width: 50px;
            }
            div#coolCardStickyCart button {
                text-transform: capitalize;
                padding: 8px 20px;
                border-width: 0;
                white-space: nowrap;
            }
            div#coolCardStickyCart div.qty p,
            div#coolCardStickyCart div.sticky-cart-price p{
                font-size: 23px;
            }
            button#stickyaddtocart {
                color: white !important;
            }
            button#stickyaddtocart:hover{
                color: #555 !important;
            }
            div#collopse_sticky > div {
                cursor: pointer;
                color: var(--ast-global-color-0);
            }
            #overviewbtn .nbo-float-summary-toggle{
                display: flex; 
                align-items: center;
                width: 100%;
                height: 100%;
            }
            #overviewbtn a:not(.nbo-collapse-expended) .nbo-float-summary-toggle svg {
                transform: rotate(180deg);
                transition: all 0.5s;
            }
        </style>
        <div id="coolCardStickyCart" class="position-fixed right-0 bottom-0 w-auto">

            <div class="position-relative">
                <div id="collopse_sticky" ng-click="sticky_cart_collopse()">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-chevron-double-down" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1.646 6.646a.5.5 0 0 1 .708 0L8 12.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"/>
                            <path fill-rule="evenodd" d="M1.646 2.646a.5.5 0 0 1 .708 0L8 8.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"/>
                        </svg>
                    </div>
                </div>
                <div id="overviewbtn">
                    <div>
                        <a href="#" class="btn btn-primary" ng-click="toggle_float_summary()">
                            <span class="nbo-float-summary-toggle">
                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="24" height="24" viewBox="0 0 24 24">
                                    <path d="M16.594 8.578l1.406 1.406-6 6-6-6 1.406-1.406 4.594 4.594z"/>
                                </svg>
                                <span class="overviewText"><?php _e('Overview', 'web-to-print-online-designer'); ?></span>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="ml-auto bg-first text-center">
                    
                    <div class="cool-row">
                        <div class="sticky-cart-price mb-0 d-flex align-item-center gap-10">
                            <span><?php _e('Preis', 'web-to-print-online-designer'); ?>:</span>
                            <p class="cart-price mb-0 text-bold"><?php echo get_woocommerce_currency_symbol(); ?>{{total_cart_item_price_num | number:2}}</p>
                        </div>
                        <div class="d-flex gap-20 justify-content-end align-item-center">
                            <div class="d-flex gap-5 qty justify-content-left align-item-center">
                                <span><?php _e('Menge', 'web-to-print-online-designer'); ?>:</span>
                                <p class="qty mb-0 text-bold">{{quantity}}</p>
                            </div>
                            <div>
                                <button id="stickyaddtocart" class="btn button btn-default bg-primary color-white" type="submit"><?php _e('Add to Card', 'coolcards'); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            
            jQuery(document).ready(function(){
                if(jQuery('button[type="submit"].single_add_to_cart_button').is(':hidden')){
                    jQuery('button[type="submit"]#stickyaddtocart').hide();
                }
                jQuery( 'button[type="submit"].single_add_to_cart_button' ).on( 'visibility', function() {
                    var $element = jQuery( this );
                    var timer = setInterval( function() {
                        if( $element.is( ':hidden' ) ) {
                            jQuery('button[type="submit"]#stickyaddtocart').hide();
                        } else {
                            jQuery('button[type="submit"]#stickyaddtocart').show();
                        }
                    }, 300 );
                }).trigger( 'visibility' );
            });

        </script>
        <?php
        echo ob_get_clean();
        
    }





    /**
     * plugin initial load 
     * @override some pri exist information 
     */
    public function plugin_loaded(){
        add_filter( 'nbd_product_templates', array( $this, 'templates_info' ), 15, 2 );
    }




    public function template_tags_info($tag_id = 0, $templates = array()){
        $thumbnail_id       = absint( get_term_meta( $tag_id, 'thumbnail_id', true ) );
        $term               = get_term_by( 'id', $tag_id, 'template_tag' );
        if ( $term && ! is_wp_error( $term ) ) {
            $template_tag = array(
                'id'        => $tag_id,
                'name'      => $term->name,
                'thumb'     => nbd_get_image_thumbnail( $thumbnail_id ),
                'templates' => array()
            );
            foreach( $templates as $template ){
                if( $template['tags'] != '' ){
                    if(isset($template['tags_arr']) && in_array( $tag_id, $template['tags_arr']) ){
                        $template_tag['templates'][] = NBD_Template_Tag::filter_template_by_folder( $data, $template['folder'] );
                    }
                }
            }

            return $template_tag;
        }
        return false;
    }



    /**
     * Filter tags for nbdesign sidebar
     */
    public function templates_info($data, $templates){
        if(!is_array($templates))
            return $data;
        
        if(count($templates) <= 0)
            return $data;
        


        
        $template_tags = $data['template_tags'];

        
        
            foreach($template_tags as $st => $childTemplate){ 
                    foreach($childTemplate['templates'] as $sc => $singleChildren){
                        
                        $query = $this->wpdb->get_row($this->wpdb->prepare("SELECT `paper_sizes`, `orientation` FROM {$this->wpdb->prefix}nbdesigner_templates WHERE `folder`=%s", $singleChildren['id']), OBJECT);
                        if($query && !empty($query->paper_sizes)){
                            $paper_sizes = explode(',', $query->paper_sizes);
                            foreach($paper_sizes as $size){
                                $sizedetails = get_term_by('id', (int)$size, 'paper_size' );
                                $data['template_tags'][$st]['templates'][$sc]['paper_sizes'][] = $sizedetails->slug;    
                            }
            
                        }
                        if($query && !empty($query->orientation)){
                            $paper_orientations = explode(',', $query->orientation);                            
                            foreach($paper_orientations as $orientation){
                                $p_orientation = get_term_by('id', (int)$orientation, 'orientation' );
                                $data['template_tags'][$st]['templates'][$sc]['paper_orientation'][] = $p_orientation->slug;    
                            }
                        }
                        
                    }
            }
            // update_option( 'testo3',  array('finaldata' => $data['template_tags']) );
        // $data['template_tags'] = $data['template_tags'];
        // update_option( 'testoption',$data );
        return $data;
    }





    /**
     * Override already registered taxonomy by wp designer plugins
     * @param array 
     * @return array
     */
    public function reregister_taxonomy(){
        $template_tag = get_taxonomy( 'template_tag' ); // returns an object
        if($template_tag)
            $template_tag->hierarchical = true;

        register_taxonomy( 'template_tag', array('product'), (array) $template_tag );        
    }


    /**
     * Add aditional js for nb designer frame 
     * @param string
     */
    public function nbd_extra_js($ui_mode){
        ob_start();
        wp_enqueue_media();
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
        <script type="text/javascript" src="<?php  echo get_stylesheet_directory_uri() .'/assets/js/child-theme-design-custom.js'; ?>"></script>
        <script>
            var local_var = <?php echo json_encode(array( 'ajaxurl' => admin_url( 'admin-ajax.php' ))); ?>
        </script>
        <?php
        echo ob_get_clean();
    }

    /**
     * Register additional css for design window
     * @param int
     */
    public function nbd_extra_css($mode){
        ob_start();
        ?>
        <link type="text/css" href="<?php echo get_stylesheet_directory_uri() . '/assets/css/child-theme-design-custom.css'; ?>" rel="stylesheet" media="all">
        <?php
        echo ob_get_clean();
    }

    
    /**
     * Register css assets for frontend 
     */
    public function registerCSS(){
        
        //CSS
        wp_register_style( 'cool-child-css', get_stylesheet_directory_uri(  ) . '/assets/css/child.css', array(), time(), 'all' );
        wp_register_style( 'cool-single-product-css', get_stylesheet_directory_uri(  ) . '/assets/css/single-product.css', array('cool-child-css'), time(), 'all' );
        wp_register_style( 'tooltip-css', 'https://cdnjs.cloudflare.com/ajax/libs/tooltipster/4.2.8/css/tooltipster.bundle.css', array('cool-child-css', 'cool-single-product-css'), time(), 'all' );
        wp_enqueue_style( 'cool-child-css' );

        if(is_product()){
            wp_enqueue_style( 'cool-single-product-css' );    
            wp_enqueue_style( 'tooltip-css' );    
        }

        //JS
        wp_register_script( 'tooltipster-js', 'https://cdnjs.cloudflare.com/ajax/libs/tooltipster/4.2.8/js/tooltipster.bundle.min.js', array('jquery'), time(), true );
        wp_register_script( 'cool-child-js', get_stylesheet_directory_uri(  ) . '/assets/js/printcart-child.js', array('jquery', 'tooltipster-js'), time(), true );
        wp_enqueue_script( 'cool-child-js' );

        if(class_exists( 'WooCommerce' ) && !is_cart()){
            wp_enqueue_script( 'wc-cart-fragments' );
        }
        if(is_product()){
            wp_enqueue_script( 'tooltipster-js' );
        }
    }

     /**
     * Add additional angular component 
     * @param string
     */
    public function nbdesign_additional_angular_component($ui_mode){
        ob_start(); ?>
            <div id="additionalTemplateMarkup">
                <div class="accordion accordion-content-transparent pl-10 pr-10" id="accordionCoolCard">
                    <div class="content-item iamomar" ng-init="testf" data-type="tags-{{template_tag.id}}" ng-repeat="template_tag in settings.template_tags">
                        <!-- <div > -->
                        <!-- <pre>
                            {{template_tag.templates | json}}
                        </pre> -->
                        <!-- <div  ng-repeat="child in template_tag.children" ng-if="coolcardCheckhaveitebysize(child.templates)" class="accordion-item  nbd-design-accordion">  Children accordion wrap -->
                            <h2 class="accordion-header mt-0 mb-0 " id="headingOne_{{template_tag.id}}">
                                <button class="border-0 accordion-button w-100 btn btn-default text-left collapsed" type="button" data-bs-toggle="collapse"  data-bs-target="#collapseCool{{template_tag.id}}" aria-expanded="false" aria-controls="collapseOne_{{template_tag.id}}">
                                    <span class="btn-text" ng-bind="template_tag.name"></span>
                                    <span class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8"/>
                                        </svg>
                                    </span>
                                </button>
                            </h2>
                            <div id="collapseCool{{template_tag.id}}" class="accordion-collapse collapse" aria-labelledby="headingOne_{{template_tag.id}}" data-bs-parent="#accordionCoolCard">
                                <div class="accordion-body coolcadAccordianBody mb-10 mt-10">
                                    <div class="d-grid gap-10">
                                    <!-- limitTo : resource.customTemplates[template_tag.id].limit -->
                                     
                                        <div ng-repeat="temp in template_tag.templates | limitTo : 30" class="item-img "  ng-click="insertTemplate(false, temp)">
                                            <img ng-src="{{temp.thumbnail}}" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- </div> --> 
                        </div>
                    <!-- </div> -->
                    <div style="display:none;" class="content-item globalCoolCard d-grid gap-10" nbd-scroll="scrollLoadMore(container, type)" data-container="#tab-product-template" data-type="globalTemplate" data-offset="30" data-current-type="{{resource.templateType}}">
                        <div class="item-img" ng-repeat="temp in resource.globalTemplate.data" ng-click="insertGlobalTemplate(temp.id, $index)">
                            <img ng-src="{{temp.thumbnail}}" alt="{{temp.name}}">
                        </div>
                    </div>
                </div>
            </div>



            <div id="additionalTypograpyCotnent">
                <div class="typography-head">
                    <span class="text-guide" ><?php esc_html_e('Click to om add text','web-to-print-online-designer'); ?></span>
                    <div class="head-main d-flex">
                        <span ng-click="addText('<?php echo str_replace( "&#039;", "\'", esc_attr__('Add Heading','web-to-print-online-designer') ); ?>')" class="text-body bg-white p-15" >
                            <span class="icon mb-5">
                                <svg width="29" height="28" viewBox="0 0 29 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.81818 5.0909C3.48063 5.0909 3.15691 5.22499 2.91823 5.46367C2.67954 5.70235 2.54545 6.02607 2.54545 6.36362V24.1818C2.54545 24.5194 2.67954 24.8431 2.91823 25.0818C3.15691 25.3204 3.48063 25.4545 3.81818 25.4545H21.6364C21.9739 25.4545 22.2976 25.3204 22.5363 25.0818C22.775 24.8431 22.9091 24.5194 22.9091 24.1818V17.3854C22.9091 16.6825 23.4789 16.1127 24.1818 16.1127C24.8847 16.1127 25.4545 16.6825 25.4545 17.3854V24.1818C25.4545 25.1945 25.0523 26.1656 24.3362 26.8817C23.6202 27.5977 22.649 28 21.6364 28H3.81818C2.80554 28 1.83437 27.5977 1.11832 26.8817C0.402272 26.1656 0 25.1945 0 24.1818V6.36362C0 5.35098 0.402271 4.37981 1.11832 3.66376C1.83437 2.94771 2.80554 2.54544 3.81818 2.54544H10.6145C11.3175 2.54544 11.8873 3.11526 11.8873 3.81817C11.8873 4.52108 11.3175 5.0909 10.6145 5.0909H3.81818Z" fill="#150707" fill-opacity="0.5"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M21.7364 0.372773C22.2334 -0.124258 23.0393 -0.124258 23.5363 0.372773L28.6272 5.46368C29.1242 5.96071 29.1242 6.76656 28.6272 7.26359L15.8999 19.9909C15.6613 20.2295 15.3375 20.3636 15 20.3636H9.90908C9.20617 20.3636 8.63635 19.7938 8.63635 19.0909V14C8.63635 13.6625 8.77044 13.3387 9.00913 13.1L21.7364 0.372773ZM11.1818 14.5272V17.8182H14.4728L25.9274 6.36364L22.6364 3.07264L11.1818 14.5272Z" fill="#150707" fill-opacity="0.5"/>
                                </svg>
                            </span>
                            <span class="text">
                                <?php echo sprintf('%s <br/>%s', esc_attr__( 'Text', 'web-to-print-online-designer' ), esc_attr__( 'hinzufügen', 'web-to-print-online-designer' )); ?>
                            </span>
                        </span>
                        <span ng-show="settings.nbdesigner_enable_curvedtext == 'yes'" ng-click="addCurvedText('<?php esc_html_e('Curved text','web-to-print-online-designer'); ?>')" class="text-body text-curved bg-white p-15">
                            <span class="icon mb-5">
                                <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14 25.4545C15.4058 25.4545 16.5455 24.3149 16.5455 22.9091C16.5455 21.5033 15.4058 20.3636 14 20.3636C12.5942 20.3636 11.4545 21.5033 11.4545 22.9091C11.4545 24.3149 12.5942 25.4545 14 25.4545ZM19.0909 22.9091C19.0909 25.7207 16.8116 28 14 28C11.1884 28 8.90909 25.7207 8.90909 22.9091C8.90909 20.0975 11.1884 17.8182 14 17.8182C16.8116 17.8182 19.0909 20.0975 19.0909 22.9091Z" fill="black" fill-opacity="0.5"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14 20.3636C13.2971 20.3636 12.7273 19.7938 12.7273 19.0909L12.7273 1.27273C12.7273 0.569822 13.2971 1.28537e-06 14 1.22392e-06C14.7029 1.16247e-06 15.2727 0.569822 15.2727 1.27273L15.2727 19.0909C15.2727 19.7938 14.7029 20.3636 14 20.3636Z" fill="black" fill-opacity="0.5"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M27.6272 14.9C27.3885 15.1386 27.0648 15.2727 26.7273 15.2727L22.9091 15.2727C22.2062 15.2727 21.6364 14.7029 21.6364 14C21.6364 13.2971 22.2062 12.7273 22.9091 12.7273L25.3837 12.7273C25.0964 10.1576 23.9456 7.74641 22.0996 5.90042C19.9514 3.75227 17.0379 2.54546 14 2.54546C10.9621 2.54546 8.04856 3.75227 5.90041 5.90042C4.05441 7.74642 2.90356 10.1576 2.61634 12.7273L5.09091 12.7273C5.79382 12.7273 6.36363 13.2971 6.36363 14C6.36363 14.7029 5.79382 15.2727 5.09091 15.2727L1.27273 15.2727C0.569819 15.2727 -1.16247e-06 14.7029 -1.22392e-06 14C-1.54852e-06 10.287 1.47499 6.72602 4.1005 4.10051C6.72601 1.475 10.287 1.54852e-06 14 1.22392e-06C17.713 8.99315e-07 21.274 1.475 23.8995 4.1005C26.525 6.72601 28 10.287 28 14C28 14.3375 27.8659 14.6613 27.6272 14.9Z" fill="black" fill-opacity="0.5"/>
                                </svg>
                            </span>
                            <span class="text"><?php esc_html_e('Gebogenen Text hinzufügen','web-to-print-online-designer'); ?></span>
                        </span>
                    </div>
                </div>
            </div>

        <?php
        echo ob_get_clean();
    }

     
}