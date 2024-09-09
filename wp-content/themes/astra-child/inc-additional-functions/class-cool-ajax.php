<?php
// use NBD_Template_Tag;
class COOL_Ajax{
    public $wpdb;
    public function __construct(){
        global $wpdb;
        $this->wpdb = $wpdb;

        // register the ajax action for authenticated users
        add_action('wp_ajax_nb_design_template_sub_tags', array($this, 'nb_design_template_sub_tags_callback'));

        // register the ajax action for unauthenticated users
        add_action('wp_ajax_nopriv_nb_design_template_sub_tags', array($this, 'nb_design_template_sub_tags_callback'));

        // Save template size tag
        add_action( 'wp_ajax_coolcardStoreTaxonomys', array($this, 'coolcard_store_taxonomys_callback') );


        // Get nodes
        add_action( 'wp_ajax_nopriv_nodes_json_data', array($this, 'nodes_json_data') );
        add_action( 'wp_ajax_nodes_json_data', array($this, 'nodes_json_data') );

        add_action( 'wp_ajax_nopriv_nodes_remove_data', array($this, 'nodes_remove_data') );
        add_action( 'wp_ajax_nodes_remove_data', array($this, 'nodes_remove_data') );

        

        
        
        $ajax_events = array(
            'transparentcart_copy_item' => true, 
            'transparentde_woocommerce_get_states' => true, 
            'transparentcard_hire_a_designer_add_to_cart' => true
        );

        foreach( $ajax_events as $ajax_event => $nopriv ) {
            add_action( 'wp_ajax_' . $ajax_event, array( $this, $ajax_event ) );
            if ( $nopriv ) {
                add_action( 'wp_ajax_nopriv_' . $ajax_event, array( $this, $ajax_event ) );
            }
        }



        add_action( 'wp_head', function(){
            
            if(is_cart()){
                // $cart = WC()->cart->get_cart();
                // $options = get_option( 'ajax_test', array() );
                // echo 'ajax test options <br/><pre>';
                // print_r($options);
                // echo '</pre>';
            }
        });
    }



    /**
     * Hire a designer form submit via ajax and add to cart
     */
    public function transparentcard_hire_a_designer_add_to_cart(){

        if (!isset($_POST['hire_a_designer_nonce']) || !wp_verify_nonce($_POST['hire_a_designer_nonce'], 'hire_a_designer_action')) {
            wp_die('Nonce verification failed');
        }

        
            
        
        if (!WC()->cart) {
            WC()->cart = new WC_Cart();
        }
                 
        // Nonce is valid, process form data
        $product_id = intval($_POST['pid']);
        $quantity = intval($_POST['quantity']);
    
        if(isset($_POST['update_request'])){
            $cart = WC()->cart;
            // Get the cart item
            $cart_item = $cart->get_cart_item($_POST['update_request']);

            $newcartitem = COOL_Frontend::updatecart_item_data($_POST['update_request'], $product_id, $quantity, 0, array(), $cart_item);

            $cart->cart_contents[$_POST['update_request']] = $newcartitem;

            WC()->session->set('cart', $cart->cart_contents);
            
        }

        if(!isset($_POST['update_request'])){
        // Add product to cart
            $cart_item_key = WC()->cart->add_to_cart($product_id, $quantity);
        
            if ($cart_item_key) {
                
                $cart = WC()->cart;
                // Get the cart item
                $cart_item = $cart->get_cart_item($cart_item_key);

                $unique_cart_item_key           = md5( microtime() . rand() );
                $cart_item['unique_key']   = $unique_cart_item_key;

                // Update the cart item
                $cart->cart_contents[$cart_item_key] = $cart_item;
                    
                $nbu_item_key = substr( md5( uniqid() ), 0, 5 ) . rand( 1, 100 ) . time();
            
                WC()->session->set( $cart_item_key. '_nbu_hire', $nbu_item_key );

                // Save the cart
                WC()->session->set('cart', $cart->cart_contents);
            }
        }

        wp_send_json_success();
        
        wp_die();   
    }



    /**
     * Get province baseed on selected country
     * 
     * @access public 
     * @param null
     */
    public function transparentde_woocommerce_get_states() {
        $country = sanitize_text_field( $_GET['country'] );
    
        if ( ! empty( $country ) ) {
            $states = WC()->countries->get_states( $country );
    
            if ( ! empty( $states ) ) {
                wp_send_json_success( array( 'states' => $states ) );
            } else {
                wp_send_json_success( array( 'states' => array() ) );
            }
        }
    
        wp_send_json_error();
    }


