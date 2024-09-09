<?php
// add_filter( 'woocommerce_cart_item_name', array( $this, 'cart_item_name' ), 50, 3 );


require_once  get_stylesheet_directory() . '/inc-additional-functions/helper.php';
// Add additional functions file 
require_once get_stylesheet_directory() . '/inc-additional-functions/class-cool-instance.php';



add_action('after_setup_theme', 'my_theme_setup');
function my_theme_setup(){
    load_theme_textdomain('web-to-print-online-designer', get_template_directory() . '/lang');
}

