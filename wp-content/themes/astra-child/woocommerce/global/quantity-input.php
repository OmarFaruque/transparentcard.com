<?php
/**
 * Product quantity inputs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/quantity-input.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     4.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $product, $nbd_fontend_printing_options;

$option_id = $nbd_fontend_printing_options->get_product_option( $args['product_id'] );
$_options = $nbd_fontend_printing_options->get_option( $option_id );
$quantityBreaks = $_options ? unserialize($_options['fields']) : array();
$quantityBreaks = $quantityBreaks['quantity_breaks'];



if(empty($max_value)){ $max_value = 9999; }
$input_style = get_theme_mod('cart_qty_selection_style');


?>
<div class="transparent-quantity <?php echo esc_attr($input_style); ?>">
	<?php if('dropdown' != $input_style): ?>
		<input type="number" class="input-text qty text" step="<?php echo esc_attr( $step ); ?>" min="<?php echo esc_attr( $min_value ); ?>" max="<?php echo esc_attr( 0 < $max_value ? $max_value : '' ); ?>" name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $input_value ); ?>" title="<?php echo esc_attr_x( 'Qty', 'Product quantity input tooltip', 'printcart' ) ?>" size="4" pattern="<?php echo esc_attr( $pattern ); ?>" inputmode="<?php echo esc_attr( $inputmode ); ?>" />
		<div class="qty-buttons">
			<span class="quantity-plus pt-icon-plus"></span>
			<span class="quantity-minus pt-icon-minus"></span>
		</div>
	<?php elseif(is_cart()): ?>
		<select style="padding: 5px 10px;" name="<?php echo esc_attr( $input_name ); ?>" id="qty_transparentcard_selection">
			<?php foreach($quantityBreaks as $break): ?>
					<option <?php selected(esc_attr( $break['val'] ), esc_attr( $input_value ), true ); ?>  value="<?php echo esc_attr($break['val']); ?>"><?php echo esc_attr($break['val']); ?></option>
			<?php endforeach; ?>
		</select>

	<?php else: ?>
		<div class="d-none" style="display:none;">
			<span class="quantity-minus pt-icon-minus"></span>
				<input type="number" class="input-text qty text" step="<?php echo esc_attr( $step ); ?>" min="<?php echo esc_attr( $min_value ); ?>" max="<?php echo esc_attr( 0 < $max_value ? $max_value : '' ); ?>" name="<?php echo esc_attr( $input_name ); ?>" value="<?php  echo esc_attr( $input_value ); ?>" title="<?php echo esc_attr_x( 'Qty', 'Product quantity input tooltip', 'printcart' ) ?>" size="4" pattern="<?php echo esc_attr( $pattern ); ?>" inputmode="<?php echo esc_attr( $inputmode ); ?>" />
			<span class="quantity-plus pt-icon-plus"></span>
		</div>
	<?php endif; ?>
	
</div>
