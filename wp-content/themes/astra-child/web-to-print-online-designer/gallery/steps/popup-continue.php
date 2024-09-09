<?php if (!defined('ABSPATH')) exit; ?>
<?php
$currentUrl = $current_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>

<div class="nbd-backdrop nbd-popup step hide" id="nbd-popup-continue">
    <div class="nbd-popup-content-wrap">
        <span class="nbd-popup-close" onclick="NBDPopup.hidePopup()">
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <title>close</title>
                <path d="M18.984 6.422l-5.578 5.578 5.578 5.578-1.406 1.406-5.578-5.578-5.578 5.578-1.406-1.406 5.578-5.578-5.578-5.578 1.406-1.406 5.578 5.578 5.578-5.578z"></path>
            </svg>
        </span>
        <div class="nbd-popup-content">
            <div class="loading hide" id="nbd-popup-loading">
                <div class="atom-loading">
                    <div class="loading__ring">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 100" style="enable-background:new 0 0 100 100;" xml:space="preserve"><path d="M85.5,42c-0.2-0.8-0.5-1.7-0.8-2.5c-0.3-0.9-0.7-1.6-1-2.3c-0.3-0.7-0.6-1.3-1-1.9c0.3,0.5,0.5,1.1,0.8,1.7  c0.2,0.7,0.6,1.5,0.8,2.3s0.5,1.7,0.8,2.5c0.8,3.5,1.3,7.5,0.8,12c-0.4,4.3-1.8,9-4.2,13.4c-2.4,4.2-5.9,8.2-10.5,11.2  c-1.1,0.7-2.2,1.5-3.4,2c-0.5,0.2-1.2,0.6-1.8,0.8s-1.3,0.5-1.9,0.8c-2.6,1-5.3,1.7-8.1,1.8l-1.1,0.1L53.8,84c-0.7,0-1.4,0-2.1,0  c-1.4-0.1-2.9-0.1-4.2-0.5c-1.4-0.1-2.8-0.6-4.1-0.8c-1.4-0.5-2.7-0.9-3.9-1.5c-1.2-0.6-2.4-1.2-3.7-1.9c-0.6-0.3-1.2-0.7-1.7-1.1  l-0.8-0.6c-0.3-0.1-0.6-0.4-0.8-0.6l-0.8-0.6L31.3,76l-0.2-0.2L31,75.7l-0.1-0.1l0,0l-1.5-1.5c-1.2-1-1.9-2.1-2.7-3.1  c-0.4-0.4-0.7-1.1-1.1-1.7l-1.1-1.7c-0.3-0.6-0.6-1.2-0.9-1.8c-0.2-0.5-0.6-1.2-0.8-1.8c-0.4-1.2-1-2.4-1.2-3.7  c-0.2-0.6-0.4-1.2-0.5-1.9c-0.1-0.6-0.2-1.2-0.3-1.8c-0.3-1.2-0.3-2.4-0.4-3.7c-0.1-1.2,0-2.5,0.1-3.7c0.2-1.2,0.3-2.4,0.6-3.5  c0.1-0.6,0.3-1.1,0.4-1.7l0.1-0.8l0.3-0.8c1.5-4.3,3.8-8,6.5-11c0.8-0.8,1.4-1.5,2.1-2.1c0.9-0.9,1.4-1.3,2.2-1.8  c1.4-1.2,2.9-2,4.3-2.8c2.8-1.5,5.5-2.3,7.7-2.8s4-0.7,5.2-0.6c0.6-0.1,1.1,0,1.4,0s0.4,0,0.4,0h0.1c2.7,0.1,5-2.2,5-5  c0.1-2.7-2.2-5-5-5c-0.2,0-0.2,0-0.3,0c0,0-0.2,0.1-0.6,0.1c-0.4,0-1,0-1.8,0.1c-1.6,0.1-4,0.4-6.9,1.2c-2.9,0.8-6.4,2-9.9,4.1  c-1.8,1-3.6,2.3-5.4,3.8C26,21.4,25,22.2,24.4,23c-0.2,0.2-0.4,0.4-0.6,0.6c-0.2,0.2-0.5,0.4-0.6,0.7c-0.5,0.4-0.8,0.9-1.3,1.4  c-3.2,3.9-5.9,8.8-7.5,14.3l-0.3,1l-0.2,1.1c-0.1,0.7-0.3,1.4-0.4,2.1c-0.3,1.5-0.4,2.9-0.5,4.5c0,1.5-0.1,3,0.1,4.5  c0.2,1.5,0.2,3,0.6,4.6c0.1,0.7,0.3,1.5,0.4,2.3c0.2,0.8,0.5,1.5,0.7,2.3c0.4,1.6,1.1,3,1.7,4.4c0.3,0.7,0.7,1.4,1.1,2.1  c0.4,0.8,0.8,1.4,1.2,2.1c0.5,0.7,0.9,1.4,1.4,2s0.9,1.3,1.5,1.9c1.1,1.3,2.2,2.7,3.3,3.5l1.7,1.6c0,0,0.1,0.1,0.1,0.1c0,0,0,0,0,0  c0,0,0,0,0,0l0.1,0.1l0.1,0.1h0.2l0.5,0.4l1,0.7c0.4,0.2,0.6,0.5,1,0.7l1.1,0.6c0.8,0.4,1.4,0.9,2.1,1.2c1.4,0.7,2.9,1.5,4.4,2  c1.5,0.7,3.1,1,4.6,1.5c1.5,0.3,3.1,0.7,4.7,0.8c1.6,0.2,3.1,0.2,4.7,0.2c0.8,0,1.6-0.1,2.4-0.1l1.2-0.1l1.1-0.1  c3.1-0.4,6.1-1.3,8.9-2.4c0.8-0.3,1.4-0.6,2.1-0.9s1.3-0.7,2-1.1c1.3-0.7,2.6-1.7,3.7-2.5c0.5-0.4,1-0.9,1.6-1.3l0.8-0.6l0.2-0.2  c0,0,0.1-0.1,0.1-0.1c0.1-0.1,0,0,0,0v0.1l0.1-0.1l0.4-0.4c0.5-0.5,1-1,1.5-1.5c0.3-0.3,0.5-0.5,0.8-0.8l0.7-0.8  c0.9-1.1,1.8-2.2,2.5-3.3c0.4-0.6,0.7-1.1,1.1-1.7c0.3-0.7,0.6-1.2,0.9-1.8c2.4-4.9,3.5-9.8,3.7-14.4C87.3,49.7,86.6,45.5,85.5,42z"></path></svg>
                    </div>
                    <div class="loading__ring">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 100" style="enable-background:new 0 0 100 100;" xml:space="preserve"><path d="M85.5,42c-0.2-0.8-0.5-1.7-0.8-2.5c-0.3-0.9-0.7-1.6-1-2.3c-0.3-0.7-0.6-1.3-1-1.9c0.3,0.5,0.5,1.1,0.8,1.7  c0.2,0.7,0.6,1.5,0.8,2.3s0.5,1.7,0.8,2.5c0.8,3.5,1.3,7.5,0.8,12c-0.4,4.3-1.8,9-4.2,13.4c-2.4,4.2-5.9,8.2-10.5,11.2  c-1.1,0.7-2.2,1.5-3.4,2c-0.5,0.2-1.2,0.6-1.8,0.8s-1.3,0.5-1.9,0.8c-2.6,1-5.3,1.7-8.1,1.8l-1.1,0.1L53.8,84c-0.7,0-1.4,0-2.1,0  c-1.4-0.1-2.9-0.1-4.2-0.5c-1.4-0.1-2.8-0.6-4.1-0.8c-1.4-0.5-2.7-0.9-3.9-1.5c-1.2-0.6-2.4-1.2-3.7-1.9c-0.6-0.3-1.2-0.7-1.7-1.1  l-0.8-0.6c-0.3-0.1-0.6-0.4-0.8-0.6l-0.8-0.6L31.3,76l-0.2-0.2L31,75.7l-0.1-0.1l0,0l-1.5-1.5c-1.2-1-1.9-2.1-2.7-3.1  c-0.4-0.4-0.7-1.1-1.1-1.7l-1.1-1.7c-0.3-0.6-0.6-1.2-0.9-1.8c-0.2-0.5-0.6-1.2-0.8-1.8c-0.4-1.2-1-2.4-1.2-3.7  c-0.2-0.6-0.4-1.2-0.5-1.9c-0.1-0.6-0.2-1.2-0.3-1.8c-0.3-1.2-0.3-2.4-0.4-3.7c-0.1-1.2,0-2.5,0.1-3.7c0.2-1.2,0.3-2.4,0.6-3.5  c0.1-0.6,0.3-1.1,0.4-1.7l0.1-0.8l0.3-0.8c1.5-4.3,3.8-8,6.5-11c0.8-0.8,1.4-1.5,2.1-2.1c0.9-0.9,1.4-1.3,2.2-1.8  c1.4-1.2,2.9-2,4.3-2.8c2.8-1.5,5.5-2.3,7.7-2.8s4-0.7,5.2-0.6c0.6-0.1,1.1,0,1.4,0s0.4,0,0.4,0h0.1c2.7,0.1,5-2.2,5-5  c0.1-2.7-2.2-5-5-5c-0.2,0-0.2,0-0.3,0c0,0-0.2,0.1-0.6,0.1c-0.4,0-1,0-1.8,0.1c-1.6,0.1-4,0.4-6.9,1.2c-2.9,0.8-6.4,2-9.9,4.1  c-1.8,1-3.6,2.3-5.4,3.8C26,21.4,25,22.2,24.4,23c-0.2,0.2-0.4,0.4-0.6,0.6c-0.2,0.2-0.5,0.4-0.6,0.7c-0.5,0.4-0.8,0.9-1.3,1.4  c-3.2,3.9-5.9,8.8-7.5,14.3l-0.3,1l-0.2,1.1c-0.1,0.7-0.3,1.4-0.4,2.1c-0.3,1.5-0.4,2.9-0.5,4.5c0,1.5-0.1,3,0.1,4.5  c0.2,1.5,0.2,3,0.6,4.6c0.1,0.7,0.3,1.5,0.4,2.3c0.2,0.8,0.5,1.5,0.7,2.3c0.4,1.6,1.1,3,1.7,4.4c0.3,0.7,0.7,1.4,1.1,2.1  c0.4,0.8,0.8,1.4,1.2,2.1c0.5,0.7,0.9,1.4,1.4,2s0.9,1.3,1.5,1.9c1.1,1.3,2.2,2.7,3.3,3.5l1.7,1.6c0,0,0.1,0.1,0.1,0.1c0,0,0,0,0,0  c0,0,0,0,0,0l0.1,0.1l0.1,0.1h0.2l0.5,0.4l1,0.7c0.4,0.2,0.6,0.5,1,0.7l1.1,0.6c0.8,0.4,1.4,0.9,2.1,1.2c1.4,0.7,2.9,1.5,4.4,2  c1.5,0.7,3.1,1,4.6,1.5c1.5,0.3,3.1,0.7,4.7,0.8c1.6,0.2,3.1,0.2,4.7,0.2c0.8,0,1.6-0.1,2.4-0.1l1.2-0.1l1.1-0.1  c3.1-0.4,6.1-1.3,8.9-2.4c0.8-0.3,1.4-0.6,2.1-0.9s1.3-0.7,2-1.1c1.3-0.7,2.6-1.7,3.7-2.5c0.5-0.4,1-0.9,1.6-1.3l0.8-0.6l0.2-0.2  c0,0,0.1-0.1,0.1-0.1c0.1-0.1,0,0,0,0v0.1l0.1-0.1l0.4-0.4c0.5-0.5,1-1,1.5-1.5c0.3-0.3,0.5-0.5,0.8-0.8l0.7-0.8  c0.9-1.1,1.8-2.2,2.5-3.3c0.4-0.6,0.7-1.1,1.1-1.7c0.3-0.7,0.6-1.2,0.9-1.8c2.4-4.9,3.5-9.8,3.7-14.4C87.3,49.7,86.6,45.5,85.5,42z"></path></svg>
                    </div>
                </div>   
            </div>
            <div class="nbd-popup-content-inner nohover">
                    <div class="popupcontent mt-15">
                        <div class="iiner" style="text-align:center;">
                            <p style="font-size:22px; color:#003F3F; font-weight:500;" class="mb-5"><?php _e('Make sure you have filled out the questionnaire correctly.', 'transparentcard'); ?></p>
                            <p style="font-size:18px; font-weight:300;" class="mb-0"><?php echo sprintf(__('By clicking <strong style="color:#003F3F;">%s</strong> , you ensure that you have submitted all the information you need to create your order.', 'transparentcard'), __('Continue', 'transparentcard')); ?></p>
                            
                            

                            <hr class="step-bottom-devider" style="height:1px; background-color: #3996d1; margin: 20px 0px;">
                            <p style="font-size:18px; font-weight:300;" class="mb-10"><?php _e('Make sure that you have completed the entire questionnaire. If essential elements to create your design are missing, the deadline for submitting the proposal will be delayed by one business day.', 'transparentcard'); ?></p>
                            <p style="font-size:18px; font-weight:300;" class="mb-0"><?php _e('To avoid this situation, we ask that you complete all the fields of the questionnaire in order to make it as complete as possible. The more information you provide, the more elements we will have to create the design you want!', 'transparentcard'); ?></p>
                            <hr class="step-bottom-devider" style="height:1px; background-color: #3996d1; margin: 20px 0px;">
                            <div class="footer d-flex gap-20 justify-content-space-between">
                                <div class="flex-1 fitem d-mobile-hidden">
                                    <div class="d-flex" style="align-items:center;">
                                        <div class="setisfectiontext"><?php _e('100% Satisfaction guaranteed', 'transparentcard'); ?></div>
                                        <img style="height:70px; margin-left:-15px;" src="<?php echo esc_url( get_stylesheet_directory_uri(  ) . '/assets/img/Satisf100.webp'); ?>" alt="<?php _e('Step 4', 'transparentcard'); ?>">
                                    </div>
                                </div>

                                <div class="flex-1 fitem d-flex align-item-center gap-20" style="text-align:right; align-items:center; justify-content:end;">
                                    <a href="#" onclick="NBDPopup.hidePopup()" class="btn btn-success backtoform"><?php _e('Back', 'transparentcard'); ?></a>
                                    <a href="#" onclick="next_step(2)" class="btn btn-success continuebtn"><?php _e('Continue', 'transparentcard'); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
