


<section id="header" class="header-fileupload fullscreen box-shadow" style="background-color:#ECFF8C;">
    <div class="innersect ast-container ml-auto mr-auto">
        <div class="d-flex align-item-start">
            <div class="flex-1 mt-40">
                <h3 class="text-capitalize"><?php _e('Order your business card', 'transparentcard'); ?></h3>
                <p class="mb-0"><?php _e('If your Business Card design is ready, simply upload your file to proceed.', 'transparentcard'); ?></p>
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
<section class="backbtn">
        <!-- Header -->
        <?php if($args['single']): ?>
            <div class="ast-container ml-auto mr-auto">
        <?php endif; ?>
        <div class="choose-design-template-header mt-20">
            <div class="back-to-product">
                <a href="<?php echo esc_url( get_the_permalink( $_GET['pid'] ) ); ?>" class="back-to-template-gallery-btn color-white" style="padding:15px 30px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                        class="bi bi-chevron-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0" />
                    </svg>
                    <?php _e('Back to Product', 'transparentcard'); ?>
                </a>
            </div>
        </div><!-- /Header -->
        <?php if($args['single']): ?>
        </div>
    <?php endif; ?>
</section>
<style>
    .youarebuying {
       padding: 15px 30px;
       margin: 40px 0px;
    }
</style>