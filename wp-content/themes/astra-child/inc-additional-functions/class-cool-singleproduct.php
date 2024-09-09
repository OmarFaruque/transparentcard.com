<?php
// use NBD_Template_Tag;
class COOL_Singleproduct{
    protected $wpdb;

    public function __construct(){
        global $wpdb;
        $this->wpdb = $wpdb;

        add_filter( 'woocommerce_add_to_cart_validation', array(__CLASS__, 'wk_add_to_cart_validation'), 10, 4 );

        add_filter( 'woocommerce_add_cart_item_data', array(__CLASS__, 'wk_add_cart_item_data'), 10, 3 );

        add_action( 'woocommerce_checkout_create_order_line_item', array(__CLASS__, 'wk_checkout_create_order_line_item'), 10, 4 );

        add_action( 'nbo_most_bottom_hook', array($this, 'coolcards_expert_design_upload_materials'), 50, 2 );


        // add_action( 'wp_head', function(){
        //     echo 'post array <br/><pre>';
        //     print_r(get_option( 'up_files', array() ));
        //     echo '</pre>';
        // });

        
    }


    /**
     * Expert option upload logo and content details 
     * 
     * @param int
     * @param array
     * 
     * @return html
    */
    public function coolcards_expert_design_upload_materials(){
        ob_start();  ?>
        <div id="expert_designer_meterials" ng-if="show_expert_upload" class="mb-10">
        
            <div class="row align-middle">
                <div class="form-group mb-5 col-xs-12 col-sm-12 col-md-12 align-middle d-flex align-item-center">
                    <label for="coolcard-nbd-logo" class="flex-1" style="min-width: 110px;"><?php _e('Wählen Sie ein Logo', 'transparentcard'); ?></label>
                    <div class="files_group flex-2 position-relative">
                        <div class="input-item">
                            <input type="file" class="form-control w-full" name="coolcard-nbd-logo[]" id="coolcard-nbd-logo" ng-change="upload_expert_logo()" >
                        </div>
                        <div class="add-more-files position-absulate" style="z-index:1;">
                            <span class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-file-plus-fill" viewBox="0 0 16 16">
                                    <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2M8.5 6v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 1 0"/>
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-5 col-xs-12 col-sm-9 col-md-12 flex-3">
                    <textarea required placeholder="<?php _e('Schreiben Sie hier Ihre Notizen...', 'transparentcard'); ?>" name="coolcard-note" id="coolcard-note" class="form-control" cols="30" rows="3"></textarea>
                </div>
            </div>
        </div>
        <?php 
        echo ob_get_clean();
    }



    /**
     * Add additional item for display order page 
     * 
     * @param array $item
     * @param string $cart_item_key
     * @param string $values
     * @param array $order
     */
    public static function wk_checkout_create_order_line_item($item, $cart_item_key, $values, $order){
        if ( isset( $values['coolcarde-note'] ) ) {
            $item->add_meta_data(__( 'Note', 'coolcard' ), $values['coolcarde-note'], true);
        }

        if ( isset( $values['coolcarde-image'] ) ) {
            $images = explode(', ', $values['coolcarde-image']);
            $outputImgHTML = '<ul class="expertUploadImg">';
            foreach($images as $sImg){
                $outputImgHTML .= sprintf('<li><a download href="%s"><img class="expertuploadImg img-fluid" style="max-width: 140px;" src="%s" alt="%s"/></a></li>', $sImg, $sImg, __('coolcard-image', 'coolcard'));
            }
            $outputImgHTML .= '</ul>';
            $item->add_meta_data(__( 'Image', 'coolcard' ), $outputImgHTML, true);
        }
    }

    /**
     * Add additional cart item
     * 
     * @param array $cart_item_data 
     * @param init $product_id 
     * @param init $variation_id 
     * 
     */
    public static function wk_add_cart_item_data($cart_item_data, $product_id, $variation_id){
        
        if ( isset( $_POST['coolcard-note'] ) && !empty($_POST['coolcard-note']) ) {
            $cart_item_data['coolcarde-note'] = sanitize_text_field( $_POST['coolcard-note'] );
        }
        if(isset($_FILES['coolcard-nbd-logo']) && !empty($_FILES['coolcard-nbd-logo']) ){

            // update_option( 'up_files', $_FILES['coolcard-nbd-logo'] );

            


            $upload_dir = wp_upload_dir();
            $baseUrl = $upload_dir['baseurl'] . '/expertupload/user_' . get_current_user_id(  ) . '/';
            $baseDir = $upload_dir['basedir'] . '/expertupload/user_' . get_current_user_id(  ) . '/';
            
            if(!is_dir($baseDir))
                mkdir($baseDir, 0755, true);


            $outputFiles = array();
            foreach($_FILES["coolcard-nbd-logo"]["name"] as $k => $singleFile){
                $itemNewName = time() . basename($singleFile);
                $image_name = $baseDir . $itemNewName;
                
                $check = getimagesize($_FILES["coolcard-nbd-logo"]["tmp_name"][$k]);
                if($check != false){
                    move_uploaded_file($_FILES["coolcard-nbd-logo"]["tmp_name"][$k], $image_name);
                }

                array_push($outputFiles, $baseUrl . $itemNewName);
            }

            $cart_item_data['coolcarde-image'] = !empty($outputFiles) ? implode(', ', $outputFiles) : '';
        }
        return $cart_item_data;
    }

    /**
     * Validation additional fields 
     * @param bool $passed
     * @param init $product_id 
     * @param init $quantity
     * @param init $variation_id
     */
    public static function wk_add_to_cart_validation($passed, $product_id, $quantity, $variation_id = null){
        if ( isset( $_POST['coolcard-note'] ) && empty($_POST['coolcard-note']) ) {
            $passed = false;
            wc_add_notice( __( 'Quote is a required field.', 'webkul' ), 'error' );
        }
        return $passed;
    }
}