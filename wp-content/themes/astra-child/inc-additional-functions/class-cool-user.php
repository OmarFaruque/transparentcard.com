
<?php
/**
 * All user related methods 
 */

if(!class_exists('COOL_User')){
    class COOL_User{
        protected static $instance;
        public static function get_instance() {
            if ( is_null( self::$instance ) ) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        /**
         * Initial
         */
        public function __construct(){
            add_action('woocommerce_created_customer', array($this, 'transparentcard_assign_pending_verification_role'), 10, 1);
            add_filter('wp_authenticate_user', array($this, 'transparentcard_restrict_pending_verification_users'), 10, 2);
        }


        /**
         * Restrict unvarified user 
         * 
         * @param string $user
         * @param string $username
         * @param string $password
         */
        public function transparentcard_restrict_pending_verification_users($user, $password, $username = null){
            if ( in_array( 'pending_verification', $user->roles ) ) {
                wp_die( 'Your account is not verified. Please check your email for the verification link.' );
            }
            return $user;
        }


        
        /**
         * Complete email varification when user click varificiation link from email
         */
        public static function transparentcard_handle_email_verification(){
            if ( isset($_GET['verify_email']) && $_GET['verify_email'] == 'true' ) {
                $user_id = intval($_GET['user_id']);
                $token = sanitize_text_field($_GET['token']);
                
                $saved_token = get_user_meta($user_id, 'email_verification_code', true);
                
                if ( $saved_token && $saved_token === $token ) {
                    // Update user role to customer
                    $user = new WP_User( $user_id );
                    $user->set_role( 'customer' );
        
                    // Delete the token
                    delete_user_meta($user_id, 'email_verification_code');
        
                    // Redirect to a confirmation page
                    wp_redirect(home_url('/email-verified-successfully'));
                    exit;
                } else {
                    // Token mismatch, show an error
                    wp_die('Invalid or expired verification link.');
                }
            }
        }

        /**
         * Assign pending_verification role new created customer profile 
         * 
         * @param string
         */
        public function transparentcard_assign_pending_verification_role($customer_id){
            $user = new WP_User( $customer_id );
            $user->set_role( 'pending_verification' );

            // Send verification email
            send_verification_email($customer_id);
        }
    }
}