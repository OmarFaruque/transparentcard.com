<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly ?>

<?php
    if(isset($_GET['pslug'])){
        $post = get_page_by_path( $_GET['pslug'], OBJECT, 'product');
        if($post) $pid = $post->ID;
    }

?>
 
<link type="text/css" href="<?php echo NBDESIGNER_PLUGIN_URL .'assets/css/modern-additional.css'; ?>" rel="stylesheet" media="all">


<style>
    .nbd-sidebar>div.wp-block-spacer {
        display: none;
    }

    .mega-panel .nbd-sidebar-con-inner {
        padding: 15px 0;
        max-height: 300px;
        overflow: auto;
    }
    .popup-nbo-options .main-popup {
        width: 80% !important;
        height: 90%;
        box-sizing: border-box;
    }

    .nbd-popup .main-popup {
        pointer-events: all;
        background-color: #fff;
        border-radius: 2px;
        -webkit-box-shadow: 0 0 42px rgba(0,0,0,.15);
        box-shadow: 0 0 42px rgba(0,0,0,.15);
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        padding: 20px;
        text-align: left;
        width: 525px;
        -webkit-transition: all .6s;
        transition: all .6s;
        position: relative;
    }
    div.quick-view div.quick-view-image img {
        display: block;
        margin: 0 0 20px;
        border: 1px solid #eee;
        width: 100%;
        height: auto;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.2);
        -webkit-box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.2);
        -moz-box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.2);
        padding: 8px;
        background: #fff;
        -moz-border-radius: 4px;
        -webkit-border-radius: 4px;
        border-radius: 4px;
    }
    div.quick-view div.quick-view-image {
        margin: 0;
        width: 38% !important;
        float: left;
        box-sizing: border-box;
    }

    .nbd-sidebar h3.ui-state-active {
        background-color: white;
    }

    .nbd-sidebar .mega-accordion .mega-panel {
        padding-right: 0;
    }

    /* Design options */
    .single-design-option-wrapper {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }

    @media only screen and (max-width:380px) {
        .popupcontent .iiner h2 {
            font-size: 24px;
        }
        .popupcontent .iiner .setps.d-grid.gap-25.grid-template-column-4.grid-template-column-mobile-2 {
            padding: 0 !important;
        }
    }

    .single-design-option {
        border-width: 6px;
        border-style: solid;
    }

    .single-design-option:nth-child(1) {
        border-color: #003F3F;
    }

    .single-design-option:nth-child(2) {
        border-color: #A8F1E2;
    }

    .single-design-option:nth-child(3) {
        border-color: #ECFF8C;
    }

    .single-design-option:nth-child(4) {
        border-color: #E7CFEF;
    }

    .single-design-option .inner-wrapper {
        background: #fff;
        text-align: center;
        padding: 30px 15px;
        height: 100%;
    }

    .single-design-option .inner-wrapper,
    .single-design-option {
        border-radius: 10px;
    }

    .single-design-option .inner-wrapper p {
        margin: 0;
    }

    .single-design-option .inner-wrapper img {
        margin-bottom: 20px;
    }

    .single-design-option-title {
        font-size: 18px;
        font-weight: 700;
        line-height: 24px;
        color: #003F3F;
        margin-bottom: 10px !important;
    }

    .single-design-option-short-desc {
        font-size: 14px;
        font-weight: 400;
        line-height: 20px;
        color: #333333;
    }
    .single-design-option-wrapper > *{
        transition:all 0.3s ease;
    }
    .single-design-option-wrapper > *:hover {
        box-shadow: 0 5px 10px rgba(0,0,0,0.15);
    }

    .single-design-option .choosetemplate {
        background: #003F3F;
        color: #ECFF8C;
        border-radius: 5px;
        padding: 8px 20px;
        display: inline-block;
        transition: all 0.3s ease;
        box-shadow: 1px 1px 4px transparent;
        min-width:70%;
    }

    .single-design-option .choosetemplate:hover {
        background: #000000;
        box-shadow: 2px 2px 4px #003F3F;
    }

    .single-design-option .desc {
        min-height: 158px;
    }

    .single-design-option .btnarea {
        min-height: 100px;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        align-items: center;
    }

    .single-design-option .btnarea span {
        font-size: 14px;
        font-weight: 500;
        line-height: 20px;
        display: inline;
        margin-top: 8px;
    }

    .single-design-option .btnarea span>span {
        color: #1BA9A9;
    }

    /* Responsive design */
    @media screen and (max-width:1201px) {
        .single-design-option-wrapper {
            gap: 15px;
        }
    }

    @media screen and (max-width:1025px) {
        .single-design-option-wrapper {
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }
    }

    @media screen and (max-width:767px) {
        .header-fileupload {
            padding: 20px;
        }

        .nbd-sidebar .accordion,
        .single-design-option-wrapper {
            padding: 0 20px;
        }
        section.backbtn > div {
            padding: 0 20px;
        }
    }

    @media screen and (max-width:581px) {

        .single-design-option-wrapper {
            grid-template-columns: repeat(1, 1fr);
        }

        .single-design-option .btnarea,
        .single-design-option .desc {
            min-height: unset;
        }
        .youarebuying{
            margin-bottom: 0 !important;
        }
    } 
    .nbd-popup.popup-nbo-options {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,.6);
        z-index: 99;
        opacity: 1;
        visibility: visible;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-transition: all .3s;
        transition: all .3s;
        overflow:hidden;
    }  
    div#nbo-options-wrap {
        overflow-x: hidden;
        overflow-y: auto;
        padding-right: 10px;
    }
    .popup-nbo-options .body {
        height: calc(100% - 130px);
    }
    .popup-nbo-options .footer .nbd-button{
        float: right;
        margin-top: 11px;
    }

    

