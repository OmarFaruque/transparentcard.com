<?php
/**
 * Request design replica popup wrap
 */
?>

<div class="design-replica-popupitems d-grid gap-20" style="padding:10px 30px; text-align:center;">
    <div class="item flex-1">
        <div class="img">
            <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/img/take-photo-submit-file.webp'); ?>"
                alt="<?php _e('Replicate modal', 'transparentcard'); ?>">
        </div>
        <p><?php _e('Capture a photo or upload your files.', 'transparentcard'); ?></p>
    </div>

    <div class="item flex-1">
        <div class="img">
            <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/img/attach-file.webp'); ?>"
                alt="<?php _e('Step 2', 'transparentcard'); ?>">
        </div>
        <p><?php _e("Attach all relevant files/images necessary for accurately replicating your design.", 'transparentcard'); ?>
        </p>
    </div>

    <div class="item flex-1">
        <div class="img">
            <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/img/available-24h.webp'); ?>"
                alt="<?php _e('Step 3', 'transparentcard'); ?>">
        </div>
        <p><?php _e("It will be available on the platform within 24h", 'transparentcard'); ?></p>
    </div>

    <div class="item flex-1">
        <div class="img">
            <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/img/ready-to-print.webp'); ?>"
                alt="<?php _e('Step 4', 'transparentcard'); ?>">
        </div>
        <p><?php _e("Your design is prepared for printing.", 'transparentcard'); ?></p>
    </div>
</div>