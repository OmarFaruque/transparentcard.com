<?php
/**
 * Step 1
 */
?>

<?php extract($args); ?>
<?php 


    $additionalMetas = $cart['nbo_additional_meta'] ?? array();
    if ( isset($_POST['custom_upload_nonce']) && wp_verify_nonce($_POST['custom_upload_nonce'], 'custom_upload_action') ) {
        $additionalMetas = $_POST;
    }
?>
<div class="wrapperstepform">
<div class="innerwrapper mt-20 border-rounded">
 <!-- Product configuration -->
    <div class="d-flex single pb-20">
        <div class="flex-1">
            <div class="sectiontitle position-relative d-flex align-item-center gap-10 d-flex align-item-center gap-10">
                <span class="count">4</span>
                <h5><?php _e('Visual Style', 'transparentcard'); ?></h5>
            </div>
        </div>
        <div class="flex-2">
            <h6 class="m-0"><?php _e('Select up to three colors you wish to have in your design', 'transparentcard'); ?></h6>
            <p><?php _e('If you do not select one, it will be our design team to decide', ) ?></p>
            <p style="color:red; line-height: 17px; font-size: 12px;"><?php echo sprintf('<strong>%s</strong>: %s', __('Warning Message', 'transparentcard'), __('If you select RGB colors or HEX, make sure you might get 20% dissimilarity from the original color. If you have CMYK color code please write down in below text field. Also CMYK color code can porduce 10% dissimilarity then the desired color. If you want exact color you should have pantone colors which we don\'t print.', 'transparentcard')); ?></p>
            <div class="form-group colorselectarea">

                <?php 
                    if(isset( $additionalMetas['colors'] ) && !empty($additionalMetas['colors'])): 
                        $colors = explode(', ', $additionalMetas['colors']);
                        foreach($colors as $k => $singleColor):
                ?>
                        <div><label for="colorPicker" class="position-relative add-new-colorplate colorplate-item" style="background-color: <?php echo esc_attr( $singleColor ); ?>; border-color: <?php echo esc_attr( $singleColor ); ?>;">
                            <div class="d-flex gap-10" style="align-items:center;flex-direction:column;">
                                <div class="flex-1">
                                    <input type="color" style="opacity:0; position:absolute; z-index:0;" id="colorPicker" name="colors[]" value="<?php echo esc_attr( $singleColor ); ?>" data-gtm-form-interact-field-id="1">
                                    <input type="text" class="form-control opencolor" readonly="" placeholder="Choose a color">
                                </div>
                                <div class="flex-2">
                                    <div class="colorbody"></div>
                                </div>
                            </div>
                        </label></div>
                <?php 
                        endforeach;
                    endif;
                ?>
                <div><label for="colorPicker" class="position-relative add-new-colorplate" onclick="addcolorplate();">
                    <div class="d-flex gap-10" style="align-items:center;">
                        <div class="flex-1">
                            <!-- <input type="color" style="opacity:0; position:absolute; z-index:0;" id="colorPicker" name="colors[]" >     -->
                            <img src="<?php echo esc_url( get_stylesheet_directory_uri(  ) . '/assets/img/plus.webp'); ?>" alt="<?php _e('Plus', 'transparentcart'); ?>">
                        </div>
                        <div class="flex-2">
                            <?php _e('Add new color', 'transparentcard'); ?>
                        </div>
                    </div>
                </label></div>
            </div>
            <div class="form-group mt-15">
                <label for="shared_idea"><?php _e('Please share your detailed color information and if you have CMYK color code please write down here.', 'transparentcard'); ?><span>*</span></label>
                <div class="d-flex gap-10 flex-direction-column-mobile">
                    <textarea name="shared_idea" style="color:#555;" id="shared_idea" class="form-control flex-2" row="5"><?php echo esc_attr( $additionalMetas['shared_idea'] ?? '' ); ?></textarea>
                    <div class="example flex-1" style="margin-top:auto;">
                        <div class="card info">
                            <div class="header"><?php _e('Example', 'transparentcard'); ?>:</div>
                            <div class="body p-5">
                                <p class="mb-0">"<?php _e('I want a very modern design with lots of colors, but I do not like red or black.', 'transparentcard'); ?>"</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group mt-15">
                <label for="image_in_design"><?php _e('Would you like to insert other images in your design?', 'transparentcard'); ?></label>
                <div class="uploadbutton">
                    <button onclick="clickuploader(this)" class="btn px-15 py-5 image_in_designbtn" type="button"><?php _e('Images Upload', 'transparentcard'); ?></button>
                    <input type="file" id="styleuploadinput" class="fileuploaderinput" name="design_images[]" title="style" style="display:none;" accept=".jpg, .jpeg, .png, .tif, .tiff, .bmp, .pdf" data-operationid="DaMImages"  data-maxfilesize="15728640" data-hasallowedextensions="true" multiple>
                </div>
                <div class="uploadfilespreview">
                    <ul></ul>
                </div>

            </div>
            
        </div>
        <div class="flex-1"></div>
    </div>



    <div class="d-flex single pb-25" style="gap:20px !important;">
        <div class="flex-1">
            <div class="sectiontitle position-relative d-flex align-item-center gap-10 d-flex align-item-center gap-10">
                <span class="count">5</span>
                <h5><?php _e('Logo', 'transparentcard'); ?></h5>
            </div>
        </div>
        <div class="flex-3">
            
            <div class="form-group">
                <label for="shared_idea"><?php _e('What Logo do you want to include in your Product Design?', 'transparentcard'); ?><span>*</span></label>
                <div class="d-grid gap-10 logo-wrap-group grid-tampleate-column-3">
                    <div class="flex-1">
                        
                        <label onclick="logo_wrap('request-logo-wrap', jQuery(this))" class="flex-2 radio-label w-full" for="logo_type_1">
                            <input <?php echo esc_attr(isset($additionalMetas['logo_type']) && $additionalMetas['logo_type'] == __('Request logo', 'transparentcard') ? 'checked' : ''); ?> data-price="8.98" type="radio" name="logo_type" id="logo_type_1" value="<?php _e('Request logo', 'transparentcard'); ?>">
                            <span class="radio-type"></span>
                            <span class="label-body">
                                <?php echo sprintf(__('Request Logo (+%s)', 'transparentcard'), get_woocommerce_currency_symbol() . '8.98'); ?>
                            </span>
                        </label>
                    </div>
                    <div class="flex-1">
                        <label class="w-full flex-2 radio-label" onclick="logo_wrap('submit-logo-wrapper', jQuery(this))" for="logo_type_2">
                            <input <?php echo esc_attr(isset($additionalMetas['logo_type']) && $additionalMetas['logo_type'] == __('Submit Logo', 'transparentcard') ? 'checked' : ''); ?> data-price="0.00" type="radio" name="logo_type" id="logo_type_2" value="<?php _e('Submit Logo', 'transparentcard'); ?>">
                            <span class="radio-type"></span>
                            <span class="label-body">
                                <?php _e('Upload your logo', 'transparentcard'); ?>
                            </span>
                        </label>
                    </div>
                    <div class="flex-1">
                        
                        <label class="flex-2 w-full radio-label" onclick="logo_wrap('', jQuery(this))" for="logo_type_3">
                        <input <?php echo esc_attr(isset($additionalMetas['logo_type']) && $additionalMetas['logo_type'] == __("I don't want logo", 'transparentcard') ? 'checked' : ''); ?> data-price="0.00" type="radio" name="logo_type" id="logo_type_3" value="<?php _e("I don't want logo", 'transparentcard') ?>">
                        <span class="radio-type"></span>
                            <span class="label-body">
                                <?php _e("I don't want logo", 'transparentcard') ?>
                            </span>
                        </label>
                    </div>
                </div>
            </div>


            <!-- Hidden section  -->
             <div class="request-logo-wrap d-hidden logo-wrapper-html mt-20 mb-20">
                <div class="form-group">
                    <label for="name_in_logo"><?php _e('Name in Logo', 'transparentcard'); ?></label>
                    <input type="text" name="name_in_logo" id="name_in_logo" value="<?php echo esc_attr( $additionalMetas['name_in_logo'] ?? '' ); ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="logo_slogan"><?php _e('Logo with Slogan', 'transparentcard'); ?></label>
                    <input type="text" name="logo_slogan" value="<?php echo esc_attr( $additionalMetas['logo_slogan'] ?? '' ); ?>" id="logo_slogan" class="form-control">
                </div>
                <div class="form-group">
                    <label for="logo_ideas"><?php _e('Do you have ideas for your logo or images of logos you like?', 'transparentcard'); ?></label>
                    <div class="uploadbutton mt-15 mb-15">
                        <button onclick="clickuploader(this)" class="btn px-15 py-5 image_in_designbtn" type="button"><?php _e('Images Upload', 'transparentcard'); ?></button>
                        <input type="file" id="styleuploadinput" class="fileuploaderinput" name="logo_ideas[]" title="style" style="display:none;" accept=".jpg, .jpeg, .png, .tif, .tiff, .bmp, .pdf" data-operationid="DaMImages"  data-maxfilesize="15728640" data-hasallowedextensions="true" multiple>
                    </div>
                    <div class="uploadfilespreview">
                        <ul></ul>
                    </div>
                </div>
                <div class="form-group">
                    <label for="request_logo_ideas"><?php _e('Share your ideas for your logo with us', 'transparentcard'); ?></label>
                    <div class="d-flex gap-10">
                        <textarea name="request_logo_ideas" id="request_logo_ideas" class="form-control flex-2" row="5"><?php echo esc_attr( $additionalMetas['request_logo_ideas'] ?? '' ); ?></textarea>
                        <div class="example flex-1" style="margin-top:auto;">
                            <div class="card info">
                                <div class="header"><?php _e('Example', 'transparentcard'); ?>:</div>
                                <div class="body p-5">
                                    <p class="mb-0">"<?php _e('I want a van that looks like candy.', 'transparentcard'); ?>"</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
             </div>


             <!-- Submit logo area -->
             <div class="submit-logo-wrapper d-hidden logo-wrapper-html">
                <div class="form-group mt-20 mb-20">
                    <label for="uploadedFiles"><?php _e('Upload your files', 'transparentcard'); ?></label>
                    <div class="uploadbutton">
                        <button onclick="clickuploader(this)" class="btn px-15 py-5 image_in_designbtn" type="button"><?php _e('Images Upload', 'transparentcard'); ?></button>
                        <input type="file" id="uploadedFiles" class="fileuploaderinput" name="uploaded_files[]" title="style" style="display:none;" accept=".jpg, .jpeg, .png, .tif, .tiff, .bmp, .pdf" data-operationid="DaMImages"  data-maxfilesize="15728640" data-hasallowedextensions="true" multiple>
                    </div>
                    <div class="uploadfilespreview">
                        <ul></ul>
                    </div>
                </div>
             </div>

            
        </div>
        <!-- <div class="flex-1"></div> -->
    </div>





    <div class="d-flex single pb-20 others" style="gap:20px !important;">
        <div class="flex-1">
            <div class="sectiontitle position-relative d-flex align-item-center gap-10 d-flex align-item-center gap-10">
                <span class="count">6</span>
                <h5><?php _e('Others', 'transparentcard'); ?></h5>
            </div>
        </div>
        <div class="flex-3">
            
            <div class="form-group mb-20">
                <label for="shared_idea"><?php _e('Do you want to keep the files or just want to print with us?', 'transparentcard'); ?><span>*</span></label>
                <p class="mb-3"><?php _e('Note: You can get your logo any time as you need.', 'transparentcard'); ?></p>
                <div class="d-flex gap-10 logofileavailability flex-direction-column-mobile align-item-center">

                    <label class="flex-2 radio-label w-full" for="logo_file_availability_1">
                        <input <?php echo esc_attr(isset($additionalMetas['logo_file_availability']) && $additionalMetas['logo_file_availability'] == 'available' ? 'checked' : ''); ?> data-price="0.00" type="radio" name="logo_file_availability" id="logo_file_availability_1" value="available">
                        <span class="radio-type"></span>
                        <span class="label-body">
                            <?php _e('To be available on TRANSPARENTCARD', 'transparentcard'); ?>
                        </span>
                    </label>

                    <label class="flex-2 radio-label w-full" for="logo_file_availability_2">
                        <input <?php echo esc_attr(isset($additionalMetas['logo_file_availability']) && $additionalMetas['logo_file_availability'] == 'i_want' ? 'checked' : ''); ?> data-price="93.73" type="radio" name="logo_file_availability" id="logo_file_availability_2" value="i_want">
                        <span class="radio-type"></span>
                        <span class="label-body">
                            <?php echo sprintf(__('I want the files (+ %s93.73)', 'transparentcard'), get_woocommerce_currency_symbol()); ?>
                        </span>
                    </label>                   
                </div>
            </div>

            <div class="form-group">
                <label for="design_usefull_info"><?php _e('Do you want to add some more useful information for the design?', 'transparentcard'); ?></label>
                <div class="d-flex gap-10 flex-direction-column-mobile">
                    <textarea name="design_usefull_info" id="design_usefull_info" class="form-control flex-2" row="5"><?php echo esc_attr( $additionalMetas['design_usefull_info'] ?? '' ); ?></textarea>
                    <div class="example flex-1" style="margin-top:auto;">
                        <div class="card info">
                            <div class="header"><?php _e('Example', 'transparentcard'); ?>:</div>
                            <div class="body p-5">
                                <p class="mb-0">"<?php _e('I have a list of competitors: www.example.com (I like the style)/www.example2.pt (I do not like the style).', 'transparentcard'); ?>"</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            
        </div>
        <!-- <div class="flex-1"></div> -->
    </div>

    

    <div class="d-flex justify-content-between mt-15 item-align-middle">
        <div class="flex-1 text-right d-mobile-hidden">
            <div class="flex-1 fitem">
                <div class="d-flex gap-10" style="align-items:center;">
                    <div class="setisfectiontext text-center"><?php _e('100% Satisfaction guaranteed', 'transparentcard'); ?></div>
                    <img style="height:70px; margin-left:-25px;" src="<?php echo esc_url( get_stylesheet_directory_uri(  ) . '/assets/img/Satisf100.webp'); ?>" alt="<?php _e('Step 4', 'transparentcard'); ?>">
                </div>
            </div>
        </div>
        <?php wp_nonce_field('hire_a_designer_action', 'hire_a_designer_nonce'); ?>

        <!-- All hiddeen field -->
         
         <input type="hidden" name="pid" value="<?php echo esc_attr( $_GET['pid'] ?? 0 ); ?>">
         <?php if(isset($_GET['size'])): ?>
            <input type="hidden" name="size" value="<?php echo esc_attr( $_GET['size'] ?? '' ); ?>">
         <?php endif; ?>
         <?php if(isset($_GET['options'])): ?>
            <input type="hidden" name="options" value="<?php echo esc_attr( $_GET['options'] ?? '' ); ?>">
         <?php endif; ?>
         <?php if(isset($_GET['qty'])): ?>
            <input type="hidden" name="quantity" value="<?php echo esc_attr( $_GET['qty'] ?? 0 ); ?>">
         <?php endif; ?>
         <?php if(isset($_GET['cik'])): ?>
            <input type="hidden" name="update_request" value="<?php echo esc_attr( $_GET['cik'] ); ?>">
         <?php endif; ?>

         <input type="hidden" name="service_total"  value="<?php echo esc_attr($additionalMetas['service_total'] ?? ''); ?>">

         <input type="hidden" name="userid" value="<?php echo is_user_logged_in(  ) ? get_current_user_id(  ) : 0; ?>">

        <div class="flex-1 text-right gap-10">
            <button class="btn btn-continue px-5 py-10 border-rounded return-prev" onclick="next_step(0)" type="button"><?php _e('Return to previous step', 'transparentcard'); ?></button>
            <button class="btn btn-continue px-5 py-10 border-rounded" type="submit"><?php _e('Add to basket', 'transparentcard'); ?></button>
        </div>
    </div>
    <div class="d-flex justify-content-right">
        <p class="text-right color-red"><strong>*<?php _e('Required', 'transparentcard'); ?></strong></p>
    </div>

    </div>
</div>