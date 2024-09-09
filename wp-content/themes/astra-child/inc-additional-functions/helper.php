<?php
if ( ! function_exists( 'elementor_pro_render_mini_cart_item' ) ) {
	function elementor_pro_render_mini_cart_item( $cart_item_key, $cart_item, $remove_icon = false ) {
		// echo 'cart item <br/><pre>';
		// print_r($cart_item);
		// echo '</pre>';
		$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
		$is_product_visible = ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) );
		

		if ( ! $is_product_visible ) {
			return;
		}
		
		$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
		$product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
		$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
		?>
		<div style="display:block;" class="mb-20">
			<?php require(get_stylesheet_directory(  ) . '/woocommerce/cart/minicart-item-single.php'); ?>
			<div class="transparent-cart-product-remove product-remove">
				<?php 
				if($remove_icon){
				// <?php foreach ( [ 'elementor_remove_from_cart_button', 'remove_from_cart_button' ] as $class )
				foreach ( [ 'elementor_remove_from_cart_button' ] as $class ) {
					echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						'<a href="%s" class="%s" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">
							<svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M5 0.75C5 0.335786 5.33579 0 5.75 0H9.75C10.1642 0 10.5 0.335786 10.5 0.75V1.5H14.75C15.1642 1.5 15.5 1.83579 15.5 2.25C15.5 2.66421 15.1642 3 14.75 3H0.75C0.335786 3 0 2.66421 0 2.25C0 1.83579 0.335786 1.5 0.75 1.5H5V0.75Z" fill="white"/>
							<path fill-rule="evenodd" clip-rule="evenodd" d="M1.9899 5.69478C2.01803 5.44157 2.23206 5.25 2.48684 5.25H13.0132C13.2679 5.25 13.482 5.44157 13.5101 5.69478L13.7102 7.49613C14.071 10.7431 14.071 14.0201 13.7102 17.267L13.6905 17.4444C13.5591 18.6269 12.6426 19.5699 11.4643 19.7349C9.0001 20.0799 6.49989 20.0799 4.03574 19.7349C2.85737 19.5699 1.94085 18.6269 1.80945 17.4444L1.78975 17.267C1.42897 14.0201 1.42897 10.7431 1.78975 7.49613L1.9899 5.69478ZM6.5 9.14999C6.5 8.73578 6.16421 8.39999 5.75 8.39999C5.33579 8.39999 5 8.73578 5 9.14999L5 16.15C5 16.5642 5.33579 16.9 5.75 16.9C6.16421 16.9 6.5 16.5642 6.5 16.15L6.5 9.14999ZM10.5 9.14999C10.5 8.73578 10.1642 8.39999 9.75 8.39999C9.33579 8.39999 9 8.73578 9 9.14999V16.15C9 16.5642 9.33579 16.9 9.75 16.9C10.1642 16.9 10.5 16.5642 10.5 16.15V9.14999Z" fill="white"/>
							</svg>
							%s					
						</a>',
						esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
						$class,
						__( 'Remove this item', 'elementor-pro' ),
						esc_attr( $product_id ),
						esc_attr( $cart_item_key ),
						esc_attr( $_product->get_sku() ), 
						esc_attr__( 'Remove Item', 'transparentcard' )
					), $cart_item_key );
				} } ?>
			</div>
		</div>
		<?php
	}
}



function transparentcard_display_item_meta($item){
	$meta_data = $item->get_formatted_meta_data('_', true);
	ob_start();
	foreach($meta_data as $m => $meta):
		if(empty($meta->value)) continue;
		?>
			<tr>
				<td><?php echo esc_attr($meta->key); ?></td>
				<td colspan="2"><?php echo sprintf($meta->value); ?></td>
			</tr>
			
		<?php
	endforeach;
	echo ob_get_clean();
}


/**
 * Copy intire directoy to another 
 * @source https://www.tutorialspoint.com/copy-the-entire-contents-of-a-directory-to-another-directory-in-php
 * 
 * @param string $source url
 * @param string $destination url
 */
function copyDirectory($source, $destination) {
	if (!is_dir($destination)) {
	   mkdir($destination, 0755, true);
	}
	$files = scandir($source);
	$return  = false;
	foreach ($files as $file) {
	   if ($file !== '.' && $file !== '..') {
		  $sourceFile = $source . '/' . $file;
		  $destinationFile = $destination . '/' . $file;
		  if (is_dir($sourceFile)) {
			 copyDirectory($sourceFile, $destinationFile);
		  } else {
			 copy($sourceFile, $destinationFile);
		  }
		  $return = true;
	   }
	}
	return $return;
 }




 /**
  * Get order information using folfer name
  *@param string
  */
function transparent_get_order_status($folder_key = ''){
	global $wpdb;

	if(empty($folder_key)) return false;

	$query = $wpdb->get_row( $wpdb->prepare( "SELECT `order_id` FROM {$wpdb->prefix}woocommerce_order_items oi LEFT JOIN {$wpdb->prefix}woocommerce_order_itemmeta im ON im.`order_item_id` = oi.`order_item_id` WHERE im.`meta_key`=%s AND im.`meta_value`=%s", '_nbd', $folder_key), OBJECT);

	if(!$query) return false;

	$order = wc_get_order($query->order_id);
	
	if(!$order) return false; 

	$order_status = $order->get_status();

	return $order_status;

}


