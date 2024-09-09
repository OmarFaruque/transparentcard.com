<?php
class COOL_Elementor{
    public function __construct(){
        add_action( 'elementor/widgets/register', array($this, 'coolcard_signup_form') );
    }

    /**
     * Signup form
     * 
     * @param object
     */

    public function coolcard_signup_form($widgets_manager){
        require_once( __DIR__ . '/widgets/signup-form.php' );

        $widgets_manager->register( new \Elementor_Signup() );

    }
}