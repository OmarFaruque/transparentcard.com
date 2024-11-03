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
		__('Wedding & Event Planning', 'transparentcard'), 
		__('Restaurant', 'transparentcard'),
        __('Finance', 'transparentcard'),
        __('Construction', 'transparentcard'),
        __('Insurance', 'transparentcard'),
        __('Beauty & Spa', 'transparentcard'),
        __('Travel & Tourism', 'transparentcard'),
        __('Nonprofit', 'transparentcard'),
        __('Telecommunications', 'transparentcard'),
        __('Agriculture', 'transparentcard'),
        __('Fashion', 'transparentcard'),
        __('Pharmaceuticals', 'transparentcard'),
        __('Fitness', 'transparentcard'),
        __('Art & Design', 'transparentcard'),
        __('Music', 'transparentcard'),
        __('Event Planning', 'transparentcard'),
        __('IT Services', 'transparentcard'),
        __('Personal Services', 'transparentcard'),
        __('Security', 'transparentcard'),
        __('Accounting', 'transparentcard'),
        __('Pet Services', 'transparentcard'),
        __('Recruitment', 'transparentcard'),
        __('Cleaning Services', 'transparentcard'),
        __('Printing Services', 'transparentcard'),
        __('Environmental Services', 'transparentcard'),
        __('Logistics', 'transparentcard'),
        __('Courier Services', 'transparentcard'),
        __('Public Relations', 'transparentcard'),
        __('Photography', 'transparentcard'),
        __('Video Production', 'transparentcard'),
        __('Software Development', 'transparentcard'),
        __('Hardware Solutions', 'transparentcard'),
        __('Mobile Development', 'transparentcard'),
        __('E-commerce', 'transparentcard'),
        __('Copywriting', 'transparentcard'),
        __('Translation Services', 'transparentcard'),
        __('Interior Design', 'transparentcard'),
        __('Architecture', 'transparentcard'),
        __('Real Estate Development', 'transparentcard'),
        __('Law Firm', 'transparentcard'),
        __('Dental Services', 'transparentcard'),
        __('Veterinary Services', 'transparentcard'),
        __('Chiropractic Services', 'transparentcard'),
        __('Massage Therapy', 'transparentcard'),
        __('Hair Salon', 'transparentcard'),
        __('Barber Shop', 'transparentcard'),
        __('Nail Salon', 'transparentcard'),
        __('Tattoo Studio', 'transparentcard'),
        __('Car Dealership', 'transparentcard'),
        __('Car Rental', 'transparentcard'),
        __('Driving School', 'transparentcard'),
        __('Construction Equipment', 'transparentcard'),
        __('Landscaping', 'transparentcard'),
        __('Pest Control', 'transparentcard'),
        __('Waste Management', 'transparentcard'),
        __('Solar Energy', 'transparentcard'),
        __('Electrician', 'transparentcard'),
        __('Plumbing Services', 'transparentcard'),
        __('HVAC Services', 'transparentcard'),
        __('Home Cleaning', 'transparentcard'),
        __('Home Renovation', 'transparentcard'),
        __('Window Cleaning', 'transparentcard'),
        __('Roofing', 'transparentcard'),
        __('Paving', 'transparentcard'),
        __('Pool Services', 'transparentcard'),
        __('Tiling', 'transparentcard'),
        __('Furniture Store', 'transparentcard'),
        __('Appliance Store', 'transparentcard'),
        __('Grocery Store', 'transparentcard'),
        __('Convenience Store', 'transparentcard'),
        __('Supermarket', 'transparentcard'),
        __('Butcher Shop', 'transparentcard'),
        __('Bakery', 'transparentcard'),
        __('Florist', 'transparentcard'),
        __('Liquor Store', 'transparentcard'),
        __('Pet Store', 'transparentcard'),
        __('Gift Shop', 'transparentcard'),
        __('Stationery Store', 'transparentcard'),
        __('Bookstore', 'transparentcard'),
        __('Toy Store', 'transparentcard'),
        __('Jewelry Store', 'transparentcard'),
        __('Electronics Store', 'transparentcard'),
        __('Hardware Store', 'transparentcard'),
        __('Paint Store', 'transparentcard'),
        __('Garden Center', 'transparentcard'),
        __('Pharmacy', 'transparentcard'),
        __('Optician', 'transparentcard'),
        __('Clothing Store', 'transparentcard'),
        __('Shoe Store', 'transparentcard'),
        __('Sports Equipment', 'transparentcard'),
        __('Outdoor Equipment', 'transparentcard'),
        __('Fishing Store', 'transparentcard'),
        __('Camping Equipment', 'transparentcard'),
        __('Bicycle Store', 'transparentcard'),
        __('Motorcycle Store', 'transparentcard'),
        __('Boat Sales', 'transparentcard'),
        __('Marina', 'transparentcard'),
        __('Car Wash', 'transparentcard'),
        __('Gas Station', 'transparentcard'),
        __('Parking Services', 'transparentcard'),
        __('Mobile Phone Store', 'transparentcard'),
        __('Computer Store', 'transparentcard'),
        __('Furniture Repair', 'transparentcard'),
        __('Shoe Repair', 'transparentcard'),
        __('Watch Repair', 'transparentcard'),
        __('Locksmith', 'transparentcard'),
        __('Tailoring', 'transparentcard'),
        __('Dry Cleaning', 'transparentcard'),
        __('Laundry Service', 'transparentcard'),
        __('Courier Services', 'transparentcard'),
        __('Freight Forwarding', 'transparentcard'),
        __('Warehousing', 'transparentcard'),
        __('Travel Agency', 'transparentcard'),
        __('Carpet Cleaning', 'transparentcard'),
        __('Window Treatment', 'transparentcard'),
        __('Tile & Grout Cleaning', 'transparentcard'),
        __('Tax Services', 'transparentcard'),
        __('Financial Planning', 'transparentcard'),
        __('Investment Services', 'transparentcard'),
        __('Business Consulting', 'transparentcard'),
        __('Career Coaching', 'transparentcard'),
        __('Life Coaching', 'transparentcard'),
        __('Health Coaching', 'transparentcard'),
        __('Mental Health Services', 'transparentcard'),
        __('Yoga Studio', 'transparentcard'),
        __('Dance Studio', 'transparentcard'),
        __('Martial Arts School', 'transparentcard'),
        __('Gym', 'transparentcard'),
        __('CrossFit', 'transparentcard'),
        __('Pilates Studio', 'transparentcard'),
        __('Boxing Gym', 'transparentcard'),
        __('Golf Course', 'transparentcard'),
        __('Tennis Club', 'transparentcard'),
        __('Ski Resort', 'transparentcard'),
        __('Surf School', 'transparentcard'),
        __('Scuba Diving', 'transparentcard'),
        __('Ballet School', 'transparentcard'),
        __('Music School', 'transparentcard'),
        __('Drama School', 'transparentcard'),
        __('Art School', 'transparentcard'),
        __('Photography School', 'transparentcard'),
        __('Language School', 'transparentcard'),
        __('Cooking School', 'transparentcard'),
        __('Driver Training', 'transparentcard')
		
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



