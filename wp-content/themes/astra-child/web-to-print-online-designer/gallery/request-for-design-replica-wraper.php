<?php
/**
 * Request a design replica wrapper 
 */
?>

<?php if (!defined('ABSPATH'))
    exit; // Exit if accessed directly  ?>


<?php
$product_id = intval($_GET['pid']);

$option_id = get_transient('nbo_product_' . $product_id);

$selectedOptions = $_GET['options'];
$selectedOptions = explode(',', $selectedOptions);

$_options = NBD_FRONTEND_PRINTING_OPTIONS::get_option($option_id);
$options = unserialize($_options['fields']);

$business_categorys = business_categorys();



if (isset($_GET['task']) && $_GET['task'] == 'resubmit') {
    $cart = WC()->cart->get_cart();
    $cart = $cart[$_GET['cik']];
    $additionalMetas = $cart['nbo_additional_meta'] ?? array();
}


if (isset($_POST['custom_upload_nonce']) && wp_verify_nonce($_POST['custom_upload_nonce'], 'custom_upload_action')) {
    $additionalMetas = $_POST;
}


?>

<style>
    .select-service-wrapper img {
        box-shadow: 0 0 0.5em #aaa;
    }
    .choose-design-template-header{
        align-items: center;
        justify-content: space-between;
    }

    .choose-design-template-header .desc{
        width: 40%;
    }
    .choose-design-template-header h3{
        font-size: 27px;
        font-weight: 600;
        line-height: 26px;
        letter-spacing: 0.03em;
        margin-bottom: 15px;
        color: #003F3F;
    }
    .choose-design-template-header p{
        font-size: 14px;
        font-weight: 600;
        line-height: 20px;
        color: #333333;
        letter-spacing: inherit;
    }
    .back-to-template-gallery-btn{
        border-radius: 5px;
        display: inline-flex;
        color: #fff !important;
        background: #003F3F;
        padding: 10px 20px;
        font-size: 16px;
        font-weight: 400;
        letter-spacing: 1.2px;
        align-items: center;
        gap: 5px;
        transition: all 0.2s ease;
        border: 1px solid transparent;
    }
    .back-to-template-gallery-btn:hover{
        background: #ECFF8C;
        color: #003F3F !important;
        border-color: #003F3F;
        box-shadow: 0 1px 0 #000;
    }
    h4.design-template-title{
        font-size: 20px;
        font-weight: 700;
        line-height: 26.66px;
        color: #003F3F;

        align-items: center;
        gap: 10px;
    }
    
    /* .design-template-title::before{
        position: absolute;
        content: '';*/
        /* background-image: url('<?php //echo get_stylesheet_directory_uri().'../../assets/img/number-bg.webp'?>') no-repeat center center / cover; */
        /* width: 100%;
        height: 100%;
        top: 0;
        left: 0; */
    /* } */
    .design-template-title .title-counter{
        position: relative;
        height: 40px;
        width: 40px;
        color: #fff;
        align-items: center;
        justify-content: center;
        background: #003F3F;
        border-radius: 4px;
        
        font-size: 20px;
        font-weight: 700;
        line-height: 26.66px;
    }

    .design-replica-wrap .single-item{
        background: #FEFFF9;
        border-radius: 10px;
        border: 1px solid #003F3F;
        padding: 58px 46px;
    }


    .select-service-wrapper label{
        cursor: pointer;
    }
    .select-service-wrapper label img{
        border-radius: 5px;
    }
    .select-service-note{
        font-size: 14px;
        line-height: 20px;
        margin-top: 15px;
        margin-bottom: 0;
    }
    .radio-label,
    .select-service-note{
        font-weight: 500;
        color: #333333;
    }

    .selected-product{
        font-size: 16px;
        font-weight: 500;
        line-height: 26px;
        color: #1BA9A9;
        margin-bottom: 25px !important;
    }
    .selected-product span{
        color: #333333;
        display: inline-block;
        margin-right: 10px;
    }
    .file-type-wrapper .single-item{
        padding: 0;
        border: none;
        background: unset;
        position: relative;
    }

    .additional-fee{
        color: #333 !important;
        font-size: 13px !important;
        top: 120%;
        left: calc(50% - 20px);
        transform: translateX(-50%);
        font-weight: 400;
    }
    .notice-wrapper .card{
        border: none !important;
    }

    .notice-wrapper .card .header{
        font-size: 18px;
        font-weight: 600;
        line-height: 26px;
        color: #ECFF8C !important;
        background: #003F3F !important;
        padding: 10px 15px !important;
        border-radius: 10px 10px 0 0;
    }

    .notice-wrapper .card .body{
        border: 1px solid #003F3F;
        border-top: none;
        padding: 10px 15px;
        border-radius: 0 0 10px 10px;
        background: #FEFFF9;

        font-size: 16px;
        font-weight: 500;
        line-height: 26px;
        color: #003F3F;
    }
    .logo-type-subtitle{
        font-size: 16px;
        font-weight: 500;
        line-height: 26px;
        color: #333333;
        margin-bottom: 20px;
    }

    .logo-design-replica-wrapper .single-item{
        padding: 0;
        border: none;
    }
    .upload-logo-wrapper{
        align-items: center;
    }

    .logo-uploader-wrapper{
        background: #ECFF8C;
        border: 1px solid #003F3F;
        border-radius: 10px;
        padding: 20px 30px;
        text-align: center;
        cursor: pointer;
        min-width: 250px;
        min-height: 130px;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    
    .upload-logo-wrapper p{
        margin: 0;
    }
    #logo_file{
        display: none;
    }
    .logo-uploader-wrapper{
        align-items: center;
        flex-direction: column;
        gap: 10px;
    }

    
    .logo-uploader-wrapper p{
        font-size: 14px;
        font-weight: 500;
        line-height: 26px;
        color: #003F3F;
    }

    .logo-uploader-wrapper .logouploader{
        background: #003F3F;
        color: #ECFF8C;
        text-shadow: 1px 1px 2px #000000;
        box-shadow: 1px 2px 0px 0px #000000;
        padding: 5px 30px;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .upload-files-wrapper .single-item{
        padding: 0;
    }
    .upload-files-wrapper .upload-file-item .upload-file-body button,
    .upload-files-wrapper .single-item{
        border: none;
    }
    .upload-files-wrapper .upload-file-item{
        border: 1px solid #003F3F;
        border-radius: 5px;
        background: #ECFF8C;
        padding: 20px;
        align-items: center;
    }
    
    .upload-files-wrapper .upload-file-item .upload-file-body button{
        font-size: 17px;
        font-weight: 600;
        line-height: 24px;
        color: #ECFF8C;
        box-shadow: 1px 2px 0px 0px #000000;
        padding: 5px 20px !important;
    }
    .logo-uploader-wrapper .logouploader:hover,
    .upload-files-wrapper .upload-file-item .upload-file-body button:focus,
    .upload-files-wrapper .upload-file-item .upload-file-body button:hover{
        background: #000000;
        color: #ECFF8C;
        box-shadow: 3px 3px 0px 0px #003F3F;
    }
    .upload-files-wrapper .upload-file-item .upload-file-title{
        font-size: 16px;
        color: #003F3F;
    }
    .upload-files-wrapper .upload-file-item .required-tag{
        font-size: 13px;
        color: #333333;
    }

    .upload-files-wrapper .upload-file-item .required-tag,
    .upload-files-wrapper .upload-file-item .upload-file-title{
        line-height: 26px;
        font-weight: 500;
    }

    .upload-files-wrapper .upload-file-item .required-tag span{
        color: #EC0000;
        font-size: 14px;
    }
    .termsnconditionwrap {
        margin-top: -10px;
    }
    .termsnconditionwrap p{
        font-size: 17px;
        font-weight: 600;
        line-height: 26px;
        color:#003F3F;
    }
    .termsnconditionwrap p span{
        color: #1BA9A9;
    }
    .describeweverything .single-item{
        padding: 0;
        border: none;
    }
    .describeweverything .single-item textarea{
        border-radius: 10px;
        background: #fff;
        padding: 15px;

        font-size: 14px;
        font-weight: 500;
        line-height: 26px;
        color: #003F3F;
    }
    .describeweverything .single-item textarea:focus{
        border: 1px solid #003F3F;
    }

    @media screen and (max-width:1025px){
        .file-type-wrapper{
            gap: 15px;
        }
        .design-replica-wrap .single-item {
            padding: 35px 25px;
        }
        .file-type-wrapper .single-item{
            padding: 0;
        }
    }

    @media screen and (max-width:992px){
        .upload-files-wrapper,
        .file-type-wrapper{
            flex-wrap: wrap !important;
        }
        .upload-files-wrapper .single-item,
        .file-type-wrapper .single-item{
            flex: unset;
            width: 48.2%;
        }
        .additional-fee {
            left: calc(80px - 20px);
        }
    }
    @media screen and (max-width:945px){
        .upload-files-wrapper .single-item{
            width: 48.1%;
        }
    }
    @media screen and (max-width:881px){
        .file-type-wrapper .single-item:last-child{
            width: 100%;
            margin-top: 15px;
        }
    }
    @media screen and (max-width:901px){
        .upload-files-wrapper .single-item{
            width: 48%;
        }
    }
    @media screen and (max-width:768px){
        .radio-label {
            font-size: 14px;
            line-height: 20px;
        }
        .logo-design-replica-wrapper .single-item{
            padding: 0;
        }
        .upload-files-wrapper, .file-type-wrapper {
            gap: 20px;
        }
        .upload-files-wrapper .single-item {
            width: 48.4%%;
        }
        .choose-design-template-header .desc {
            width: 55%;
        }
        .upload-files-wrapper, .file-type-wrapper {
            gap: 15px;
        }
    }
    @media screen and (max-width:640px){
        .choose-design-template-header {
            flex-wrap: wrap;
            margin-bottom: 20px;
        }
        .choose-design-template-header .desc,
        .upload-files-wrapper .single-item, .file-type-wrapper .single-item,
        .select-service-wrapper label.flex-1,
        .logo-design-replica-wrapper .single-item,
        .describeweverything .form-group .single-item,
        .choose-design-template-header > div{
            width: 100%;
        }
        .describeweverything .form-group,
        .logo-design-replica-wrapper,
        .select-service-wrapper{
            flex-wrap: wrap;
        }
        .describeweverything .form-group .single-item,
        .logo-design-replica-wrapper .single-item,
        .select-service-wrapper label.flex-1{
            flex: unset;
        }
        .select-service-wrapper label.flex-1{
            border: 1px solid #eee;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 0.3em #ddd;
            background-color:white;
        }
        .upload-files-wrapper{gap:0;}
        div#describeweverything .gap-30 {
            gap: 0;
        }
        .file-type-wrapper {
            gap: 30px;
        }
        .additional-fee {
            top: 40px;
        }
        .termsnconditionwrap p {
            font-size: 15px;
            line-height: 20px;
            margin-bottom: 0;
        }
    }

    @media screen and (max-width:551px) {
        .footer.d-flex.justify-content-space-between{
            flex-wrap: wrap;
        }
        .footer.d-flex.justify-content-space-between .fitem{
            flex: unset;
            width: 100%;
        }
        .footer.d-flex.justify-content-space-between .fitem:first-child{
            display: none;
        }
        .design-replica-wrap .single-item {
            padding: 20px 15px;
        }
        .file-type-wrapper .single-item,
        .logo-design-replica-wrapper .single-item{
            padding: 0;
        }
    }
    </style>