</style>




<?php if (isset($_GET['source']) && $_GET['source'] == 'single-product'): ?>



    <?php nbdesigner_get_template('gallery/header.php', array('tag' => $args['tag'], 'single' => is_tax('template_tag'))); ?>
    <div id="transparentDesignOptions">
        <?php if(is_tax('template_tag')): ?>
            <div class="ast-container ml-auto mr-auto">
        <?php endif; ?>
        <div class="single-design-option-wrapper">
            <div class="single-design-option">
                <div class="inner-wrapper">
                    <div class="desc">
                        <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/img/choose_templates.svg'); ?>"
                            alt="<?php echo __('Choose Templates', 'transparentcard'); ?>">
                        <p class="single-design-option-title">
                            <?php _e('Choose From Prebuilt Design', 'transparentcard'); ?>
                        </p>
                        <p class="single-design-option-short-desc">
                            <?php _e('Extensively Creative Prebuilt Business Card Templates.', 'transparentcard'); ?>
                        </p>
                    </div>
                    <div class="btnarea btn-wrapper">
                        <a href="#nbd_design_con" class="choosetemplate">
                            <?php _e('Select Design', 'transparentcard'); ?>
                        </a>
                        <!-- <span><?php //echo sprintf(__('From %s0.00', 'transparentcard'), get_woocommerce_currency_symbol()); ?></span> -->
                    </div>
                </div>
            </div>
            <div class="single-design-option">
                <div class="inner-wrapper">
                    <div class="desc">
                        <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/img/upload_galeria.svg'); ?>"
                            alt="<?php echo __('Upload your design', 'transparentcard'); ?>">
                        <p class="single-design-option-title">
                            <?php _e('Are You a Designer or an Artist?', 'transparentcard'); ?>
                        </p>
                        <p class="single-design-option-short-desc">
                            <?php _e('Upload your business card artwork, and let us bring it in real.', 'transparentcard'); ?>
                        </p>
                    </div>
                    <div class="btnarea">
                        <!-- <a href="#nbd_design_con" id="startUpload" class="choosetemplate"><?php //_e('Submit File', 'transparentcard'); ?></a> -->
                        <a href="#nbd_design_con" id="startUploadLink" class="choosetemplate">
                            <?php _e('Upload File', 'transparentcard'); ?>
                        </a>

                        <?php $option  = unserialize( get_post_meta( $pid, '_nbdesigner_upload', true ) );?>

                        <span style="font-weight:500; text-transform: uppercase;font-size:12px;"><?php echo sprintf(__('Upload:  %s etc.', 'transparentcard'), $option['allow_type']); ?></span>
                    </div>
                </div>
            </div>
            <div class="single-design-option">
                <div class="inner-wrapper">
                    <div class="desc">
                        <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/img/Ana_design.svg'); ?>"
                            alt="<?php echo __('Custom Design', 'transparentcard'); ?>" />
                        <p class="single-design-option-title">
                            <?php _e('Seeking Custom Design?', 'transparentcard'); ?>
                        </p>
                        <p class="single-design-option-short-desc">
                            <?php _e('Use our design expert’s eye for your brand.', 'transparentcard'); ?>
                        </p>
                    </div>
                    <div class="btnarea">
                        <a href="#hire-a-designer" onclick="hire_a_designer_popup(this)"
                            class="hire-a-designer-btn choosetemplate">
                            <?php _e('Hire Designer', 'transparentcard'); ?>
                        </a>
                        <span><?php echo sprintf(__('For just <span>$25.67</span>', 'transparentcard'), get_woocommerce_currency_symbol()); ?></span>
                    </div>
                </div>
            </div>
            <div class="single-design-option">
                <div class="inner-wrapper">
                    <div class="desc">
                        <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/img/Designer_P.svg'); ?>"
                            alt="<?php echo __('Digital Format', 'transparentcard'); ?>">
                        <p class="single-design-option-title">
                            <?php _e('Do you need us to replicate a design?', 'transparentcard'); ?>
                        </p>
                        <p class="single-design-option-short-desc">
                            <?php _e('Upload a photo or an image of the business card; our expert designers will replicate that.', 'transparentcard'); ?>
                        </p>
                    </div>
                    <div class="btnarea">
                        <a href="#nbd_design_con" onclick="design_replica_popup(this)" class="choosetemplate">
                            <?php _e('Request Replica', 'transparentcard'); ?>
                        </a>
                        <span><?php echo sprintf(__('For just <span>$0.00</span>', 'transparentcard'), get_woocommerce_currency_symbol()); ?></span>
                    </div>
                </div>
            </div>
        </div>
        <?php if( is_tax('template_tag') ): ?>
            </div>
        <?php endif; ?>
    </div>