/**
 * Remove all folder, sub-folder and files 
 * @param dir
 */
function rrmdir($dir) {
	if (is_dir($dir)) {
	  $objects = scandir($dir);
	  foreach ($objects as $object) {
		if ($object != "." && $object != "..") {
		  if (filetype($dir."/".$object) == "dir") 
			 rrmdir($dir."/".$object); 
		  else unlink   ($dir."/".$object);
		}
	  }

	  if(is_array($objects)){
	  	reset($objects);
	  }

	  rmdir($dir);
	}
}



/**
 * All business cateogrys 
 */
function business_categorys(){
	return array(
		__('Advertising Agencies', 'transparentcard'),
		__('Architects & Designers', 'transparentcard'),
		__('Art Galleries', 'transparentcard'),
		__('Automotive', 'transparentcard'),
		__('Book Publishers', 'transparentcard'),
		__('Churches & Religious Organizations', 'transparentcard'),
		__('Clothing & Fashion', 'transparentcard'),
		__('Construction & Contractors', 'transparentcard'),
		__('Consulting Services', 'transparentcard'),
		__('Corporate Offices', 'transparentcard'),
		__('Education & Schools', 'transparentcard'),
		__('Event Planners', 'transparentcard'),
		__('Financial Services', 'transparentcard'),
		__('Food & Beverage', 'transparentcard'),
		__('Government & Municipalities', 'transparentcard'),
		__('Healthcare & Medical', 'transparentcard'),
		__('Hotels & Hospitality', 'transparentcard'),
		__('Legal Services', 'transparentcard'),
		__('Manufacturing & Industrial', 'transparentcard'),
		__('Marketing & Public Relations', 'transparentcard'),
		__('Media & Entertainment', 'transparentcard'),
		__('Non-Profit Organizations', 'transparentcard'),
		__('Photography & Videography', 'transparentcard'),
		__('Printing & Publishing', 'transparentcard'),
		__('Real Estate', 'transparentcard'),
		__('Retail & E-commerce', 'transparentcard'),
		__('Sports & Recreation', 'transparentcard'),
		__('Technology & Software', 'transparentcard'),
		__('Transportation & Logistics', 'transparentcard'),
		__('Travel & Tourism', 'transparentcard'),
		__('Wedding & Event Planning', 'transparentcard')
	);
	
}



function upload_transparent_file_to_directory($files, $uniqKey) {
    // Define the custom directory inside wp-content/uploads
    $upload_dir = wp_upload_dir();
    $custom_dir = $upload_dir['basedir'] . '/nbdesigner/uploads/hire_a_designer_' . $uniqKey;

    // Create the directory if it doesn't exist
    if (!file_exists($custom_dir)) {
        wp_mkdir_p($custom_dir);
    }


	// Array to hold the results
	$uploaded_files = array();

	if(!is_array($files['name'])){
		$files = array_map(function($v){
			return (array) $v;
		}, $files);
	}

	// Iterate through each file
    foreach ($files['name'] as $key => $name) {
        if ($files['error'][$key] === UPLOAD_ERR_OK) {
            // Prepare the file array
            $file = array(
                'name'     => $files['name'][$key],
                'type'     => $files['type'][$key],
                'tmp_name' => $files['tmp_name'][$key],
                'error'    => $files['error'][$key],
                'size'     => $files['size'][$key],
            );

			// Set the upload path to the custom directory
			add_filter('upload_dir', function($dirs) use ($custom_dir, $uniqKey) {
				$dirs['path'] = $custom_dir;
				$dirs['url'] = $upload_dir['baseurl'] . '/nbdesigner/uploads/hire_a_designer_' . $uniqKey ;
				return $dirs;
			});

			// Handle the file upload
            $uploaded_file = wp_handle_upload($file, array('test_form' => false));

			if (isset($uploaded_file['error'])) {
                // Handle error
                $uploaded_files[$name] = new WP_Error('upload_error', $uploaded_file['error']);
            } else {
                // Store the uploaded file info
                $uploaded_files[] = $uploaded_file;
            }

			
		}else {
            // Handle file upload error
            $uploaded_files[$name] = new WP_Error('upload_error', 'Error uploading file: ' . $name);
        }
	}

	// Remove the upload_dir filter to restore default behavior
	remove_filter('upload_dir', '__return_false');

    // Return the uploaded file info
    return $uploaded_files;
}


/**
 * @param string
 * @return html
 */
function color_to_html($colors){
	$colors = explode(', ', $colors);
	$html = '<p class="colors">';
	foreach($colors as $color){
		$html .= '<span style="background-color:'.$color.'"></span>';
	}
	$html .= '</p>';

	return $html;
}


/**
 * @desc get selected category for cart and order line item
 * @param init
 * @return string
 */
function selected_business_category($key = ''){
	if(empty($key)) return $key;

	$categories = business_categorys();
	return $categories[$key];
}