<?php 
    $urlArgs = array(
        'pid'    => $pid, 
        'source' => 'single-product'
    );

    $nbd_settings = get_post_meta( $pid, '_designer_setting', true );
    if($nbd_settings){
        $nbd_settings = unserialize($nbd_settings);
        $real_width = $nbd_settings[0]['real_width'] ?? 0;
        $real_height = $nbd_settings[0]['real_height'] ?? 0;
        $size_slug = $real_width . 'x' . $real_height . '-mm';
        $sizedetails = get_term_by('slug', $size_slug, 'paper_size' );

        if($sizedetails)
            $urlArgs['size'] = $sizedetails->term_id;

        if(isset($_GET['step'])){
            $action = match( $_GET['step'] ) 
            {
                '1' => 'submitFile',
                '2' => 'hire-a-designer', 
                '3' => 'request-for-design-replica' 
            };
            $urlArgs['action'] = $action;
        }
    }


    $template_gallery_url   = add_query_arg( $urlArgs, getUrlPageNBD( 'gallery' ) );
?>


<div class="nbd-popup popup-nbo-options" data-animate="bottom-to-top">
    <div class="overlay-popup"></div>
    <div class="main-popup" >
        <i class="icon-nbd icon-nbd-clear close-popup"></i>
        <div class="overlay-main active">
            <div class="loaded">
                <svg class="circular" viewBox="25 25 50 50" >
                    <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
                </svg>
            </div>
        </div>
        <div class="head">
            <h2><?php esc_html_e('Choose options','web-to-print-online-designer'); ?> <?php if($task2 != ''): ?><a class="edit-options" href="<?php echo $link_edit_option; ?>"><?php esc_html_e('Edit options','web-to-print-online-designer'); ?></a><?php endif; ?> </h2>
        </div>
        <div class="body">
            <div class="main-body" id="nbo-options-wrap">
            </div>
        </div>
        <div class="footer om5" >
            <span  class="nbd-invalid-form"><?php esc_html_e('Please choose options before apply to start design!', 'web-to-print-online-designer'); ?></span>
            <a style="text-align:center; color:white;" class="nbd-button nbo-apply" id="useTemplate" href="<?php echo $template_gallery_url;?>" ng-click="applyOptions()"><?php esc_html_e('Apply options','web-to-print-online-designer'); ?></a>
        </div>
    </div>
</div>