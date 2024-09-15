<?php
/**
 * Submit files 
 */
if (!defined('ABSPATH'))
    exit;



$settings = get_post_meta($_GET['pid'], '_designer_setting', true);
$settings = unserialize($settings);
$pwidth = $settings[0]['real_width'];
$pheight = $settings[0]['real_height'];

$swidth = 100;
$lowerValue = min($pwidth, $pheight);
$higherValue = max($pwidth, $pheight);
$percentage = ($lowerValue / $higherValue) * 100;

$sheight = $pwidth >= $pheight ? $percentage : 100 + $percentage;


// nbdesigner_get_template('gallery/header.php', array());
?>
<section id="body" class="cutting mt-50">
    <style>
        p#uploaded_file_name {
            max-width: 120px;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
        .selectedImgWrap {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
        }
        .selectedImgWrap img{
            min-width:100%;
            min-height:100%;
        }
        .choose-design-template-header {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 50px;
        }


        @media screen and (max-width:992px) {
            .designarea {
                display: block;
            }

            .designarea>div {
                width: 100%;
                margin: 30px 0;
                justify-content: flex-start;
            }

            .designarea>div.questionformate {
                width: 100% !important;
            }

            .questionformate .menulist ul {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 15px;
            }

            .maindesigncanvas .designwrap {
                justify-content: center;
            }
        }

        @media screen and (max-width: 881px) {
            .questionformate .menulist ul {
                flex-wrap: wrap;
                gap: 10px;
            }

            .questionformate .menulist ul li {
                width: 25% !important;
            }
        }

        @media screen and (max-width: 768px) {
            .cutting {
                padding: 0 20px;
            }

            .questionformate .menulist:after {
                display: none !important;
            }

            .cutting .topbradecamp {
                justify-content: flex-start !important;
            }

            .choose-design-template-header {
                margin-bottom: 10px;
            }

            section.fullscreen {
                padding: 20px;
            }

            .maincard {
                text-align: center;
            }

            .maincard h5 {
                font-size: 30px !important;
            }
        }

        @media screen and (max-width:680px) {
            .maincard h5 {
                font-size: 24px !important;
            }

            .questionformate .menulist ul li {
                width: 32% !important;
            }

            .questionformate ul li a {
                font-size: 16px;
                padding: 0px;
                text-align: center;
                display: block;
            }

        }

        @media screen and (max-width:580px) {
            .questionformate {
                text-align: center;
            }
            .questionformate .menulist ul {
                display: block;
            }

            .questionformate .menulist ul li {
                width: 100% !important;
            }

            .designarea>div {
                justify-content: center;
            }

            .cutting .topbradecamp {
                justify-content: center !important;
            }

            .choose-design-template-header {
                margin-bottom: 50px;
            }
        }
    </style>
    <!-- Header -->
    <div class="choose-design-template-header">
        <div class="back-to-left">
            <a href="#" class="back-to-template-gallery-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                    class="bi bi-chevron-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0" />
                </svg>
                <?php _e('Back to Template Gallery', 'transparentcard'); ?>
            </a>
        </div>
    </div><!-- /Header -->

    <div class="innersect">
        <div class="d-flex justify-content-end topbradecamp">
            <ul class="list-style-none d-flex gap-15">
                <li><a href="#"><?php _e('Help', 'transparentcard'); ?></a></li>
                <li><a onclick="printingara_curring(this, event)" href="#"><?php _e('View product after cutting', 'transparentcard'); ?></a></li>
            </ul>
        </div>

        <div class="designarea d-flex gap-40">
            <div class="flex-1 item-align-center justify-content-center d-flex">
                <div class="questionformate">
                    <h4><?php _e('Have questions regarding the format?', 'transparentcard'); ?></h4>
                    <p class="mb-10 mt-5" style="line-height:18px;">
                        <?php _e('Download our templates to help you prepare your file before uploading it.', 'transparentcard') ?>
                    </p>
                    <div class="menulist p-10 border-rounded" style="background-color:#ECFF8C; margin-bottom:20px;">
                        <ul class="list-style-none m-0">
                            <li><?php echo sprintf(__('<a download href="%s">Adobe Photoshop</a>', 'transparentcard'), get_stylesheet_directory_uri(  ) . '/assets/img/Adobe-Photoshop.zip'); ?></li>
                            <li><?php echo sprintf(__('<a download href="%s">Adobe Illustrator</a>', 'transparentcard'), get_stylesheet_directory_uri(  ) . '/assets/img/Adobe-Illustrator.zip'); ?></li>
                            <li><?php echo sprintf(__('<a download href="%s">Adobe In Design</a>', 'transparentcard'), get_stylesheet_directory_uri(  ) . '/assets/img/Adobe-inDesign.zip'); ?></li>
                            <li><?php echo sprintf(__('<a download href="%s">Microsoft PowerPoint</a>', 'transparentcard'), get_stylesheet_directory_uri(  ) . '/assets/img/Microsoft-Powerpoint.zip'); ?></li>
                            <li><?php echo sprintf(__('<a download href="%s">Microsoft Word</a>', 'transparentcard'), get_stylesheet_directory_uri(  ) . '/assets/img/Microsoft-Word.zip'); ?></li>
                            <li><?php echo sprintf(__('<a download href="%s">CorelDRAW</a>', 'transparentcard'), get_stylesheet_directory_uri(  ) . '/assets/img/CorelDRAW.zip'); ?></li>
                            
                        </ul>
                    </div>
                </div>
            </div>
            <div class="flex-3 designareaappeard">
                <div class="innerdesignappeard">


                    <div class="maindesigncanvas">

                        <div class="designwrap d-flex flex-direction-column align-item-end gap-15 position-relative">
                            <div class="xy text-center d-flex">
                                <div class="flex-10">
                                    <div class="width"><?php echo esc_attr($pwidth); ?>mm</div>
                                    <div class="arrow d-flex justify-content-center"><img style="width:calc(100% - 30px);"
                                            src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/img/arrow-left-right.svg'); ?>"
                                            alt="<?php _e('Arrow', 'transparentcard'); ?>"></div>
                                </div>
                                <div class="flex-1"></div>
                            </div>
                            <div class="designwrapinner d-flex" style="width: 80%; height: 700px; margin-left:auto;">
                                <div class="innerdesignarea flex-11">
                                    <div class="outer border-rounded d-flex align-item-center justify-content-center  position-relative"
                                        style="background-color:#003F3F; height:<?php echo $sheight; ?>%;width:<?php echo esc_attr($swidth); ?>%;">
                                        <div class="blade-area positon-absulate">
                                            <?php _e('Bleed area', 'transparentcard'); ?>
                                        </div>
                                        <div
                                            class="inner border-rounded d-flex align-item-center justify-content-center">
                                            <div class="trim-line position-absulate">
                                                <?php _e('Trim line', 'transparentcard'); ?>
                                            </div>
                                            <div
                                                class="maincard w-full h-full border-rounded d-flex justify-content-center align-item-center">
                                                <h5 class="text-capitalize" style="font-size:40px;">
                                                    <?php _e('Upload your design here', 'transparentcard'); ?>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="uploadbutton d-flex mt-20">
                                        <button type="button" id="startUploadSubmitPopup"
                                            class="w-full justify-content-center"><?php _e('Upload Now', 'transparentcard'); ?></button>
                                    </div>
                                </div>
                                <div class="flex-1"></div>
                            </div>
                            <div class="yx text-center flex-1">
                                <div>
                                    <div class="height"><?php echo esc_attr($pheight); ?>mm</div>
                                    <div class="arrow d-flex justify-content-right"><img style="width:calc(100% - 30px);"
                                            src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/img/arrow-left-right.svg'); ?>"
                                            alt="<?php _e('Arrow', 'transparentcard'); ?>"></div>
                                </div>
                            </div>
                        </div>

                    </div>


                    <!-- Area for non image  -->
                     <div id="uploadareadesign" class="d-hide">
                        <div class="d-flex align-item-center gap-30" style="width: 80%; margin-left:auto;">
                            <div class="flex-1 d-flex justify-content-center">
                                <div class="border-rounded filedisplayarea">
                                    <div class="icon">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" shape-rendering="geometricPrecision" text-rendering="geometricPrecision" image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 441 512.399"><path fill="#88BCF4" fill-rule="nonzero" d="M102.778 354.886c-5.727 0-10.372-4.645-10.372-10.372s4.645-10.372 10.372-10.372h85.568a148.095 148.095 0 00-7.597 20.744h-77.971zm0-145.37c-5.727 0-10.372-4.645-10.372-10.372 0-5.726 4.645-10.372 10.372-10.372h151.288c5.727 0 10.372 4.646 10.372 10.372 0 5.727-4.645 10.372-10.372 10.372H102.778zm0 72.682c-5.727 0-10.372-4.646-10.372-10.373 0-5.727 4.645-10.372 10.372-10.372H246.05c2.83 0 5.395 1.134 7.265 2.971a149.435 149.435 0 00-25.876 17.774H102.778z"/><path fill="#3C4D7A" d="M324.263 278.925c32.23 0 61.418 13.067 82.544 34.192C427.933 334.241 441 363.43 441 395.66c0 32.236-13.067 61.419-34.193 82.544-21.126 21.126-50.31 34.194-82.544 34.194-32.232 0-61.419-13.068-82.543-34.194-21.125-21.125-34.194-50.312-34.194-82.544s13.069-61.417 34.194-82.543c21.126-21.125 50.309-34.192 82.543-34.192zM60.863 0h174.809c3.382 0 6.384 1.619 8.279 4.124l110.107 119.119a10.292 10.292 0 012.745 7.012h.053v119.817a149.591 149.591 0 00-20.752-3.111v-92.212h-43.666v-.042h-.161c-22.046-.349-39.33-6.222-51.694-16.784-12.849-10.979-20.063-26.614-21.504-46.039a10.145 10.145 0 01-.095-1.404V20.752H60.863c-11.02 0-21.049 4.518-28.321 11.79-7.274 7.272-11.79 17.301-11.79 28.321v338.276c0 11.015 4.521 21.037 11.796 28.311 7.278 7.28 17.31 11.802 28.315 11.802h120.749a148.132 148.132 0 008.116 20.752H60.863c-16.73 0-31.958-6.85-42.987-17.881C6.852 431.099 0 415.882 0 399.139V60.863C0 44.114 6.842 28.894 17.87 17.87 28.894 6.846 44.114 0 60.863 0zm178.873 29.983v60.433c1.021 13.737 5.819 24.535 14.302 31.783 8.667 7.404 21.488 11.544 38.4 11.835v-.037h43.442L239.736 29.983zM389.21 385.259l-53.294 51.131v-25.502c-31.087-6.24-56.244-1.705-76.606 23.636 2.869-44.518 31.926-72.567 76.606-74.456v-25.94l53.294 51.131z"/></svg>
                                        </span>
                                    </div>
                                    <div>
                                        <p class="mb-0" id="uploaded_file_name">C4b3c2i1WiPjj3Tv.mp4</p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-3 d-flex justify-content-center flex-direction-column">
                                <h4>
                                    <span class="icon">
                                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 122.88 88.98" style="enable-background:new 0 0 122.88 88.98" xml:space="preserve"><style type="text/css">.st0{fill-rule:evenodd;clip-rule:evenodd;}</style><g><path class="st0" d="M85.33,16.83c12.99-9.83,31.92,1.63,31.92,13.63c0,7.75-2.97,10.79-7.57,14.03 c23.2,12.41,12.7,39.86-7.54,44.49l-70.69,0c-33.2,0-45.48-44.99-10.13-55.89C14.69,6.66,66.5-17.2,85.33,16.83L85.33,16.83z M53.37,69.54V53.66H39.16l22.29-26.82l22.29,26.82H69.53v15.88H53.37L53.37,69.54z"/></g></svg>
                                    </span>
                                    <?php _e('Your design has been successfully submitted!', 'transparentcard'); ?>
                                </h4>
                                <p class="mb-0"><?php _e('Preview is not available for files in the format you submitted.', 'transparentcard'); ?></p>
                            </div>
                        </div>
                     </div>

                </div>
            </div>

        </div>
    </div>

