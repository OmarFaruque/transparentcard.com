<?php
class COOL_Backend extends COOL_Inods{
    public function __construct(){

        parent::__construct();
        // Additional tab for single print page 
        add_action( 'nbo_options_meta_box_tabs', array($this, 'add_adiional_product_tab') );
        add_action( 'nbo_options_meta_box_panels', array($this, 'cool_additional_product_tabs'), 15, 1 );
        add_action('nbo_save_options', array($this, 'save_product_option'));

        // Create nbdesigner table aditional column if not exists 
        add_action('nbd_create_tables', array($this, 'create_additional_column_to_nb_designer'));
        // add_action('admin_init', array($this, 'create_additional_column_to_nb_designer'));

        add_action( 'admin_enqueue_scripts', array(__CLASS__, 'enqueue_coolcard_assets'), 10, 1 );

        add_action( 'customize_register' , array(__CLASS__, 'transparentcard_register_additional_options') );

        
    }

    


    /**
     * Remove Inodes while remove order from backend
     * 
     * @param string $order_id
     * 
     * @return remove related inodes
     */
    public static function transparentcard_delete_order_related_files($order_id){
        
        if ( get_post_type( $order_id ) === 'shop_order' ) {
            $order = wc_get_order( $order_id );

            // Get all order items
            $items = $order->get_items();

            foreach ( $items as $item_id => $item ) {
                // For NBD Design 
                $meta_data = $item->get_meta('_nbd', true);
                if($meta_data){
                    $dir = NBDESIGNER_CUSTOMER_DIR . '/' . $meta_data;
                    $order_dir = NBDESIGNER_CUSTOMER_DIR . '/' . $order_id . '_' . $meta_data;
                    $old_dir = NBDESIGNER_CUSTOMER_DIR . '/' . $meta_data . '_old';

                    if(is_dir($dir)) rrmdir($dir);
                    if(is_dir($order_dir)) rrmdir($order_dir);
                    if(is_dir($old_dir)) rrmdir($old_dir);
                }

                // Remove order related upload directory
                $nbu_meta_data = $item->get_meta('_nbu', true);
                if($nbu_meta_data){
                    $dir = NBDESIGNER_UPLOAD_DIR . '/' . $nbu_meta_data;
                    $prev_dir = NBDESIGNER_UPLOAD_DIR . '/' . $nbu_meta_data . '_preview';
                    if(is_dir($dir)) rrmdir($dir);
                    if(is_dir($prev_dir)) rrmdir($prev_dir);
                }

                // For Other Images
                $cus_meta_data = '';
                if($item->get_meta('Other images in your design', true))
                    $cus_meta_data .= $item->get_meta('Other images in your design', true);

                if($item->get_meta('Uploaded Files', true))
                    $cus_meta_data .= $item->get_meta('Uploaded Files', true);

                if($item->get_meta('Images for use in Design', true))
                    $cus_meta_data .= $item->get_meta('Images for use in Design', true);

                if($item->get_meta('Uploaded Logo', true))
                    $cus_meta_data .= $item->get_meta('Uploaded Logo', true);

                if(!empty($cus_meta_data)){
                    if ($cus_meta_data !== strip_tags($cus_meta_data)) {
                        preg_match_all('/<a\s+[^>]*href=["\']([^"\']+)["\'][^>]*>/i', $cus_meta_data, $matches);
                        $hrefs = $matches[1];

                        foreach ($hrefs as $href) {
                            $getDir = explode('/', $href);
                            $dirName = $getDir[count($getDir) - 2];
                            $dir = NBDESIGNER_UPLOAD_DIR . '/' . $dirName;
                            if(is_dir($dir))
                                rrmdir($dir);
                        }
                    }
                }
            }
        }
    }



    /**
     * Add some additional option in theme customize section 
     * for some additional service for transparentcard 
     * 
     * @param array
     */
    public static function transparentcard_register_additional_options($wp_customizer){
        $wp_customizer->add_section( 
            'transparent_card_controller', 
            array(
                'title'       => __( 'Transparent Controller', 'mytheme' ),
                'priority'    => 200,
                'capability'  => 'edit_theme_options',
                'description' => __('Change additional options here.', 'mytheme'), 
            ) 
        );

        $wp_customizer->add_setting( 'cart_qty_selection_style',
            array(
                'default' => 'default'
            )
        );  
        
        $wp_customizer->add_control( 'cart_qty_selection_style', array(
            'type' => 'select',
            'section' => 'transparent_card_controller', 
            'label' => __( 'Select Qty Input Style', 'transparentcard' ), 
            'description' => __( 'Custom header layout', 'transparentcard' ), 
            'choices' => array(  
                 'default' => __( 'Default', 'transparentcard' ),
                 'dropdown' => __( 'Dropdown', 'transparentcard' )
                )
              ) 
            );
    }


    /**
     * Enqueue Scripts for nbd optioins pages 
     * 
     * @param string $hook
     * 
     */
    public static function enqueue_coolcard_assets($hook){

        if(in_array($hook, array('post.php'))){
            wp_register_style('printcart_admin_child_css', get_stylesheet_directory_uri(  ) . '/assets/css/printcart-admin-css.css', array(), time(), 'all' );
            wp_enqueue_style( 'printcart_admin_child_css' );
        }

        if(in_array($hook, array('nbdesigner_page_nbd_printing_options'))){
            wp_register_script( 'nbd_customScripts', get_stylesheet_directory_uri(  ) . '/assets/js/printcart-child-admin.js', array('nbd_options'), NBDESIGNER_VERSION);
            wp_enqueue_script( 'nbd_customScripts' );
        }

    }

