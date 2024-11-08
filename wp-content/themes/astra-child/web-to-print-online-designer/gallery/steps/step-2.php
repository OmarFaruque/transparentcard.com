<?php
/**
 * Step 1
 */
?>

<?php extract($args); ?>
<?php 


$additionalMetas = $cart['nbo_additional_meta'] ?? array();
$filesArray = $cart['nbo_cus_files'] ?? array();

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
                <span class="count">3</span>
                <h5><?php _e('Visual Style', 'transparentcard'); ?></h5>
            </div>
        </div>
        <div class="flex-2">
            <h6 class="m-0"><?php _e('Choose up to three colors for your design.', 'transparentcard'); ?></h6>
            <p><?php _e('If no colors are selected, our design team will choose for you.', 'transparentcard'); ?></p>
            <p style="color:red; line-height: 17px; font-size: 12px;"><?php echo sprintf('<strong>%s</strong>: %s', __('Warning', 'transparentcard'), __('Selecting RGB or HEX colors may result in up to a 20% variation from the original color. If you have CMYK color codes, please enter them below, but note that they may still produce up to a 10% variation. For exact color matching, Pantone colors are required, which we do not print.', 'transparentcard')); ?></p>
            <div class="form-group colorselectarea">

                <?php 
                    $colors = array();
                    if(isset( $additionalMetas['colors'] ) && !empty($additionalMetas['colors'])): 
                        $colors = explode(', ', $additionalMetas['colors']);
                        foreach($colors as $k => $singleColor):
                ?>
                        <div><label for="colorPicker<?php echo esc_attr( $k ); ?>" class="position-relative add-new-colorplate colorplate-item" style="background-color: <?php echo esc_attr( $singleColor ); ?>; border-color: <?php echo esc_attr( $singleColor ); ?>;">
                            <div class="d-flex gap-10" style="align-items:center;flex-direction:column;">
                                <div class="flex-1">
                                    <input type="color" style="opacity:0; position:absolute; z-index:0;" id="colorPicker<?php echo esc_attr( $k ); ?>" name="colors[]" value="<?php echo esc_attr( $singleColor ); ?>" data-gtm-form-interact-field-id="1">
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


                <div class="<?php echo isset( $additionalMetas['colors'] ) && count($colors) >= 3 ? 'd-hide' : ''; ?>"><label for="colorPicker" class="position-relative add-new-colorplate" onclick="addcolorplate();">
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
                                <p class="mb-0"><?php _e('I am looking for a vibrant, modern design with plenty of colors, but I\'d prefer to avoid using red or black. ', 'transparentcard'); ?></p>
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
                    <ul>
                    <?php
                        if(isset($filesArray['design_images']) && count($filesArray['design_images']) > 0):
                            foreach($filesArray['design_images'] as $k => $single):
                                $image_name = basename(parse_url($single['url'], PHP_URL_PATH));
                                echo sprintf('<li>%s<span class="close" value="0" style="line-height: 17.5px;" onclick="CloseFilename(this, %s, %s, %s, %s)">×</span></li>', $image_name, "'design_images'", $k, "'".$single['file']."'", "'".$cart['key']."'");
                            endforeach; 
                        endif;
                    ?>
                    </ul>
                </div>

            </div>
            
        </div>
        <div class="flex-1"></div>
    </div>



    <div class="d-flex single pb-25" style="gap:20px !important;">
        <div class="flex-1">
            <div class="sectiontitle position-relative d-flex align-item-center gap-10 d-flex align-item-center gap-10">
                <span class="count">4</span>
                <h5><?php _e('Logo', 'transparentcard'); ?></h5>
            </div>
        </div>
        <div class="flex-3">
            
            <div class="form-group">
                <label><?php _e('What Logo do you want to include in your Business Card Design?', 'transparentcard'); ?></label>
                <div class="d-grid gap-10 logo-wrap-group grid-tampleate-column-3">
                    <div class="flex-1">
                        
                        <label onclick="logo_wrap('request-logo-wrap', jQuery(this))" class="flex-2 radio-label w-full" for="logo_type_1">
                            <input <?php echo esc_attr(isset($additionalMetas['logo_type']) && $additionalMetas['logo_type'] == __('Request logo', 'transparentcard') ? 'checked' : ''); ?> data-price="8.98" type="radio" name="logo_type" id="logo_type_1" value="<?php _e('Request logo', 'transparentcard'); ?>">
                            <span class="radio-type"></span>
                            <span class="label-body">
                                <?php echo sprintf(__('Request logo (+%s)', 'transparentcard'), get_woocommerce_currency_symbol() . '8.98'); ?>
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
            <?php
                $hiddenClass = 'd-hidden';
                if(isset($additionalMetas['logo_type']) && $additionalMetas['logo_type'] == __('Request logo', 'transparentcard') ){
                    $hiddenClass = '';
                }

                

            ?>

             <div class="request-logo-wrap logo-wrapper-html mt-20 mb-20 <?php echo esc_attr( $hiddenClass ); ?>">
                <div class="form-group">
                    <label for="name_in_logo"><?php _e('Name in Logo', 'transparentcard'); ?><span>*</span></label>
                    <input type="text" name="name_in_logo" id="name_in_logo" value="<?php echo esc_attr( $additionalMetas['name_in_logo'] ?? '' ); ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="logo_slogan"><?php _e('Logo with Slogan', 'transparentcard'); ?></label>
                    <input type="text" name="logo_slogan" value="<?php echo esc_attr( $additionalMetas['logo_slogan'] ?? '' ); ?>" id="logo_slogan" class="form-control">
                </div>
                <div class="form-group">
                    <label for="logo_ideas"><?php _e('If you want, Please upload some reference images that can insipre us to design your business card.', 'transparentcard'); ?></label>
                    <div class="uploadbutton mt-0 mb-15">
                        <button onclick="clickuploader(this)" class="btn px-15 py-5 image_in_designbtn" type="button"><?php _e('Images Upload', 'transparentcard'); ?></button>
                        <input type="file" id="styleuploadinput" class="fileuploaderinput" name="logo_ideas[]" title="style" style="display:none;" accept=".jpg, .jpeg, .png, .tif, .tiff, .bmp, .pdf" data-operationid="DaMImages"  data-maxfilesize="15728640" data-hasallowedextensions="true" multiple>
                    </div>
                    <div class="uploadfilespreview">
                        <ul>
                            <?php
                                if(isset($filesArray['logo_ideas']) && count($filesArray['logo_ideas']) > 0):
                                    foreach($filesArray['logo_ideas'] as $k => $single):
                                        $image_name = basename(parse_url($single['url'], PHP_URL_PATH));
                                        echo sprintf('<li>%s<span class="close" value="0" style="line-height: 17.5px;" onclick="CloseFilename(this, %s, %s, %s, %s)">×</span></li>', $image_name, "'logo_ideas'", $k, "'".$single['file']."'", "'".$cart['key']."'");
                                    endforeach; 
                                endif;
                            ?>
                        </ul>
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
                        <p class="mt-5" style="line-height:14px; margin-top:5px;"><small style="color:red;"><?php _e('Your logo should be in high resulation. If you have the original design file (AI, PSD, PDF or CDR), it will ensure the best print quality. If not, you can send it in PNG or JPEG format. As long as these formates are high resulation, there wan\'t be any issues with the print. However, low-resulation PNG or JPEG files may result in poor print quality.', 'transparentcard'); ?></small></p>
                    </div>
                    <div class="uploadfilespreview">
                        <ul>
                        <?php
                            if(isset($filesArray['uploaded_files']) && count($filesArray['uploaded_files']) > 0):
                                foreach($filesArray['uploaded_files'] as $k => $single):
                                    $image_name = basename(parse_url($single['url'], PHP_URL_PATH));
                                    echo sprintf('<li>%s<span class="close" value="0" style="line-height: 17.5px;" onclick="CloseFilename(this, %s, %s, %s, %s)">×</span></li>', $image_name, "'uploaded_files'", $k, "'".$single['file']."'", "'".$cart['key']."'");
                                endforeach; 
                            endif;
                        ?>
                        </ul>
                    </div>
                </div>
             </div>

            
        </div>
        <!-- <div class="flex-1"></div> -->
    </div>





    <div class="d-flex single pb-20 others" style="gap:20px !important;">
        <div class="flex-1">
            <div class="sectiontitle position-relative d-flex align-item-center gap-10 d-flex align-item-center gap-10">
                <span class="count">5</span>
                <h5><?php _e('Others', 'transparentcard'); ?></h5>
            </div>
        </div>
        <div class="flex-3">
            
            <div class="form-group mb-20">
                <label><?php _e('Would you like to retain the files or simply proceed with printing?', 'transparentcard'); ?></label>
                <p class="mb-3"><?php _e('Note: Your logo will be accessible anytime you need it.', 'transparentcard'); ?></p>
                <div class="d-flex gap-10 logofileavailability flex-direction-column-mobile align-item-center">

                    <label class="flex-2 radio-label w-full" for="logo_file_availability_1">
                        <input <?php echo esc_attr(isset($additionalMetas['logo_file_availability']) && $additionalMetas['logo_file_availability'] == 'available' ? 'checked' : ''); ?> data-price="0.00" type="radio" name="logo_file_availability" id="logo_file_availability_1" value="available">
                        <span class="radio-type"></span>
                        <span class="label-body">
                            <?php _e('Currenty I don\'t need the file.', 'transparentcard'); ?>
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
                <label for="design_usefull_info"><?php _e('Would you like to include any additional details for the design?', 'transparentcard'); ?></label>
                <div class="d-flex gap-10 flex-direction-column-mobile">
                    <textarea name="design_usefull_info" id="design_usefull_info" class="form-control flex-2" row="5"><?php echo esc_attr( $additionalMetas['design_usefull_info'] ?? '' ); ?></textarea>
                    <div class="example flex-1" style="margin-top:auto;">
                        <div class="card info">
                            <div class="header"><?php _e('Example', 'transparentcard'); ?>:</div>
                            <div class="body p-5">
                                <p class="mb-0">"<?php _e('I have a list of competitors: www.example.com (I like the style)/www.example2.com (I do not like the style).', 'transparentcard'); ?>"</p>
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

        <div class="flex-1 text-right gap-10" id="prevsubmitbtn">
            <button class="btn btn-continue px-5 py-10 border-rounded return-prev" onclick="next_step(0)" type="button"><?php _e('Return to previous step', 'transparentcard'); ?></button>
            <button class="btn btn-continue px-5 py-10 border-rounded position-relative" id="submit" type="submit">
                <span class="loadericon bg-dark path-dark d-hide">
                    <svg style="color:#999;" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M12,23a9.63,9.63,0,0,1-8-9.5,9.51,9.51,0,0,1,6.79-9.1A1.66,1.66,0,0,0,12,2.81h0a1.67,1.67,0,0,0-1.94-1.64A11,11,0,0,0,12,23Z"><animateTransform attributeName="transform" dur="0.75s" repeatCount="indefinite" type="rotate" values="0 12 12;360 12 12"/></path></svg>
                </span>

                <?php 
                   echo isset($_GET['cik']) ? __('Update basket', 'transparentcard') : __('Add to basket', 'transparentcard'); 
                ?>
            </button>
        </div>
    </div>
    <div class="d-flex justify-content-right">
        <p class="text-right color-red"><strong>*<?php _e('Required', 'transparentcard'); ?></strong></p>
    </div>

    </div>
</div>