<?php endif; ?>

<!-- <h2 class="text-center elementor-heading-title elementor-size-default"><?php //_e('Transparent Business Card Templates', 'transparentcard'); ?></h2> -->
<!-- Title -->

<?php

$limit = $row * $per_row;
$limit = $limit == 0 ? 1 : $limit;
$current_user_id = get_current_user_id();
$title = __('Business Card Templates', 'transparentcard');
if ($pid || $args['tag']):
    if ($args['tag']) {
        $product_cat = get_term($args['tag'], 'template_tag');
        $title = $product_cat->name;
    } else {
        $title = get_the_title($pid);
    }
endif;

?>
<?php if (!isset($_GET['source'])):
        nbdesigner_get_template('gallery/default-header.php', array( 'title' => $title, 'tag' => $args['tag'] ));
endif; ?>



<div id="nbd_design_con" class="nbd-gallery-con" style="overflow:visible; padding-top:5px;">
    <?php
    $show_sidebar = get_option('nbdesigner_gallery_hide_sidebar', 'n');
    if ($show_sidebar != 'y'):
        ?>
        <div class="nbd-sidebar" style="width:250px;">
            <?php include_once('sidebar.php'); ?>
        </div>
    <?php endif; ?>
    <div class="nbd-list-designs <?php if ($show_sidebar == 'y')
        echo 'nbd-hidden-sidebar'; ?>">
        <?php if (isset($_GET['tag']) || isset($_GET['size']) || isset($_GET['corners']) || isset($_GET['orientations']) || isset($_GET['color']) || isset($_GET['search'])): ?>
            <div class="nbd-gallery-filter">
                <span
                    class="nbd-gallery-filter-text"><?php esc_html_e("You've Selected", 'web-to-print-online-designer'); ?></span>
                <?php do_action('coolcard_gallery_filter'); ?> <a href="#" class="nbd-gallery-filter-clear-transparant"
                    onclick="clear_quarayZ_param(event)"><?php esc_html_e("Clear All", 'web-to-print-online-designer'); ?></a>
            </div>
        <?php endif; ?>
        <?php $column = absint(get_option('nbdesigner_gallery_column', 3)); ?>
        <div class="nbdesigner-gallery nbd-gallery-wrap <?php echo 'nbd-gallery-column-' . $column; ?>"
            id="nbdesigner-gallery">
            <?php include_once('gallery-item.php'); ?>
        </div>
        <div>
            <div class="nbd-load-more" id="nbd-load-more"></div>
            <div id="nbd-pagination-wrap" class="mb-30">
                <?php if ($pagination)
                    include_once('pagination.php'); ?>
            </div>
            <?php //include_once('popup-wrap.php'); ?>
            <?php include_once('popup-howitworks.php'); ?>

        </div>
    </div> <!-- End. list designs -->
