<?php if (!defined('ABSPATH'))
    exit; ?>
<?php
$currentUrl = $current_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>

<div class="nbd-backdrop nbd-popup step hide nbd-popup-hire-a-designer" id="nbd-popup">
    <div class="nbd-popup-content-wrap">
        <span class="nbd-popup-close" onclick="NBDPopup.hidePopup()">
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <title>close</title>
                <path
                    d="M18.984 6.422l-5.578 5.578 5.578 5.578-1.406 1.406-5.578-5.578-5.578 5.578-1.406-1.406 5.578-5.578-5.578-5.578 1.406-1.406 5.578 5.578 5.578-5.578z">
                </path>
            </svg>
        </span>
        <div class="nbd-popup-content" style="display:none;">
            <div class="loading hide" id="nbd-popup-loading">
                <div class="atom-loading">
                    <div class="loading__ring">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                            x="0px" y="0px" viewBox="0 0 100 100" style="enable-background:new 0 0 100 100;"
                            xml:space="preserve">
                            <path
                                d="M85.5,42c-0.2-0.8-0.5-1.7-0.8-2.5c-0.3-0.9-0.7-1.6-1-2.3c-0.3-0.7-0.6-1.3-1-1.9c0.3,0.5,0.5,1.1,0.8,1.7  c0.2,0.7,0.6,1.5,0.8,2.3s0.5,1.7,0.8,2.5c0.8,3.5,1.3,7.5,0.8,12c-0.4,4.3-1.8,9-4.2,13.4c-2.4,4.2-5.9,8.2-10.5,11.2  c-1.1,0.7-2.2,1.5-3.4,2c-0.5,0.2-1.2,0.6-1.8,0.8s-1.3,0.5-1.9,0.8c-2.6,1-5.3,1.7-8.1,1.8l-1.1,0.1L53.8,84c-0.7,0-1.4,0-2.1,0  c-1.4-0.1-2.9-0.1-4.2-0.5c-1.4-0.1-2.8-0.6-4.1-0.8c-1.4-0.5-2.7-0.9-3.9-1.5c-1.2-0.6-2.4-1.2-3.7-1.9c-0.6-0.3-1.2-0.7-1.7-1.1  l-0.8-0.6c-0.3-0.1-0.6-0.4-0.8-0.6l-0.8-0.6L31.3,76l-0.2-0.2L31,75.7l-0.1-0.1l0,0l-1.5-1.5c-1.2-1-1.9-2.1-2.7-3.1  c-0.4-0.4-0.7-1.1-1.1-1.7l-1.1-1.7c-0.3-0.6-0.6-1.2-0.9-1.8c-0.2-0.5-0.6-1.2-0.8-1.8c-0.4-1.2-1-2.4-1.2-3.7  c-0.2-0.6-0.4-1.2-0.5-1.9c-0.1-0.6-0.2-1.2-0.3-1.8c-0.3-1.2-0.3-2.4-0.4-3.7c-0.1-1.2,0-2.5,0.1-3.7c0.2-1.2,0.3-2.4,0.6-3.5  c0.1-0.6,0.3-1.1,0.4-1.7l0.1-0.8l0.3-0.8c1.5-4.3,3.8-8,6.5-11c0.8-0.8,1.4-1.5,2.1-2.1c0.9-0.9,1.4-1.3,2.2-1.8  c1.4-1.2,2.9-2,4.3-2.8c2.8-1.5,5.5-2.3,7.7-2.8s4-0.7,5.2-0.6c0.6-0.1,1.1,0,1.4,0s0.4,0,0.4,0h0.1c2.7,0.1,5-2.2,5-5  c0.1-2.7-2.2-5-5-5c-0.2,0-0.2,0-0.3,0c0,0-0.2,0.1-0.6,0.1c-0.4,0-1,0-1.8,0.1c-1.6,0.1-4,0.4-6.9,1.2c-2.9,0.8-6.4,2-9.9,4.1  c-1.8,1-3.6,2.3-5.4,3.8C26,21.4,25,22.2,24.4,23c-0.2,0.2-0.4,0.4-0.6,0.6c-0.2,0.2-0.5,0.4-0.6,0.7c-0.5,0.4-0.8,0.9-1.3,1.4  c-3.2,3.9-5.9,8.8-7.5,14.3l-0.3,1l-0.2,1.1c-0.1,0.7-0.3,1.4-0.4,2.1c-0.3,1.5-0.4,2.9-0.5,4.5c0,1.5-0.1,3,0.1,4.5  c0.2,1.5,0.2,3,0.6,4.6c0.1,0.7,0.3,1.5,0.4,2.3c0.2,0.8,0.5,1.5,0.7,2.3c0.4,1.6,1.1,3,1.7,4.4c0.3,0.7,0.7,1.4,1.1,2.1  c0.4,0.8,0.8,1.4,1.2,2.1c0.5,0.7,0.9,1.4,1.4,2s0.9,1.3,1.5,1.9c1.1,1.3,2.2,2.7,3.3,3.5l1.7,1.6c0,0,0.1,0.1,0.1,0.1c0,0,0,0,0,0  c0,0,0,0,0,0l0.1,0.1l0.1,0.1h0.2l0.5,0.4l1,0.7c0.4,0.2,0.6,0.5,1,0.7l1.1,0.6c0.8,0.4,1.4,0.9,2.1,1.2c1.4,0.7,2.9,1.5,4.4,2  c1.5,0.7,3.1,1,4.6,1.5c1.5,0.3,3.1,0.7,4.7,0.8c1.6,0.2,3.1,0.2,4.7,0.2c0.8,0,1.6-0.1,2.4-0.1l1.2-0.1l1.1-0.1  c3.1-0.4,6.1-1.3,8.9-2.4c0.8-0.3,1.4-0.6,2.1-0.9s1.3-0.7,2-1.1c1.3-0.7,2.6-1.7,3.7-2.5c0.5-0.4,1-0.9,1.6-1.3l0.8-0.6l0.2-0.2  c0,0,0.1-0.1,0.1-0.1c0.1-0.1,0,0,0,0v0.1l0.1-0.1l0.4-0.4c0.5-0.5,1-1,1.5-1.5c0.3-0.3,0.5-0.5,0.8-0.8l0.7-0.8  c0.9-1.1,1.8-2.2,2.5-3.3c0.4-0.6,0.7-1.1,1.1-1.7c0.3-0.7,0.6-1.2,0.9-1.8c2.4-4.9,3.5-9.8,3.7-14.4C87.3,49.7,86.6,45.5,85.5,42z">
                            </path>
                        </svg>
                    </div>
                    <div class="loading__ring">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                            x="0px" y="0px" viewBox="0 0 100 100" style="enable-background:new 0 0 100 100;"
                            xml:space="preserve">
                            <path
                                d="M85.5,42c-0.2-0.8-0.5-1.7-0.8-2.5c-0.3-0.9-0.7-1.6-1-2.3c-0.3-0.7-0.6-1.3-1-1.9c0.3,0.5,0.5,1.1,0.8,1.7  c0.2,0.7,0.6,1.5,0.8,2.3s0.5,1.7,0.8,2.5c0.8,3.5,1.3,7.5,0.8,12c-0.4,4.3-1.8,9-4.2,13.4c-2.4,4.2-5.9,8.2-10.5,11.2  c-1.1,0.7-2.2,1.5-3.4,2c-0.5,0.2-1.2,0.6-1.8,0.8s-1.3,0.5-1.9,0.8c-2.6,1-5.3,1.7-8.1,1.8l-1.1,0.1L53.8,84c-0.7,0-1.4,0-2.1,0  c-1.4-0.1-2.9-0.1-4.2-0.5c-1.4-0.1-2.8-0.6-4.1-0.8c-1.4-0.5-2.7-0.9-3.9-1.5c-1.2-0.6-2.4-1.2-3.7-1.9c-0.6-0.3-1.2-0.7-1.7-1.1  l-0.8-0.6c-0.3-0.1-0.6-0.4-0.8-0.6l-0.8-0.6L31.3,76l-0.2-0.2L31,75.7l-0.1-0.1l0,0l-1.5-1.5c-1.2-1-1.9-2.1-2.7-3.1  c-0.4-0.4-0.7-1.1-1.1-1.7l-1.1-1.7c-0.3-0.6-0.6-1.2-0.9-1.8c-0.2-0.5-0.6-1.2-0.8-1.8c-0.4-1.2-1-2.4-1.2-3.7  c-0.2-0.6-0.4-1.2-0.5-1.9c-0.1-0.6-0.2-1.2-0.3-1.8c-0.3-1.2-0.3-2.4-0.4-3.7c-0.1-1.2,0-2.5,0.1-3.7c0.2-1.2,0.3-2.4,0.6-3.5  c0.1-0.6,0.3-1.1,0.4-1.7l0.1-0.8l0.3-0.8c1.5-4.3,3.8-8,6.5-11c0.8-0.8,1.4-1.5,2.1-2.1c0.9-0.9,1.4-1.3,2.2-1.8  c1.4-1.2,2.9-2,4.3-2.8c2.8-1.5,5.5-2.3,7.7-2.8s4-0.7,5.2-0.6c0.6-0.1,1.1,0,1.4,0s0.4,0,0.4,0h0.1c2.7,0.1,5-2.2,5-5  c0.1-2.7-2.2-5-5-5c-0.2,0-0.2,0-0.3,0c0,0-0.2,0.1-0.6,0.1c-0.4,0-1,0-1.8,0.1c-1.6,0.1-4,0.4-6.9,1.2c-2.9,0.8-6.4,2-9.9,4.1  c-1.8,1-3.6,2.3-5.4,3.8C26,21.4,25,22.2,24.4,23c-0.2,0.2-0.4,0.4-0.6,0.6c-0.2,0.2-0.5,0.4-0.6,0.7c-0.5,0.4-0.8,0.9-1.3,1.4  c-3.2,3.9-5.9,8.8-7.5,14.3l-0.3,1l-0.2,1.1c-0.1,0.7-0.3,1.4-0.4,2.1c-0.3,1.5-0.4,2.9-0.5,4.5c0,1.5-0.1,3,0.1,4.5  c0.2,1.5,0.2,3,0.6,4.6c0.1,0.7,0.3,1.5,0.4,2.3c0.2,0.8,0.5,1.5,0.7,2.3c0.4,1.6,1.1,3,1.7,4.4c0.3,0.7,0.7,1.4,1.1,2.1  c0.4,0.8,0.8,1.4,1.2,2.1c0.5,0.7,0.9,1.4,1.4,2s0.9,1.3,1.5,1.9c1.1,1.3,2.2,2.7,3.3,3.5l1.7,1.6c0,0,0.1,0.1,0.1,0.1c0,0,0,0,0,0  c0,0,0,0,0,0l0.1,0.1l0.1,0.1h0.2l0.5,0.4l1,0.7c0.4,0.2,0.6,0.5,1,0.7l1.1,0.6c0.8,0.4,1.4,0.9,2.1,1.2c1.4,0.7,2.9,1.5,4.4,2  c1.5,0.7,3.1,1,4.6,1.5c1.5,0.3,3.1,0.7,4.7,0.8c1.6,0.2,3.1,0.2,4.7,0.2c0.8,0,1.6-0.1,2.4-0.1l1.2-0.1l1.1-0.1  c3.1-0.4,6.1-1.3,8.9-2.4c0.8-0.3,1.4-0.6,2.1-0.9s1.3-0.7,2-1.1c1.3-0.7,2.6-1.7,3.7-2.5c0.5-0.4,1-0.9,1.6-1.3l0.8-0.6l0.2-0.2  c0,0,0.1-0.1,0.1-0.1c0.1-0.1,0,0,0,0v0.1l0.1-0.1l0.4-0.4c0.5-0.5,1-1,1.5-1.5c0.3-0.3,0.5-0.5,0.8-0.8l0.7-0.8  c0.9-1.1,1.8-2.2,2.5-3.3c0.4-0.6,0.7-1.1,1.1-1.7c0.3-0.7,0.6-1.2,0.9-1.8c2.4-4.9,3.5-9.8,3.7-14.4C87.3,49.7,86.6,45.5,85.5,42z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="nbd-popup-content-inner nohover">
                <div class="popupcontent">
                    <div class="iiner" style="text-align:center;">
                        <h2 style="margin-bottom:0; color:#003F3F;"><?php _e('How does the process work?', 'transparentcard'); ?></h2>
                        <p style="font-size:18px; font-weight:300;">
                            <?php _e('Share your idea with us, and our skilled team will make a design for you.', 'transparentcard'); ?>
                        </p>

                        <?php nbdesigner_get_template('gallery/hire-steps.php', array()); ?>

                        <hr class="step-bottom-devider"
                            style="height:1px; background-color: #333333; margin: 20px 0px;">
                        <div class="footer d-flex gap-20 justify-content-center popupfooter-areea">
                            
                            <div class="flex-1 fitem d-flex"
                                style="text-align:right; align-items:center; justify-content:center;">
                                <a href="<?php echo esc_url($currentUrl . '&action=hire-a-designer'); ?>"
                                    class="btn btn-success continuebtn"><?php _e('Continue', 'transparentcard'); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Request Design Replica popup -->
