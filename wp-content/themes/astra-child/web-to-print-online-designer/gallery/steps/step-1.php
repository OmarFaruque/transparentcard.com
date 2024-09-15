<?php
/**
 * Step 1
 */
?>

<?php extract($args); ?>


<?php



$additionalMetas = $cart['nbo_additional_meta'] ?? array();
if (isset($_POST['custom_upload_nonce']) && wp_verify_nonce($_POST['custom_upload_nonce'], 'custom_upload_action')) {
    $additionalMetas = $_POST;
}


?>

<div class="wrapperstepform">
    <div class="innerwrapper mt-20 border-rounded">
        <!-- Product configuration -->
        <div class="d-flex gap-20 single">
            <div class="flex-1">
                <div
                    class="sectiontitle position-relative d-flex align-item-center gap-10 d-flex align-item-center gap-10">
                    <span class="count">1</span>
                    <h5><?php _e('Product configuration', 'transparentcard'); ?></h5>
                </div>
            </div>
            <div class="flex-2">
                <h6 class="m-0"><?php _e('Product', 'transparentcard'); ?></h6>
                <p><?php echo esc_attr(isset($_GET['pid']) ? get_the_title($_GET['pid']) : ''); ?></p>
                <?php
                foreach ($selectedOptions as $so):
                    $_so = explode('-', $so);
                    $_key = array_search($_so[0], array_column($options['fields'], 'id'));
                    if ($options['fields'][$_key]['general']['published'] == 'n')
                        continue;
                    if (empty($options['fields'][$_key]['general']['attributes']['options'][$_so[1]]['name']))
                        continue;

                    echo sprintf('<h6 class="m-0">%s</h6>', $options['fields'][$_key]['general']['title']);
                    echo sprintf('<p>%s</p>', $options['fields'][$_key]['general']['attributes']['options'][$_so[1]]['name']);

                endforeach;
                ?>
            </div>
            <div class="flex-1"></div>
        </div>
        <!-- Info to be included in your design -->
        <div class="d-flex gap-20 single">
            <div class="flex-1">
                <div class="sectiontitle position-relative d-flex align-item-center gap-10">
                    <span class="count">2</span>
                    <h5><?php _e('Provide us all info on your business card', 'transparentcard'); ?></h5>
                </div>
            </div>
            <div class="flex-2">
                <div class="form-group">
                    <label
                        for="company_name"><?php _e('Company or Individual Name', 'transparentcard'); ?></label>
                    <input type="text" name="company_name" id="company_name" class="form-control"
                        value="<?php echo $additionalMetas['company_name'] ?? ''; ?>">
                </div>
                <div class="form-group">
                    <label for="email"><?php _e('Email', 'transparentcard'); ?></label>
                    <input type="email" name="email" id="email" class="form-control"
                        value="<?php echo esc_attr($additionalMetas['email'] ?? ''); ?>">
                </div>
                <div class="form-group">
                    <label for="website"><?php _e('Website', 'transparentcard'); ?></label>
                    <input type="text" name="website" id="website" class="form-control"
                        value="<?php echo esc_attr($additionalMetas['website'] ?? ''); ?>">
                </div>
                <div class="form-group">
                    <label for="phone"><?php _e('Phone', 'transparentcard'); ?></label>
                    <input type="tel" name="phone" id="phone" class="form-control"
                        value="<?php echo esc_attr($additionalMetas['phone'] ?? ''); ?>">
                </div>
                <div class="form-group">
                    <label for="address"><?php _e('Address', 'transparentcard'); ?></label>
                    <input type="text" name="address" id="address" class="form-control"
                        value="<?php echo esc_attr($additionalMetas['address'] ?? ''); ?>">
                </div>
                <div class="form-group">
                    <label
                        for="other_information_to_include"><?php _e('Additional details you\'d like to include', 'transparentcard'); ?></label>
                    <textarea name="other_information_to_include" id="other_information_to_include" class="form-control"
                        row="5"><?php echo esc_attr($additionalMetas['other_information_to_include'] ?? ''); ?></textarea>
                </div>
            </div>
            <div class="flex-1 d-flex">
                <div class="example" style="margin-top:auto;">
                    <div class="card info">
                        <div class="header"><?php _e('Example', 'transparentcard'); ?>:</div>
                        <div class="body p-5">
                            <p class="mb-0">
                                "<?php _e('Please add a QR code for www.example.com and include a Facebook icon.', 'transparentcard'); ?>"
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="about-the-business d-flex gap-20 single">
            <div class="flex-1">
                <div class="sectiontitle position-relative d-flex align-item-center gap-10">
                    <span class="count">3</span>
                    <h5><?php _e('About the business', 'transparentcard'); ?></h5>
                </div>
            </div>
            <div class="flex-2">
                <div class="form-group">
                    <label
                        for="business_category"><?php _e('Select your business category', 'transparentcard'); ?></label>
                    <select style="padding:3px 15px;" name="business_category" id="business_category" 
                        class="form-control">
                        <option value=""><?php _e('Select a business category...', 'transparentcard'); ?></option>
                        <?php foreach ($business_categorys as $k => $cat): ?>
                            <option <?php selected($additionalMetas['business_category'] ?? '', $k); ?>
                                value="<?php echo intval($k); ?>"><?php echo esc_attr($cat); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label
                        for="business_desc"><?php _e('Describe your business or design details', 'transparentcard'); ?><span>*</span></label>
                    <textarea name="business_description" id="business_desc" required class="form-control"
                        row="5"><?php echo $additionalMetas['business_description'] ?? ''; ?></textarea>
                </div>
            </div>
            <div class="flex-1 d-flex">
                <div class="example" style="margin-top:auto;">
                    <div class="card info">
                        <div class="header"><?php _e('Example', 'transparentcard'); ?>:</div>
                        <div class="body p-5">
                            <p class="mb-0">
                                "<?php _e('We are a company that delivers sweets in X. Our target audience are young people who like sweets.', 'transparentcard'); ?>"
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="step-continue-btn-wrapper">
            <button class="btn btn-continue px-5 py-10 border-rounded" onclick="next_step(1)" type="button">
                <?php _e('Continue', 'transparentcard'); ?>
            </button>
        </div>
    </div>
</div>