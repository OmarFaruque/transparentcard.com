<?php
/**
 * Order details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.5.0
 *
 * @var bool $show_downloads Controls whether the downloads table should be rendered.
 */

defined( 'ABSPATH' ) || exit;

$order = wc_get_order( $order_id ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited

if ( ! $order ) {
	return;
}

$order_items           = $order->get_items( apply_filters( 'woocommerce_purchase_order_item_types', 'line_item' ) );
$show_purchase_note    = $order->has_status( apply_filters( 'woocommerce_purchase_note_order_statuses', array( 'completed', 'processing' ) ) );
$show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id();
$downloads             = $order->get_downloadable_items();

if ( $show_downloads ) {
	wc_get_template(
		'order/order-downloads.php',
		array(
			'downloads'  => $downloads,
			'show_title' => true,
		)
	);
}
?>
<section class="woocommerce-order-details transparentcard-order-details">
	<?php do_action( 'woocommerce_order_details_before_order_table', $order ); ?>

	<!-- <h2 class="woocommerce-order-details__title"><?php // esc_html_e( 'Order details', 'woocommerce' ); ?></h2> -->

	<table style="border: none;" class="woocommerce-table woocommerce-table--order-details transparentcard-shop_table order_details">
		<tbody>
			<?php
			do_action( 'woocommerce_order_details_before_order_table_items', $order );

			foreach ( $order_items as $item_id => $item ) {
				$product = $item->get_product();

				wc_get_template(
					'order/order-details-item.php',
					array(
						'order'              => $order,
						'item_id'            => $item_id,
						'item'               => $item,
						'show_purchase_note' => $show_purchase_note,
						'purchase_note'      => $product ? $product->get_purchase_note() : '',
						'product'            => $product,
					)
				);
			}

			do_action( 'woocommerce_order_details_after_order_table_items', $order );
			?>
		</tbody>
	</table>

	<?php do_action( 'woocommerce_order_details_after_order_table', $order ); ?>
</section>

<section class="transparentcard-checkout-summery-details">
	<table class="mt-10" style="background-color:#308EA71A;">
		<tbody>
			<?php
			$delivery = '';
			foreach ( $order->get_order_item_totals() as $key => $total ) {
				if($key == 'payment_method'){
					$delivery = $total;
					continue;
				}
				?>
					<tr>
						<th class="th_<?php esc_attr_e($key); ?>" scope="row"><?php echo esc_html( $total['label'] ); ?></th>
						<td class="td_<?php esc_attr_e($key); ?>"><?php echo wp_kses_post( $total['value'] ); ?></td>
					</tr>
					<?php
			}
			?>

			<?php if(!empty($delivery)): ?>
				<tr>
					<td colspan="2" class="text-center transparentcard-paymentmehtods">
						<span>
							<span><?php echo esc_attr( $delivery['label'] ); ?></span>
							<span><?php echo esc_attr( $delivery['value'] ); ?></span>
						</span>
					</td>
				</tr>
			<?php endif; ?>
			<?php if ( $order->get_customer_note() ) : ?>
				<tr>
					<th><?php esc_html_e( 'Note:', 'woocommerce' ); ?></th>
					<td><?php echo wp_kses_post( nl2br( wptexturize( $order->get_customer_note() ) ) ); ?></td>
				</tr>
			<?php endif; ?>
		</tbody>
	</table>

</section>

<?php
/**
 * Action hook fired after the order details.
 *
 * @since 4.4.0
 * @param WC_Order $order Order data.
 */
do_action( 'woocommerce_after_order_details', $order );

if ( $show_customer_details ) {
	wc_get_template( 'order/order-details-customer.php', array( 'order' => $order ) );
}
