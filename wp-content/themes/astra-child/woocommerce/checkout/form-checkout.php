<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}
// wc_get_template_part
?>

<div class="container">
<?php 
	if(is_user_logged_in(  ))
		require_once( get_stylesheet_directory(  ) . '/woocommerce/checkout/checkout-form.php' );
	
	if(!is_user_logged_in(  ))
		require_once( get_stylesheet_directory(  ) . '/woocommerce/checkout/checkout-registration-form.php' );

?>
</div>
<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
	