<div class="nbd-backdrop nbd-popup step hide nbd-popup-request-replica" id="nbd-popup">
    <div class="nbd-popup-content-wrap">
        <span class="nbd-popup-close" onclick="NBDPopup.hidePopup()">
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <title>close</title>
                <path
                    d="M18.984 6.422l-5.578 5.578 5.578 5.578-1.406 1.406-5.578-5.578-5.578 5.578-1.406-1.406 5.578-5.578-5.578-5.578 1.406-1.406 5.578 5.578 5.578-5.578z">
                </path>
            </svg>
        </span>
        <div class="nbd-popup-content" style="display:none;">
            <div class="loading hide" id="nbd-popup-loading">
                <div class="atom-loading">
                    <div class="loading__ring">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                            x="0px" y="0px" viewBox="0 0 100 100" style="enable-background:new 0 0 100 100;"
                            xml:space="preserve">
                            <path
                                d="M85.5,42c-0.2-0.8-0.5-1.7-0.8-2.5c-0.3-0.9-0.7-1.6-1-2.3c-0.3-0.7-0.6-1.3-1-1.9c0.3,0.5,0.5,1.1,0.8,1.7  c0.2,0.7,0.6,1.5,0.8,2.3s0.5,1.7,0.8,2.5c0.8,3.5,1.3,7.5,0.8,12c-0.4,4.3-1.8,9-4.2,13.4c-2.4,4.2-5.9,8.2-10.5,11.2  c-1.1,0.7-2.2,1.5-3.4,2c-0.5,0.2-1.2,0.6-1.8,0.8s-1.3,0.5-1.9,0.8c-2.6,1-5.3,1.7-8.1,1.8l-1.1,0.1L53.8,84c-0.7,0-1.4,0-2.1,0  c-1.4-0.1-2.9-0.1-4.2-0.5c-1.4-0.1-2.8-0.6-4.1-0.8c-1.4-0.5-2.7-0.9-3.9-1.5c-1.2-0.6-2.4-1.2-3.7-1.9c-0.6-0.3-1.2-0.7-1.7-1.1  l-0.8-0.6c-0.3-0.1-0.6-0.4-0.8-0.6l-0.8-0.6L31.3,76l-0.2-0.2L31,75.7l-0.1-0.1l0,0l-1.5-1.5c-1.2-1-1.9-2.1-2.7-3.1  c-0.4-0.4-0.7-1.1-1.1-1.7l-1.1-1.7c-0.3-0.6-0.6-1.2-0.9-1.8c-0.2-0.5-0.6-1.2-0.8-1.8c-0.4-1.2-1-2.4-1.2-3.7  c-0.2-0.6-0.4-1.2-0.5-1.9c-0.1-0.6-0.2-1.2-0.3-1.8c-0.3-1.2-0.3-2.4-0.4-3.7c-0.1-1.2,0-2.5,0.1-3.7c0.2-1.2,0.3-2.4,0.6-3.5  c0.1-0.6,0.3-1.1,0.4-1.7l0.1-0.8l0.3-0.8c1.5-4.3,3.8-8,6.5-11c0.8-0.8,1.4-1.5,2.1-2.1c0.9-0.9,1.4-1.3,2.2-1.8  c1.4-1.2,2.9-2,4.3-2.8c2.8-1.5,5.5-2.3,7.7-2.8s4-0.7,5.2-0.6c0.6-0.1,1.1,0,1.4,0s0.4,0,0.4,0h0.1c2.7,0.1,5-2.2,5-5  c0.1-2.7-2.2-5-5-5c-0.2,0-0.2,0-0.3,0c0,0-0.2,0.1-0.6,0.1c-0.4,0-1,0-1.8,0.1c-1.6,0.1-4,0.4-6.9,1.2c-2.9,0.8-6.4,2-9.9,4.1  c-1.8,1-3.6,2.3-5.4,3.8C26,21.4,25,22.2,24.4,23c-0.2,0.2-0.4,0.4-0.6,0.6c-0.2,0.2-0.5,0.4-0.6,0.7c-0.5,0.4-0.8,0.9-1.3,1.4  c-3.2,3.9-5.9,8.8-7.5,14.3l-0.3,1l-0.2,1.1c-0.1,0.7-0.3,1.4-0.4,2.1c-0.3,1.5-0.4,2.9-0.5,4.5c0,1.5-0.1,3,0.1,4.5  c0.2,1.5,0.2,3,0.6,4.6c0.1,0.7,0.3,1.5,0.4,2.3c0.2,0.8,0.5,1.5,0.7,2.3c0.4,1.6,1.1,3,1.7,4.4c0.3,0.7,0.7,1.4,1.1,2.1  c0.4,0.8,0.8,1.4,1.2,2.1c0.5,0.7,0.9,1.4,1.4,2s0.9,1.3,1.5,1.9c1.1,1.3,2.2,2.7,3.3,3.5l1.7,1.6c0,0,0.1,0.1,0.1,0.1c0,0,0,0,0,0  c0,0,0,0,0,0l0.1,0.1l0.1,0.1h0.2l0.5,0.4l1,0.7c0.4,0.2,0.6,0.5,1,0.7l1.1,0.6c0.8,0.4,1.4,0.9,2.1,1.2c1.4,0.7,2.9,1.5,4.4,2  c1.5,0.7,3.1,1,4.6,1.5c1.5,0.3,3.1,0.7,4.7,0.8c1.6,0.2,3.1,0.2,4.7,0.2c0.8,0,1.6-0.1,2.4-0.1l1.2-0.1l1.1-0.1  c3.1-0.4,6.1-1.3,8.9-2.4c0.8-0.3,1.4-0.6,2.1-0.9s1.3-0.7,2-1.1c1.3-0.7,2.6-1.7,3.7-2.5c0.5-0.4,1-0.9,1.6-1.3l0.8-0.6l0.2-0.2  c0,0,0.1-0.1,0.1-0.1c0.1-0.1,0,0,0,0v0.1l0.1-0.1l0.4-0.4c0.5-0.5,1-1,1.5-1.5c0.3-0.3,0.5-0.5,0.8-0.8l0.7-0.8  c0.9-1.1,1.8-2.2,2.5-3.3c0.4-0.6,0.7-1.1,1.1-1.7c0.3-0.7,0.6-1.2,0.9-1.8c2.4-4.9,3.5-9.8,3.7-14.4C87.3,49.7,86.6,45.5,85.5,42z">
                            </path>
                        </svg>
                    </div>
                    <div class="loading__ring">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                            x="0px" y="0px" viewBox="0 0 100 100" style="enable-background:new 0 0 100 100;"
                            xml:space="preserve">
                            <path
                                d="M85.5,42c-0.2-0.8-0.5-1.7-0.8-2.5c-0.3-0.9-0.7-1.6-1-2.3c-0.3-0.7-0.6-1.3-1-1.9c0.3,0.5,0.5,1.1,0.8,1.7  c0.2,0.7,0.6,1.5,0.8,2.3s0.5,1.7,0.8,2.5c0.8,3.5,1.3,7.5,0.8,12c-0.4,4.3-1.8,9-4.2,13.4c-2.4,4.2-5.9,8.2-10.5,11.2  c-1.1,0.7-2.2,1.5-3.4,2c-0.5,0.2-1.2,0.6-1.8,0.8s-1.3,0.5-1.9,0.8c-2.6,1-5.3,1.7-8.1,1.8l-1.1,0.1L53.8,84c-0.7,0-1.4,0-2.1,0  c-1.4-0.1-2.9-0.1-4.2-0.5c-1.4-0.1-2.8-0.6-4.1-0.8c-1.4-0.5-2.7-0.9-3.9-1.5c-1.2-0.6-2.4-1.2-3.7-1.9c-0.6-0.3-1.2-0.7-1.7-1.1  l-0.8-0.6c-0.3-0.1-0.6-0.4-0.8-0.6l-0.8-0.6L31.3,76l-0.2-0.2L31,75.7l-0.1-0.1l0,0l-1.5-1.5c-1.2-1-1.9-2.1-2.7-3.1  c-0.4-0.4-0.7-1.1-1.1-1.7l-1.1-1.7c-0.3-0.6-0.6-1.2-0.9-1.8c-0.2-0.5-0.6-1.2-0.8-1.8c-0.4-1.2-1-2.4-1.2-3.7  c-0.2-0.6-0.4-1.2-0.5-1.9c-0.1-0.6-0.2-1.2-0.3-1.8c-0.3-1.2-0.3-2.4-0.4-3.7c-0.1-1.2,0-2.5,0.1-3.7c0.2-1.2,0.3-2.4,0.6-3.5  c0.1-0.6,0.3-1.1,0.4-1.7l0.1-0.8l0.3-0.8c1.5-4.3,3.8-8,6.5-11c0.8-0.8,1.4-1.5,2.1-2.1c0.9-0.9,1.4-1.3,2.2-1.8  c1.4-1.2,2.9-2,4.3-2.8c2.8-1.5,5.5-2.3,7.7-2.8s4-0.7,5.2-0.6c0.6-0.1,1.1,0,1.4,0s0.4,0,0.4,0h0.1c2.7,0.1,5-2.2,5-5  c0.1-2.7-2.2-5-5-5c-0.2,0-0.2,0-0.3,0c0,0-0.2,0.1-0.6,0.1c-0.4,0-1,0-1.8,0.1c-1.6,0.1-4,0.4-6.9,1.2c-2.9,0.8-6.4,2-9.9,4.1  c-1.8,1-3.6,2.3-5.4,3.8C26,21.4,25,22.2,24.4,23c-0.2,0.2-0.4,0.4-0.6,0.6c-0.2,0.2-0.5,0.4-0.6,0.7c-0.5,0.4-0.8,0.9-1.3,1.4  c-3.2,3.9-5.9,8.8-7.5,14.3l-0.3,1l-0.2,1.1c-0.1,0.7-0.3,1.4-0.4,2.1c-0.3,1.5-0.4,2.9-0.5,4.5c0,1.5-0.1,3,0.1,4.5  c0.2,1.5,0.2,3,0.6,4.6c0.1,0.7,0.3,1.5,0.4,2.3c0.2,0.8,0.5,1.5,0.7,2.3c0.4,1.6,1.1,3,1.7,4.4c0.3,0.7,0.7,1.4,1.1,2.1  c0.4,0.8,0.8,1.4,1.2,2.1c0.5,0.7,0.9,1.4,1.4,2s0.9,1.3,1.5,1.9c1.1,1.3,2.2,2.7,3.3,3.5l1.7,1.6c0,0,0.1,0.1,0.1,0.1c0,0,0,0,0,0  c0,0,0,0,0,0l0.1,0.1l0.1,0.1h0.2l0.5,0.4l1,0.7c0.4,0.2,0.6,0.5,1,0.7l1.1,0.6c0.8,0.4,1.4,0.9,2.1,1.2c1.4,0.7,2.9,1.5,4.4,2  c1.5,0.7,3.1,1,4.6,1.5c1.5,0.3,3.1,0.7,4.7,0.8c1.6,0.2,3.1,0.2,4.7,0.2c0.8,0,1.6-0.1,2.4-0.1l1.2-0.1l1.1-0.1  c3.1-0.4,6.1-1.3,8.9-2.4c0.8-0.3,1.4-0.6,2.1-0.9s1.3-0.7,2-1.1c1.3-0.7,2.6-1.7,3.7-2.5c0.5-0.4,1-0.9,1.6-1.3l0.8-0.6l0.2-0.2  c0,0,0.1-0.1,0.1-0.1c0.1-0.1,0,0,0,0v0.1l0.1-0.1l0.4-0.4c0.5-0.5,1-1,1.5-1.5c0.3-0.3,0.5-0.5,0.8-0.8l0.7-0.8  c0.9-1.1,1.8-2.2,2.5-3.3c0.4-0.6,0.7-1.1,1.1-1.7c0.3-0.7,0.6-1.2,0.9-1.8c2.4-4.9,3.5-9.8,3.7-14.4C87.3,49.7,86.6,45.5,85.5,42z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="nbd-popup-content-inner nohover">
                <div class="popupcontent">
                    <div class="iiner">
                        <div class="popup-title-container">
                            <h2>
                                <?php _e('How does it work?', 'transparentcard'); ?>
                            </h2>
                        </div>

                        


                        <div class="footer d-flex gap-20 justify-content-center popup-button-container">
                            <!-- <div class="flex-1 fitem">
                                <div class="d-flex" style="align-items:center;">
                                    <div class="setisfectiontext">
                                        <?php _e('100% Satisfaction guaranteed', 'transparentcard'); ?>
                                    </div>
                                    <img style="height:70px; margin-left:-15px;"
                                        src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/img/Satisf100.webp'); ?>"
                                        alt="<?php _e('Step 4', 'transparentcard'); ?>">
                                </div>
                            </div> -->

                            <a href="<?php echo esc_url($currentUrl . '&action=request-for-design-replica'); ?>"
                                class="btn btn-success continuebtn"><?php _e('Continue', 'transparentcard'); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Request Design Replica popup for topchoice -->
