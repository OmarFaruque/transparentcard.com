<!-- nbo-disabled="!status_fields['<?php //echo $field['id']; ?>'][<?php //echo $key; ?>].enable" nbo-disabled-type="class" -->


<?php if (!defined('ABSPATH')) exit; ?>


<?php 
    $field_slug = str_replace(' ', '', $field['general']['title']);
    $field_slug = strtolower($field_slug);
    $class = $field_slug .' ' . $class;
?>
<div nbo-adv-dropdown class="nbd-option-field nbd-field-xlabel-wrap two <?php echo 'count_' . count($field['general']['attributes']["options"]); ?> <?php echo $class; ?> <?php echo isset($field['action']) ? $field['action'] : ''; ?>" data-id="<?php echo $field['id']; ?>" ng-if="nbd_fields['<?php echo $field['id']; ?>'].enable">
    <?php include( $currentDir .'/options-builder/field-header.php' ); ?>
    <div class="nbd-field-content">
        <div class="nbd-xlabel-wrapper nbo-clearfix vc_row wpb_row vc_row-fluid count_<?php echo count($field['general']['attributes']["options"]); ?>">
            <?php
                foreach ($field['general']['attributes']["options"] as $key => $attr): 
                    $image_url = nbd_get_image_thumbnail( $attr['image'] );
                    $enable_subattr = isset($attr['enable_subattr']) ? $attr['enable_subattr'] : 0;
                    $attr['sub_attributes'] = isset( $attr['sub_attributes'] ) ? $attr['sub_attributes'] : array();
                    $show_subattr = ($enable_subattr == 'on' && count($attr['sub_attributes']) > 0) ? true : false;
                    $field['general']['attributes']["options"][$key]['show_subattr'] = $show_subattr;


                    // echo 'Form values <br/><pre>';
                    // print_r($field);
                    // echo '</pre>';
             

            ?>
            <div class="nbd-xlabel-wrap 
            <?php echo $field['id']; ?> 
            <?php echo isset($attr['action']) ? 'action_class_' . $attr['action'] : ''; ?> 
            wpb_column vc_column_container vc_col-sm-12">
                <label ng-click="change_product_image('<?php echo $field['id']; ?>', <?php echo $key; ?>)" class="cooltitled" style="margin: 0px 0px 0px 0px !important;" for='nbd-field-<?php echo $field['id'].'-'.$key; ?>'>
                    <div class="nbd-xlabel-value">
                        <div class="nbd-xlabel-value-inner" title="<?php echo $attr['name']; ?>">

                            <input title="<?php echo $attr['name']; ?>" ng-change="check_valid();updateMapOptions('<?php echo $field['id']; ?>')" value="<?php echo $key; ?>" ng-model="nbd_fields['<?php echo $field['id']; ?>'].value" data-cekcek="<?php echo $field['id']; ?>" name="nbd-field[<?php echo $field['id']; ?>]<?php if($show_subattr) echo '[value]'; ?>" 
                                type="radio" class="cekcek" id='nbd-field-<?php echo $field['id'].'-'.$key; ?>' 
                                <?php 
                                    if( isset($form_values[$field['id']]) ){
                                        $fvalue = (is_array($form_values[$field['id']]) && isset($form_values[$field['id']]['value'])) ? $form_values[$field['id']]['value'] : $form_values[$field['id']];
                                        checked( $fvalue, $key ); 
                                    }else{
                                        checked( isset($attr['selected']) ? $attr['selected'] : 'off', 'on' ); 
                                    }
                                ?> />
                            <?php $idsi=$attr['image']; 
                            $gorseliyazdir= $idsi ? wp_get_attachment_image_src($idsi, 'full')[0] : ''; ?>
                            <label class="nbd-xlabel" style="<?php if( $attr['preview_type'] == 'i' ){echo 'background: url('.$gorseliyazdir. ') 0% 0% / cover';}else{echo 'background: '.$attr['color'];}?>" 
                                for='nbd-field-<?php echo $field['id'].'-'.$key; ?>'>
                                <?php if(isset($attr['des']) && $attr['des'] != ''): ?>
                                
                                    <span class="tooltip custom" data-tooltip-content="#tooltip_content<?php echo $field['id'] . $key; ?>"></span>

                                <?php endif; ?>
                                <?php if( isset($attr['selected']) && $attr['selected'] == 'on'  ): ?>
                                <span class="nbo-recomand" title="<?php _e('Recommended', 'web-to-print-online-designer'); ?>">
                                    <svg class="octicon octicon-bookmark" viewBox="0 0 10 16" version="1.1" width="10" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M9 0H1C.27 0 0 .27 0 1v15l5-3.09L10 16V1c0-.73-.27-1-1-1zm-.78 4.25L6.36 5.61l.72 2.16c.06.22-.02.28-.2.17L5 6.6 3.12 7.94c-.19.11-.25.05-.2-.17l.72-2.16-1.86-1.36c-.17-.16-.14-.23.09-.23l2.3-.03.7-2.16h.25l.7 2.16 2.3.03c.23 0 .27.08.09.23h.01z"></path></svg>
                                </span>
                                <?php endif; ?>
                            </label>
                            <p class="heading-5"><?php echo $attr['name']; ?></p>
                        </div>
                    </div>
                    
                    <!-- <p class="cooltextd" style="margin-top:37px;margin-bottom:0px;"> -->
                        <?php// echo $attr['des']; ?>
                    <!-- </p> -->
                </label>
                
            </div>
            <?php if(isset($attr['des']) && $attr['des'] != ''): ?>
                <div class="tooltip_templates">
                    <span id="tooltip_content<?php echo $field['id'] . $key; ?>" style="margin-bottom:0;">
                        <?php echo $attr['des']; ?>
                    </span>
                </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <div class="nbo-invalid-option" 
            ng-class="nbd_fields['<?php echo $field['id']; ?>'].valid === false ? 'active' : ''"
            ng-if="nbd_fields['<?php echo $field['id']; ?>'].valid === false">{{nbd_fields['<?php echo $field['id']; ?>'].invalidOption}} <?php _e('is not available', 'web-to-print-online-designer'); ?>
        </div>
        <?php 
            foreach ($field['general']['attributes']["options"] as $key => $attr): 
                if( $attr['show_subattr'] ):
                    $sattr_display_type = isset( $attr['sattr_display_type'] ) ? $attr['sattr_display_type'] : 's';
                    switch($sattr_display_type){
                        case 's':
                            $tempalte = $currentDir .'/options-builder/sattr_swatch'.$prefix.'.php';
                            $wrap_class = 'nbd-swatch-wrap';
                            break;
                        case 'l':
                            $tempalte = $currentDir .'/options-builder/sattr_label.php';
                            $wrap_class = 'nbd-label-wrap';
                            break;            
                        case 'r':
                            $tempalte = $currentDir .'/options-builder/sattr_radio.php';
                            $wrap_class = 'nbd-radio';
                            break;
                        default:
                            $tempalte = $currentDir .'/options-builder/sattr_dropdown.php';
                            $wrap_class = '';
                            break;            
                    }
        ?>
        <div ng-if="nbd_fields['<?php echo $field['id']; ?>'].value == '<?php echo $key; ?>'" class="nbo-sub-attr-wrap <?php echo $wrap_class; ?>">
        <?php include($tempalte); ?>
        </div>
        <?php endif; endforeach; ?>
    </div>
</div>

