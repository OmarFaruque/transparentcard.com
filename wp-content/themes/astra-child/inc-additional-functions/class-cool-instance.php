<?php 

// Loading Classes.
if (!function_exists('COOL_autoloader')) {
    function COOL_autoloader($class_name)
    {
        if (0 === strpos($class_name, 'COOL')) {
            $classes_dir = get_stylesheet_directory() . '/inc-additional-functions/';
            $class_file = 'class-' . str_replace('_', '-', strtolower($class_name)) . '.php';
            require_once $classes_dir . $class_file;
        }
    }
}

spl_autoload_register('COOL_autoloader');



// Initial class 
final class COLFinal_Instance{
    
    // Initial load
    public function __construct(){
        add_action( 'init', array($this, 'initCallback'));
        add_action( 'woocommerce_register_taxonomy', array( $this, 'coolcard_init_taxonomy' ) );
        // add_filter( 'parent_file', array( $this, 'set_current_menu' ) );
        // add_action( 'init', array($this, 'init_callback_function') );
        add_action('vc_before_init', array(__CLASS__, 'load_vc_elements'));


    }


    /**
     * Remove vc shortcode
     */
    public static function load_vc_elements(){
        remove_shortcode( 'netbase_template_online_design' );
        add_shortcode( 'netbase_template_online_design', array( __CLASS__, 'shortcode_template_online_design' ) );
        
    }

    /**
     * Shortcode for display vc templatges 
     * 
     * @param array 
     * @param html
     * 
     * @return html
     */
    public static function shortcode_template_online_design($atts, $content = null){
        $html = '';
        extract(
          shortcode_atts(
            array(
              'accordionstyle' => 'style1',
              'num_template_design' => 4,
              'title_template_design' => '',
              'description_template_design' => '',
              'template_per_view' => 2,
              'color_arrow' => '#CC7272',
              'padding_template_design' => '0px',
              'template_direction' => 'ASC',
            ),
            $atts
          )
        );
        
        global $wpdb;
        if ( is_plugin_active('web-to-print-online-designer/nbdesigner.php') ) {
          $sql = "SELECT p.ID, p.post_title, t.id AS tid, t.name, t.folder, t.product_id, t.variation_id, t.user_id, t.thumbnail FROM {$wpdb->prefix}nbdesigner_templates AS t";     
          $sql .= " LEFT JOIN {$wpdb->prefix}posts AS p ON t.product_id = p.ID";
          $sql .= " WHERE t.publish = 1 AND p.post_status = 'publish' AND publish = 1"; 
          $sql .= " ORDER BY t.created_date ".$template_direction;
          $sql .= " LIMIT ".$num_template_design;
          $posts = $wpdb->get_results($sql, 'ARRAY_A');
          $listTemplates = array();
          foreach ($posts as $p) {
            $path_preview = NBDESIGNER_CUSTOMER_DIR .'/'.$p['folder']. '/preview';
            if( $p['thumbnail'] ){
              $image = wp_get_attachment_url( $p['thumbnail'] );
            }else{
              $listThumb = Nbdesigner_IO::get_list_images($path_preview);
              $image = '';
              if(count($listThumb)){
                $image = Nbdesigner_IO::wp_convert_path_to_url(reset($listThumb));
              }                
            }
            $title = $p['name'] ?  $p['name'] : $p['post_title'];
            $listTemplates[] = array('tid' => $p['tid'], 'id' => $p['ID'], 'title' => $title, 'image' => $image, 'folder' => $p['folder'], 'product_id' => $p['product_id'], 'variation_id' => $p['variation_id'], 'user_id' => $p['user_id']);
          }
          $html.='<div class="template-online-design">';
  
          if($accordionstyle=="style1") {
            if($title_template_design){
              $html.='<h3>'.$title_template_design.'</h3>';
            }
            $html.='<div class="row">';
            if($description_template_design){
              $html.='<div class="col-xs-12 col-md-12 col-lg-8 des">'.$description_template_design.'</div>';
              $html.='<div class="col-xs-12 col-md-12 col-lg-4">';
            }else{
              $html.='<div class="col-xs-12 col-md-12">';
            }
  
            $html.='<h5><a href="'.getUrlPageNBD('designer').'">Browse all designers</a></h5>';
            $html.='</div>';
            if(count($listTemplates)>0) {
              $UrlPageNBD = getUrlPageNBD('create');
              foreach ($listTemplates as $key => $temp) {
                $link_template = add_query_arg(array(
                  'product_id' => $temp['product_id'],
                  'variation_id' => $temp['variation_id'],
                  'reference'  =>  $temp['folder']
                ), $UrlPageNBD);
                $html.='<div class="col-sm-6 col-md-6 col-lg-3 item effect1">';
                $html.='<a href="'.$link_template.'" class="thumbnail">';
                $html.='<img src="'.$temp['image'].'" alt="'.$temp['title'].'">';
                $html.='</a>';
                $html.='</div>';
              }
            }
            $html.='</div>';
          } else {
            $html.='<div class="vc-printshop-template-online">';
            $html.='<div class="swiper-container vc-template-od">';
            $html.='<div class="swiper-wrapper" data-per="'.$template_per_view.'" data-color="'.$color_arrow.'">';
            if(count($listTemplates)>0) {
              $UrlPageNBD = getUrlPageNBD('create');
              foreach ($listTemplates as $key => $temp) {
                $link_template = add_query_arg(array(
                  'product_id' => $temp['product_id'],
                  'variation_id' => $temp['variation_id'],
                  'reference'  =>  $temp['folder']
                ), $UrlPageNBD);
                $html.='<div class="swiper-slide">';
                $html.='<a href="'.$link_template.'" class="thumbnail" style="padding: '.$padding_template_design.';">';
                $html.='<img src="'.$temp['image'].'" alt="'.$temp['title'].'">';
                $html.='</a>';
                $html.='</div>';
              }
            }
            $html.='</div>';
            // $html.='<div class="swiper-pagination"></div>';
            $html.='<div class="wrap-swiper-button-next"><div class="swiper-button-next-2"></div></div>';
            $html.='<div class="wrap-swiper-button-prev"><div class="swiper-button-prev-2"></div></div>';
            $html.='</div>';
            $html.='</div>';
          }
          $html.='</div>';
        }
        return apply_filters('netbase_shortcode_template_online_design', force_balance_tags($html));
    }

