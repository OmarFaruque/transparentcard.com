<?php
/**
 * Order Item Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-item.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! apply_filters( 'woocommerce_order_item_visible', true, $item ) ) {
	return;
}
?>

<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_order_item_class', 'woocommerce-table__line-item order_item', $item, $order ) ); ?>">
	<td class="transparentProduct-details p-0" style="border:none;" colspan="2">
		<table>
			<tbody class="bg-white" style="background-color:white;">
				<tr>
					<td rowspan="4" class="p-0">
						<?php do_action( 'transparentcard_woocommerce_order_item_meta_top', $item_id, $item, $order, false ); ?>
					</td>
					<td colspan="2" class="text-center">
						<?php 
							$is_visible        = $product && $product->is_visible();
							$product_permalink = apply_filters( 'woocommerce_order_item_permalink', $is_visible ? $product->get_permalink( $item ) : '', $item, $order );
							echo wp_kses_post( apply_filters( 'woocommerce_order_item_name', $product_permalink ? sprintf( '<a style="font-size:26px; font-waight:500;" href="%s">%s</a>', $product_permalink, $item->get_name() ) : $item->get_name(), $item, $is_visible ) );
						?>
					</td>
				</tr>
				<tr>
					<td class="product-unit-price bg-light"><?php _e( 'Product price', 'transparentcard' ); ?></td>
					<td class="bg-light">
						<?php 
							echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $product ), $item, $item_id ); // PHPCS: XSS ok.
						?>
					</td>
				</tr>
				<tr>
					<td class="qty bg-light"><?php _e( 'Quantity', 'transparentcard' ); ?></td>
					<td class="bg-light">
						<?php 
							$qty          = $item->get_quantity();
							$refunded_qty = $order->get_qty_refunded_for_item( $item_id );

							if ( $refunded_qty ) {
								$qty_display = '<del>' . esc_html( $qty ) . '</del> <ins>' . esc_html( $qty - ( $refunded_qty * -1 ) ) . '</ins>';
							} else {
								$qty_display = esc_html( $qty );
							}

							echo apply_filters( 'woocommerce_order_item_quantity_html', ' <strong class="product-quantity">' . sprintf( '&times;&nbsp;%s', $qty_display ) . '</strong>', $item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						?>
					</td>
				</tr>
				<tr>
					<td class="bg-light item-total"><?php _e( 'Total price', 'transparentcard' ); ?></td>
					<td class="bg-light">
						<?php 
							// echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $product, $item['quantity'] ), $item, $item_id ); // PHPCS: XSS ok.
							echo $order->get_formatted_line_subtotal( $item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						?>
					</td>
				</tr>
				
				<?php 
					transparentcard_display_item_meta( $item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				?>
				
			</tbody>
		</table>
	</td>


</tr>

<?php if ( $show_purchase_note && $purchase_note ) : ?>

<tr class="woocommerce-table__product-purchase-note product-purchase-note">

	<td colspan="2"><?php echo wpautop( do_shortcode( wp_kses_post( $purchase_note ) ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></td>

</tr>

<?php endif; ?>
