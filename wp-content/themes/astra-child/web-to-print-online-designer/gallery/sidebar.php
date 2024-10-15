<?php do_action('nbd_before_gallery_sidebar'); ?>
<div class="nbd-designers nbd-sidebar-con">
    <p class="nbd-sidebar-h3"><?php esc_html_e('Wish list', 'web-to-print-online-designer'); ?></p>
    <div class="nbd-sidebar-con-inner wishlist">
        <?php foreach( $fts as $t ): ?>
        <div class="wishlist-tem-wrap" data-id="<?php echo( $t['id'] ); ?>">
            <div class="left" onclick="previewTempalte(event, <?php echo( $t['id'] ); ?>)">
                <img src="<?php echo esc_url( $t['img'] ); ?>" class="nbdesigner-img"/>
            </div>
            <div class="right">
                <div><?php esc_html_e('Template for', 'web-to-print-online-designer'); ?></div>
                <div><?php esc_html_e( $t['title'] ); ?></div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