<div class="nbd-backdrop nbd-popup step hide nbd-popup-request-replica-top-choice" id="nbd-popup">
    <div class="nbd-popup-content-wrap">
        <span class="nbd-popup-close" onclick="NBDPopup.hidePopup()">
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <title>close</title>
                <path
                    d="M18.984 6.422l-5.578 5.578 5.578 5.578-1.406 1.406-5.578-5.578-5.578 5.578-1.406-1.406 5.578-5.578-5.578-5.578 1.406-1.406 5.578 5.578 5.578-5.578z">
                </path>
            </svg>
        </span>
        <div class="nbd-popup-content" style="display:none;">
            <div class="loading hide" id="nbd-popup-loading">
                <div class="atom-loading">
                    <div class="loading__ring">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                            x="0px" y="0px" viewBox="0 0 100 100" style="enable-background:new 0 0 100 100;"
                            xml:space="preserve">
                            <path
                                d="M85.5,42c-0.2-0.8-0.5-1.7-0.8-2.5c-0.3-0.9-0.7-1.6-1-2.3c-0.3-0.7-0.6-1.3-1-1.9c0.3,0.5,0.5,1.1,0.8,1.7  c0.2,0.7,0.6,1.5,0.8,2.3s0.5,1.7,0.8,2.5c0.8,3.5,1.3,7.5,0.8,12c-0.4,4.3-1.8,9-4.2,13.4c-2.4,4.2-5.9,8.2-10.5,11.2  c-1.1,0.7-2.2,1.5-3.4,2c-0.5,0.2-1.2,0.6-1.8,0.8s-1.3,0.5-1.9,0.8c-2.6,1-5.3,1.7-8.1,1.8l-1.1,0.1L53.8,84c-0.7,0-1.4,0-2.1,0  c-1.4-0.1-2.9-0.1-4.2-0.5c-1.4-0.1-2.8-0.6-4.1-0.8c-1.4-0.5-2.7-0.9-3.9-1.5c-1.2-0.6-2.4-1.2-3.7-1.9c-0.6-0.3-1.2-0.7-1.7-1.1  l-0.8-0.6c-0.3-0.1-0.6-0.4-0.8-0.6l-0.8-0.6L31.3,76l-0.2-0.2L31,75.7l-0.1-0.1l0,0l-1.5-1.5c-1.2-1-1.9-2.1-2.7-3.1  c-0.4-0.4-0.7-1.1-1.1-1.7l-1.1-1.7c-0.3-0.6-0.6-1.2-0.9-1.8c-0.2-0.5-0.6-1.2-0.8-1.8c-0.4-1.2-1-2.4-1.2-3.7  c-0.2-0.6-0.4-1.2-0.5-1.9c-0.1-0.6-0.2-1.2-0.3-1.8c-0.3-1.2-0.3-2.4-0.4-3.7c-0.1-1.2,0-2.5,0.1-3.7c0.2-1.2,0.3-2.4,0.6-3.5  c0.1-0.6,0.3-1.1,0.4-1.7l0.1-0.8l0.3-0.8c1.5-4.3,3.8-8,6.5-11c0.8-0.8,1.4-1.5,2.1-2.1c0.9-0.9,1.4-1.3,2.2-1.8  c1.4-1.2,2.9-2,4.3-2.8c2.8-1.5,5.5-2.3,7.7-2.8s4-0.7,5.2-0.6c0.6-0.1,1.1,0,1.4,0s0.4,0,0.4,0h0.1c2.7,0.1,5-2.2,5-5  c0.1-2.7-2.2-5-5-5c-0.2,0-0.2,0-0.3,0c0,0-0.2,0.1-0.6,0.1c-0.4,0-1,0-1.8,0.1c-1.6,0.1-4,0.4-6.9,1.2c-2.9,0.8-6.4,2-9.9,4.1  c-1.8,1-3.6,2.3-5.4,3.8C26,21.4,25,22.2,24.4,23c-0.2,0.2-0.4,0.4-0.6,0.6c-0.2,0.2-0.5,0.4-0.6,0.7c-0.5,0.4-0.8,0.9-1.3,1.4  c-3.2,3.9-5.9,8.8-7.5,14.3l-0.3,1l-0.2,1.1c-0.1,0.7-0.3,1.4-0.4,2.1c-0.3,1.5-0.4,2.9-0.5,4.5c0,1.5-0.1,3,0.1,4.5  c0.2,1.5,0.2,3,0.6,4.6c0.1,0.7,0.3,1.5,0.4,2.3c0.2,0.8,0.5,1.5,0.7,2.3c0.4,1.6,1.1,3,1.7,4.4c0.3,0.7,0.7,1.4,1.1,2.1  c0.4,0.8,0.8,1.4,1.2,2.1c0.5,0.7,0.9,1.4,1.4,2s0.9,1.3,1.5,1.9c1.1,1.3,2.2,2.7,3.3,3.5l1.7,1.6c0,0,0.1,0.1,0.1,0.1c0,0,0,0,0,0  c0,0,0,0,0,0l0.1,0.1l0.1,0.1h0.2l0.5,0.4l1,0.7c0.4,0.2,0.6,0.5,1,0.7l1.1,0.6c0.8,0.4,1.4,0.9,2.1,1.2c1.4,0.7,2.9,1.5,4.4,2  c1.5,0.7,3.1,1,4.6,1.5c1.5,0.3,3.1,0.7,4.7,0.8c1.6,0.2,3.1,0.2,4.7,0.2c0.8,0,1.6-0.1,2.4-0.1l1.2-0.1l1.1-0.1  c3.1-0.4,6.1-1.3,8.9-2.4c0.8-0.3,1.4-0.6,2.1-0.9s1.3-0.7,2-1.1c1.3-0.7,2.6-1.7,3.7-2.5c0.5-0.4,1-0.9,1.6-1.3l0.8-0.6l0.2-0.2  c0,0,0.1-0.1,0.1-0.1c0.1-0.1,0,0,0,0v0.1l0.1-0.1l0.4-0.4c0.5-0.5,1-1,1.5-1.5c0.3-0.3,0.5-0.5,0.8-0.8l0.7-0.8  c0.9-1.1,1.8-2.2,2.5-3.3c0.4-0.6,0.7-1.1,1.1-1.7c0.3-0.7,0.6-1.2,0.9-1.8c2.4-4.9,3.5-9.8,3.7-14.4C87.3,49.7,86.6,45.5,85.5,42z">
                            </path>
                        </svg>
                    </div>
                    <div class="loading__ring">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                            x="0px" y="0px" viewBox="0 0 100 100" style="enable-background:new 0 0 100 100;"
                            xml:space="preserve">
                            <path
                                d="M85.5,42c-0.2-0.8-0.5-1.7-0.8-2.5c-0.3-0.9-0.7-1.6-1-2.3c-0.3-0.7-0.6-1.3-1-1.9c0.3,0.5,0.5,1.1,0.8,1.7  c0.2,0.7,0.6,1.5,0.8,2.3s0.5,1.7,0.8,2.5c0.8,3.5,1.3,7.5,0.8,12c-0.4,4.3-1.8,9-4.2,13.4c-2.4,4.2-5.9,8.2-10.5,11.2  c-1.1,0.7-2.2,1.5-3.4,2c-0.5,0.2-1.2,0.6-1.8,0.8s-1.3,0.5-1.9,0.8c-2.6,1-5.3,1.7-8.1,1.8l-1.1,0.1L53.8,84c-0.7,0-1.4,0-2.1,0  c-1.4-0.1-2.9-0.1-4.2-0.5c-1.4-0.1-2.8-0.6-4.1-0.8c-1.4-0.5-2.7-0.9-3.9-1.5c-1.2-0.6-2.4-1.2-3.7-1.9c-0.6-0.3-1.2-0.7-1.7-1.1  l-0.8-0.6c-0.3-0.1-0.6-0.4-0.8-0.6l-0.8-0.6L31.3,76l-0.2-0.2L31,75.7l-0.1-0.1l0,0l-1.5-1.5c-1.2-1-1.9-2.1-2.7-3.1  c-0.4-0.4-0.7-1.1-1.1-1.7l-1.1-1.7c-0.3-0.6-0.6-1.2-0.9-1.8c-0.2-0.5-0.6-1.2-0.8-1.8c-0.4-1.2-1-2.4-1.2-3.7  c-0.2-0.6-0.4-1.2-0.5-1.9c-0.1-0.6-0.2-1.2-0.3-1.8c-0.3-1.2-0.3-2.4-0.4-3.7c-0.1-1.2,0-2.5,0.1-3.7c0.2-1.2,0.3-2.4,0.6-3.5  c0.1-0.6,0.3-1.1,0.4-1.7l0.1-0.8l0.3-0.8c1.5-4.3,3.8-8,6.5-11c0.8-0.8,1.4-1.5,2.1-2.1c0.9-0.9,1.4-1.3,2.2-1.8  c1.4-1.2,2.9-2,4.3-2.8c2.8-1.5,5.5-2.3,7.7-2.8s4-0.7,5.2-0.6c0.6-0.1,1.1,0,1.4,0s0.4,0,0.4,0h0.1c2.7,0.1,5-2.2,5-5  c0.1-2.7-2.2-5-5-5c-0.2,0-0.2,0-0.3,0c0,0-0.2,0.1-0.6,0.1c-0.4,0-1,0-1.8,0.1c-1.6,0.1-4,0.4-6.9,1.2c-2.9,0.8-6.4,2-9.9,4.1  c-1.8,1-3.6,2.3-5.4,3.8C26,21.4,25,22.2,24.4,23c-0.2,0.2-0.4,0.4-0.6,0.6c-0.2,0.2-0.5,0.4-0.6,0.7c-0.5,0.4-0.8,0.9-1.3,1.4  c-3.2,3.9-5.9,8.8-7.5,14.3l-0.3,1l-0.2,1.1c-0.1,0.7-0.3,1.4-0.4,2.1c-0.3,1.5-0.4,2.9-0.5,4.5c0,1.5-0.1,3,0.1,4.5  c0.2,1.5,0.2,3,0.6,4.6c0.1,0.7,0.3,1.5,0.4,2.3c0.2,0.8,0.5,1.5,0.7,2.3c0.4,1.6,1.1,3,1.7,4.4c0.3,0.7,0.7,1.4,1.1,2.1  c0.4,0.8,0.8,1.4,1.2,2.1c0.5,0.7,0.9,1.4,1.4,2s0.9,1.3,1.5,1.9c1.1,1.3,2.2,2.7,3.3,3.5l1.7,1.6c0,0,0.1,0.1,0.1,0.1c0,0,0,0,0,0  c0,0,0,0,0,0l0.1,0.1l0.1,0.1h0.2l0.5,0.4l1,0.7c0.4,0.2,0.6,0.5,1,0.7l1.1,0.6c0.8,0.4,1.4,0.9,2.1,1.2c1.4,0.7,2.9,1.5,4.4,2  c1.5,0.7,3.1,1,4.6,1.5c1.5,0.3,3.1,0.7,4.7,0.8c1.6,0.2,3.1,0.2,4.7,0.2c0.8,0,1.6-0.1,2.4-0.1l1.2-0.1l1.1-0.1  c3.1-0.4,6.1-1.3,8.9-2.4c0.8-0.3,1.4-0.6,2.1-0.9s1.3-0.7,2-1.1c1.3-0.7,2.6-1.7,3.7-2.5c0.5-0.4,1-0.9,1.6-1.3l0.8-0.6l0.2-0.2  c0,0,0.1-0.1,0.1-0.1c0.1-0.1,0,0,0,0v0.1l0.1-0.1l0.4-0.4c0.5-0.5,1-1,1.5-1.5c0.3-0.3,0.5-0.5,0.8-0.8l0.7-0.8  c0.9-1.1,1.8-2.2,2.5-3.3c0.4-0.6,0.7-1.1,1.1-1.7c0.3-0.7,0.6-1.2,0.9-1.8c2.4-4.9,3.5-9.8,3.7-14.4C87.3,49.7,86.6,45.5,85.5,42z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="nbd-popup-content-inner nohover">
                <div class="popupcontent">
                    <div class="iiner">
                        <div class="popup-title-container">
                            <h2>
                                <?php _e('How does it work?', 'transparentcard'); ?>
                            </h2>
                        </div>

                        
                        <?php nbdesigner_get_template('gallery/design_replica_popup.php', array()); ?>

                        <div class="footer d-flex gap-20 justify-content-center popup-button-container">
                            <!-- <div class="flex-1 fitem">
                                <div class="d-flex" style="align-items:center;">
                                    <div class="setisfectiontext">
                                        <?php _e('100% Satisfaction guaranteed', 'transparentcard'); ?>
                                    </div>
                                    <img style="height:70px; margin-left:-15px;"
                                        src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/img/Satisf100.webp'); ?>"
                                        alt="<?php _e('Step 4', 'transparentcard'); ?>">
                                </div>
                            </div> -->

                            <a href="<?php echo esc_url($currentUrl . '&action=request-for-design-replica'); ?>"
                                class="btn btn-success continuebtn"><?php _e('Continue', 'transparentcard'); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>







