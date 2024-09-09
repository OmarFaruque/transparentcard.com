<?php if (!defined('ABSPATH')) exit; ?>
<div class="nbd-option-field <?php echo $class; ?>" data-id="<?php echo $field['id']; ?>" ng-if="nbd_fields['<?php echo $field['id']; ?>'].enable">
    <?php include( $currentDir .'/options-builder/field-header.php' ); ?>
    <div class="nbd-field-content">
        <div class="nbd-label-wrap" style="align-items: center;">
        <?php 
            foreach ($field['general']['attributes']["options"] as $key => $attr): 
                $enable_subattr = isset($attr['enable_subattr']) ? $attr['enable_subattr'] : 0;
                $attr['sub_attributes'] = isset( $attr['sub_attributes'] ) ? $attr['sub_attributes'] : array();
                $show_subattr = ($enable_subattr == 'on' && count($attr['sub_attributes']) > 0) ? true : false;
                $field['general']['attributes']["options"][$key]['show_subattr'] = $show_subattr;
        ?>
        <input ng-change="check_valid();updateMapOptions('<?php echo $field['id']; ?>')" value="<?php echo $key; ?>" ng-model="nbd_fields['<?php echo $field['id']; ?>'].value"  data-cekcek2="<?php echo $field['id'].'-'.$key; ?>" data-cekcek="<?php echo $field['id']; ?>" class="cekcek2" name="nbd-field[<?php echo $field['id']; ?>]<?php if($show_subattr) echo '[value]'; ?>" type="radio" id='nbd-field-<?php echo $field['id'].'-'.$key; ?>' 
            <?php 
                if( isset($form_values[$field['id']]) ){
                    $fvalue = (is_array($form_values[$field['id']]) && isset($form_values[$field['id']]['value'])) ? $form_values[$field['id']]['value'] : $form_values[$field['id']];
                    checked( $fvalue, $key );
                }else{
                    checked( isset($attr['selected']) ? $attr['selected'] : 'off', 'on' ); 
                }
            ?> />
        <label class="nbd-label <?php echo $field['id']; ?> <?php echo $field['id'].'-'.$key; ?>" for='nbd-field-<?php echo $field['id'].'-'.$key; ?>' 
            nbo-disabled="!status_fields['<?php echo $field['id']; ?>'][<?php echo $key; ?>].enable" nbo-disabled-type="class" >
			<div style="display:flex;gap:10px;    justify-content: space-around; align-items: center;">
				<div style="width:50%;max-width:100%;text-align:left;">
				 <div class="cooltitledd">	 
					<h5><?php echo $attr['name']; ?></h5>
                    <p class="cooltextd mb-0"><?php echo $attr['des']; ?></p> 
                </div>
					
				</div>
				<div style="width:50%;text-align:right;">
					<?php $idsi=$attr['image']; $gorseliyazdir=wp_get_attachment_image_src($idsi, 'full')[0]; ?>
					<img width="36" height="36" src="<?php echo $gorseliyazdir; ?>">
				</div>
			</div>
           
        </label>
        <?php endforeach; ?>
        </div>
        <div class="nbo-invalid-option" 
            ng-class="nbd_fields['<?php echo $field['id']; ?>'].valid === false ? 'active' : ''"
            ng-if="nbd_fields['<?php echo $field['id']; ?>'].valid === false">{{nbd_fields['<?php echo $field['id']; ?>'].invalidOption}} <?php _e('is not available', 'web-to-print-online-designer'); ?></div>
        <?php 
            foreach ($field['general']['attributes']["options"] as $key => $attr): 
                if( $attr['show_subattr'] ):
                    $sattr_display_type = isset( $attr['sattr_display_type'] ) ? $attr['sattr_display_type'] : 'l';
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
        <?php include( $tempalte ); ?>
        </div>
        <?php endif; endforeach; ?>
    </div>
</div>