    /**
     * Remove Inodes
     */
    public function nodes_remove_data(){
        $removal_items = $_POST['removal_items'];
        $nonce = $_POST['nonce'];
        if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) ) {
            wp_send_json_success(['message' => 'error', 'printable_msg' => __('Something wrong, nonce is missing.')]);
            wp_die();
        }
        
        $removeFileLists = array();
        foreach($removal_items as $singleItem){
            if(empty($singleItem['directory'])) continue;
            if(empty($singleItem['folder'])) continue;

            $dir = $singleItem['directory'] . '/' . $singleItem['folder'];
            rrmdir($dir);
        }
        wp_send_json_success(['message' => 'success', 'printable_msg' => __('Remove successfully.')]);
        wp_die();

    }



    /**
     * Reteun all of nodes to wp backend 
     * 
     * @return json 
     */
    public function nodes_json_data(){
        $nonce = $_POST['nonce'];
        $tab = $_POST['tab'];

        if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) ) {
            wp_send_json_success(['message' => 'error', 'printable_msg' => __('Something wrong, nonce is missing.')]);
            wp_die();
        }

        $directoryArray = array(NBDESIGNER_CUSTOMER_DIR, NBDESIGNER_UPLOAD_DIR);


        
        $query = $this->wpdb->get_results($this->wpdb->prepare("SELECT * FROM {$this->wpdb->prefix}nbdesigner_templates"), OBJECT);
        $templates = array_map(function($v){
            return $v->folder;
        }, $query);


        $file_infos = array();


        foreach($directoryArray as $singleDiectory):
        $dir = new DirectoryIterator($singleDiectory);


      


        foreach ($dir as $fileinfo) {
            if (!$fileinfo->isDot()) {

                $fileUrl = NBDESIGNER_CUSTOMER_URL .'/'.$fileinfo->getFilename() . '/preview/frame_0.png';
                if($singleDiectory == NBDESIGNER_UPLOAD_DIR){
                    $files = scandir(NBDESIGNER_UPLOAD_DIR .'/'.$fileinfo->getFilename());

                    // Filter out . and .. (current and parent directory)
                    $files = array_diff($files, array('.', '..'));

                    // Get the first file
                    $firstFile = reset($files);
                    $fileUrl = NBDESIGNER_UPLOAD_URL . '/' . $fileinfo->getFilename(). '/' . $firstFile;
                    
                }



                $order_status = transparent_get_order_status($fileinfo->getFilename());

                if($tab == 'templates' && in_array($fileinfo->getFilename(), $templates)):
                    $itemArray = array(
                        'folder_name' => $fileinfo->getFilename(), 
                        'template' => in_array($fileinfo->getFilename(), $templates), 
                        'preview_img' => $fileUrl,
                        'order_status' => $order_status, 
                        'directory' => $singleDiectory
                    );
                    array_push($file_infos, $itemArray);
                
                endif;

                if($tab == 'userdesign' && !in_array($fileinfo->getFilename(), $templates)):
                    $itemArray = array(
                        'folder_name' => $fileinfo->getFilename(), 
                        'template' => in_array($fileinfo->getFilename(), $templates), 
                        'preview_img' => $fileUrl,
                        'order_status' => $order_status, 
                        'directory' => $singleDiectory
                    );
                    array_push($file_infos, $itemArray);
                
                endif;

                if(!$tab):
                    $itemArray = array(
                        'folder_name' => $fileinfo->getFilename(), 
                        'template' => in_array($fileinfo->getFilename(), $templates), 
                        'preview_img' => $fileUrl,
                        'order_status' => $order_status, 
                        'directory' => $singleDiectory
                    );
                    array_push($file_infos, $itemArray);
                
                endif;
                
            }
        }
        endforeach;



        wp_send_json_success(['message' => 'success', 'nbd_items' => $file_infos, 'tab'=> $_POST['tab']]);
        wp_die();


    }
    /**
     * Copy item in cart page
     * 
     */
    public function transparentcart_copy_item(){

        $cart_item_key = sanitize_text_field($_POST['item_key']);
        $source_folder = sanitize_text_field( $_POST['item_source_folder']);
        $orientation = sanitize_text_field( $_POST['orientation']);


        $cart = WC()->cart->get_cart();

        $variation_id = 0;
        $layout = 'm';
        $redirect = 'cart';

        if (isset($cart[$cart_item_key])) {
            $item = $cart[$cart_item_key];

            $unique_cart_item_key           = md5( microtime() . rand() );

            $new_cart_item_key = WC()->cart->add_to_cart($item['product_id'], $item['quantity'], $item['variation_id'], $item['variation'], array( 'unique_key' => $unique_cart_item_key ));


            // New Item session key
            $nbd_item_key = substr( md5( uniqid() ), 0, 5 ) . rand( 1, 100 ) . time();
            WC()->session->set($new_cart_item_key. '_nbd', $nbd_item_key);
            
            WC()->cart->cart_contents[ $new_cart_item_key ]['nbo_meta'] = $cart[$cart_item_key]['nbo_meta'];
            WC()->cart->cart_contents[$cart_item_key]['nbo_cart_item_key'] = $new_cart_item_key;

            WC()->cart->set_session();



            // Old item key
            $nbd_item_session   = WC()->session->get( 'nbd_item_key_' . $cart_item_key );
            if(!$nbd_item_session)
                    $nbd_item_session = $source_folder;
            
            
            $existing_design_path = NBDESIGNER_CUSTOMER_DIR . '/' . $nbd_item_session; 
            $newfile = NBDESIGNER_CUSTOMER_DIR . '/' . $nbd_item_key;

            $copy = false;
            if (copyDirectory($existing_design_path, $newfile)) {
                $copy = array(
                    'new_cart_item_key' => $new_cart_item_key, 
                    'folder_key' => $nbd_item_key
                );
            }

            $link_edit_design = add_query_arg(
                array(
                    'task'          => 'edit',
                    'product_id'    => $item['product_id'],
                    'nbd_item_key'  => $nbd_item_key,
                    'cik'           => $new_cart_item_key,
                    'view'          => $layout,
                    'rd'            => $redirect,
                    'source'        => $redirect,
                    'trns_nbd_design_id' => $source_folder, 
                    'orientation' => $orientation
                ),
                getUrlPageNBD('create'));

                // $link_edit_design .= '&source=cart&orientation=' . $orientation . '&trns_nbd_design_id=' . $cart_item['nbd_design_id'];
    
            wp_send_json_success(['message' => 'item-duplicated', 'redirect_url' => $link_edit_design, 'copy' => $copy, 'newkey' => $new_cart_item_key]);
        } else {
            wp_send_json_error(['message' => 'Item not found']);
        }
        wp_die();
    }

    /**
     * Save template size 
     * Ajax funciton
     */
    public function coolcard_store_taxonomys_callback(){
        global $wpdb;
        $columnValue = isset($_POST['paper_size']) ? $_POST['paper_size'] : '';
        $folder_id = (string)$_POST['nbd_item_key'];
        $nonce = $_POST['nonce'];
        $product_id = $_POST['product_id'];
        $nonce_success = 'false';
        if (!wp_verify_nonce($nonce, 'save-design') && NBDESIGNER_ENABLE_NONCE) {
            wp_send_json(array('error' => 'error'));
            wp_die();
        }

        $column = 'paper_sizes';
        if(isset($_POST['paper_corner'])){
            $column = 'corner';
            $columnValue = $_POST['paper_corner'];
        }
        if(isset($_POST['orientation'])){
            $column = 'orientation';
            $columnValue = $_POST['orientation'];
        }
        
        $update = $wpdb->update(
            $wpdb->prefix . 'nbdesigner_templates', 
            array($column => $columnValue),
            array('product_id' => $product_id, 'folder' => $folder_id), 
            array('%s'), 
            array('%d', '%s')
        );

        $error = '';
        if($wpdb->last_error !== '') :
            $error = $wpdb->print_error();
        endif;

        wp_send_json( array('success' => true, 'error' => $error, 'column' => $column, 'update' => $update, 'columnvalue' => $columnValue, 'posts' => $_POST) );
        wp_die();
    }

    /**
     * Ajax callback for return child template lists 
     */
    public function nb_design_template_sub_tags_callback(){

        $variation_id = 0;
        $product_id = $_POST['product_id'];
        $tagId = $_POST['tag_id'];
        $template_data  = nbd_get_resource_templates( $product_id, $variation_id, false, 0, true );
        $children = array_search($tagId, array_column($template_data['template_tags'], 'id'));
        $children = $template_data['template_tags'][$children]['children'];
        
        $tags = get_term_children( $tagId, 'template_tag' );
       
        foreach($children as $k => $s){
            
            $children[$k]['templates'] = wp_json_encode($children[$k]['templates']);
            

        }
       
        echo wp_json_encode( array('templates' => $template_data, 'children' => $children ) );
        wp_die();
    }


}