<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.9.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>

<div class="transparentcard-cart-page d-flex gap-10">
	<div class="transparent-cart-details flex-2">
		<div class="transparent-title bg-white b-1 bs-solid" style="border-color: #DBDBDB; padding: 10px 30px;">
			<h2 class="mb-5 mt-5" style="margin-bottom: 5px; font-size: 30px;"><?php _e('Product list', 'transparentcard'); ?></h2>
		</div>
		<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
			<?php do_action( 'woocommerce_before_cart_table' ); ?>

			<div class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
				
				<div> <!-- <tbody> -->
					<?php do_action( 'woocommerce_before_cart_contents' ); ?>

					<?php
					foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {

						// $meta_data = $cart_item->get_formatted_meta_data('_', true);
						// echo 'meta data: <br/><pre>';
						// print_r($cart_item);
						// echo '</pre>';



						$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
						$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
						$preview_img = COOL_Frontend::get_design_preview($cart_item, $cart_item_key, false);
						$preview_img2 = COOL_Frontend::get_design_preview($cart_item, $cart_item_key, true);
						$orientation = COOL_Frontend::get_transparent_card_orientation_by_cart_item($cart_item);

						

						$nbd_settings = get_post_meta( $product_id, '_designer_setting', true );
            			$nbd_settings = unserialize($nbd_settings);
						$bg_img =  isset($nbd_settings[0]['img_src']) ? wp_get_attachment_image_src($nbd_settings[0]['img_src'], 'full') : array();
						$bg_img = $bg_img[0] ?? '';

						/**
						 * Filter the product name.
						 *
						 * @since 2.1.0
						 * @param string $product_name Name of the product in the cart.
						 * @param array $cart_item The product in the cart.
						 * @param string $cart_item_key Key for the product in the cart.
						 */
						$product_name = apply_filters( 'transparent_woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );

						

						if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
							$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
							?>
							<div style="border-color: #DBDBDB; padding: 30px 30px;" class="mt-10 mb-10 woocommerce-cart-form__cart-item d-block bg-white b-1 bs-solid <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>"> <!-- <tr> -->

									<div class="d-flex gap-20">
										<div class="item-left-shap flex-1">
											<div class="product-thumbnail">
												<?php
												$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image('full'), $cart_item, $cart_item_key );

												$metaNbd = $nbd_session = WC()->session->get($cart_item_key . '_nbd'); 
												
												if(empty($metaNbd))
													$metaNbd = isset($cart_item['nbd_item_meta_ds']['nbd']) ? $cart_item['nbd_item_meta_ds']['nbd'] : '';

												// $cart_item['nbd_item_meta_ds']['nbd'];

												if ( ! $product_permalink ) {
													echo $thumbnail; // PHPCS: XSS ok.
												}else if(!empty($metaNbd) && !empty($preview_img)){
													$thumbnail = apply_filters( 'transparentcard_cart_item_thumbnail', $preview_img, $cart_item, $cart_item_key );
													printf( '<a class="linknbu" href="%s"><img src="%s" alt="%s"/></a>', esc_url( $product_permalink ), $thumbnail, $_product->get_name() ); // PHPCS: XSS ok.
												} else {
													printf( '<a class="linkothumb" href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
												}
												?>
											</div>
										</div>


										<div class="item-right-shap flex-3">
											<div class="product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
												<?php

												
												if ( ! $product_permalink ) {
													echo wp_kses_post( $product_name . '&nbsp;' );
												} else {
													/**
													 * This filter is documented above.
													 *
													 * @since 2.1.0
													 */
													echo wp_kses_post( apply_filters( 'transparent_woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
												}

												do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

												// Meta data.
												// echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

												// Backorder notification.
												if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
													echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
												}
												?>
											</div>	
											<div class="transparent-action-area d-flex mb-10">
											<!-- <div class="product-price flex-2" data-title="<?php //esc_attr_e( 'Price', 'woocommerce' ); ?>">
												<h4><strong><?php ///esc_attr_e( 'Unit Price', 'woocommerce' ); ?></strong></h4>
												<?php
													//echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
												?>
											</div> -->

										<div class="product-quantity flex-2" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
											<h4><strong><?php esc_attr_e( 'Quantity', 'woocommerce' ); ?></strong></h4>
											<?php
											if ( $_product->is_sold_individually() ) {
												$min_quantity = 1;
												$max_quantity = 1;
											} else {
												$min_quantity = 0;
												$max_quantity = $_product->get_max_purchase_quantity();
											}

											$product_quantity = woocommerce_quantity_input(
												array(
													'input_name'   => "cart[{$cart_item_key}][qty]",
													'input_value'  => $cart_item['quantity'],
													'max_value'    => $max_quantity,
													'min_value'    => $min_quantity,
													'product_name' => $product_name,
												),
												$_product,
												false
											);

											echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
											?>
										</div>
										<div class="product-subtotal flex-1" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
											<h4><strong><?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?></strong></h4>
											<?php
												echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
											?>
										</div>
									</div>
									</div>
									<hr>
								</div> <!-- Right side -->

								<div class="bottons-group">
								<div class="transparent-action-buttons d-flex gap-15 mt-10">
										<div class="flex-1">
											<button type="button" onClick="openDetails('<?php echo esc_attr( $cart_item_key ); ?>')" class="transparent-product-details-btn btn btn-primary mt-0"><span><?php esc_attr_e( 'Product Details', 'transparentcard' ); ?></span></button>
										</div>
										<div  class="flex-1">
											<?php echo COOL_Frontend::get_nbd_edit_link(null, $cart_item, $cart_item_key); ?>
										</div>
										<?php if(isset($cart_item['nbd_item_meta_ds']['nbd'])): ?>
											<div  class="flex-1">
												<?php echo COOL_Frontend::copy_transparent_design($cart_item, $cart_item_key); ?>
											</div>
										<?php endif; ?>

										<?php if(isset($cart_item['nbo_cus_meta'])): ?>
											<div  class="flex-1">
												<?php echo COOL_Frontend::copy_transparent_upload($cart_item, $cart_item_key); ?>
											</div>
										<?php endif; ?>

										
										<div class="flex-1">
											<div class="transparent-product-remove h-full">
												<?php
													echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
														'woocommerce_cart_item_remove_link',
														sprintf(
															'<a href="%s" class="remove-transparent btn btn-primary" aria-label="%s" data-product_id="%s" data-product_sku="%s"><span class="removeIcon"><img src="%s" alt="%s"/></span>%s</a>',
															esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
															/* translators: %s is the product name */
															esc_attr( sprintf( __( 'Remove %s from cart', 'woocommerce' ), wp_strip_all_tags( $product_name ) ) ),
															esc_attr( $product_id ),
															esc_attr( $_product->get_sku() ), 
															get_stylesheet_directory_uri(  ) . '/assets/img/remove-icon.svg',
															esc_attr__( 'Remove', 'transparentcard' ),
															esc_attr__( 'Delete', 'transparentcard' )
														),
														$cart_item_key
													);
												?>
											</div>
										</div>
									</div>
							</div>
							</div>



							<div class="cart-product-details-popup" id="popup-details-<?php echo esc_attr( $cart_item_key ); ?>">
								<div class="pipinner position-absulate">
									<div class="popup-close position-absulate">
										<span class="close courser-pointer" onClick="openDetails('<?php echo esc_attr( $cart_item_key ); ?>')">
											<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
												<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"/>
											</svg>
										</span>
									</div>
									<div class="d-flex pipinner-wrapr <?php echo esc_attr( $orientation ); ?>" style="align-items: center; gap: 30px;">
									<?php if($preview_img): ?>
										<div class="flex-1">
											<div class="image">
												<div class="design" style="<?php echo !empty($bg_img) ? 'background-image:url('.$bg_img.')':''; ?>" colspan="2" style="padding:0;">
													<img style="max-width:100%;" class="nbd_cart_item_design_preview" src="<?php echo esc_url( $preview_img2 ); ?>"/>
												</div>
											</div>
										</div>
										<?php endif; ?>
										<div class="flex-1">
											<table class="popuptable">
												<tbody>
													<?php
													// Meta data.
														echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.
													?>		
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							<?php
						}
					} // EndForeach
					?>

					<?php do_action( 'woocommerce_cart_contents' ); ?>

					<div class="transparentcart-coupon-area bg-white p-10 b-1 bs-solid" style="border-color: #DBDBDB; padding: 30px;">
						<div colspan="6" class="actions">

							<?php if ( wc_coupons_enabled() ) { ?>
								<div class="coupon">
									<label for="coupon_code" class="screen-reader-text"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label> 
									<input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> 
									<?php do_action( 'woocommerce_cart_coupon' ); ?>
								</div>
							<?php } ?>

							<button type="submit" class="button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_html_e( 'Apply coupon', 'woocommerce' ); ?></button>
							<button type="submit" class="button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>

							<?php do_action( 'woocommerce_cart_actions' ); ?>

							<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
						</div>
					</div>

					<?php do_action( 'woocommerce_after_cart_contents' ); ?>
				</div> <!-- </tbody> -->
			</div> <!-- </table> -->
			<?php do_action( 'woocommerce_after_cart_table' ); ?>
		</form>
	</div>
	<div class="transparent-cart-total flex-1">
	<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>
		<div class="transparent-cart-collaterals">
			<?php
				/**
				 * Cart collaterals hook.
				 *
				 * @hooked woocommerce_cross_sell_display
				 * @hooked woocommerce_cart_totals - 10
				 */
				do_action( 'woocommerce_cart_collaterals' );
			?>
		</div>
	</div>
</div>
<?php do_action( 'woocommerce_after_cart' ); ?>
