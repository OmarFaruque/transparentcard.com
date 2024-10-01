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



// WC()->cart->get_cart()[$cart_item_key]['custom_meta_key'] = 'Custom Meta Value';



?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<section class="header fullscreen">
    <div class="hire-header ast-container">
        <div class="innter">
            <h2 class="mb-1 text-uppercase" style="color:white; margin-bottom:1px;font-size:30px;">
                <?php _e('Need a custom design? We\'ve got you covered!', 'transparentcard'); ?>
            </h2>
            <p style="margin-bottom:0; color:#ECFF8C; font-size:20px;">
                <?php _e('With your vision as our guide, we create something that exceeds expectations.', 'transparentcard'); ?>
            </p>
        </div>
    </div>
</section>

<section class="steps fullscreen pt-20 pb-20">
    <div class="ssteps-inner ast-container">
        <?php nbdesigner_get_template('gallery/hire-steps.php', array()); ?>
    </div>
</section>
<section class="stepstab fullscreen">
    <div class="steptabinner">
        <div class="d-flex">
            <div class="tabitem flex-1 tab-step-1 active">
                <div class="d-flex gap-20 w-hulf w-mobile-full" style="align-items:center;">
                    <div class="stepcount flex-1">1</div>
                    <div class="stepdesc flex-6">
                        <?php _e('Choose the product and the information you want to include in the design', 'transparentcard'); ?>
                    </div>
                </div>
            </div>
            <div class="tabitem tab-step-2 flex-1">
                <div class="d-flex gap-20 w-hulf w-mobile-full">
                    <div class="stepcount">2</div>
                    <div class="stepdesc"><?php _e('Choose the design style', 'transparentcard'); ?></div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="step-form">

    <style>
        .choose-design-template-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 50px;
            margin-bottom: -20px;
        }

        .back-to-template-gallery-btn {
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

        .back-to-template-gallery-btn:hover {
            background: #ECFF8C;
            color: #003F3F !important;
            border-color: #003F3F;
            box-shadow: 0 1px 0 #000;
        }

        h4.design-template-title {
            font-size: 26px;
            font-weight: 700;
            line-height: 26.66px;
            color: #003F3F;

            align-items: center;
            gap: 10px;
        }

        @media screen and (max-width:1200px) {
            h4.design-template-title {
                font-size: 22px;
            }
        }

        @media screen and (max-width:991px) {
            h4.design-template-title {
                font-size: 20px;
            }
        }

        @media screen and (max-width:768px) {
            .choose-design-template-header {
                padding: 0 25px;
            }


            /* .back-to-template-gallery-btn {
                padding: 10px;
            }

            .back-to-template-gallery-btn svg {
                margin-left: -5px;
            } */
        }

        @media screen and (max-width:560px) {
            .back-to-template-gallery-btn {
                padding: 7px;
                font-size: 14px;
            }
            div#prevsubmitbtn {
                display: flex;
                flex-direction: column;
                justify-content: center;
            }
            div#prevsubmitbtn button{
                text-align:center;
                justify-content:center;
            }
            .logo-wrap-group.grid-tampleate-column-3 {
                grid-template-columns: repeat(1, 1fr);
            }

            h4.design-template-title {
                font-size: 18px;
            }
        }
        @media screen and (max-width:540px) {
            .choose-design-template-header {
                display: block;
                text-align: center;
            }
            .back-to-template-gallery-btn{
                margin-top: 10px;
            }
        }

        div#prevsubmitbtn button {
            min-width: 200px;
            text-align: center;
            justify-content: center;
        }
    </style>
    <!-- Header -->
    <div class="choose-design-template-header">
        <div class="desc">
            <h4 class="design-template-title">
                <?php _e('What information do you want to include?', 'transparentcard'); ?>
            </h4>
        </div>
        <div class="back-to-left">
            <a href="#" class="back-to-template-gallery-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                    class="bi bi-chevron-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0" />
                </svg>
                <?php _e('Back <span>to Template Gallery</span>', 'transparentcard'); ?>
            </a>
        </div>
    </div><!-- /Header -->

    <div class="forminner mt-40 mb-40">
        <form method="post" id="hireadesignerForm" action="">
            <?php
            /** Parameters */
            $step1 = array(
                'selectedOptions' => $selectedOptions,
                'business_categorys' => $business_categorys,
                'options' => $options
            );

            $step2 = array();

            if (isset($_GET['task']) && $_GET['task'] == 'resubmit') {
                $cart = WC()->cart->get_cart();
                $step1['cart'] = $cart[$_GET['cik']];
                $step2['cart'] = $cart[$_GET['cik']];
            }
            ?>


            <div class="step-1">
                <?php
                $cart = WC()->cart->get_cart();

                nbdesigner_get_template(
                    'gallery/steps/step-1.php',
                    $step1
                );
                ?>
            </div>
            <div class="step-2" style="display:none;">
                <?php
                nbdesigner_get_template(
                    'gallery/steps/step-2.php',
                    $step2
                );
                ?>
            </div>

        </form>
    </div>