<section class="step-form">
    <div class="forminner mt-40">
        <!-- Header -->
        <div class="choose-design-template-header">
            <div class="desc">
                <h3><?php _e('Design Questionnaire', 'transparentcartd'); ?></h3>
                <p><?php _e('Do you need to reprint your business card but don’t have the original editable files? No problem! Our team can recreate your design for you.', 'transparentcard'); ?>
            </p>
        </div>
        <div class="back-to-left">
            <a href="#" class="back-to-template-gallery-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                    class="bi bi-chevron-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0" />
                </svg>
                <?php _e('Back to Design Options', 'transparentcard'); ?>
            </a>
        </div>
        </div><!-- /Header -->

        <!-- Start content area -->
        <form method="post" id="hireadesignerForm" action="">
            <div class="design-replica-wrap">
                <div class="single-item bg-light border-rounded p-15">
                    <h4 class="mb-10 design-template-title">
                        <span class="title-counter">1</span>
                        <?php _e('Select a service', 'transparentcard'); ?>
                    </h4>
                    <p class="mb-5"><?php _e('If you have more complex designs, please choose second option that is a paid service.', 'transparentcard'); ?></p>
                    <div class="d-flex form-group gap-30 select-service-wrapper">
                        <label class="flex-1">
                            <?php
                            $checked1 = 'checked';
                            if (isset($additionalMetas['service']) && $additionalMetas['service'] != 'Replicate simple design')
                                $checked1 = '';
                            ?>
                            <p class="mb-0 radio-label">
                                <input <?php echo esc_attr($checked1); ?> type="radio" data-price="0.00" name="service"
                                id="service" value="<?php _e('Replicate simple design', 'transparentcard'); ?>">
                                <span class="radio-type"></span>
                                <?php _e('Replicate simple design', 'transparentcard'); ?>
                                <?php echo sprintf('<span class="price">%s0.00</span>', get_woocommerce_currency_symbol()); ?>
                            </p>
                            <?php echo sprintf('<img class="w-full" src="%s" alt="%s" />', get_stylesheet_directory_uri() . '/assets/img/service-1.webp', __('Replicate simple design', 'transparentcard')); ?>
                            <p class="select-service-note"><?php _e('Perfect for those with a finalized design, without any need for changes to the information or design.', 'transparentcard'); ?>
                            </p>
                        </label>

                        <label class="flex-1">
                            <p class="mb-0 radio-label">
                                <input type="radio" <?php echo (isset($additionalMetas['service']) && $additionalMetas['service'] == 'Replicate design changing text, backgrounds and colours') ? 'checked' : ''; ?> name="service" id="service" data-price="8.98" value="<?php _e('Replicate design changing text, backgrounds and colours', 'transparentcard'); ?>">
                                <span class="radio-type"></span>
                                <?php _e('Replicate design changing text, backgrounds and colours', 'transparentcard'); ?>
                                <?php echo sprintf('<span class="price">%s8.98</span>', get_woocommerce_currency_symbol()); ?>
                            </p>

                            <?php echo sprintf('<img class="w-full" src="%s" alt="%s" />', get_stylesheet_directory_uri() . '/assets/img/service-2.webp', __('Replicate simple design', 'transparentcard')); ?>
                            <p class="select-service-note"><?php _e('Ideal if updates to the information or design are required.', 'transparentcard'); ?></p>
                        </label>
                    </div>
                </div>

                <!-- What kind of file do you have -->
                <div class="single-item bg-light border-rounded p-15">
                    <h4 class="mb-10 design-template-title">
                        <span class="title-counter">2</span>
                        <?php _e('What type of file do you have?', 'transparentcard'); ?>
                    </h4>
                    
                    <p class="selected-product">
                        <?php echo sprintf(__('<span>Business Card:</span> %s', 'transparentcard'), get_the_title($product_id)); ?>
                    </p>
                    <div class="d-flex form-group gap-30 align-item-start file-type-wrapper">

                        <?php
                        $checked2 = 'checked';
                        if (isset($additionalMetas['what_kind_of_file']) && $additionalMetas['what_kind_of_file'] != 'I have editable files')
                            $checked2 = '';
                        ?>
                        <!-- Item -->
                        <div class="single-item flex-2">
                            <label class="flex-2 radio-label" style="display:block;" for="what_kind_of_file1">
                                <input type="radio" <?php echo esc_attr($checked2); ?> data-price="0.00"
                                    name="what_kind_of_file" id="what_kind_of_file1"
                                    value="<?php _e('I have editable files', 'transparentcard'); ?>">
                                    <span class="radio-type"></span>
                                    <span class="label-body">
                                        <?php _e('I have editable files', 'transparentcard'); ?>
                                    </span>
                            </label>
                        </div>
                        <!-- Item -->
                        <div class="single-item flex-2">
                            <label class="flex-2 radio-label d-flex align-item-start gap-5"
                            for="what_kind_of_file2">
                            <input <?php echo isset($additionalMetas['what_kind_of_file']) && in_array($additionalMetas['what_kind_of_file'], array("I don't have editable files", "I don\'t have editable files")) ? 'checked' : ''; ?>
                            type="radio" data-price="8.98" name="what_kind_of_file" id="what_kind_of_file2"
                            value="<?php _e("I don't have editable files", 'transparentcard'); ?>">
                            <span class="radio-type"></span>
                            <span class="label-body w-full">
                                <?php _e("I don't have editable files", 'transparentcard'); ?>
                            </span>
                            </label>
                            <div class="additional-infomation text-center">
                                <small class="note text-center" style="color:red; text-decoration: underline;"><?php _e('If you choose it, you should upload logo from step 3.', 'transparentcard'); ?></small>
                                <span class="additional-fee"><?php echo sprintf(__('Additional %s%s', 'transparentcard'), get_woocommerce_currency_symbol(), 8.98); ?></span>
                            </div>
                        </div>
                        <!-- Item -->
                        <div class="single-item flex-3 note">
                            <div class="notesinner notice-wrapper">
                                <div class="card info">
                                    <div class="header">
                                        <?php _e('What\'s the difference?', 'transparentcard'); ?>:
                                    </div>
                                    <div class="body">
                                        <?php _e('What is the difference? - If you send us a photo, We need to redesign again in illustrator, photoshop or something like this.', 'transparentcard'); ?>
                                    </div>
                                </div>
                                <!-- <div class="example flex-1">
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Logo -->
                <div class="single-item bg-light border-rounded p-15">
                    <h4 class="mb-10 design-template-title">
                        <span class="title-counter">3</span>
                        <?php _e('Logo', 'transparentcard'); ?>
                    </h4>
                    <p class="logo-type-subtitle">
                        <?php _e('Which logo would you like us to use in the replica of your business card?', 'transparentcard'); ?>
                    </p>
                    
                    <div class="d-flex form-group gap-30 logo-design-replica-wrapper align-item-center">
                        <?php
                        $checked3 = 'checked';
                        if (isset($additionalMetas['logo']) && $additionalMetas['logo'] != "I don't want logo on my business card")
                            $checked3 = '';
                        ?>
                        
                        
                        <div class="single-item flex-1">
                            <label class="flex-2 upload-logo-wrapper" for="logo1">
                                <p class="radio-label">
                                    <input type="radio" <?php echo isset($additionalMetas['logo']) && $additionalMetas['logo'] == "Upload Logo" ? 'checked' : ''; ?>  name="logo" id="logo1" value="<?php _e('Upload Logo', 'transparentcard'); ?>">
                                    <span class="radio-type"></span>
                                </p>
                                <div>
                                    <div class="logo-uploader-wrapper">
                                        <p><?php _e('Upload Logo', 'transparentcard'); ?></p>
                                        <label for="logo_file" class="logouploader d-hide">
                                            <input type="file" name="logo_file" id="logo_file" class="form-control"  accept=".jpg, .jpeg, .png, .tif, .ai, .bmp, .pdf, .eps, .psd, .cdr, .indd">
                                            <?php _e('Upload', 'transparentcard'); ?>
                                        </label>
                                        <div class="required-tag for-logo d-hide">
                                            <?php _e('For uploading logo, attachment is required', 'transparentcard'); ?>
                                        </div>
                                    </div>
                                    <div class="logouploader-note d-hide">
                                        <small style="color:red;"><?php _e('For upload logo, attachment is required.', 'transparentccard') ?></small>
                                    </div>
                                </div>
                                
                            </label>
                            
                            <div class="uploadfilespreview logo-file" style="margin-left:20px;">
                                <ul></ul>
                            </div>
                        </div>
                        <div class="single-item flex-3">
                            <label class="flex-2 radio-label" style="display:block;" for="logo2">
                                <input type="radio" <?php echo esc_attr($checked3); ?>  name="logo" id="logo2" value="<?php _e("I don't want logo on my business card", 'transparentcard'); ?>">
                                <span class="radio-type"></span>
                                <span class="label-body">
                                    <?php _e("I don't want logo on my business card", 'transparentcard'); ?>
                                </span>
                            </label>
                        </div>
                        

                        <!-- <div class="single-item flex-3 note">

                        </div> -->
                    </div>
                </div>

                <!-- Upload your files -->
                <div class="single-item upload-your-files file-uploader-wrap bg-light border-rounded p-15">
                    <h4 class="mb-10 design-template-title">
                        <span class="title-counter">4</span>
                        <?php _e('Please upload your files', 'transparentcard'); ?>
                    </h4>
                    <p class="logo-type-subtitle">
                        <?php _e('The more files you submit the better the quality of your replica will be', 'transparentcard'); ?>
                    </p>
                    <div class="d-flex form-group gap-30 align-item-top upload-files-wrapper">
                        <!-- <div
                            class="single-item flex-1 border-rounded d-flex flex-direction-column border-1 border-solid justify-content-center gap-10 singleuploader upload-file-item">
                            <div class="upload-file-title">
                                <?php// _e('Front Side', 'transparentcard'); ?>
                            </div>
                            <div class="upload-file-body">
                                <button onclick="document.getElementById('front_side').click();"
                                    type="button">
                                    <?php// _e('Upload', 'transparentcard'); ?>
                                </button>
                                <input type="file" name="front_side" id="front_side" class="d-hide"
                                    accept=".jpg, .jpeg, .png, .tif, .tiff, .bmp, .pdf">
                            </div>
                            <div class="required-tag">
                                <span>*</span><?php //_e('Required', 'transparentcard'); ?>
                            </div>
                        </div> -->

                        <!-- <div
                            class="single-item flex-1 border-rounded d-flex flex-direction-column border-1 border-solid justify-content-center gap-10 singleuploader upload-file-item">
                            <div class="upload-file-title">
                                <?php //_e('Back Side', 'transparentcard'); ?>
                            </div>
                            <div class="upload-file-body">
                                <button onclick="document.getElementById('back_side').click();"
                                    type="button"><?php //_e('Upload', 'transparentcard'); ?></button>
                                <input type="file" name="back_side" id="back_side" class="d-hide"
                                    accept=".jpg, .jpeg, .png, .tif, .tiff, .bmp, .pdf">
                            </div>
                            <div class="required-tag">
                                <?php //_e('Optional', 'transparentcard'); ?>
                            </div>
                        </div> -->

                        <!-- Item -->
                        <div class="single-item flex-1">
                            <div class="upload-file-item border-rounded border-1 border-solid justify-content-center gap-10 singleuploader d-flex flex-direction-column">
                                <div class="upload-file-title">
                                    <?php _e('Upload more reference', 'transparentcard'); ?>
                                </div>
                                <div class="upload-file-body">
                                    <button onclick="document.getElementById('other_files').click();"
                                        type="button"><?php _e('Upload', 'transparentcard'); ?></button>
                                    <input type="file"  name="other_files[]" id="other_files" multiple class="d-hide"
                                        accept=".jpg, .jpeg, .png, .tif, .tiff, .bmp, .pdf">
                                </div>
                               
                            </div>
                            <div class="d-flex mt-20" style="display:none;">
                                <div class="flex-1">
                                    <div class="uploadfilespreview">
                                        <ul></ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Item -->
                        <div class="single-item flex-3 note">
                            <div class="notesinner notice-wrapper">
                                <div class="card info">
                                    <div class="header">
                                        <?php _e('What should I send?', 'transparentcard'); ?>:
                                    </div>
                                    <div class="body">
                                        <?php _e('For the finished business card to be as accurate as possible, please send us all the files/images used to create it.', 'transparentcard'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    



                </div>

                <div class="termsnconditionwrap">
                    <p>
                        <?php _e('By adding any files, you’re accepting our', 'transparentcard'); ?>
                        <span><?php _e('Terms and Conditions.', 'transparentcard'); ?></span>
                    </p>
                </div>

                <!-- Describe everything you’d like us to do -->
                <div class="single-item describeweverything bg-light border-rounded p-15" id="describeweverything">
                    <h4 class="mb-10 design-template-title">
                        <span class="title-counter">5</span>
                        <?php _e('Describe everything you’d like us to do', 'transparentcard'); ?>
                    </h4>
                    <p class="logo-type-subtitle">
                        <?php _e('Write everything you want to change here', 'transparentcard'); ?>
                    </p>
                    <div class="d-flex form-group gap-30 align-item-top">
                        <div class="single-item flex-3 d-flex">
                            <textarea name="describe_everything" id="describe_everything"
                                class="form-control w-full border-rounded"
                                rows="5" placeholder="Describe your changes"><?php echo $additionalMetas['describe_everything'] ?? ''; ?></textarea>
                        </div>

                        <!-- Item -->
                        <div class="single-item flex-3 note">
                            <div class="notesinner notice-wrapper">
                                <div class="card info">
                                    <div class="header">
                                        <?php _e('What should I write?', 'transparentcard'); ?>:
                                    </div>
                                    <div class="body">
                                        <?php _e('Use this box to add any additional information you consider to be important, such as typeface, colours to use, etc.', 'transparentcard'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex mt-20">
                        <div class="flex-1">
                            <div class="uploadfilespreview">
                                <ul></ul>
                            </div>
                        </div>
                        <div class="flex-1"></div>
                    </div>
                </div>

                <div class="footer d-flex gap-20 justify-content-space-between">

                    <style>
                        .total-amount .total-amount-title h5{
                            font-size: 22px;
                            font-weight: 600;
                            line-height: 26px;
                            letter-spacing: 0.03em;
                            color: #003F3F;
                        }
                        .total-amount .pricetotal{
                            border: 1px solid #003F3F;
                            padding: 4px 10px;
                            border-radius: 5px;
                            color: #003F3F;
                            margin-left: 10px;

                            font-size: 18px;
                            font-weight: 600;
                            line-height: 26px;
                        }
                    </style>

                    <div class="flex-1 fitem d-flex" style="text-align:right; align-items:center; justify-content:end;">
                        <div class="d-flex align-item-center gap-5 total-amount">
                            <div class="total-amount-title">
                                <h5><?php _e('Service Total') ?>:</h5>
                            </div>
                            <div class="pricetotal">
                                <?php echo get_woocommerce_currency_symbol(); ?>
                                <span><?php echo esc_attr($additionalMetas['service_total'] ?? '0.00'); ?><span>
                            </div>
                            <input type="hidden" name="service_total"
                                value="<?php echo esc_attr($additionalMetas['service_total'] ?? ''); ?>">
                        </div>
                    </div>
                </div>
                <?php wp_nonce_field('hire_a_designer_action', 'hire_a_designer_nonce'); ?>

                <!-- All hiddeen field -->
                <input type="hidden" name="pid" value="<?php echo esc_attr($_GET['pid'] ?? 0); ?>">
                <?php if (isset($_GET['size'])): ?>
                    <input type="hidden" name="size" value="<?php echo esc_attr($_GET['size'] ?? ''); ?>">
                <?php endif; ?>
                <?php if (isset($_GET['options'])): ?>
                    <input type="hidden" name="options" value="<?php echo esc_attr($_GET['options'] ?? ''); ?>">
                <?php endif; ?>
                <?php if (isset($_GET['qty'])): ?>
                    <input type="hidden" name="quantity" value="<?php echo esc_attr($_GET['qty'] ?? 0); ?>">
                <?php endif; ?>
                <?php if (isset($_GET['cik'])): ?>
                    <input type="hidden" name="update_request" value="<?php echo esc_attr($_GET['cik']); ?>">
                <?php endif; ?>

                <input type="hidden" name="userid"
                    value="<?php echo is_user_logged_in() ? get_current_user_id() : 0; ?>">

                    <style>
                        button{
                            transition: all 0.3s ease;
                        }
                        .add-to-cart-btn-wrapper button{
                            background: #003F3F;
                            box-shadow: 1px 2px 0px 0px #000000;
                            padding: 8px 15px;
                            border-radius: 5px;
                            border: none;
                            color: #fff;
                            
                            font-size: 17px;
                            font-weight: 600;
                            line-height: 26px;
                        }
                        .add-to-cart-btn-wrapper button:hover{
                            background: ##ECFF8C;
                            color: #000;
                            box-shadow: 2px 3px 0px 0px #000000;
                        }
                    </style>

                <div class="flex-1 text-right gap-10 add-to-cart-btn-wrapper">
                    <button class="btn btn-continue px-5 py-10 border-rounded position-relative" id="submit" type="submit">
                        <span class="loadericon d-hide">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M12,23a9.63,9.63,0,0,1-8-9.5,9.51,9.51,0,0,1,6.79-9.1A1.66,1.66,0,0,0,12,2.81h0a1.67,1.67,0,0,0-1.94-1.64A11,11,0,0,0,12,23Z"><animateTransform attributeName="transform" dur="0.75s" repeatCount="indefinite" type="rotate" values="0 12 12;360 12 12"/></path></svg>
                        </span>
                        <?php if (isset($_GET['task']) && $_GET['task'] == 'resubmit'): ?>
                            <?php _e('Update cart item', 'transparentcard'); ?>
                        <?php else: ?>
                            <?php _e('Add to cart', 'transparentcard'); ?>
                        <?php endif; ?>

                    </button>
                    <div class="btn-error d-hide">
                        <small style="color:red;font-size:14px;" ><?php _e('Please fix above error first', 'transparentcard'); ?></small>
                    </div>
                </div>

                <div style="padding:5px;"></div>

            </div>
        </form>
    </div>
</section>

<?php nbdesigner_get_template('gallery/steps/popup-continue.php', array()); ?>



<style>
    section.header {
        background-image: url(<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/img/DaMbackground.webp'); ?>);
    }

    .card.info {
        border: 1px solid #103f3f;
    }

    .card.info .header {
        background-color: #103f3f;
        color: white;
        padding: 3px 6px;
    }
    

    .design-replica-wrap {
        flex-direction: column;
        gap: 30px;
    }
    

    .card.info .body {}

    .tabitem:not(.active) {
        opacity: 0.5;
    }

    @media only screen and (max-width:639px) {
        .upload-logo-wrapper{
            justify-content: space-between; width: 100%;
        }
        .upload-logo-wrapper div{
            width:100%;
        }
    }
    

    .tabitem {
        color: white;
        min-height: 140px;
        align-items: center
    }

    .arrow.position-relative {
        width: 80px;
        display: table-cell;
        height: 80px;
    }

    .justify-content-center {
        justify-content: center;
        text-align: center;
        padding: 5px;
    }

    .stepcount {
        font-size: 70px;
    }

    .colorselectarea label {
        border: 2px solid #428dcc;
        width: 220px;
        display: inline-block;
        border-radius: 5px;
        cursor: pointer;

    }

    label.position-relative.add-new-colorplate.colorplate-item {
        height: 53px;
    }

    .form-group.colorselectarea {
        align-items: center;
        gap: 10px;
    }
    
    .form-group.colorselectarea,
    .tabitem,
    .design-replica-wrap,
    .upload-files-wrapper .upload-file-item,
    .logo-uploader-wrapper,
    .upload-logo-wrapper,
    .design-template-title .title-counter,
    h4.design-template-title,
    .choose-design-template-header{
        display: flex;
    }

    .form-group.colorselectarea input[type="text"] {
        cursor: pointer;
    }

    .colorselectarea label.colorplate-item input[type="text"] {
        padding: 10px 12px !important;
        background: white;
        height: 30px;
        width: 100%;
        z-index: 1;
        position: absolute;
        left: 0;
        border-radius: 5px;
        overflow: hidden;
        font-size: 12px;
    }

    .colorselectarea label:not(.colorplate-item) {
        padding: 7px 12px;
    }

    .stepdesc {
        font-size: 18px;
    }

    section.steps {
        background-color: #eceff1;
    }

    section.stepstab {
        background-color: #6f8b95;
        overflow: hidden;
        position: relative;
        display: block;
    }

    .tabitem .arrow {}

    .tabitem .arrow:before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        height: 50%;
        width: 10%;
        background: #fff;
        border: 1px solid #fff;
        -webkit-transform: skew(-17.5deg, 0deg);
        -moz-transform: skew(-17.5deg, 0deg);
        -ms-transform: skew(-17.5deg, 0deg);
        -o-transform: skew(-17.5deg, 0deg);
        transform: skew(-17.5deg, 0deg);
    }

    .tabitem .arrow:after {
        content: '';
        position: absolute;
        top: 0;
        right: 40%;
        height: 50.5%;
        width: 10%;
        background: #fff;
        border: 1px solid #fff;
        -webkit-transform: skew(17.5deg, 0deg);
        -moz-transform: skew(17.5deg, 0deg);
        -ms-transform: skew(17.5deg, 0deg);
        -o-transform: skew(17.5deg, 0deg);
        transform: skew(17.5deg, 0deg);
    }

    .hire-header {
        padding: 85px 0;
    }

    .uploadfilespreview ul {
        margin: 0;
        list-style: none;
    }

    .uploadfilespreview ul li {
        position: relative;
        padding: 2px 0px;
        display:inline-flex;
        align-items:center;
        width:100%;
        gap:10px;
    }

    .uploadfilespreview ul li span.close:hover {
        color: red;
    }

    .uploadfilespreview ul li span.close {
        right: 0;
        font-size: 30px;
        color: #999;
        cursor: pointer;
    }

    .uploadfilespreview ul li span.filename {
        max-width: 95%;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .forminner form input.error {
        border-color: red !important;
        box-shadow: 1px 1px 0.1em #ff00008c;
    }

    @media only screen and (max-width:769px) {
        .ast-container .forminner {
            max-width: 90%;
            margin-left: auto;
            margin-right: auto;
        }
    }

    @media only screen and (max-width:639px) {
        .ast-container .forminner {
            max-width: 90%;
            margin-left: auto;
            margin-right: auto;
        }
    }
</style>

<script>

    /** Back button url */
    function removeURLParameter(param) {
        // Get the current URL
        var url = new URL(window.location.href);

        // Get the search parameters
        var searchParams = new URLSearchParams(url.search);

        // Remove the specified parameter
        searchParams.delete('action');

        // Update the URL with the modified parameters
        url.search = searchParams.toString();

        // use url to string to back button
        window.location.replace(url.toString());

    }


    jQuery(document.body).on('click', '.back-to-left a', function () {
        removeURLParameter();
    });


    var validationErrors = function(){
        var havError = false;
        var logoValue = jQuery(document.body).find('input[name="logo"]:checked').val();
        var what_kind_of_file = jQuery(document.body).find('input[name="what_kind_of_file"]:checked').val();
        if(logoValue == 'Upload Logo'){
            var logofiles = jQuery(document.body).find('input#logo_file').val();
            if(logofiles == ''){
                jQuery(document.body).find('.logouploader-note, .btn-error, button#submit span.loadericon, .required-tag.for-logo').removeClass('d-hide');
                jQuery(document.body).find('button#submit').prop('disabled', true);
                return true;
            }else{
                jQuery(document.body).find('.logouploader-note, .btn-error, button#submit span.loadericon, .required-tag.for-logo').addClass('d-hide');
                jQuery(document.body).find('button#submit').prop('disabled', false);
                return false;
            }   
        }


        if(what_kind_of_file == "I don't have editable files"){            

            if(logoValue == 'Upload Logo'){
                jQuery(document.body).find('.logouploader-note, .btn-error, button#submit span.loadericon, .required-tag.for-logo').addClass('d-hide');
                jQuery(document.body).find('button#submit').prop('disabled', false);
                return false;
            }else{
                jQuery(document.body).find('input[name="logo"][value="Upload Logo"]').trigger('click');
                jQuery(document.body).find('.logouploader-note, .btn-error, button#submit span.loadericon, .required-tag.for-logo').removeClass('d-hide');
                jQuery(document.body).find('button#submit').prop('disabled', true);
                return true;
            }
        }else{
            jQuery(document.body).find('.logouploader-note, .btn-error, button#submit span.loadericon, .required-tag.for-logo').addClass('d-hide');
            jQuery(document.body).find('button#submit').prop('disabled', false);
            return false;
        }
    }



    jQuery(document.body).on('click', 'button#submit', function(){
        let files;
        files = jQuery(document.body).find('input[name="logo_file"]')[0].files;
        if(files.length <= 0){
            
            jQuery(document.body).find('.logo-uploader-wrapper').css('border-color', 'red');
        }else{
            jQuery(document.body).find('.logo-uploader-wrapper').css('border-color', '#003F3F');
        }
    });


    /** Add to basket process */
    jQuery(document.body).on('submit', '#hireadesignerForm', function (e) {
        e.preventDefault();


        jQuery(document.body).find('button#submit').prop('disabled', true);
        jQuery(document.body).find('.loadericon').removeClass('d-hide');

        // Create a new FormData object
        var formData = new FormData(this);
        var nonce = nbds_frontend.nonce;

        formData.append('action', 'transparentcard_hire_a_designer_add_to_cart');


        formData.set('other_files[]', '');

        for (var key in design_images) {
            // if(key != 'other_files') continue;

            if (design_images.hasOwnProperty(key)) {
                for (var i = 0; i < design_images[key].length; i++) {
                    formData.append(`${key}[]`, design_images[key][i]);
                }
            }
        }



        // Perform the AJAX request
        if(!validationErrors( )){
            jQuery.ajax({
                url: window.nbds_frontend.url, // Replace with your server-side upload handler
                type: 'POST',
                data: formData,
                contentType: false, // Prevent jQuery from setting the Content-Type header
                processData: false, // Prevent jQuery from processing the data
                dataType: 'json',
                success: function (response) {
                    if (response.success)
                        window.location.replace(nbds_frontend.cart_url);

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    // Handle errors here
                    alert('Form submission failed: ' + textStatus);
                }
            });
        }
    });



    /** Add new color picker by clicking button */
    let addcolorplate = function () {
        var length = jQuery(document.body).find('label.colorplate-item').length;
        if (length > 1)
            jQuery(document.body).find('.colorselectarea label:not(.colorplate-item)').remove();

        var htmlelements = `<label for="colorPicker" class="position-relative add-new-colorplate colorplate-item">
                    <div class="d-flex gap-10" style="align-items:center;flex-direction:column;">
                        <div class="flex-1">
                            <input type="color" style="opacity:0; position:absolute; z-index:0;" id="colorPicker" name="colors[]" >
                            <input type="text" class="form-control opencolor" readonly placeholder="<?php _e('Choose a color', 'transparentcard'); ?>"/>
                        </div>
                        <div class="flex-2">
                            <div class="colorbody" ></div>
                        </div>
                    </div>
                </label>`;

        jQuery('.colorselectarea').prepend(htmlelements);
    }

    /**Trigger file uploader */
    var clickuploader = function (e) {
        jQuery(e).next('input[type="file"]').trigger('click');
    }

    /** Toggle request logo wraper html */
    let logo_wrap = function (selector) {
        // if(!jQuery('.logo-wrapper-html').hasClass('d-hidden'))
        jQuery(`.logo-wrapper-html:not(.${selector})`).addClass('d-hidden');

        jQuery(document.body).find(`.${selector}`).removeClass('d-hidden');
    }






    let design_images = [];
    let CloseFilename = function (e, name, index) {
        design_images[name].splice(index, 1);
        preview_imageshtml(design_images, e);
    }


    /**List image preview as item */
    var preview_imageshtml = function (lists, thiselement = '') {
        var htmlwrap = '';

        for (var item in lists) {
            lists[item].forEach(function (v, k) {
                htmlwrap += `<li><span class="filename">${v.name}</span><span class="close" value="0" style="line-height: 17.5px;" onclick="CloseFilename(this,'${item}', ${k})">×</span></li>`;
            });
        }


        jQuery(thiselement).closest('.file-uploader-wrap').find('.uploadfilespreview ul').html(htmlwrap);
        jQuery(thiselement).closest('.file-uploader-wrap').find('.uploadfilespreview').closest('.d-flex').show();
    }

    jQuery(document.body).on('change', '.file-uploader-wrap input[type="file"]', function () {
        var name = jQuery(this).attr('name');
        name = name.replace('[]', '');

        var values = this.files;
        var cont = true;

        if (typeof design_images[name] == 'undefined')
            design_images[name] = [];

        if (['front_side', 'back_side'].indexOf(name) > -1 && design_images[name].length > 0)
            cont = false;


        if (cont)
            design_images[name] = [...design_images[name], ...values];


        preview_imageshtml(design_images, this);

    });



    var CloselogoFile = function(element){
        jQuery(element).closest('ul').html('');
        jQuery(document.body).find('input[name="logo_file"]').val('');
    }

    /** On change logo file upload */
    jQuery(document.body).on('change', 'input[name="logo_file"]', function () {
        var values = this.files;

        var htmlwrap = `<li>${values[0].name}<span class="close" value="0" style="line-height: 17.5px;" onclick="CloselogoFile(jQuery(this))">×</span></li>`;
        jQuery(this).closest('.single-item').find('.uploadfilespreview ul').html(htmlwrap);

        validationErrors();
    });


    jQuery('input[type="radio"][name="logo"]').change(function () {
        let selectedValue = jQuery(this).val();
        selectedValue = selectedValue.toLowerCase();
        if (selectedValue == 'upload logo'){
            jQuery(document.body).find('.logouploader').removeClass('d-hide');
            jQuery(document.body).find('input[name="logo_file"]').attr('required', true);
        }

        if (selectedValue != 'upload logo'){
            jQuery(document.body).find('.logouploader').addClass('d-hide');
            jQuery(document.body).find('input[name="logo_file"]').attr('required', false);
        }

        validationErrors();
    });




    // Price Calculation
    var price = [];
    jQuery('input[type="radio"]').change(function () {
        calculatePrice();

        var inputname = jQuery(this).attr('name');
        var value = jQuery(this).val();
        if(inputname == 'logo'){
            makelogofile_empty(value);
        }

        if(inputname == 'what_kind_of_file'){
            validationErrors();
        }
    });

    var makelogofile_empty = function(value){
        // console.log('value: ', value)
        if(value != 'Upload Logo'){
            jQuery(document.body).find('input[name="logo_file"]').val('');
            jQuery(document.body).find('input[name="logo_file"]').closest('.single-item').find('.uploadfilespreview ul').html('');
        }
    }


    var calculatePrice = function(){
        var finalPrice = 0;
        jQuery('input[type="radio"][data-price]').each(function(v, element){
            if(jQuery(element).is(':checked')){
                var priceis = jQuery(element).data('price');
                finalPrice += parseFloat(priceis);
            }
        });

        finalPrice = finalPrice.toFixed(2);
        jQuery(document.body).find('.pricetotal span').text(finalPrice);
        jQuery(document.body).find('input[name="service_total"]').val(finalPrice);


    }
    calculatePrice();

</script>