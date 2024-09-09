<section id="header" class="header-fileupload fullscreen box-shadow" style="background-color:#ECFF8C;">
    <div class="innersect ast-container ml-auto mr-auto">
        <div class="d-flex align-item-center">
            <div class="flex-1">
                <h3 class="text-capitalize"><?php _e('Order your business card', 'transparentcard'); ?></h3>
                <p class="mb-0"><?php _e('If you already have the design for your Business Cards, you only need to upload your file.', 'transparentcard'); ?></p>
            </div>
            <div class="flex-1 text-right bg-white box-shadow border-rounded  youarebuying">
                <div class="w-full d-flex  align-item-center">
                    <div class="flex-6 text-left">
                        <p class="mb-0 color-gray" style="color:#879494;"><?php _e('You are buying', 'transparentcard'); ?></p>
                        <p class="mb-0"><strong><?php echo isset($_GET['pid']) ? esc_attr( get_the_title( $_GET['pid'] ) ) : ''; ?></strong></p>
                        <p class="mb-0"><?php echo sprintf(__('%s Units', 'transparentcard'), $_GET['qty'] ?? 0) ?></p>
                    </div>
                    <div class="flex-1">
                        <p class="cart-price mb-0"><strong><?php echo get_woocommerce_currency_symbol(); ?><?php echo esc_attr( number_format($_GET['price'] ?? 0, 2) ); ?></strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .youarebuying {
       padding: 15px 30px;
       margin: 40px 0px;
    }
</style>