</section>

<section id="footer" class="header-fileupload fullscreen pt-20 pb-20" style="background-color:#ECFF8C;">
    <div class="innersect ast-container ml-auto mr-auto">
        <div class="d-flex justify-content-between align-item-center">
            <div class="flex-1">
                <h3><?php _e('Once your design is ready and verified, click “Finalize”.', 'transparentcard'); ?>
                </h3>
            </div>
            <div class="flex-1 text-right">
                <div class="w-full d-flex justify-content-end">
                    <button type="button" onclick="hideUploadFrame()" class="btn  btn-default submit-upload-design"
                        style="margin-top:0; padding:0 20px;"><?php _e('Finalize', 'transparentcard'); ?></button>
                </div>
            </div>
        </div>
    </div>
</section>


<style>
    .maincard
    {
        width: calc(100% - 30px);
        height: calc(100% - 30px);
    }
    .selectedImgWrap > *:before {
        content: '';
        width: calc(100% - 20px);
        height: calc(100% - 20px);
        left: 0;
        top: 0;
        border: dashed 1px #aaa;
        z-index: 1;
        display: block;
        position: absolute;
        margin: 10px;
    }
    .selectedImgWrap.cutActive > *:after {
        width: 100%;
        height: 100%;
        position: absolute;
        left: 0;
        top: 0;
        z-index: 9999999;
        display: block;
        overflow: hidden;
        content: '';
        margin: 0;
        background-color: transparent;
        border: 10px solid #f4f4f4;
    }
    .selectedImgWrap .wrapinner{width: 100%; height:100%;}
    .maindesigncanvas .inner {
        width: calc(100% - 30px);
        height: calc(100% - 30px);
    }

    .maincard {
        background-color: white;
    }

    .maindesigncanvas .inner {
        border: 2px solid red;
        background-color: #ECFF8C;
    }

    .e-con-inner {
        padding-bottom: 0;
    }

    .maindesigncanvas .outer {
        position: relative;
    }

    .border-rounded.filedisplayarea {
        border-style: solid;
        border-width: 1px;
        padding: 20px 35px;
        border-color: #ccc;
    }
    div#uploadareadesign h4 span.icon {
        width: 30px;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        color:#003D3C;
    }
    div#uploadareadesign h4 span.icon svg path{
        fill: #003D3C;
    }
    div#uploadareadesign h4 {
        display: flex;
        gap: 8px;
        align-items: end;
        color:#003D3C;
    }
    .blade-area {
        position: absolute;
        left: -100px;
        top: 20px;
    }

    .yx {
        position: absolute;
        right: -24%;
        height: 0;
        top: 32%;
        width: 50%;
    }

    .yx>div {
        transform: rotate(90deg);
    }
    div#uploadareadesign > * {
        box-shadow: 0 0 0.5em #aaa;
        padding: 20px;
        margin: 25px 0;
    }

    .questionformate ul li a {
        text-decoration: underline;
        font-size: 18px;
        line-height: 40px;
        padding: 0px 15px;
    }

    .questionformate .menulist {
        position: relative;
    }

    .outer:before {
        content: '';
        width: 90px;
        height: 50px;
        position: absolute;
        left: -82px;
        top: 51px;
        background-image: url(<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/img/blade-arrow.svg'); ?>);
        background-size: contain;
        background-repeat: no-repeat;
        background-position: top right;
    }

    .inner:before {
        content: '';
        width: 70px;
        height: 50px;
        position: absolute;
        left: -54px;
        top: 168px;
        background-image: url(<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/img/trimline-arrow.svg'); ?>);
        background-size: contain;
        background-repeat: no-repeat;
        background-position: top right;
    }

    .questionformate .menulist:after {
        content: '';
        width: 50px;
        height: 90px;
        position: absolute;
        right: -34px;
        top: -20px;
        background-image: url(<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/img/down-cercal-arrow.svg'); ?>);
        background-size: contain;
        background-repeat: no-repeat;
        background-position: top right;
    }

    .designwrap .xy {
        max-width: 80%;
    }

    .trim-line {
        left: -76px;
        top: 140px
    }
    .elementor-shortcode section#footer.d-fixed {
        position: fixed;
        bottom: 0;
        left: 0;
        z-index: 1;
        margin: auto;
    }
    .elementor-shortcode section#footer{
        transition: all 0.3s;
    }

    /* .topbradecamp ul li a {
        background-color: #003F3F;
        color: #ECFF8C;
        padding: 7px 20px;
        display: flex;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.3s;
    } */
    .filedisplayarea .icon span {
        width: 50px;
        display: block;
        margin: 0 auto;
    }
    /* .topbradecamp ul li a:hover {
        color: #003F3F;
        background-color: #ECFF8C;
    } */
</style>

<script>
    let printingara_curring = function(thisitem, event){
        event.preventDefault();
        jQuery(document.body).find('.selectedImgWrap').toggleClass('cutActive');
    }


    jQuery(document.body).on('click', '#startUploadSubmitPopup', function () {

        if (!jQuery(document.body).find('div#container-online-designer.template').hasClass('active')) {
            jQuery(document.body).find('div#container-online-designer.template').addClass('active');
            jQuery(document.body).find('div#container-online-designer.template .conntainer-inline').slideDown();
            jQuery('html, body').animate({ scrollTop: 0 }, 'slow');
        }
    });


    var hidepopup = function () {
        if (jQuery(document.body).find('div#container-online-designer.template').hasClass('active')) {
            jQuery(document.body).find('div#container-online-designer.template').removeClass('active');
            jQuery(document.body).find('div#container-online-designer.template .conntainer-inline').slideUp();
        }
    }
    jQuery(document.body).on('click', '#container-online-designer .overley, .closebtn', function () {
        hidepopup();
    });

    jQuery(document.body).on('click', '.submit-upload-design-preview', function () {
        var imgsrc = jQuery('.nbd-upload-items-inner').find('img').attr('src');


        if(imgsrc){
            imgsrc = imgsrc.replace('_preview', '');
            var imgval = jQuery('input[name="nbd-upload-files"]').val();

            let extension = getFileExtension(imgval);
            let imgTypes = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp']; 
            
            if(imgTypes.indexOf(extension) < 0){
                jQuery(document.body).find('#uploadareadesign').removeClass('d-hide');
                jQuery(document.body).find('.maindesigncanvas').addClass('d-hide');
                jQuery(document.body).find('#uploaded_file_name').text(imgval);
            }

            hidepopup();
            if (typeof imgsrc != 'undefined') {
                jQuery(document.body).find('.maincard').html('');
                let htmlOutput = `<div class="selectedImgWrap">
                    <div class="wrapinner">
                        <img src="${imgsrc}" alt="" />
                    </div>
                </div>`;
                jQuery(document.body).find('.innerdesignarea .outer').css("background-color", 'rgba(0,0,0,0,0)')
                jQuery(document.body).find('.innerdesignarea .outer').append(htmlOutput);
                // jQuery(document.body).find('.maincard').css("background-image", `url(${imgsrc})`);
            }
        }else{
            jQuery(this).find('span').css({'border-color': 'red'});
        }
    });

    function getFileExtension(url) {
        return url.split('.').pop().split(/\#|\?/)[0];
    }


    jQuery(document).ready(function(){
        var footerheight, footherElement, footerOffset, scrollTop, windowHeight, distanceFromFooterToViewportBottom;
        footerheight = jQuery(document.body).find('.elementor-location-footer').height();
        footherElement = jQuery(document.body).find('.elementor-location-footer');
        jQuery(window).on('scroll', function() {
            footerOffset = footherElement.offset().top + footherElement.outerHeight();
            scrollTop = jQuery(window).scrollTop();
            windowHeight = jQuery(window).height();
            distanceFromFooterToViewportBottom = footerOffset - (scrollTop + windowHeight);
            setTimeout(() => {
                if(footerheight < distanceFromFooterToViewportBottom){
                    jQuery(document.body).find('.elementor-shortcode section#footer').addClass('d-fixed');
                }else{
                    jQuery(document.body).find('.elementor-shortcode section#footer').removeClass('d-fixed');
                }
            }, 1000);
        });
    });

</script>