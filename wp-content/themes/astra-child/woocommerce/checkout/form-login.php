<?php
/**
 * Checkout login form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;

if ( is_user_logged_in() || 'no' === get_option( 'woocommerce_enable_checkout_login_reminder' ) ) {
	return;
}

?>
<div class="note text-center mb-25">
	<?php _e( 'Wenn Sie schon einmal bei uns eingekauft haben, geben Sie bitte Ihre Zugangsdaten in die Felder des Anmeldeformulars ein. Wenn Sie ein neuer Kunde sind, klicken Sie bitte auf den Registrierungsbutton und erstellen Sie Ihr Profil vor dem Checkout.', 'transparentcard' );  ?>
</div>
<div class="d-flex gap-20 mb-40">
	<div class="flex-1">
		<div class="woocommerce-form-login-toggle text-center">
			<?php echo apply_filters( 'woocommerce_checkout_registration_button', ' <button type="button" class="secondary-color showRegistration">' . __( 'Hier geht\'s zur Anmeldung', 'transparentcard' ) . '</button>' ); ?>
		</div>
	</div>
	<div class="flex-1">
		<div class="woocommerce-form-login-toggle text-center">
			<?php echo apply_filters( 'woocommerce_checkout_login_button', ' <button type="button" class="secondary-color showlogin">' . __( 'Klicken Sie hier, um sich anzumelden', 'transparentcard' ) . '</button>' ); ?>
		</div>
	</div>
</div>

<?php

woocommerce_login_form(
	array(
		'message'  => '',
		'redirect' => wc_get_checkout_url(),
		'hidden'   => true,
	)
);
