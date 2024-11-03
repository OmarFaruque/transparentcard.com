<?php
// add_filter( 'woocommerce_cart_item_name', array( $this, 'cart_item_name' ), 50, 3 );


require_once  get_stylesheet_directory() . '/inc-additional-functions/helper.php';
// Add additional functions file 
require_once get_stylesheet_directory() . '/inc-additional-functions/class-cool-instance.php';



add_action('after_setup_theme', 'my_theme_setup');
function my_theme_setup(){
    load_theme_textdomain('web-to-print-online-designer', get_template_directory() . '/lang');
}



// Removes the price
add_filter('woocommerce_get_price_html', function() {
    return ''; 
});

add_action('woocommerce_after_shop_loop_item_title', 'display_custom_price_in_product_card',10);
function display_custom_price_in_product_card() {
    global $product;
    $product_id = $product->get_id();
    
    $custom_price = get_field('product_package_price', $product_id);
    
    if ($custom_price && $custom_price > 0) {
        echo '<p class="tc-custom-price">' .'<span>Quantity: 250</span>'. ' '. '<span>Price: </span>'. wc_price($custom_price) . '</p>';
    }
}


// Post tags shortcode
function display_post_tags_shortcode() {
    if (is_single()) {
        $post_tags = get_the_tags();
        
        if ($post_tags) {
            $output = '<ul class="tc-post-tags">';
            foreach ($post_tags as $tag) {
                $output .= '<li><a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a></li>';
            }
            $output .= '</ul>';
        } else {
            $output = '<p style="margin:0;font-size:16px;">No tags found.</p>';
        }
        
        return $output;
    }
}
add_shortcode('post_tags', 'display_post_tags_shortcode');