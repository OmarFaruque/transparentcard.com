<?php

defined( 'ABSPATH' ) || exit;

$cart_items = WC()->cart->get_cart();


// echo 'cart items array <br/><pre>';
// print_r($cart_items);
// echo '</pre>';


if ( empty( $cart_items ) ) { ?>
	<div class="woocommerce-mini-cart__empty-message"><?php esc_attr_e( 'No products in the cart.', 'elementor-pro' ); ?></div>
<?php } else { ?>
	<div class="transparent-100 elementor-menu-cart__products woocommerce-mini-cart cart woocommerce-cart-form__contents">
		<?php
		do_action( 'woocommerce_before_mini_cart_contents' );

		foreach ( $cart_items as $cart_item_key => $cart_item ) {
			elementor_pro_render_mini_cart_item( $cart_item_key, $cart_item, true );
		}

		do_action( 'woocommerce_mini_cart_contents' );
		?>
	</div>

	<div class="elementor-menu-cart__subtotal text-white">
		<h4 class="mb-0"><strong><?php echo esc_html__( 'Subtotal', 'woocommerce' ); // phpcs:ignore WordPress.WP.I18n ?>:</strong></h4>
		<h3 class="mb-0"><?php echo WC()->cart->get_cart_subtotal(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h3>
	</div>
	<div class="elementor-menu-cart__footer-buttons">
		<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="elementor-button elementor-button--view-cart elementor-size-md">
			<span class="elementor-button-text"><?php echo esc_html__( 'View cart', 'woocommerce' ); // phpcs:ignore WordPress.WP.I18n ?></span>
		</a>
		<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="elementor-button elementor-button--checkout elementor-size-md">
			<span class="elementor-button-text"><?php echo esc_html__( 'Checkout', 'woocommerce' ); // phpcs:ignore WordPress.WP.I18n ?></span>
		</a>
	</div>
	<?php
} // empty( $cart_items )

?>