    /**
     * Create additional column to database 
     * 
     */
    public function create_additional_column_to_nb_designer(){
        global $wpdb;
        $collate = '';
        if ( $wpdb->has_cap( 'collation' ) ) {
            $collate = $wpdb->get_charset_collate();
        } 
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        $tableName = $wpdb->prefix . 'nbdesigner_templates';

        $column_exists = $wpdb->get_var("SHOW COLUMNS FROM $tableName LIKE 'paper_sizes'");
        if(!$column_exists)
            $wpdb->query("ALTER TABLE $tableName ADD COLUMN paper_sizes VARCHAR(255) NOT NULL DEFAULT ''");

        $column_exists = $wpdb->get_var("SHOW COLUMNS FROM $tableName LIKE 'corner'");
        if(!$column_exists)
            $wpdb->query("ALTER TABLE $tableName ADD COLUMN corner VARCHAR(255) NOT NULL DEFAULT '', ADD COLUMN orientation VARCHAR(255) NOT NULL DEFAULT ''");
    }



    public function save_product_option($post_id){
        $nbpt_title2        = $_POST['_nbpt_title2'];
        $nbpt_content2      = $_POST['_nbpt_content2'];

        $nbpt_title3        = $_POST['_nbpt_title3'];
        $nbpt_content3      = $_POST['_nbpt_content3'];
        
        
        update_post_meta($post_id, '_nbpt_title2', $nbpt_title2);
        update_post_meta($post_id, '_nbpt_title3', $nbpt_title3);
        update_post_meta($post_id, '_nbpt_content2', htmlspecialchars( $nbpt_content2 ) );
        update_post_meta($post_id, '_nbpt_content3', htmlspecialchars( $nbpt_content3 ) );

    }

    /**
     * Add additional tabs content for printing options
     */
    public function cool_additional_product_tabs($post_id){
        $nbpt_title2     = get_post_meta($post_id, '_nbpt_title2', true);
        $nbpt_content2   = get_post_meta($post_id, '_nbpt_content2', true);
        $nbpt_title3     = get_post_meta($post_id, '_nbpt_title3', true);
        $nbpt_content3   = get_post_meta($post_id, '_nbpt_content3', true);
        ob_start();
        ?>
        <div class="nbo_options_panel" id="nbpt-options2" style="display: none;">
            <p class="nbo-form-field">
                <label for="_nbpt_title"><?php _e('Title', 'web-to-print-online-designer'); ?></label>
                <span class="nbo-option-val">
                    <input style="width: 100%;" type="text" value="<?php echo $nbpt_title2; ?>" name="_nbpt_title2" id="_nbpt_title2" />
                </span>
            </p>
            <div style="padding: 10px;">
                <p><?php _e('Content', 'web-to-print-online-designer'); ?></p>
            <?php
                $settings2 = array(
                    'textarea_name' => '_nbpt_content2',
                    'tinymce'       => array(
                        'theme_advanced_buttons1' => 'bold,italic,strikethrough,separator,bullist,numlist,separator,blockquote,separator,justifyleft,justifycenter,justifyright,separator,link,unlink,separator,undo,redo,separator',
                        'theme_advanced_buttons2' => '',
                    ),
                    'editor_height' => 175
                );
                wp_editor( htmlspecialchars_decode( $nbpt_content2 ), 'nbo_print_info_tab_editor2', apply_filters( 'woocommerce_product_short_description_editor_settings', $settings2 ) );
            ?>
            </div>
        </div>
        <!-- <div class="clear"></div> -->



        <div class="nbo_options_panel" id="nbpt-options3" style="display: none;">
            <p class="nbo-form-field">
                <label for="_nbpt_title3"><?php _e('Title', 'web-to-print-online-designer'); ?></label>
                <span class="nbo-option-val">
                    <input style="width: 100%;" type="text" value="<?php echo $nbpt_title3; ?>" name="_nbpt_title3" id="_nbpt_title3" />
                </span>
            </p>
            <div style="padding: 10px;">
                <p><?php _e('Content', 'web-to-print-online-designer'); ?></p>
            <?php
                $settings3 = array(
                    'textarea_name' => '_nbpt_content3',
                    'tinymce'       => array(
                        'theme_advanced_buttons1' => 'bold,italic,strikethrough,separator,bullist,numlist,separator,blockquote,separator,justifyleft,justifycenter,justifyright,separator,link,unlink,separator,undo,redo,separator',
                        'theme_advanced_buttons2' => '',
                    ),
                    'editor_height' => 175
                );
                wp_editor( htmlspecialchars_decode( $nbpt_content3 ), 'nbo_print_info_tab_editor3', apply_filters( 'woocommerce_product_short_description_editor_settings', $settings3 ) );
            ?>
            </div>
        </div>
        <!-- <div class="clear"></div> -->

        <?php
        echo ob_get_clean();
    }


    /**
     * Add additional printing tab in backend for the surve purpose to addd additional tab in single product page 
     * 
     * @return html
     */
    public function add_adiional_product_tab(){
        ob_start(); ?>
        <li><a href="#nbpt-options3"><span class="dashicons dashicons-feedback"></span> <?php _e('Standard Size', 'web-to-print-online-designer'); ?></a></li>
        <li><a href="#nbpt-options2"><span class="dashicons dashicons-feedback"></span> <?php _e('Coolcard Size', 'web-to-print-online-designer'); ?></a></li>
        <?php echo ob_get_clean();
    }


}