<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
if(!class_exists('COOL_CoolcardsTax')) {
    class COOL_CoolcardsTax{
        protected static $instance;
        public static function get_instance() {
            if ( is_null( self::$instance ) ) {
                self::$instance = new self();
            }
            return self::$instance;
        }


        /**
         * Initial
         */
        public function __construct(){
            add_action( 'nbd_menu', array($this, 'add_sub_menu'), 100 );
            add_filter( 'parent_file', array( $this, 'set_current_menu' ) );   
        }

        public function add_sub_menu(){
            if( current_user_can( 'manage_nbd_tool' ) ){
                add_submenu_page(
                    'nbdesigner', esc_html__('Paper Sizes', 'coolcards'), esc_html__('Paper Sizes', 'coolcards'), 'manage_nbd_tool', 'edit-tags.php?taxonomy=paper_size&post_type=product', null
                );
                add_submenu_page(
                    'nbdesigner', esc_html__('Paper Corners', 'coolcards'), esc_html__('Paper Corners', 'coolcards'), 'manage_nbd_tool', 'edit-tags.php?taxonomy=paper_corner&post_type=product', null
                );
                add_submenu_page(
                    'nbdesigner', esc_html__('Orientations', 'coolcards'), esc_html__('Orientations', 'coolcards'), 'manage_nbd_tool', 'edit-tags.php?taxonomy=orientation&post_type=product', null
                );
                // orientation
            }
        }


        /**
         * Change parent menu to nbdesigner
         * @return string
         * @param string
         */
        public function set_current_menu( $parent_file ){
            global $submenu_file, $current_screen, $pagenow;
            if ( $current_screen->post_type == 'product' && in_array($current_screen->taxonomy, array('paper_corner', 'paper_size', 'orientation')) ) {
                if ( $pagenow == 'edit-tags.php' || $pagenow == 'term.php' ) {
                    $submenu_file = 'edit-tags.php?taxonomy='.$current_screen->taxonomy.'&post_type=' . $current_screen->post_type;
                }
                $parent_file = 'nbdesigner';
            }
            return $parent_file;
        }
    }
}