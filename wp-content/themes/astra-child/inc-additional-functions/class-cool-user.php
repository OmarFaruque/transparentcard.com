
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
            add_action('init', array($this, 'transparentcard_add_pending_verification_role'));
        }

        /**
         * Add additional user role for varification purpose 
         */
        public function transparentcard_add_pending_verification_role(){
            add_role('pending_verification', __('Pending Verification'), array(
                'read' => true,
            ));
        }
    }
}