    /**
     * Register size taxonomy
     * 
     */
    public function coolcard_init_taxonomy(){
        register_taxonomy('paper_size', array('product'),
            apply_filters('register_taxonomy_paper_size', array(
                'hierarchical'  => false,
                'public'        => true,
                'rewrite'       => false,
                'show_ui'       => true,
                'show_in_menu'  => false,
                'show_tagcloud' => false,
                'meta_box_cb'   => false,
                'label'         => esc_html__('Paper Size', 'coolcards'),
                'labels'        => array(
                    'name'              => esc_html__('Paper Sizes', 'coolcards'),
                    'singular_name'     => esc_html__('Paper Size', 'coolcards'),
                    'search_items'      => esc_html__('Search Paper Size', 'coolcards'),
                    'all_items'         => esc_html__('All Paper Size', 'coolcards'),
                    'edit_item'         => esc_html__('Edit Paper Size', 'coolcards'),
                    'update_item'       => esc_html__('Update Paper Size', 'coolcards'),
                    'add_new_item'      => esc_html__('Add New Paper Size', 'coolcards'),
                    'new_item_name'     => esc_html__('New Paper Size', 'coolcards')
                ),  
            ))
        );


        // Corner
        register_taxonomy('paper_corner', array('product'),
            apply_filters('register_taxonomy_paper_corner', array(
                'hierarchical'  => false,
                'public'        => true,
                'rewrite'       => false,
                'show_ui'       => true,
                'show_in_menu'  => false,
                'show_tagcloud' => false,
                'meta_box_cb'   => false,
                'label'         => esc_html__('Paper Corner', 'coolcards'),
                'labels'        => array(
                    'name'              => esc_html__('Paper Corners', 'coolcards'),
                    'singular_name'     => esc_html__('Paper Corner', 'coolcards'),
                    'search_items'      => esc_html__('Search Paper Corner', 'coolcards'),
                    'all_items'         => esc_html__('All Paper Corner', 'coolcards'),
                    'edit_item'         => esc_html__('Edit Paper Corner', 'coolcards'),
                    'update_item'       => esc_html__('Update Paper Corner', 'coolcards'),
                    'add_new_item'      => esc_html__('Add New Paper Corner', 'coolcards'),
                    'new_item_name'     => esc_html__('New Paper Corner', 'coolcards')
                ),  
            ))
        );

        // Orientation
        register_taxonomy('orientation', array('product'),
            apply_filters('register_taxonomy_paper_orientation', array(
                'hierarchical'  => false,
                'public'        => false,
                'rewrite'       => false,
                'show_ui'       => true,
                'show_in_menu'  => false,
                'show_tagcloud' => false,
                'meta_box_cb'   => false,
                'label'         => esc_html__('Orientation', 'coolcards'),
                'labels'        => array(
                    'name'              => esc_html__('Orientations', 'coolcards'),
                    'singular_name'     => esc_html__('Orientation', 'coolcards'),
                    'search_items'      => esc_html__('Search Orientation', 'coolcards'),
                    'all_items'         => esc_html__('All Orientation', 'coolcards'),
                    'edit_item'         => esc_html__('Edit Orientation', 'coolcards'),
                    'update_item'       => esc_html__('Update Orientation', 'coolcards'),
                    'add_new_item'      => esc_html__('Add New Orientation', 'coolcards'),
                    'new_item_name'     => esc_html__('New Orientation', 'coolcards')
                ),  
            ))
        );

    }



    /**
     * Remove shortcode because need some additional modification 
     * @param array
     */
    public function init_callback_function(){
        remove_shortcode( 'nbdesigner_gallery' );
    }


    
    /**
     * Initial callback function and register necessary assets 
     * 
     */
    public function initCallback(){
        remove_shortcode( 'netbase_template_online_design' );
        COOL_CoolcardsTax::get_instance();
        if (is_admin()) {
            new COOL_Backend();
        }
        new COOL_Frontend();
        new COOL_Ajax();
        new COOL_Singleproduct();
        new COOL_Checkout();
        new COOL_Elementor();
    }
}

add_action( 'plugins_loaded', 'plugin_loaded_callback', 20);
add_action( 'after_setup_theme', 'plugin_loaded_callback', 0 );
function plugin_loaded_callback(){
  remove_action( 'wp_ajax_nbd_get_next_gallery_page', array('My_Design_Endpoint', 'nbd_get_next_gallery_page') );
  remove_action( 'wp_ajax_nopriv_nbd_get_next_gallery_page', array('My_Design_Endpoint', 'nbd_get_next_gallery_page') );
  

}

if(class_exists('My_Design_Endpoint')){
  new COLFinal_Instance;
}



