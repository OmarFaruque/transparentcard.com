<?php if (!defined('ABSPATH')) exit; ?>
<?php 
extract($args); 
$pwidth = $settings[0]['real_width'];
$pheight = $settings[0]['real_height'];


?>

<div class="nbd-upload-inner" style="flex:1; wdith:100%;">
    <div class="header mb-10" style="padding-left:20px; padding-right:20px; border-bottom:1px solid #ddd; text-align:center;">
        <h3 style="color:#003F3F;" class="text-capitalize"><?php _e('Upload design', 'web-to-print-online-designer'); ?></h3>
        <p style="color:#6D6D6D; margin-bottom:5px;" ><?php _e('Add your documents here, and you can upload up to 5 files max', 'transparentcard'); ?></p>
    </div>
    <?php
        $login_required = ( nbdesigner_get_option( 'nbdesigner_upload_file_php_logged_in', 'no' ) !== 'no' && !is_user_logged_in() ) ? 1 : 0;
        if( $login_required ):
            $login_url      = get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) . '?nbu_redirect=' . $product->get_permalink();
    ?>
    <div class="nbu-require-login">
        <p><?php esc_html_e( 'You need to be logged in to upload design!', 'web-to-print-online-designer' ); ?></p>
        <a class="nbu-login-btn" href="<?php echo $login_url; ?>"><?php esc_html_e( 'Login', 'web-to-print-online-designer' ); ?></a>
    </div>
    <?php else: ?>
    <div class="nbu-upload-zone column-inner">
        <input type="file" id="nbd-file-upload" autocomplete="off" class="nbu-inputfile"/> 

        <svg width="42" height="42" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0_212_189)">
            <path d="M33.4417 3.12061H14.1743V11.1106H37.5567V7.23402C37.5567 4.96567 35.7107 3.12061 33.4417 3.12061Z" fill="#ECFF8C"/>
            <path d="M22.5352 12.3403H0V4.92636C0 2.20972 2.21068 0 4.92828 0H12.1336C12.8497 0 13.5396 0.150925 14.1664 0.434509C15.0418 0.828964 15.7939 1.47913 16.3213 2.3286L22.5352 12.3403Z" fill="#002C2C"/>
            <path d="M42 14.0001V37.8815C42 40.1527 40.1511 42 37.8789 42H4.12111C1.84891 42 0 40.1527 0 37.8815V9.88062H37.8789C40.1511 9.88062 42 11.7286 42 14.0001Z" fill="#003F3F"/>
            <path d="M42 14.0001V37.8815C42 40.1527 40.1511 42 37.8789 42H21V9.88062H37.8789C40.1511 9.88062 42 11.7286 42 14.0001Z" fill="#003F3F"/>
            <path d="M32.048 25.9398C32.048 32.0322 27.0919 36.9887 21.0001 36.9887C14.9083 36.9887 9.95215 32.0322 9.95215 25.9398C9.95215 19.8483 14.9083 14.8918 21.0001 14.8918C27.0919 14.8918 32.048 19.8483 32.048 25.9398Z" fill="#E3F585"/>
            <path d="M32.0479 25.9398C32.0479 32.0322 27.0918 36.9887 21 36.9887V14.8918C27.0918 14.8918 32.0479 19.8483 32.0479 25.9398Z" fill="#ECFF8C"/>
            <path d="M24.5612 26.0753C24.3308 26.2704 24.0485 26.3656 23.7688 26.3656C23.4185 26.3656 23.0705 26.2173 22.827 25.9282L22.2307 25.2213V29.8494C22.2307 30.5287 21.6795 31.0799 21.0002 31.0799C20.3209 31.0799 19.7698 30.5287 19.7698 29.8494V25.2213L19.1734 25.9282C18.7344 26.4476 17.9587 26.514 17.4392 26.0753C16.9201 25.6373 16.8535 24.8612 17.2915 24.3418L19.7271 21.4543C20.0447 21.0788 20.508 20.8628 21.0002 20.8628C21.4924 20.8628 21.9558 21.0788 22.2733 21.4543L24.7089 24.3418C25.147 24.8612 25.0803 25.6373 24.5612 26.0753Z" fill="#003F3F"/>
            <path d="M24.561 26.0753C24.3306 26.2704 24.0483 26.3656 23.7686 26.3656C23.4183 26.3656 23.0703 26.2173 22.8268 25.9282L22.2305 25.2213V29.8494C22.2305 30.5287 21.6793 31.0799 21 31.0799V20.8628C21.4922 20.8628 21.9555 21.0788 22.2731 21.4543L24.7087 24.3418C25.1467 24.8612 25.0801 25.6373 24.561 26.0753Z" fill="#002C2C"/>
            </g>
            <defs>
            <clipPath id="clip0_212_189">
            <rect width="42" height="42" fill="white"/>
            </clipPath>
            </defs>
        </svg>
        <div class="orsection">
            <span class="capitalize"><?php _e('Or', 'transparentcard'); ?></span>
        </div>

        <label for="nbd-file-upload">
            
            <span style="margin-bottom: 10px; margin-top: 10px;"><?php _e('Upload File', 'web-to-print-online-designer'); ?></span>
            
            <?php //if( $option['disallow_type'] != '' ): ?>
                <!-- <span><small><?php //_e( 'Disallow extensions', 'web-to-print-online-designer' ); ?>: <?php //echo $option['disallow_type']; ?></small></span><?php //endif; ?> -->
            <!-- <span><small><?php //_e( 'Min size', 'web-to-print-online-designer' ); ?> <?php //echo $option['minsize']; ?> MB</small></span>
            <span><small><?php //_e( 'Max size', 'web-to-print-online-designer' ); ?> <?php //echo $option['maxsize']; ?> MB</small></span> -->
        </label>
        <svg class="nbd-upload-loading" xmlns="http://www.w3.org/2000/svg" width="50px" height="50px" viewBox="0 0 50 50"><circle fill="none" opacity="0.05" stroke="#000000" stroke-width="3" cx="25" cy="25" r="20"/><g transform="translate(25,25) rotate(-90)"><circle  style="stroke:#48B0F7; fill:none; stroke-width: 3px; stroke-linecap: round" stroke-dasharray="110" stroke-dashoffset="0"  cx="0" cy="0" r="20"><animate attributeName="stroke-dashoffset" values="360;140" dur="2.2s" keyTimes="0;1" calcMode="spline" fill="freeze" keySplines="0.41,0.314,0.8,0.54" repeatCount="indefinite" begin="0"/><animateTransform attributeName="transform" type="rotate" values="0;274;360" keyTimes="0;0.74;1" calcMode="linear" dur="2.2s" repeatCount="indefinite" begin="0"/><animate attributeName="stroke" values="#10CFBD;#48B0F7;#ff0066;#48B0F7;#10CFBD" fill="freeze" dur="3s" begin="0" repeatCount="indefinite"/></circle></g></svg>

        <?php if( $option['allow_type'] != '' ): 
            $allowedtype = str_replace(',', ', ', $option['allow_type']);
            ?>
            <div class="allowedfiletypes">
                <div class="type-inner">
                    <span style="color:#999;"><?php _e('Only support', 'web-to-print-online-designer' ); ?>: <?php echo $allowedtype; ?></span>
                </div>
            </div>
        <?php endif; ?>
    </div>



    <div class="previewandbuttonarea" style="max-width:unset;">
        <div class="upload-design-preview custom d-flex justify-content-center" style="max-width:unset;"></div>
        <div class="submit-upload-design-preview mb-30" style="max-width:96%; text-align:center; margin-left:auto; margin-right:auto;"><span><?php _e('Submit', 'web-to-print-online-designer'); ?></span></div>
    </div>


    <div class="dymention mb-5 mt-10" style="border-bottom:1px solid #ddd; color:#6D6D6D; padding-bottom:15px;">
        <div class="column-inner details d-flex">
            <div class="flex-1" style="color:#003F3F;">
                <span><?php _e('Dimensions', 'transparentcard'); ?>:</span>
            </div>
            <div class="flex-2">
                <?php echo sprintf('<span>%s x %s mm</span>', $pwidth, $pheight); ?>
            </div>
        </div>
    </div>

    <div class="dymention mb-10" style="border-bottom:1px solid #ddd; padding-bottom:15px;">
        <div class="column-inner details d-flex">
            <div class="flex-1" style="color:#003F3F;">
                <span><?php _e('Recommended format', 'transparentcard'); ?>:</span>
            </div>
            <div class="flex-2">
                <div class="inner-details">
                        <p class="mb-0"><?php echo sprintf(__('Adobe illustrator <a href="%s" download>(How to save)</a>', 'transparentcard'), get_stylesheet_directory_uri(  ) . '/assets/img/Adobe-Illustrator.zip'); ?></p>
                        <p class="mb-0"><?php echo sprintf(__('Adobe In Design <a href="%s" download>(how to save)</a>', 'transparentcard'), get_stylesheet_directory_uri(  ) . '/assets/img/Adobe-inDesign.zip'); ?></p>
                        <p class="mb-0"><?php echo sprintf(__('Adobe Photoshop <a href="%s" download>(how to save)</a>', 'transparentcard'), get_stylesheet_directory_uri(  ) . '/assets/img/Adobe-Photoshop.zip'); ?></p>
                        <p class="mb-0"><?php echo sprintf(__('CorelDRAW <a href="%s" download>(how to save)</a>', 'transparentcard'), get_stylesheet_directory_uri(  ) . '/assets/img/CorelDRAW.zip'); ?></p>
                        <p class="mb-0"><?php _e('PDF', 'transparentcard') ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="dymention mb-10" style="border-bottom:1px solid #ddd; padding-bottom:15px;">
        <div class="column-inner details d-flex">
            <div class="flex-1" style="color:#003F3F;">
                <span><?php _e('Other formats', 'transparentcard'); ?>:</span>
            </div>
            <div class="flex-2">
                <div class="inner-details">
                        <p class="mb-0"><?php echo sprintf(__('Microsoft PowerPoint <a href="%s" download>(How to save)</a>', 'transparentcard'), get_stylesheet_directory_uri(  ) . '/assets/img/Microsoft-Powerpoint.zip'); ?></p>
                        <!-- <p class="mb-0"><?php //_e('Microsoft Publisher (How to save)', 'transparentcard') ?></p> -->
                        <p class="mb-0"><?php echo sprintf(__('Microsoft Word <a download href="%s">(How to save)</a>', 'transparentcard'),  get_stylesheet_directory_uri(  ) . '/assets/img/Microsoft-Word.zip' ); ?></p>
                        <!-- <p class="mb-0"><?php //_e('Inkscape (How to save)', 'transparentcard') ?></p> -->
                </div>
            </div>
        </div>
    </div>

    <div class="dymention mb-10" style="border-bottom:1px solid #ddd; padding-bottom:15px;">
        <div class="column-inner details d-flex">
            <div class="flex-1" style="color:#003F3F;">
                <span><?php _e('Maximum size', 'transparentcard'); ?>:</span>
            </div>
            <div class="flex-2">
                <div class="inner-details">
                    <p class="mb-0"><?php echo esc_attr( $option['maxsize'] ); ?>&nbsp;MB</p>
                </div>
            </div>
        </div>
    </div>


    <div class="dymention" style="border-bottom:1px solid #ddd; padding-bottom:15px;">
        <div class="column-inner details d-flex">
            <div class="flex-1" style="color:#003F3F;">
                <span><?php _e('Note', 'transparentcard'); ?>:</span>
            </div>
            <div class="flex-2">
                <div class="inner-details">
                    <p class="mb-0"><?php echo sprintf(__('By adding a design, you accept our <a href="%s" />Terms and Conditions.</a>', 'transparentcard'), 'https://transparentcard.com/terms-of-use/'); ?></p>
                </div>
            </div>
        </div>
    </div>

    
   
    <?php endif; ?>
    <?php if( isset( $_enable_upload_without_design ) && $_enable_upload_without_design == '0' ): ?>
    <p style="margin-top: 15px;margin-bottom: 0;color: #2a6496;cursor: pointer;" onclick="backtoOption()">← <?php _e('Back to option', 'web-to-print-online-designer'); ?></p>
    <?php endif; ?>
</div>