<?php
$gap = absint(get_option('nbdesigner_gallery_gutter', 8)) * 2;
?>
<style type="text/css">
    .nbd-popup-close {
        position: absolute;
        top: 20px;
        right: 20px;
        display: block;
        width: unset;
        height: unset;
        padding: 0;
        background: transparent;
    }

    .nbd-popup-close,
    .nbd-popup-close:hover {
        box-shadow: none;
    }

    .nbd-popup.step .nbd-popup-content-wrap {
        opacity: 1;
    }

    .nbd-popup .nbd-popup-content-wrap {
        border-radius: 15px;
    }

    .elementor a.continuebtn,
    .continuebtn {
        font-weight: bold;
        font-size: 20px;
        padding: 10px 35px;
        margin-top: 10px;
        color: #ECFF8C;
        text-shadow: 0 1px 0 rgba(0, 0, 0, .25);
        box-shadow: 0 3px 0 #136031;
        background-color: #004D4D;
        border-radius: 5px;
        color: white;
    }

    .setisfectiontext {
        width: 140px;
        border: 1px solid #3996d1;
        border-left: unset;
        border-right: unset;
    }

    .nbd-popup-content-inner.nohover {
        padding: 30px;
        border-radius: 15px;
        border: 2px solid #003F3F;
        background: #FEFFF9;
    }

    .nbd-popup-content-inner.nohover img:hover {
        box-shadow: unset;
        box-shadow: none;
    }

    .design-replica-popupitems {
        grid-template-columns: repeat(2, 1fr);
        width: 100%;
        overflow: hidden;
        box-sizing: border-box;
        padding: 0 20px !important;
    }

    .design-replica-popupitems .item {
        text-align: center;
    }

    .design-replica-popupitems .item .img img {
        border-radius: 8px;
        border: 1px solid #003F3F;
        height: 160px;
        object-fit: cover;
    }

    .design-replica-popupitems .item p {
        font-size: 14px;
        font-weight: 500;
        line-height: 22px;
        margin: 0;
        margin-top: 10px;
        color: #003F3F;
    }

    .design-replica-popupitems img {
        width: 100%;
    }

    .nbd-hidden-sidebar {
        width: calc(100%);
    }

    .nbd-gallery-column-3 .nbdesigner-item {
        width: calc(33.3333% -
                <?php echo $gap; ?>
                px);
    }

    .nbd-gallery-column-5 .nbdesigner-item {
        width: calc(20% -
                <?php echo $gap; ?>
                px);
    }

    .nbd-gallery-column-4 .nbdesigner-item {
        width: calc(25% -
                <?php echo $gap; ?>
                px);
    }

    .nbdesigner-item,
    .nbd-gallery-wrap .nbdesigner-item {
        margin: 0
            <?php echo $gap / 2; ?>
            px
            <?php echo $gap; ?>
            px;
    }

    .nbd-gallery-wrap.nbd-gallery-column-2 .nbdesigner-item {
        width: calc(50% -
                <?php echo $gap; ?>
                px);
    }

    .nbd-gallery-wrap.nbd-gallery-column-3 .nbdesigner-item {
        width: calc(33.3333% -
                <?php echo $gap; ?>
                px);
    }

    .nbd-gallery-wrap.nbd-gallery-column-4 .nbdesigner-item {
        width: calc(25% -
                <?php echo $gap; ?>
                px);
    }

    .popup-title-container {
        border-bottom: 1px solid #003F3F;
        margin-bottom: 20px;
        padding-bottom: 20px;
    }

    .popup-title-container h2 {
        font-size: 27px;
        font-weight: 600;
        line-height: 26px;
        letter-spacing: 0.03em;
        text-align: center;
        color: #003F3F;
        margin: 0;
    }

    .elementor a.continuebtn {
        font-size: 18px;
        font-weight: 800;
        line-height: 20px;
        text-align: center;
        color: #ECFF8C !important;
        background: #003F3F !important;
        padding: 10px 20px;
        border-radius: 5px;
        box-shadow: 2px 2px 0 #000000;
        text-shadow: 1px 1px 2px #00000091;
        margin-top: 20px;
        transition: all 0.2s ease;
    }

    @media only screen and (max-width:480px) {
        .elementor a.continuebtn{
            margin-top:0;
            margin-bottom:7px;
        }
        .footer.popup-button-container a.continuebtn {
            margin-top: 20px;
        }
    }

    .elementor a.continuebtn:hover {
        background: #ECFF8C !important;
        color: #003F3F !important;
        box-shadow: 3px 3px 0 #000000;
        text-shadow: none;
    }

    .popup-button-container {
        display: flex !important;
        align-items: center;
        padding: 0 20px;
    }

    .nbd-backdrop.nbd-popup.step.nbd-popup-request-replica {
        overflow-y: unset;
    }

    

    .nbd-popup.step:not(.nbd-popup-request-replica) .nbd-popup-content-wrap {
        min-height: 500px;
    }

    .nbd-popup.step .nbd-popup-content-wrap {
        max-width: 900px;
        width: 100%;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
    }

    @media screen and (max-width: 1270px) {
        .nbd-gallery-column-3 .nbdesigner-item {
            width: calc(50% -
                    <?php echo $gap; ?>
                    px);
        }

        .nbd-gallery-column-4 .nbdesigner-item {
            width: calc(33.3333% -
                    <?php echo $gap; ?>
                    px);
        }

        .nbd-gallery-column-5 .nbdesigner-item {
            width: calc(25% -
                    <?php echo $gap; ?>
                    px);
        }

        .nbd-gallery-wrap.nbd-gallery-column-3 .nbdesigner-item {
            width: calc(50% -
                    <?php echo $gap; ?>
                    px);
        }

        .nbd-gallery-wrap.nbd-gallery-column-4 .nbdesigner-item {
            width: calc(33.3333% -
                    <?php echo $gap; ?>
                    px);
        }
    }

    @media screen and (max-width:931px) {
        .nbd-popup.step .nbd-popup-content-wrap {
            max-width: 800px !important;
        }

        .nbd-popup-content-inner.nohover {
            padding: 20px;
        }

        .design-replica-popupitems {
            padding: 0 15px !important;
        }
    }

    @media screen and (max-width: 831px) {
        .nbd-popup.step .nbd-popup-content-wrap {
            max-width: 730px !important;
        }
    }

    @media screen and (max-width: 768px) {

        .nbd-gallery-wrap.nbd-gallery-column-3 .nbdesigner-item,
        .nbd-gallery-column-3 .nbdesigner-item {
            width: calc(100% -
                    <?php echo $gap; ?>
                    px);
        }

        .nbd-gallery-column-4 .nbdesigner-item,
        .nbd-gallery-column-5 .nbdesigner-item {
            width: calc(50% -
                    <?php echo $gap; ?>
                    px);
        }

        .nbd-gallery-wrap.nbd-gallery-column-4 .nbdesigner-item {
            width: calc(50% -
                    <?php echo $gap; ?>
                    px);
        }

        .popup-title-container h2 {
            font-size: 22px;
            line-height: 24px;
        }

        .elementor a.continuebtn {
            font-size: 16px !important;
            padding: 8px 15px !important;
        }

        .nbd-popup.step .nbd-popup-content-wrap {
            min-height: 500px;
        }
    }

    @media screen and (max-width: 761px) {
        .nbd-popup.step .nbd-popup-content-wrap {
            max-width: 700px !important;
        }

        .nbd-popup-content-inner.nohover {
            padding: 15px;
        }

        .design-replica-popupitems {
            padding: 0 10px !important;
        }

        .popup-button-container {
            padding: 0 10px;
        }

        .design-replica-popupitems .item p {
            font-size: 13px;
            line-height: 18px;
        }
    }

    @media screen and (max-width: 720px) and (min-width:601px) {
        .nbd-popup.step .nbd-popup-content-wrap {
            max-width: 600px !important;
        }
    }

    @media screen and (max-width: 600px) {
        .nbd-popup.step .nbd-popup-content-wrap {
            max-width: 92% !important;
        }
    }
    

    @media screen and (max-width: 700px) {
        .nbd-popup.step .nbd-popup-content-wrap {
            min-height: 400px;
        }
    }

    @media screen and (max-width: 631px) {
        .design-replica-popupitems {
            grid-template-columns: repeat(2, 1fr);
        }

        .nbd-backdrop.nbd-popup.step.nbd-popup-request-replica {
            overflow-y: scroll !important;
        }

        .design-replica-popupitems .item .img img {
            height: 75px;
        }
    }

    @media screen and (max-width: 600px) {

        .nbd-gallery-column-4 .nbdesigner-item,
        .nbd-gallery-column-5 .nbdesigner-item {
            width: calc(100% -
                    <?php echo $gap; ?>
                    px);
        }

        .nbd-gallery-wrap.nbd-gallery-column-4 .nbdesigner-item {
            width: calc(100% -
                    <?php echo $gap; ?>
                    px);
        }
    }
