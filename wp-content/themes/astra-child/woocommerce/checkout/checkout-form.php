
<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

	<div class="checkoutwrap d-flex gap-30">
		<div class="flex-5">
		<h3 id="order_review_heading" style="background-color:white; margin-bottom:10px;" class="bg-white mb-10"><?php _e( 'Billing details', 'woocommerce' ); ?></h3>
			<?php if ( $checkout->get_checkout_fields() ) : ?>

				<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

				<div class="col3-set" id="customer_details">
					<div class="col-1 orderDetailsInner">
						<?php do_action( 'woocommerce_checkout_billing' ); ?>
					</div>

					<div class="col-2">
						<?php do_action( 'woocommerce_checkout_shipping' ); ?>
					</div>
				</div>
				
				
				<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
			<?php endif; ?>
		</div>
		<div class="flex-3">
		
			<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
			

			<h3 id="order_review_heading" style="background-color:white; margin-bottom:10px;" class="bg-white mb-10"><?php _e( 'Your order', 'woocommerce' ); ?></h3>
			
			<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

			<div id="transparent_order_review" class="woocommerce-checkout-review-order">

				<?php do_action( 'woocommerce_checkout_order_review' ); ?>
			</div>

			<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
		</div>
	</div>
</form>