</section>

<?php nbdesigner_get_template('gallery/steps/popup-continue.php', array()); ?>



<style>
    section.header {
        background-color: #103f3fd9;
        text-align: center;
    }

    .card.info {
        border: 1px solid #103f3f;
    }

    .card.info .header {
        background-color: #103f3f;
        color: white;
        padding: 3px 6px;
    }

    .card.info .body {}

    .tabitem:not(.active) * {
        color: #ECFF8C;
    }

    .tabitem:not(.active) {
        opacity: 0.5;
    }

    .tabitem:first-child>div {
        padding-right: 50px;
    }

    .tabitem {
        color: white;
        min-height: 100px;
        display: flex;
        align-items: center;

    }

    .tabitem.active {
        background-color: #ECFF8C;
    }

    .tabitem.active * {
        color: #003F3F;
    }

    .innerwrapper {
        border-style: solid;
        border-width: 1px;
        border-color: #004D4D;
        padding: 80px;
        background-color: #FEFFF9;
    }

    .steptabinner .tabitem {
        flex-basis: 50%;
    }

    .tabitem:first-child {
        justify-content: flex-end;
    }

    .tabitem:last-child {
        justify-content: flex-start;
        padding-left: 50px;
    }

    .arrow.position-relative {
        width: 80px;
        display: table-cell;
        height: 80px;
    }

    .stepcount {
        font-size: 70px;
    }

    .colorselectarea label {
        border: 2px solid #428dcc;
        width: 150px;
        display: inline-block;
        border-radius: 5px;
        cursor: pointer;

    }

    label.position-relative.add-new-colorplate.colorplate-item {
        height: 53px;
    }


    .form-group.colorselectarea {
        display: flex;
        align-items: end;
        gap: 10px;
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
        padding: 7px;
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

    .hire-header {
        padding: 50px 0;
    }

    .uploadfilespreview ul {
        margin: 0;
        list-style: none;
    }

    .uploadfilespreview ul li {
        position: relative;
        padding: 2px 0px;
        display:inline-flex;
        gap: 8px;
        align-items:center;

    }

    .uploadfilespreview ul li span:hover {
        color: red;
    }

    .uploadfilespreview ul li span {
        position: relative;
        right: 0;
        font-size: 30px;
        color: #999;
        cursor: pointer;
    }

    .forminner form textarea.error,
    .forminner form select.error,
    .forminner form input.error {
        border-color: red !important;
        box-shadow: 1px 1px 0.1em #ff00008c;
    }

    .wrapperstepform .innerwrapper .single {
        gap: 40px !important;
    }

    .wrapperstepform .innerwrapper .single p:not(:last-child) {
        margin-bottom: 1.15em !important;
    }

    .wrapperstepform .innerwrapper .single p:last-child {
        margin: 0;
    }

    .wrapperstepform .innerwrapper .single:not(:last-child) {
        padding-bottom: 50px;
    }

    .wrapperstepform .innerwrapper .single .form-group:not(:last-child) {
        margin-bottom: 1em;
    }

    .wrapperstepform .innerwrapper .single .form-group label {
        margin-bottom: 5px;
        font-size: 14px;
        display: inline-block;
    }

    .wrapperstepform .innerwrapper .single .form-group input,
    .wrapperstepform .innerwrapper .single .form-group textarea {
        color: #333;
        border-radius: 5px;
        padding: 10px;
    }

    .wrapperstepform .innerwrapper .single .form-group textarea {
        height: 100px;
    }

    .wrapperstepform .innerwrapper .single .form-group input:focus,
    .wrapperstepform .innerwrapper .single .form-group textarea:focus {
        outline: none;
        border: 1px solid #003F3F !important;
    }

    .wrapperstepform .sectiontitle {
        display: flex;
        align-items: center;
        gap: 15px;
        justify-content: flex-start;
    }

    .sectiontitle span.count {
        width: 52px;
        height: 52px;
        border-radius: 100%;
        background: #003F3F;
        margin-left: -6px;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 30px;
        line-height: 28px;
        font-weight: 400;
        color: #ECFF8C;
    }

    .wrapperstepform .sectiontitle h5 {
        font-size: 20px;
        line-height: 25px;
        font-weight: 700;
        color: #003F3F;
        max-width: 70%;
        width: 100%;
    }

    .step-continue-btn-wrapper {
        display: flex;
        justify-content: center;
        margin-right: calc(100% - 67%);
    }

    .step-continue-btn-wrapper .btn-continue {
        background: #003F3F !important;
        color: #ECFF8C !important;
        border-radius: 5px;
        font-size: 20px;
        line-height: 22px;
        padding: 10px 30px;
        box-shadow: 2px 2px 3px #000;
        transition: all 0.3s ease;
        font-weight: 500;
        border: none !important;
    }


    .step-continue-btn-wrapper .btn-continue:hover {
        background: #ECFF8C !important;
        color: #003F3F !important;
        box-shadow: 3px 3px 3px #000;
    }

    .innerwrapper .single {
        position: relative;
    }
    .add-new-colorplate.d-hide{display:none;}

    .innerwrapper .single:not(.about-the-business):not(.others):before {
        content: '';
        position: absolute;
        left: 20px;
        height: 100%;
        width: 1px;
        background-color: #003F3F;
    }

    .form-group label span {
        color: red;
    }

    .elementor-kit-11 .wrapperstepform label.btn,
    .elementor-kit-11 .wrapperstepform button {
        background-color: transparent;
        color: #003F3F;
        border-color: #003F3F;
        line-height: 20px;
    }

    .elementor-kit-11 .wrapperstepform button:hover {
        background-color: #ECFF8C;
    }

    .elementor-kit-11 .wrapperstepform .logo-wrap-group button.active {
        background-color: #003F3F;
        color: #ECFF8C;
    }



    .logofileavailability input[type="radio"]:checked+label {
        color: #ECFF8C;
        background-color: #003F3F;
    }

    @media screen and (max-width:1025px) {
        .innerwrapper {
            padding: 50px;
        }

        .wrapperstepform .sectiontitle h5 {
            font-size: 16px;
            line-height: 20px;
        }

        .sectiontitle span.count {
            width: 40px;
            height: 40px;
            margin-left: 0px;
            font-size: 20px;
            line-height: 24px;
        }

        .step-continue-btn-wrapper {
            margin-right: calc(100% - 70%);
        }
    }

    @media screen and (max-width:992px) {
        .innerwrapper {
            padding: 40px 30px;
        }

        .wrapperstepform .innerwrapper .single:not(:last-child) {
            padding-bottom: 30px;
        }

        .wrapperstepform .innerwrapper .single {
            gap: 30px !important;
        }

        .step-continue-btn-wrapper {
            margin-right: calc(100% - 69%);
        }

        .ssteps-inner .setps>div.item:nth-child(2):after {
            display: none;
        }

        .grid-template-column-4 {
            grid-template-columns: repeat(2, 1fr);
        }

        .ssteps-inner .setps {
            row-gap: 80px;
        }

        .setps .item span {
            width: 35px;
            height: 35px;
            line-height: 33px;
        }

        .wrapperstepform .innerwrapper {
            padding: 30px;
        }

        .wrapperstepform .innerwrapper .single {
            display: block;
        }

        .innerwrapper .single:not(.about-the-business):not(.others):before {
            display: none;
        }

        .innerwrapper .single .example {
            margin-top: 15px !important;
        }

        .step-continue-btn-wrapper {
            margin-right: inherit;
            justify-content: flex-start;
        }

        .wrapperstepform .sectiontitle {
            margin-bottom: 20px;
        }
    }

    @media screen and (max-width:768px) {
        .ssteps-inner .setps {
            padding: 30px !important;
        }

        .tabitem>div {
            width: 100% !important;
            padding: 0 20px;
        }

        .wrapperstepform .innerwrapper {
            margin: 20px;
        }
    }

    @media screen and (max-width:551px) {
        .wrapperstepform .innerwrapper {
            padding: 20px;
        }
    }
</style>


<script src="https://cdn.jsdelivr.net/npm/spectrum-colorpicker2/dist/spectrum.min.js"></script>
<script>


function rgbToCmyk(r, g, b) {
        let c = 1 - (r / 255);
        let m = 1 - (g / 255);
        let y = 1 - (b / 255);
        let k = Math.min(c, m, y);
        c = (c - k) / (1 - k) || 0;
        m = (m - k) / (1 - k) || 0;
        y = (y - k) / (1 - k) || 0;
        return { c: Math.round(c * 100), m: Math.round(m * 100), y: Math.round(y * 100), k: Math.round(k * 100) };
    }

    function cmykToRgb(c, m, y, k) {
        let r = 255 * (1 - c / 100) * (1 - k / 100);
        let g = 255 * (1 - m / 100) * (1 - k / 100);
        let b = 255 * (1 - y / 100) * (1 - k / 100);
        return { r: Math.round(r), g: Math.round(g), b: Math.round(b) };
    }

    jQuery(document.body).find('input.colorpicker').spectrum({
        showInput: true,
        showPalette: true,
        change: function(color) {
            const rgb = color.toRgb();
            const cmyk = rgbToCmyk(rgb.r, rgb.g, rgb.b);
            console.log("CMYK:", cmyk);
        }
    });



    let next_step = function (stape = 0) {
        let step = parseInt(stape);
        if (step == 1) {
            if (!validation()) {
                jQuery('.nbd-popup.step').addClass('active');
                jQuery('.nbd-popup.step').removeClass('hide');
                jQuery('body').addClass('open-nbd-popup');
            }
        }

        if (step == 2) {
            jQuery(document.body).find('.step-1').hide();
            jQuery(document.body).find('.step-2').show();
            jQuery('.nbd-popup.step').removeClass('active');
            jQuery('.nbd-popup.step').addClass('hide');
            jQuery('body').removeClass('open-nbd-popup');

            jQuery(document.body).find('.tab-step-1').removeClass('active');
            jQuery(document.body).find('.tab-step-2').addClass('active');
        }

        if (step == 0) {
            jQuery(document.body).find('.step-2').hide();
            jQuery(document.body).find('.step-1').show();
            jQuery('.nbd-popup.step').removeClass('active');
            jQuery('.nbd-popup.step').addClass('hide');
            jQuery('body').removeClass('open-nbd-popup');

            jQuery(document.body).find('.tab-step-2').removeClass('active');
            jQuery(document.body).find('.tab-step-1').addClass('active');
        }
    }

    function extractFloat(str) {
        // Use a regular expression to find the first occurrence of a number in the string
        let match = str.match(/-?\d+(\.\d+)?/);

        // If a match is found, convert it to a float
        if (match) {
            return parseFloat(match[0]);
        } else {
            return NaN; // Return NaN if no valid number is found
        }
    }


    /** Add to basket process */
    jQuery(document.body).on('submit', '#hireadesignerForm', function (e) {
        e.preventDefault();

        jQuery(document.body).find('button#submit').prop('disabled', true);
        jQuery(document.body).find('.loadericon').removeClass('d-hide');

        // Create a new FormData object
        var formData = new FormData(this);
        var nonce = nbds_frontend.nonce;

        formData.append('action', 'transparentcard_hire_a_designer_add_to_cart');


        formData.set('design_images[]', '');
        formData.set('logo_ideas[]', '');
        formData.set('uploaded_files[]', '');

        for (var key in design_images) {
            if (design_images.hasOwnProperty(key)) {
                for (var i = 0; i < design_images[key].length; i++) {
                    formData.append(`${key}[]`, design_images[key][i]);
                }
            }
        }
        var product_id = jQuery('input[name="pid"]').val();
        var unitprice = localStorage.getItem('nbd_selected_unit_price' + product_id);
        formData.append('unit_price', unitprice);


        // Perform the AJAX request
        if (!validation2()) {
            jQuery.ajax({
                url: window.nbds_frontend.url, // Replace with your server-side upload handler
                type: 'POST',
                data: formData,
                contentType: false, // Prevent jQuery from setting the Content-Type header
                processData: false, // Prevent jQuery from processing the data
                success: function (response) {
                    // Handle the success response
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

    /** Form validation */
    var validation = function () {
        var haverror = false;
        jQuery('form .step-1').find('[required]').each(function () {
            let fieldName = jQuery(this).attr('name');  // Get the field name
            let type = jQuery(this).attr('type'); //get the field type
            let value = jQuery(this).val();
            switch (type) {
                case 'email':
                    if (!validateEmail(value)) {
                        jQuery(this).addClass('error');
                        haverror = true;
                    }
                    break;
                default:
                    if (value == '') {
                        jQuery(this).addClass('error');
                        haverror = true;
                    }
            }
        });
        return haverror;
    }


    // validation for step 2
    var validation2 = function () {
        var haverror = false;

        
        jQuery('form .step-2').find('[required], [required="required"]').each(function () {
            let fieldName = jQuery(this).attr('name');  // Get the field name
            let type = jQuery(this).attr('type'); //get the field type
            let value = jQuery(this).val();
            switch (type) {
                default:
                    if (value == '') {
                        jQuery(this).addClass('error');
                        haverror = true;
                    }
            }
        });
        return haverror;
    }

    /** Email validatation */
    var validateEmail = function (email) {
        var re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        return re.test(email);
    }

    /** Add new color picker by clicking button */
    let addcolorplate = function () {
        var length = jQuery(document.body).find('label.colorplate-item').length;
        if (length > 1)
            jQuery(document.body).find('.colorselectarea label:not(.colorplate-item)').remove();

        var htmlelements = `<div class="d-flex"><label for="colorPicker${length}" class="position-relative add-new-colorplate colorplate-item">
                    <div class="d-flex gap-10" style="align-items:center;flex-direction:column;">
                        <div class="flex-1">
                            <input type="color" class="colorpicker" style="opacity:0; position:absolute; z-index:0;" id="colorPicker${length}" name="colors[]" >
                            <input type="text" class="form-control opencolor" placeholder="<?php _e('Choose a color', 'transparentcard'); ?>"/>
                        </div>
                        <div class="flex-2">
                            <div class="colorbody" ></div>
                        </div>
                    </div>
                </label></div>`;

        jQuery('.colorselectarea > div:last').before(htmlelements);
    }

    /**Trigger file uploader */
    var clickuploader = function (e) {
        jQuery(e).next('input[type="file"]').trigger('click');
    }

    /** Toggle request logo wraper html */
    let logo_wrap = function (selector, thisselector) {

        if(selector == ''){
            jQuery(document.body).find('.logo-wrapper-html').addClass('d-hidden');
        }

        if (selector != '')
            jQuery(`.logo-wrapper-html:not(.${selector})`).addClass('d-hidden');

        jQuery(`.logo-wrap-group`).find('button').removeClass('active');
        jQuery(thisselector).addClass("active");

        jQuery(document.body).find(`.${selector}`).removeClass('d-hidden');
    }


    jQuery(document.body).on('change', 'input.opencolor', function () {
        
        let colorvalue = jQuery(this).val();
        jQuery(this).prev('input[type="color"]').val(colorvalue);
        jQuery(this).prev('input[type="color"]').trigger('change');
    });

    jQuery(document.body).on('click', 'input.opencolor', function () {
        
        jQuery(this).prev('input').trigger('click');
    });

    jQuery(document.body).on('input', 'input[type="color"]', function(){
        
        var color = jQuery(this).val();
        jQuery(this).closest('label.position-relative.add-new-colorplate.colorplate-item').css({ "background-color": color, "border-color": color })
        jQuery(this).next('input').val(color);
    });

    jQuery(document.body).on('change', 'input[type="color"]', function () {
        
        var color = jQuery(this).val();
        jQuery(this).closest('label.position-relative.add-new-colorplate.colorplate-item').css({ "background-color": color, "border-color": color })
        jQuery(this).next('input').val(color);
    });

    let design_images = [];
    let CloseFilename = function (e, name, index, fromdb = false, cik = false) {
        if(!fromdb){
            design_images[name].splice(index, 1);
            preview_imageshtml(design_images, name, e);
        }
        let thisitem = e;

        if(fromdb){
            let filepath = fromdb;
            let nonce = "<?php echo wp_create_nonce('fileremovefdb'); ?>";
            let formData = {
                filepath: fromdb,
                index: index,
                cik: cik, 
                input_name: name,
                nonce:nonce, 
                action: 'uploaded_file_remove_from_db'
            }

            jQuery.ajax({
                url: window.nbds_frontend.url, // Replace with your server-side upload handler
                type: 'POST',
                data: formData,
                success: function (response) {
                    jQuery(thisitem).closest('li').remove();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log('Form submission failed: ' + errorThrown, 'jqxhr: ', jqXHR);
                }
            });
        }
    }


    /**List image preview as item */
    var preview_imageshtml = function (lists, name, thiselement = '') {
        var htmlwrap = '';
        lists[name].forEach(function (v, k) {
            htmlwrap += `<li>${v.name}<span class="close" value="0" style="line-height: 17.5px;" onclick="CloseFilename(this,'${name}', ${k})">×</span></li>`;
        });
        jQuery(thiselement).closest('.form-group').find('.uploadfilespreview ul').html(htmlwrap);
    }

    jQuery(document.body).on('change', 'input[type="file"]', function () {
        var name = jQuery(this).attr('name');
        name = name.replace('[]', '');

        var values = this.files;

        if (typeof design_images[name] == 'undefined')
            design_images[name] = [];

        design_images[name] = [...design_images[name], ...values];

        preview_imageshtml(design_images, name, this);

    });


    // Price Calculation
    var price = [];
    jQuery('input[type="radio"]').change(function () {

        let thisval = jQuery(this).val();
        let name = jQuery(this).attr('name');

        console.log('name: ',name, 'val: ', thisval)

        if(name == 'logo_type' && thisval == 'Request logo'){
            jQuery(document.body).find('input#name_in_logo').attr('required', true);
        }

        if(name == 'logo_type' && thisval != 'Request logo'){
            jQuery(document.body).find('input#name_in_logo').attr('required', false);
        }

        calculatePrice();
    });

    var calculatePrice = function(){

        
        var finalPrice = 0;
        jQuery('input[type="radio"][data-price]').each(function(v, element){
            if(jQuery(element).is(':checked')){
                var priceis = jQuery(element).data('price');
                finalPrice += parseFloat(priceis);
            }
        });

        finalPrice = finalPrice.toFixed(2);
        if(jQuery('.pricetotal').length){
            jQuery(document.body).find('.pricetotal span').text(finalPrice);
        }
        
        jQuery(document.body).find('input[name="service_total"]').val(finalPrice);
    }
    calculatePrice();

    jQuery(document).ready(function() {
        jQuery('#business_category').select2();
    });

</script>