<?php
    $gap = absint( get_option( 'nbdesigner_gallery_gutter', 8 ) ) * 2;
?>
<style type="text/css">
    .nbd-popup.step .nbd-popup-content-wrap{
        opacity: 1;
    }

    .backtoform{
        border: 1px solid #004D4D;
        font-weight: bold;
        font-size: 20px;
        padding: 10px 35px;
        margin-top: 10px;
        box-shadow: 0 3px 0 #136031;
        border-radius: 5px;
    }
    .elementor a.continuebtn,
    .continuebtn{
        font-weight: bold;
        font-size: 20px;
        padding: 10px 35px;
        margin-top: 10px;
        color: #fff;
        text-shadow: 0 1px 0 rgba(0, 0, 0, .25) ;
        box-shadow: 0 3px 0 #136031;
        background-color: #004D4D;
        border-radius: 5px;
        color:white;
    }
    .setisfectiontext {
        width: 140px;
        border: 1px solid #3996d1;
        border-left: unset;
        border-right: unset;
    }
    .nbd-popup-content-inner.nohover img:hover{
        box-shadow:unset;
        box-shadow:none;
    }
    
    
    
    .nbd-hidden-sidebar {
        width: calc(100%);
    }
    .nbd-gallery-column-3 .nbdesigner-item {
        width: calc(33.3333% - <?php echo $gap; ?>px);
    }
    .nbd-gallery-column-5 .nbdesigner-item {
        width: calc(20% - <?php echo $gap; ?>px);
    }
    .nbd-gallery-column-4 .nbdesigner-item {
        width: calc(25% - <?php echo $gap; ?>px);
    }
    .nbdesigner-item,
    .nbd-gallery-wrap .nbdesigner-item{
        margin: 0 <?php echo $gap / 2; ?>px <?php echo $gap; ?>px;
    }
    .nbd-gallery-wrap.nbd-gallery-column-2 .nbdesigner-item {
        width: calc(50% - <?php echo $gap; ?>px);
    }
    .nbd-gallery-wrap.nbd-gallery-column-3 .nbdesigner-item {
        width: calc(33.3333% - <?php echo $gap; ?>px);
    }
    .nbd-gallery-wrap.nbd-gallery-column-4 .nbdesigner-item {
        width: calc(25% - <?php echo $gap; ?>px);
    }
    @media screen and (max-width: 1270px){
        .nbd-gallery-column-3 .nbdesigner-item {
            width: calc(50% - <?php echo $gap; ?>px);
        }
        .nbd-gallery-column-4 .nbdesigner-item {
            width: calc(33.3333% - <?php echo $gap; ?>px);
        }
        .nbd-gallery-column-5 .nbdesigner-item {
            width: calc(25% - <?php echo $gap; ?>px);
        }
        .nbd-gallery-wrap.nbd-gallery-column-3 .nbdesigner-item {
            width: calc(50% - <?php echo $gap; ?>px);
        }
        .nbd-gallery-wrap.nbd-gallery-column-4 .nbdesigner-item {
            width: calc(33.3333% - <?php echo $gap; ?>px);
        }
    }
    @media screen and (max-width: 768px){
        .nbd-gallery-wrap.nbd-gallery-column-3 .nbdesigner-item,
        .nbd-gallery-column-3 .nbdesigner-item {
            width: calc(100% - <?php echo $gap; ?>px);
        }
        .nbd-gallery-column-4 .nbdesigner-item, .nbd-gallery-column-5 .nbdesigner-item {
            width: calc(50% - <?php echo $gap; ?>px);
        }
        .nbd-gallery-wrap.nbd-gallery-column-4 .nbdesigner-item {
            width: calc(50% - <?php echo $gap; ?>px);
        }
    }
    @media screen and (max-width: 600px) {
        .nbd-gallery-column-4 .nbdesigner-item,
        .nbd-gallery-column-5 .nbdesigner-item {
            width: calc(100% - <?php echo $gap; ?>px);
        }
        .nbd-gallery-wrap.nbd-gallery-column-4 .nbdesigner-item {
            width: calc(100% - <?php echo $gap; ?>px);
        }
    }