</style>
<script type="text/javascript">
    var art_id = "<?php echo $current_user_id; ?>";
    var nonce = "<?php echo wp_create_nonce('nbd_update_favourite_template') ?>";
    var nbd_page = {
        url: "<?php echo $url; ?>",
        current_page: parseInt(<?php echo isset($page) ? $page : 1; ?>),
        row: parseInt(<?php echo $row; ?>),
        per_row: parseInt(<?php echo $per_row; ?>),
        total: parseInt(<?php echo $total; ?>),
        limit: parseInt(<?php echo $limit; ?>),
        last_page: parseInt(<?php echo ceil($total / $limit); ?>)
    };
    var updateFavouriteTemplate = function (e, type, template_id) {
        var self = jQuery(e),
            parent = self.parent('.nbd-like-icons'),
            tempaltes = localStorage.getItem("nbd_favourite_templates");
        if (tempaltes.indexOf(template_id) > -1 && type == 'like') {
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
        jQuery.post(woocommerce_params.ajax_url, _data, function (data) {
            localStorage.setItem("nbd_favourite_templates", JSON.stringify(data.templates));
            parent.find('.nbd-like-icon.loading').removeClass('active');
            parent.find('.nbd-like-icon.' + type).addClass('active');
            if (type == 'like') {
                updateWishlistSidebar(self, template_id);
            } else {
                jQuery.each(jQuery('.wishlist-tem-wrap'), function () {
                    if (jQuery(this).attr('data-id') == template_id) {
                        jQuery(this).addClass('unwish');
                    }
                });
            }
        });
    };
    var updateWishlistSidebar = function (e, temp_id) {
        var parent = e.parents('.nbdesigner-item');
        var exist = false;
        jQuery.each(jQuery('.wishlist-tem-wrap'), function () {
            if (jQuery(this).attr('data-id') == temp_id) {
                jQuery(this).removeClass('unwish');
                exist = true;
            }
        });
        if (!exist) {
            var wish_html = '<div class="wishlist-tem-wrap" data-id="' + parent.attr('data-id') + '">';
            wish_html += '<div class="left" onclick="previewTempalte(event, ' + parent.attr('data-id') + ')">';
            wish_html += '<img src="' + parent.attr('data-img') + '" class="nbdesigner-img"/>';
            wish_html += '</div>';
            wish_html += '<div class="right">';
            wish_html += '<div>Template for</div>';
            wish_html += '<div>' + parent.attr('data-title') + '</div>';
            wish_html += '</div>';
            wish_html += '</div>';
            jQuery('.nbd-sidebar-con-inner.wishlist').prepend(wish_html);
        }
    };
    var nbd_preview_html = [];
    var previewTempalte = function (e, tid) {
        e.preventDefault();
        NBDPopup.initPopup();
        if (nbd_preview_html[tid] != undefined) {
            jQuery(document.body).find('.nbd-popup.nbd-popup-request-replica').find('.nbd-popup-content-inner').html(nbd_preview_html[tid]);
        } else {
            jQuery('#nbd-popup-loading').removeClass('hide');
            jQuery(document.body).find('.nbd-popup.nbd-popup-request-replica').find('.nbd-popup-content-inner').addClass('hide');
            jQuery.ajax({
                url: nbds_frontend.url,
                method: "POST",
                data: 'action=nbd_get_template_preview&template_id=' + tid + '&nonce=' + nonce
            }).done(function (data) {
                if (data.flag == 1) {
                    jQuery(document.body).find('.nbd-popup.nbd-popup-request-replica').find('.nbd-popup-content-inner').html(data.html);
                    nbd_preview_html[tid] = data.html;
                }
                jQuery('#nbd-popup-loading').addClass('hide');
               
                jQuery(document.body).find('.nbd-popup.nbd-popup-request-replica').find('.nbd-popup-content').show();
                
                jQuery('.nbd-popup-content-inner').removeClass('hide');
            });
        }
    };
    var nbd_list_product_html = '';
    var showPopupCreateTemplate = function () {
        NBDPopup.initPopup();
        if (nbd_list_product_html != '') {
            jQuery('.nbd-popup-content-inner').html(nbd_list_product_html);
        } else {
            jQuery('#nbd-popup-loading').removeClass('hide');
            jQuery('.nbd-popup-content-inner').addClass('hide');
            jQuery.ajax({
                url: nbds_frontend.url,
                method: "POST",
                data: 'action=nbd_get_list_product_ready_to_create_template' + '&nonce=' + nonce
            }).done(function (data) {
                if (data.flag == 1) {
                    jQuery('.nbd-popup-content-inner').html(data.html);
                    nbd_list_product_html = data.html;
                }
                jQuery('#nbd-popup-loading').addClass('hide');
                jQuery('.nbd-popup-content-inner').removeClass('hide');
            });
        }
    };
    var nbd_preview_product_html = [];
    var previewNBDProduct = function (pid) {
        if (nbd_preview_product_html[pid] != undefined) {
            jQuery('.nbd-popup-content-inner').html(nbd_preview_product_html[pid]);
        } else {
            jQuery('#nbd-popup-loading').removeClass('hide');
            jQuery('.nbd-popup-content-inner').addClass('hide');
            jQuery.ajax({
                url: nbds_frontend.url,
                method: "POST",
                data: 'action=nbd_get_preview_product_before_create_template&product_id=' + pid + '&nonce=' + nonce + '&art_id=' + art_id
            }).done(function (data) {
                if (data.flag == 1) {
                    jQuery('.nbd-popup-content-inner').html(data.html);
                    nbd_preview_product_html[pid] = data.html;
                }
                jQuery('#nbd-popup-loading').addClass('hide');
                jQuery('.nbd-popup-content-inner').removeClass('hide');
            });
        }
    };
    var changePreviewImage = function (e) {
        var src = jQuery(e).attr('src');
        jQuery('.nbd-popup-list-preview img').removeClass('active');
        jQuery(e).addClass('active');
        jQuery('#nbd-popup-large-preview').attr('src', src);
    };
    var switchNBDProductVariation = function (e) {
        var vid = jQuery(e).val(),
            btn = jQuery('#nbd-popup-link-create-template'),
            origin_fref = btn.data('href'),
            new_href = origin_fref + '&variation_id=' + vid;
        btn.attr('href', new_href);
    }
    jQuery(document).ready(function () {
        var templates = '<?php echo json_encode($favourite_templates); ?>';
        localStorage.setItem("nbd_favourite_templates", templates);
        renderNBDGallery(true);

        NBDPopup.calcWidth();
    });
    jQuery("body").click(function (e) {
        if (e.target.id == 'nbd-popup') {
            NBDPopup.hidePopup();
        }
    });
    jQuery(document).bind('keydown', function (e) {
        if (e.which == 27) {
            NBDPopup.hidePopup();
        }
    });
    jQuery(window).on('resize', function () {
        NBDPopup.calcWidth();
    });
    var isNBDLoading = true;
    jQuery(window).on('scroll', function () {
        !isNBDLoading && (nbd_page.current_page < nbd_page.last_page) && isScrolledIntoView('#nbd-pagination') && loadMoreGallery(nbd_page);
    });
    var renderNBDGallery = function (init, callback) {

        imagesLoaded(jQuery('#nbdesigner-gallery'), function () {
            if (!init) jQuery('#nbdesigner-gallery').masonry('reloadItems');
            jQuery('#nbdesigner-gallery').masonry({
                itemSelector: '.nbdesigner-item',
                transitionDuration: 0
            });
            jQuery.each(jQuery('#nbdesigner-gallery .nbdesigner-item'), function (e) {
                jQuery(this).addClass("in-view");
            });
            if (typeof callback == 'function') {
                callback();
            }
        });
    };
    var loadMoreGallery = function (nbd_page) {
        console.log('load more gallary')
        jQuery('#nbd-load-more').show();
        isNBDLoading = true;
        nbd_page.current_page++;
        jQuery('#nbd-pagination').addClass('nbdesigner-disable');
        var data = {
            action: 'nbd_get_next_gallery_page',
            url: nbd_page.url,
            page: nbd_page.current_page,
            row: nbd_page.row,
            per_row: nbd_page.per_row,
            total: nbd_page.total,
            limit: nbd_page.limit,
            nonce: nonce
        };

        jQuery.ajax({
            url: nbds_frontend.url,
            method: "POST",
            data: data
        }).done(function (data) {
            jQuery('#nbd-pagination').removeClass('nbdesigner-disable');
            var new_url = addParameter(nbd_page.url, 'paged', nbd_page.current_page, false);
            history.pushState(null, null, new_url);
            isNBDLoading = false;
            if (data.flag) {
                jQuery('#nbdesigner-gallery').append(data.items);
                jQuery('#nbd-pagination-wrap').html('').html(data.pagination);
                renderNBDGallery(false, function () {
                    jQuery('#nbd-load-more').hide();
                });
            } else {
                jQuery('#nbd-load-more').hide();
            }
        });
    };
    var NBDPopup = {
        initPopup: function () {
            jQuery('.nbd-popup.nbd-popup-request-replica').addClass('active');
            jQuery('.nbd-popup.nbd-popup-request-replica').removeClass('hide');
            jQuery('body').addClass('open-nbd-popup');
        },
        calcWidth: function () {
            var width = jQuery(window).width(),
                height = jQuery(window).height(),
                popupWidth = 1000,
                minHeight = 460,
                popupTop = 100;
            if (width < 600) {
                popupWidth = width - 30;
            }
            if (height < 700) {
                minHeight = height - 200;
            }
            jQuery('.nbd-popup-content-wrap').css({
                //'width': popupWidth + 'px',
                //'margin': popupTop + 'px auto',
                //'min-height': minHeight + 'px'
            });
            jQuery('.nbd-popup-content').css({
                //  'min-height': minHeight + 'px'
            });
        },
        hidePopup: function () {
            jQuery('.nbd-popup').removeClass('active');
            jQuery('body').removeClass('open-nbd-popup');
            setTimeout(function () {
                jQuery('.nbd-popup').addClass('hide');
            }, 500);
        }
    };
    var isScrolledIntoView = function (elem) {
        var docViewTop = jQuery(window).scrollTop();
        var docViewBottom = docViewTop + jQuery(window).height();
        var elemTop = jQuery(elem).offset().top;
        var elemBottom = elemTop + jQuery(elem).height();
        return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
    };
</script>