</div>


<?php 
 if(isset($_GET['pslug'])){
    /**
     * Popup for product options 
     */
    include_once('popup/printing-options.php');

    $link_get_options   = add_query_arg(
        urlencode_deep( array(
            'wc-api'  => 'NBO_Quick_View',
            'source' => 'gallery',
            'product' => $pid
        ) ),
        home_url( '/' )
    );
}
   
    
?>

<script>

    var nboApp = angular.module('nboApp', []);


    var is_nbd_gallery = 1;
    let clear_quarayZ_param = function (e) {
        e.preventDefault();
        var link = removeParam('tag', window.location.href);
        link = removeParam('color', link);
        link = removeParam('paged', link);
        link = removeParam('search', link);
        link = removeParam('search_type', link);
        link = removeParam('size', link);
        link = removeParam('orientations', link);
        window.location = link;
    }

    var hire_a_designer_popup = function (event) {
        var selector = '.nbd-popup-hire-a-designer';
        jQuery(document.body).find(selector).removeClass('hide');
        setTimeout(() => {
            jQuery(document.body).find(selector).find('.nbd-popup-content').slideDown();
        }, 500);
        return false;
    }

    var design_replica_popup = function (event) {
        console.log('design replica event');
        var selector = '.nbd-popup-request-replica-top-choice';
        jQuery(document.body).find(selector).removeClass('hide');
        setTimeout(() => {
            jQuery(document.body).find(selector).find('.nbd-popup-content').slideDown();
        }, 500);
        return false;
    }


    /** dynamic sumit file button with additional param */
    function redirectToUploadWindow() {
        // Get the current URL
        var url = new URL(window.location.href);

        // Add a new parameter
        url.searchParams.append('action', 'submitFile');

        // console.log('urlis: ', url.toString())
        // use url to string to back button
        window.location.replace(url.toString());

    }


    jQuery(document.body).on('click', 'a#startUploadLink', function (e) {
        e.preventDefault();
        redirectToUploadWindow();
    });




    <?php if(isset($_GET['pslug'])){ ?>


        var xhr = new XMLHttpRequest();
        xhr.open('GET', '<?php echo $link_get_options; ?>', true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    var container = jQuery('#nbo-options-wrap');
                    container.append(xhr.responseText);
                }
            }
        };
        xhr.send();
    <?php } ?>

</script>