</style>
<script type="text/javascript">

    var updateFavouriteTemplate = function(e, type, template_id){
        var self = jQuery(e),
        parent = self.parent('.nbd-like-icons'),
        tempaltes = localStorage.getItem("nbd_favourite_templates");
        if( tempaltes.indexOf(template_id) > -1 && type == 'like') {
            alert('Template has been added into favourite list!');
            parent.find('.nbd-like-icon').removeClass('active');
            parent.find('.nbd-like-icon.like').addClass('active');
            return;
        }
        var _data = {
            action: 'nbd_update_favorite_template',
            template_id: template_id,
            type: type,
            nonce: nonce
        };
        parent.find('.nbd-like-icon').removeClass('active');
        parent.find('.nbd-like-icon.loading').addClass('active');
        jQuery.post(woocommerce_params.ajax_url , _data, function(data){
            localStorage.setItem("nbd_favourite_templates", JSON.stringify(data.templates));
            parent.find('.nbd-like-icon.loading').removeClass('active');
            parent.find('.nbd-like-icon.'+type).addClass('active');
            if( type == 'like' ){
                updateWishlistSidebar( self, template_id );
            }else{
                jQuery.each(jQuery('.wishlist-tem-wrap'), function(){
                    if( jQuery(this).attr('data-id') == template_id ){
                        jQuery(this).addClass('unwish');
                    }
                });
            }
        });
    };
    var updateWishlistSidebar = function(e, temp_id){
        var parent = e.parents('.nbdesigner-item');
        var exist = false;
        jQuery.each(jQuery('.wishlist-tem-wrap'), function(){
            if( jQuery(this).attr('data-id') == temp_id ){
                jQuery(this).removeClass('unwish');
                exist = true;
            }
        });
        if( !exist ){
            var wish_html  = '<div class="wishlist-tem-wrap" data-id="'+parent.attr('data-id')+'">';
                wish_html +=    '<div class="left" onclick="previewTempalte(event, '+parent.attr('data-id')+')">';
                wish_html +=        '<img src="'+parent.attr('data-img')+'" class="nbdesigner-img"/>';
                wish_html +=    '</div>';
                wish_html +=        '<div class="right">';
                wish_html +=        '<div>Template for</div>';
                wish_html +=        '<div>'+parent.attr('data-title')+'</div>';
                wish_html +=    '</div>';
                wish_html += '</div>';
            jQuery('.nbd-sidebar-con-inner.wishlist').prepend(wish_html);
        }
    };
    var nbd_preview_html = [];

    var nbd_list_product_html = '';
 
    var nbd_preview_product_html = [];

    var changePreviewImage = function(e){
        var src = jQuery(e).attr('src');
        jQuery('.nbd-popup-list-preview img').removeClass('active');
        jQuery(e).addClass('active');
        jQuery('#nbd-popup-large-preview').attr('src', src);
    };
    var switchNBDProductVariation = function(e){
        var vid = jQuery(e).val(),
        btn = jQuery('#nbd-popup-link-create-template'),
        origin_fref = btn.data('href'),
        new_href = origin_fref + '&variation_id=' + vid;
        btn.attr('href', new_href);
    }
    jQuery( document ).ready(function(){
        NBDPopup.calcWidth();
    }); 
    jQuery("body").click(function(e) {
        if(e.target.id == 'nbd-popup'){
            NBDPopup.hidePopup();
        }
    });
    jQuery(document).bind('keydown', function(e) {
        if( e.which == 27 ){
            NBDPopup.hidePopup();
        }
    });
    jQuery(window).on('resize', function () {
        NBDPopup.calcWidth();
    });
   

    var renderNBDGallery = function( init, callback ){
        imagesLoaded( jQuery('#nbdesigner-gallery'), function() {
            if( !init ) jQuery('#nbdesigner-gallery').masonry('reloadItems');
            jQuery('#nbdesigner-gallery').masonry({
                itemSelector: '.nbdesigner-item',
                transitionDuration: 0
            });
            jQuery.each(jQuery('#nbdesigner-gallery .nbdesigner-item'), function(e) {
                jQuery(this).addClass("in-view");
            });
            if( typeof callback == 'function' ){
                callback();
            }
        });
    };

    var NBDPopup = {
        initPopup: function(){
            jQuery('.nbd-popup').addClass('active');
            jQuery('.nbd-popup').removeClass('hide');
            jQuery('body').addClass('open-nbd-popup');
        },
        calcWidth: function(){
          
            var width = jQuery(window).width(),
            height = jQuery(window).height(),
            popupWidth = 1000,
            minHeight = 250,
            popupTop = 100;
            if( width < 600 ) {
                popupWidth = width - 30;
            }
            if( height < 700 ) {
                minHeight = height - 400;
            }            
            jQuery('.nbd-popup-content-wrap').css({
                'width': popupWidth + 'px',
                'margin': popupTop + 'px auto',
                'min-height': minHeight + 'px'
            });     
            jQuery('.nbd-popup-content').css({
                'min-height': minHeight + 'px'
            });
        },
        hidePopup: function(){
            jQuery('.nbd-popup').removeClass('active');
            jQuery('body').removeClass('open-nbd-popup');
            setTimeout(function(){ 
                jQuery('.nbd-popup').addClass('hide');
            }, 500);
        }
    }; 
    var isScrolledIntoView = function(elem){
        var docViewTop = jQuery(window).scrollTop();
        var docViewBottom = docViewTop + jQuery(window).height();
        var elemTop = jQuery(elem).offset().top;
        var elemBottom = elemTop + jQuery(elem).height();
        return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
    };
</script>