// Function to find the index using array_column and array_search
function searchKeyValueInMultidimensionalArray($array, $searchKey, $searchValue) {
    foreach ($array as $outerKey => $subArray) {
        $column = array_column($subArray, $searchKey); // Get values by key
        $index = array_search($searchValue, $column);  // Search for value in column
        if ($index !== false) {
            // return ['outerIndex' => $outerKey, 'innerIndex' => $index]; // Return outer and inner index
            return $outerKey;
        }

    }
    return false; // No match found
}



/**
 * Send verification email to new created email 
 */
function send_verification_email( $customer_id ) {
    $user = get_userdata( $customer_id );
    $email = $user->user_email;

    
    // Generate a unique verification token
    $verification_code = md5(uniqid($customer_id, true));
    
    // Save the token as user meta
    update_user_meta($customer_id, 'email_verification_code', $verification_code);

    // Create the verification URL
    $verification_url = add_query_arg(array(
        'verify_email' => 'true',
        'user_id' => $customer_id,
        'token' => $verification_code
    ), home_url());

    // Email content
    // $subject = 'Email Verification';


    // $headers = array('Content-Type: text/html; charset=UTF-8');

    WC()->mailer()->get_emails()['COOL_Validationemail']->trigger( $customer_id, $verification_url );

    // Load WooCommerce mailer
    // $mailer = WC()->mailer();

    // Debug logging
    // error_log('Sending email to: ' . $email);
    // error_log('Verification URL: ' . $verification_url);
    
    // Send the email
    // Send email
    // $mailer->send( $email, $subject, $message, $headers );
}


