<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<h1><?php _e('Manager Backgrounds', 'web-to-print-online-designer'); ?></h1>
<?php echo $notice; ?>
<div class="wrap nbdesigner-container">
	<div class="nbdesigner-content-full">
		<form name="post" action="" method="post" enctype="multipart/form-data" autocomplete="off">
                    <div class="nbdesigner-content-left postbox">
                        <div class="inside">	
                            <?php wp_nonce_field($nb_designer->plugin_id, $nb_designer->plugin_id.'_hidden'); ?>		
                            <table class="form-table">			
                                <tr class="bg_preview" valign="top">
                                    <th scope="row" class="titledesc"><?php echo __("Background files", 'web-to-print-online-designer'); ?> </th>
                                    <td class="forminp-text">
                                        <input type="file" onchange="NBDESIGNADMIN.upload_background_image(this)" name="svg[]" value="" accept=".svg,image/*" multiple/><br />
                                        <div style="font-size: 11px; font-style: italic;"><?php _e('Allow extensions: svg, png, jpg, jpeg', 'web-to-print-online-designer'); ?>
                                            <br /><?php _e('Allow upload multiple files.', 'web-to-print-online-designer'); ?>
                                            <br /><?php _e('Note: if you export svg file from Illustrator, please choose Fonts type "Convert to outline"', 'web-to-print-online-designer'); ?></div>
                                    </td>
                                </tr>			
                            </table>
                            <input type="hidden" name="nbdesigner_background_id" value="<?php echo $background_id; ?>"/>
                            <p class="submit">
                                <input type="submit" name="Submit" class="button-primary" value="<?php _e('Save', 'web-to-print-online-designer'); ?>" />
                                <a href="?page=nbdesigner_manager_fonts" class="button-primary" style="<?php $style = (isset($_GET['id'])) ? '' : 'display:none;';echo $style; ?>"><?php _e('Add New', 'web-to-print-online-designer'); ?></a>
                            </p>				
                        </div>
                    </div>
                    <div class="nbdesigner-content-side">
                        <div class="postbox" style="padding-bottom: 5px;">
                            <h3><?php _e('Categories', 'web-to-print-online-designer'); ?><img src="<?php echo NBDESIGNER_PLUGIN_URL . 'assets/images/loading.gif'; ?>" class="nbdesigner_editcat_loading nbdesigner_loaded" style="margin-left: 15px;"/></h3>
                            <div class="inside">
                                <ul id="nbdesigner_list_background_cats">
                                <?php if(is_array($cat) && (sizeof($cat) > 0)): ?>
                                    <?php foreach($cat as $val): ?>
                                        <li id="nbdesigner_cat_background_<?php echo $val->id; ?>" class="nbdesigner_action_delete_background_cat">
                                            <label>
                                                <input value="<?php echo $val->id; ?>" type="checkbox" name="nbdesigner_background_cat[]" <?php if($update && (sizeof($cats) > 0 )) if(in_array($val->id, $cats)) echo "checked";  ?> />
                                            </label>
                                            <span class="nbdesigner-right nbdesigner-delete-item dashicons dashicons-no-alt" onclick="NBDESIGNADMIN.delete_cat_background(this)"></span>
                                            <span class="dashicons dashicons-edit nbdesigner-right nbdesigner-delete-item" onclick="NBDESIGNADMIN.edit_cat_background(this)"></span>
                                            <a href="<?php echo add_query_arg(array('cat_id' => $val->id), admin_url('admin.php?page=nbdesigner_manager_backgrounds')); ?>" class="nbdesigner-cat-link"><?php echo $val->name; ?></a>
                                            <input value="<?php echo $val->name; ?>" class="nbdesigner-editcat-name" type="text"/>
                                            <span class="dashicons dashicons-yes nbdesigner-delete-item nbdesigner-editcat-name" onclick="NBDESIGNADMIN.save_cat_background(this)"></span>
                                            <span class="dashicons dashicons-no nbdesigner-delete-item nbdesigner-editcat-name" onclick="NBDESIGNADMIN.remove_action_cat_background(this)"></span>
                                        </li>
                                    <?php endforeach; ?>                            
                                <?php else: ?> 
                                        <li><?php _e('You don\'t have any category.', 'web-to-print-online-designer'); ?></li>
                                <?php endif; ?>                     
                                </ul>
                                <input type="hidden" id="nbdesigner_current_background_cat_id" value="<?php echo $current_background_cat_id; ?>"/>
                                <p><a id="nbdesigner_add_background_cat"><?php _e('+ Add new background category', 'web-to-print-online-designer'); ?></a></p>
                                <div id="nbdesigner_background_newcat" class="category-add"></div> 
                            </div>
                        </div>
                    </div>
		</form>
	</div>
	<div class="clear"></div>
    <div class="postbox" id="nbd-list-backgrounds">
            <h3 style="line-height: 20px;"><?php echo __('List backgrounds ', 'web-to-print-online-designer'); ?>
                <?php if(is_array($cat) && (sizeof($cat) > 0)): ?>
                    <select onchange="if (this.value) window.location.href=this.value+'#nbd-list-backgrounds'">
                        <option value="<?php echo admin_url('admin.php?page=nbdesigner_manager_backgrounds'); ?>"><?php _e('Select a category', 'web-to-print-online-designer'); ?></option>
                        <?php foreach($cat as $cat_index => $val): ?>
                        <option value="<?php echo add_query_arg(array('cat_id' => $val->id), admin_url('admin.php?page=nbdesigner_manager_backgrounds')) ?>" <?php selected( $cat_index, $current_cat_id ); ?>><?php echo $val->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php  endif; ?>
                <span class="nbdesigner-right">
                    <a href="<?php echo admin_url('admin.php?page=nbdesigner_manager_backgrounds'); ?>"><?php _e('All arts', 'web-to-print-online-designer'); ?></a>
                </span>
            </h3>
        <div class="nbdesigner-list-fonts inside">              
                    <div class="nbdesigner-list-backgrounds-container">
                            <?php if(is_array($_list) && (sizeof($_list) > 0)): ?>
                                    <?php 
                                        foreach($_list as $val): 
                                        $background_url = ( strpos($val->url, 'http') > -1 ) ? $val->url : NBDESIGNER_BACKGROUND_URL.$val->url;
                                    ?>
                                            <span class="nbdesigner_background_link "><img src="<?php echo $background_url; ?>" /><span class="nbdesigner_action_delete_background" data-index="<?php echo $val->id; ?>" onclick="NBDESIGNADMIN.delete_background(this)">&times;</span></span>
                                    <?php endforeach; ?>
                            <?php else: ?>
                                    <?php _e('You don\'t have any Background.', 'web-to-print-online-designer');?>
                            <?php  endif; ?>
                    </div>
                    <div class="tablenav top">
                        <div class="tablenav-pages">
                            <span class="displaying-num"><?php echo $total.' '. __('backgrounds', 'web-to-print-online-designer'); ?></span>
                            <?php echo $paging->html();  ?>
                        </div>
                    </div>                       
        </div>
    </div>
</div>
