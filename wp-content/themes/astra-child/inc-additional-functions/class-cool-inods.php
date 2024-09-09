<?php
/**
 * Manage inodes from backend to server for customer design 
 */

 class COOL_Inods{
    public $registered_page = array();
    public function __construct(){
        add_action( 'admin_menu', array($this, 'transparent_nbdesign_additional_menu_for_nodes') );

        add_action( 'admin_init', array($this, 'transparent_nbdesign_nodes_settings_init') );

        add_action( 'admin_enqueue_scripts', array($this, 'transparent_enqueue_script') );

        add_action('before_delete_post', array($this, 'transparentcard_action_after_order_delete'));
    }



    /**
     * remove inods while delete order
     * 
     * @param init
     */
    public function transparentcard_action_after_order_delete($post_id){
        // Check if the deleted post is an order
        if (get_post_type($post_id) === 'shop_order') {

            $order = wc_get_order($post_id);
            $order_meta_data = $order->get_meta_data();
            $postmetas = get_post_meta( $post_id );
        // Perform your custom action here
        // For example, logging or notifying
        
        update_option( 'ajax_test', array('metas' => $order_meta_data, 'metas' => $postmetas) );
            
        }
    }


    /**
     * Enqueue script for nodes list
     * 
     * @param string 
     * 
     * @return null
     */

    public function transparent_enqueue_script($hook){

        if(!in_array($hook, $this->registered_page))
            return;

        // js
        wp_enqueue_script( 'vuejs', 'https://unpkg.com/vue@3/dist/vue.global.prod.js', array(), time(), false );
        wp_enqueue_script( 'jQuery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js', array(), time(), false );
        wp_enqueue_script( 'dataTable', 'https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js', array('jQuery'), time(), true );

        // css 
        wp_enqueue_style( 'dataTableCSS', 'https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css', array(), time(), 'all' );

        wp_localize_script('vuejs', 'vueAjax', array(
            'nonce' => wp_create_nonce('ajax-nonce'), 
            'tab' => $_GET['tab'] ?? false
        ));

        
    }


    /**
     * Add additional menu to nbdesigner menu 
     * 
     * @param null
     */
    public function transparent_nbdesign_additional_menu_for_nodes(){
        $this->registered_page[] = add_submenu_page(
                'nbdesigner', esc_html__('Inodes Settings', 'web-to-print-online-designer'), esc_html__('Inodes Settings', 'web-to-print-online-designer'), 'manage_nbd_setting', 'nbdesigner-inodes', array( $this, 'nbdesigner_inodes_settings' )
        );
    }


    /**
     * Manage inodes settings fields 
     */
    public function transparent_nbdesign_nodes_settings_init(){
        register_setting( 'manage_nbd_setting', 'manage_nbd_templates' );

        add_settings_section('manage_nbd_setting_section_developers', '', array($this, 'wporg_section_developers_callback'), 'manage_nbd_setting');
        add_settings_section('manage_nbd_templates_section_developers', '', array($this, 'wporg_section_developers_callback'), 'manage_nbd_templates');
        add_settings_section('manage_nbd_setting_section_developers', '', array($this, 'wporg_section_developers_callback'), 'manage_nbd_setting');
    }






/**
 * Developers section callback function.
 *
 * @param array $args  The settings array, defining title, id, callback.
 */
public function wporg_section_developers_callback( $args ) {
	?>
        <div id="app_<?php echo esc_attr( $args['id'] ); ?>" style="margin-top:20px; position:relative;">
            <div class="loader" v-if="loader" style="top: 0; left: 0; width: 100%; height: 100%;">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="5em" height="5em" viewBox="0 0 24 24"><rect width="10" height="10" x="1" y="1" fill="currentColor" rx="1"><animate id="svgSpinnersBlocksShuffle30" fill="freeze" attributeName="x" begin="0;svgSpinnersBlocksShuffle3b.end" dur="0.2s" values="1;13"/><animate id="svgSpinnersBlocksShuffle31" fill="freeze" attributeName="y" begin="svgSpinnersBlocksShuffle38.end" dur="0.2s" values="1;13"/><animate id="svgSpinnersBlocksShuffle32" fill="freeze" attributeName="x" begin="svgSpinnersBlocksShuffle39.end" dur="0.2s" values="13;1"/><animate id="svgSpinnersBlocksShuffle33" fill="freeze" attributeName="y" begin="svgSpinnersBlocksShuffle3a.end" dur="0.2s" values="13;1"/></rect><rect width="10" height="10" x="1" y="13" fill="currentColor" rx="1"><animate id="svgSpinnersBlocksShuffle34" fill="freeze" attributeName="y" begin="svgSpinnersBlocksShuffle30.end" dur="0.2s" values="13;1"/><animate id="svgSpinnersBlocksShuffle35" fill="freeze" attributeName="x" begin="svgSpinnersBlocksShuffle31.end" dur="0.2s" values="1;13"/><animate id="svgSpinnersBlocksShuffle36" fill="freeze" attributeName="y" begin="svgSpinnersBlocksShuffle32.end" dur="0.2s" values="1;13"/><animate id="svgSpinnersBlocksShuffle37" fill="freeze" attributeName="x" begin="svgSpinnersBlocksShuffle33.end" dur="0.2s" values="13;1"/></rect><rect width="10" height="10" x="13" y="13" fill="currentColor" rx="1"><animate id="svgSpinnersBlocksShuffle38" fill="freeze" attributeName="x" begin="svgSpinnersBlocksShuffle34.end" dur="0.2s" values="13;1"/><animate id="svgSpinnersBlocksShuffle39" fill="freeze" attributeName="y" begin="svgSpinnersBlocksShuffle35.end" dur="0.2s" values="13;1"/><animate id="svgSpinnersBlocksShuffle3a" fill="freeze" attributeName="x" begin="svgSpinnersBlocksShuffle36.end" dur="0.2s" values="1;13"/><animate id="svgSpinnersBlocksShuffle3b" fill="freeze" attributeName="y" begin="svgSpinnersBlocksShuffle37.end" dur="0.2s" values="1;13"/></rect></svg>
                </div>
            </div>
            <div v-if="showRemoveBtn" class="actionbtns" style="margin:25px 10px;">
                <button type="button" v-on:click="removeItems()" class="remove"><?php _e('Remove', 'transparentcard'); ?></button>
            </div>
            
            <table class="table table-hover table-bordered" id="inodesTable">
                <thead>
                <tr>
                    <th>
                        <input type="checkbox" v-model="selectedAll" v-on:change="toggleAll()">
                    </th>
                    <th><?php _e('Folder', 'transparentcard') ?></th>
                    <th><?php _e('Is Template?', 'transparentcard') ?></th>
                    <th><?php _e('Order Status', 'transparentcard') ?></th>
                    <th><?php _e('Preview', 'transparentcard') ?></th>
                </tr>
                </thead>
                <tbody>

                
                <tr v-for="item in designes">
                    <td>
                        <input type="checkbox" v-if="item.template" disabled :checked="isChecked(item)" v-on:change="toggleAll(item.folder_name, selected.some(obj => obj.folder === item.folder_name) ? 'remove' : 'add', item.directory)">
                        <input type="checkbox" v-else :checked="isChecked(item)" v-on:change="toggleAll(item.folder_name, selected.some(obj => obj.folder === item.folder_name) ? 'remove' : 'add', item.directory)">
                    </td>
                    <td>{{ item.folder_name }}</td>
                    <td>{{ item.template ? 'Yes' : '' }}</td>
                    <td>{{ item.order_status ? 'Yes' : ''  }}</td>
                    <td><img v-bind:src="item.preview_img" alt="<?php _e('Design', 'transparentcard'); ?>"></td>
                </tr> 
                </tbody>
            </table>
        </div>
        <style>
            button.remove{
                padding: 15px 50px;
                background-color: #d63638;
                border-radius: 5px;
                border: 0;
                color: white;
                font-size: 20px;
                cursor: pointer;
                transition: all 0.4s;
            }
            button.remove:hover{
                background-color: #92080a;
            }
            table#inodesTable img {
                max-width: 150px;
            }
            .loader,
            .actionbtns{
                -moz-transition-duration: 0.3s;
                -webkit-transition-duration: 0.3s;
                -o-transition-duration: 0.3s;
                transition-duration: 0.3s;
                -moz-transition-timing-function: ease-in;
                -webkit-transition-timing-function: ease-in;
                -o-transition-timing-function: ease-in;
                transition-timing-function: ease-in;
            }
            .loader{
                position: absolute;
                display: flex;
                justify-content: center;
                align-items: center;
                background-color: rgba(0,0,0,0.5);
            }
            .loader svg rect{
                fill:#c3c4c7;
            }
        </style>
	<?php
}


    public function nbdesigner_inodes_settings(){
        // check user capabilities
        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }

        //Get the active tab from the $_GET param
        $default_tab = null;
        $tab = isset($_GET['tab']) ? $_GET['tab'] : $default_tab;

        ?> 
            <div class="wrap">
                    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

                    <nav class="nav-tab-wrapper">
                        <a href="<?php echo esc_url( admin_url('admin.php?page=nbdesigner-inodes') ); ?>" class="nav-tab <?php if($tab===null):?>nav-tab-active<?php endif; ?>"><?php _e('All Design', 'transparentcard'); ?></a>
                        <a href="<?php echo esc_url( admin_url('admin.php?page=nbdesigner-inodes&tab=templates') ); ?>" class="nav-tab <?php if($tab==='templates'):?>nav-tab-active<?php endif; ?>"><?php _e('Templates', 'transparentcard'); ?></a>
                        <a href="<?php echo esc_url( admin_url('admin.php?page=nbdesigner-inodes&tab=userdesign') ); ?>" class="nav-tab <?php if($tab==='userdesign'):?>nav-tab-active<?php endif; ?>"><?php _e('Users Design', 'transparentcard') ?></a>
                    </nav>

                    
                    <form action="options.php" method="post">
                        <div class="tab-content">
                        <?php
                        do_settings_sections( 'manage_nbd_setting' );
                        
                        // output save settings button
                        submit_button( 'Save Settings' );
                        ?>
                        </div>
                    </form>
            </div>

            <script>
                const { createApp, ref, onMounted } = Vue

                const app = createApp({
                    data() {
                        return {
                            designes:[], 
                            selected:[], 
                            selectedAll: false, 
                            showRemoveBtn: false, 
                            loader: false
                        }
                    },
                    methods:{

                        isChecked(item){
                            let temSelected = this.selected
                            return temSelected.some(obj => obj.folder == item.folder_name);
                        },
                        toggleAll: function(folder_name = '', add, directory){
                            let temSelected = this.selected;
                            if(folder_name == ''){
                                
                                if(this.designes.length > temSelected.length ){
                                    var temeSelected = [];
                                    this.designes.forEach(function(v){
                                        if(!v.template){
                                            temeSelected.push({folder:v.folder_name, directory:v.directory})
                                        }
                                    })
                                    temSelected= temeSelected;
                                    this.selectedAll = true;
                                    this.showRemoveBtn = true;
                                    
                                }else{
                                    temSelected = [];
                                    this.showRemoveBtn = false;
                                }
                            }
                            if(add == 'remove'){
                                    const filteredArray = new Proxy( temSelected.filter(obj => obj.folder !== folder_name), Reflect.getPrototypeOf(temSelected) );
                                    temSelected = filteredArray;

                                    this.showRemoveBtn = true;
                                    
                            }

                            if(add == 'add'){
                                    temSelected.push({folder:folder_name, directory:directory});
                                    this.showRemoveBtn = true;
                            }
                            this.selected = temSelected;
                            
                        },
                        removeItems: function(){
                            this.loader = true
                            var data = {
                                action: 'nodes_remove_data', 
                                nonce: window.vueAjax.nonce, 
                                removal_items: this.selected
                            };
                            jQuery.ajax({
                                url: window.ajaxurl,
                                method: 'POST',
                                dataType: 'json',
                                context: this,
                                data:data,
                                // contentType: 'application/json',
                                success: function(res){  
                                    this.loader = false
                                    
                                    var temDesigns = [];
                                    var selectedTem = this.selected
                                    this.designes.forEach(function(v){
                                        if(selectedTem.indexOf(v.folder_name) < 0){
                                            temDesigns.push(v)
                                        }
                                    })
                                    this.designes = temDesigns
                                }, 
                                error: function(xhr, status, error){
                                    console.log('error: ', xhr.responseText)
                                }
                            });
                        }
                    },
                    
                    mounted() {  
                        
                        
                        this.loader = true
                        var data = {
                            action: 'nodes_json_data', 
                            nonce: window.vueAjax.nonce, 
                            tab: window.vueAjax.tab
                        };

                        jQuery.ajax({
                            url: window.ajaxurl,
                            method: 'POST',
                            dataType: 'json',
                            context: this,
                            data:data,
                            // contentType: 'application/json',
                            success: function(res){   
                                this.designes = res.data.nbd_items;
                                this.loader = false
                                
                                Vue.nextTick(() => {
                                    jQuery('#inodesTable').DataTable(); 
                                });
                            }, 
                            error: function(xhr, status, error){
                                console.log('error: ', xhr.responseText)
                            }
                        });
                    }, 
                });

                app.mount('#app_manage_nbd_setting_section_developers');
            </script>


        <?php
    }
 }