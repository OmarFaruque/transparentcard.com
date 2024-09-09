<?php
/**
 * Single product short description
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/short-description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $post, $product;

$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );

if ( ! $short_description ) {
	return;
}

$qty = $sell_price = 0;
$option_id = NBD_FRONTEND_PRINTING_OPTIONS::get_product_option( $post->ID );
if( $option_id ){
	$_options = NBD_FRONTEND_PRINTING_OPTIONS::get_option( $option_id );
	if( $_options ){
		$options = unserialize( $_options['fields'] );
		$qty = $options['quantity_breaks'][0]['val'];
		$sale_price = $product->get_price();
		$sell_price = $qty * $sale_price;
	}
}


?>
<div class="regular-price start-from">
	<?php echo sprintf('<span>%s: %s</span>', __('Price start from', 'transparent'), get_woocommerce_currency_symbol() . esc_attr( number_format($sell_price, 2) )); ?>
</div>
<div class="woocommerce-product-details__short-description">
	<?php echo $short_description; // WPCS: XSS ok. ?>
</div>
