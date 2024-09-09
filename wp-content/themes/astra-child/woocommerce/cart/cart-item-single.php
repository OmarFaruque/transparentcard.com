<div style="display:flex; padding-right:0; padding-bottom:0;" class="transparentcard-menu-cart elementor-menu-cart__product woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

<div class="transparentcard-mini-cart-header d-flex">
    <div class="flex-1">
        <div class="elementor-menu-cart__product-image product-thumbnail thisOmarF">
            <?php
            $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
            $preview_img = COOL_Frontend::get_design_preview($cart_item, $cart_item_key);
            if ( ! $product_permalink ){
                echo wp_kses_post( $thumbnail );
            }else if(!isset($cart_item['nbd_item_meta_ds']['nbu']) && !empty($preview_img)){
                $thumbnail = apply_filters( 'transparentcard_cart_item_thumbnail', $preview_img, $cart_item, $cart_item_key );
                printf( '<a class="linknbu" href="%s"><img src="%s" alt="%s"/></a>', esc_url( $product_permalink ), $thumbnail, $_product->get_name() ); // PHPCS: XSS ok.
            }else{
                printf('<a href="%s">%s</a>', esc_url( $product_permalink ), wp_kses_post( $thumbnail));
            };
            ?>
        </div>
    </div>
    <div class="flex-1">
        <div class="qty-metas">
            <?php  
                if ( ! $product_permalink ) :
                    echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
                else :
                    echo wp_kses_post( apply_filters( 'transparent_card_woocommerce_cart_item_name', sprintf( '<a class="mini-cart-itemname" href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
                endif;
                do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );
            ?>
            <div class="transparentcard-qty-price-metas">
                <div class="price d-flex">
                    <div class="flex-1"><?php _e('Price per unit', 'woocommerce'); ?></div>
                    <div class="flex-1">
                        <div class="transparentcard-menu-cart__product-price product-price" data-title="<?php esc_attr_e( 'Preis', 'elementor-pro' ); ?>">
                            <?php echo apply_filters( 'transaparent_card_unit_price', $product_price, $cart_item, $cart_item_key );
                            ?>
                        </div>
                    </div>
                </div>
                <div class="qty d-flex">
                    <div class="flex-1"><?php _e( 'Quantity', 'transparentcard' ); ?></div>
                    <div class="flex-1">
                        <?php echo apply_filters( 'transaparent_card_cart_quantity', $cart_item['quantity'], $cart_item, $cart_item_key ); ?>
                    </div>
                </div>
                <div class="totalPrice d-flex">
                    <div class="flex-1"><?php _e( 'Total Price', 'transparentcard' ); ?></div>
                    <div class="flex-1">
                        <?php //echo apply_filters( 'transparent_cart_item_linetotal', '<span class="subtotal">' . $cart_item['line_subtotal'] . '</span>', $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped  ?>
                        <?php echo apply_filters( 'transparent_cart_item_linetotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok. ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="transparentcart-mini-cart-options-detai">
    <div class="elementor-menu-cart__product-name product-name" data-title="<?php esc_attr_e( 'Product', 'elementor-pro' ); ?>">
        <?php

        // Meta data.
        echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        ?>
    </div>
</div>
</div>