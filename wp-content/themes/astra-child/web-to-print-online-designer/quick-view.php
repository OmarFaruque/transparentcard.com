<?php
/**
 * NBO Quick view template
 */
if (!defined('ABSPATH')) {
    exit;
}
global $product, $post, $woocommerce;
do_action('nbo_quick_view_before_single_product');
?>
<div class="woocommerce quick-view">
    <div class="product" id="product-<?php echo $post->ID; ?>">
        <div class="quick-view-image images transparent-popup-details">
            <div class="singleitem">
                <div class="woocommerce-product-gallery__image scrollable">
                    <?php woocommerce_template_single_title(); ?>
                    <?php //woocommerce_template_single_price(); ?>
                    <?php woocommerce_template_single_excerpt(); ?>
                </div>
                <a class="quick-view-detail-button button" target="_blank" href="<?php echo get_permalink($product->get_id()); ?>"><?php _e('View Full Details', 'web-to-print-online-designer'); ?></a>
            </div>
            <div class="singleitem">

            </div>
        </div>
        <div class="quick-view-content entry-summary summary omarf">
            <?php woocommerce_template_single_add_to_cart(); ?>
        </div>
    </div>
</div>

<script>
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    let qty = urlParams.get('qty');
    let options = urlParams.get('options');

    setTimeout(() => {
        if(qty){
            document.querySelector('.defaultProductQty').value = qty;
        }
        // console.log('Options: ', options);
    }, 1000);

</script>

<style>
    
</style>