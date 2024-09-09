<?php if (!defined('ABSPATH'))
    exit; // Exit if accessed directly  ?>

<style>
    .nbd-sidebar>div.wp-block-spacer {
        display: none;
    }

    .mega-panel .nbd-sidebar-con-inner {
        padding: 15px 0;
        max-height: 300px;
        overflow: auto;
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

    .single-design-option {
        border-width: 10px;
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
        font-weight: 500;
        line-height: 20px;
        color: #333333;
    }

    .single-design-option .choosetemplate {
        background: #003F3F;
        color: #ECFF8C;
        border-radius: 5px;
        padding: 8px 20px;
        display: inline-block;
        transition: all 0.3s ease;
        box-shadow: 1px 1px 4px transparent;
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
</style>




<?php if (isset($_GET['source']) && $_GET['source'] == 'single-product'): ?>
    <?php nbdesigner_get_template('gallery/header.php', array()); ?>
    <div id="transparentDesignOptions">
        <div class="single-design-option-wrapper">
            <div class="single-design-option">
                <div class="inner-wrapper">
                    <div class="desc">
                        <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/img/choose_templates.svg'); ?>"
                            alt="<?php echo __('Choose Templates', 'transparentcard'); ?>">
                        <p class="single-design-option-title">
                            <?php _e('More than 2000 templates available.', 'transparentcard'); ?>
                        </p>
                        <p class="single-design-option-short-desc">
                            <?php _e('Pay for the design once, and use it whenever you like.', 'transparentcard'); ?>
                        </p>
                    </div>
                    <div class="btnarea">
                        <a href="#nbd_design_con" class="choosetemplate">
                            <?php _e('Choose a Design', 'transparentcard'); ?>
                        </a>
                        <span><?php echo sprintf(__('From %s0.00', 'transparentcard'), get_woocommerce_currency_symbol()); ?></span>
                    </div>
                </div>
            </div>
            <div class="single-design-option">
                <div class="inner-wrapper">
                    <div class="desc">
                        <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/img/upload_galeria.svg'); ?>"
                            alt="<?php echo __('Upload your design', 'transparentcard'); ?>">
                        <p class="single-design-option-title">
                            <?php _e('Already have your design?', 'transparentcard'); ?>
                        </p>
                        <p class="single-design-option-short-desc">
                            <?php _e('Just upload the final artwork.', 'transparentcard'); ?>
                        </p>
                    </div>
                    <div class="btnarea">
                        <!-- <a href="#nbd_design_con" id="startUpload" class="choosetemplate"><?php //_e('Submit File', 'transparentcard'); ?></a> -->
                        <a href="#nbd_design_con" id="startUploadLink" class="choosetemplate">
                            <?php _e('Submit File', 'transparentcard'); ?>
                        </a>

<?php 
$option         = unserialize( get_post_meta( $pid, '_nbdesigner_upload', true ) );
// echo 'options <br/><pre>';
// print_r($option);
// echo '</pre>';
?>

                        <span><?php echo sprintf(__('Upload %s etc.', 'transparentcard'), $option['allow_type']); ?></span>
                    </div>
                </div>
            </div>
            <div class="single-design-option">
                <div class="inner-wrapper">
                    <div class="desc">
                        <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/img/Ana_design.svg'); ?>"
                            alt="<?php echo __('Custom Design', 'transparentcard'); ?>">
                        <p class="single-design-option-title">
                            <?php _e('Want a custom Design', 'transparentcard'); ?>
                        </p>
                        <p class="single-design-option-short-desc">
                            <?php _e('Tell us your ideas and our design team will create your artwork.', 'transparentcard'); ?>
                        </p>
                    </div>
                    <div class="btnarea">
                        <a href="#hire-a-designer" onclick="hire_a_designer_popup(this)"
                            class="hire-a-designer-btn choosetemplate">
                            <?php _e('Hire a Designer', 'transparentcard'); ?>
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
                            <?php _e('Your design not in digital format?', 'transparentcard'); ?>
                        </p>
                        <p class="single-design-option-short-desc">
                            <?php _e('Upload images or photos and our design team will replicate your artwork.', 'transparentcard'); ?>
                        </p>
                    </div>
                    <div class="btnarea">
                        <a href="#nbd_design_con" onclick="design_replica_popup(this)" class="choosetemplate">
                            <?php _e('Request Design Replica  ', 'transparentcard'); ?>
                        </a>
                        <span><?php echo sprintf(__('For just <span>$0.00</span>', 'transparentcard'), get_woocommerce_currency_symbol()); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>

<!-- <h2 class="text-center elementor-heading-title elementor-size-default"><?php //_e('Transparent Business Card Templates', 'transparentcard'); ?></h2> -->
<!-- Title -->

<?php
$limit = $row * $per_row;
$limit = $limit == 0 ? 1 : $limit;
$current_user_id = get_current_user_id();
if ($pid || $cat):
    if ($cat) {
        $product_cat = get_term($cat, 'product_cat');
        $title = $product_cat->name;
    } else {
        $title = get_the_title($pid);
    }
endif;

?>
<?php if (!isset($_GET['source'])): ?>
    <section id="header-title" class="header-fileupload fullscreen"
        style="background-color:#003F3F; color:#ECFF8C; margin-top:-30px; margin-bottom:50px;">
        <div class="innersect ast-container ml-auto mr-auto">
            <div class="d-flex align-item-center justify-content-center">
                <h3 class="text-center text-uppercase" style="color:#ECFF8C; padding:50px 0;">
                    <?php echo esc_attr($title); ?>     <?php _e('designs', 'web-to-print-online-designer'); ?>
                </h3>
            </div>
        </div>
    </section>
<?php endif; ?>



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
            <?php
            if ($pid && count($templates)):
                $link_start_design = add_query_arg(array('product_id' => $pid), getUrlPageNBD('create'));
                ?>
                <div class="nbdesigner-item">
                    <div class="nbd-gallery-item nbd-gallery-item-upload">
                        <div class="nbd-gallery-item-upload-inner">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="80" height="80"
                                viewBox="0 0 80 80">
                                <title>plus-circle</title>
                                <path fill="#ddd"
                                    d="M40 3.333c-20.333 0-36.667 16.333-36.667 36.667s16.333 36.667 36.667 36.667 36.667-16.333 36.667-36.667-16.333-36.667-36.667-36.667zM40 70c-16.667 0-30-13.333-30-30s13.333-30 30-30c16.667 0 30 13.333 30 30s-13.333 30-30 30z">
                                </path>
                                <path fill="#ddd"
                                    d="M53.333 36.667h-10v-10c0-2-1.333-3.333-3.333-3.333s-3.333 1.333-3.333 3.333v10h-10c-2 0-3.333 1.333-3.333 3.333s1.333 3.333 3.333 3.333h10v10c0 2 1.333 3.333 3.333 3.333s3.333-1.333 3.333-3.333v-10h10c2 0 3.333-1.333 3.333-3.333s-1.333-3.333-3.333-3.333z">
                                </path>
                            </svg>
                        </div>
                        <div class="nbd-gallery-item-upload-inner">
                            <a href="<?php echo esc_url($link_start_design); ?>" class="" target="_blank"
                                title="<?php esc_html_e('Start design', 'web-to-print-online-designer'); ?>">
                                <?php esc_html_e('Design or', 'web-to-print-online-designer'); ?><br />
                                <?php esc_html_e('Upload file', 'web-to-print-online-designer'); ?>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php include_once('gallery-item.php'); ?>
        </div>
        <div>
            <div class="nbd-load-more" id="nbd-load-more"></div>
            <div id="nbd-pagination-wrap">
                <?php if ($pagination)
                    include_once('pagination.php'); ?>
            </div>
            <?php //include_once('popup-wrap.php'); ?>
            <?php include_once('popup-howitworks.php'); ?>

        </div>
    </div> <!-- End. list designs -->
</div>






<script>
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
        var selector = '.nbd-popup-request-replica';
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



</script>