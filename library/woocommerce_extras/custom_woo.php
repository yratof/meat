<?php // Remove each style one by one
add_filter( 'woocommerce_enqueue_styles', 'jk_dequeue_styles' );
	function jk_dequeue_styles( $enqueue_styles ) {
	unset( $enqueue_styles['woocommerce-general'] ); // Remove the gloss
	unset( $enqueue_styles['woocommerce-layout'] ); // Remove the layout
	unset( $enqueue_styles['woocommerce-smallscreen'] ); // Remove the smallscreen optimisation
	return $enqueue_styles;
}

/*
	function wp_enqueue_woocommerce_style(){
		wp_register_style( 'woocommerce', get_template_directory_uri() . '/library/css/woocommerce.css' );
		if ( class_exists( 'woocommerce' ) ) {
			wp_enqueue_style( 'woocommerce' );
		}
	}
	add_action( 'wp_enqueue_scripts', 'wp_enqueue_woocommerce_style' );
*/


/* Function to Reorder the checkout page fields */

add_filter('woocommerce_checkout_fields','reorder_woo_fields');
function reorder_woo_fields($fields) {
	//Move these around in the order you'd like
	$fields2['billing']['billing_first_name'] 	= $fields['billing']['billing_first_name'];
	$fields2['billing']['billing_last_name'] 	= $fields['billing']['billing_last_name'];
	$fields2['billing']['billing_email'] 		= $fields['billing']['billing_email'];
	//$fields2['billing']['billing_phone'] 		= $fields['billing']['billing_phone'];

	$fields2['billing']['billing_address_1'] 	= $fields['billing']['billing_address_1'];
	$fields2['billing']['billing_address_2'] 	= $fields['billing']['billing_address_2'];
	$fields2['billing']['billing_city'] 		= $fields['billing']['billing_city'];
	$fields2['billing']['billing_postcode'] 	= $fields['billing']['billing_postcode'];
	$fields2['billing']['billing_state'] 		= $fields['billing']['billing_state'];
	$fields2['billing']['billing_country'] 		= $fields['billing']['billing_country'];

	// Change the Shipping order too

	$fields2['shipping']['shipping_first_name'] = $fields['shipping']['shipping_first_name'];
	$fields2['shipping']['shipping_last_name'] 	= $fields['shipping']['shipping_last_name'];
	//$fields2['billing']['billing_phone'] 		= $fields['shipping']['shipping_phone'];

	$fields2['shipping']['shipping_address_1'] 	= $fields['shipping']['shipping_address_1'];
	$fields2['shipping']['shipping_address_2'] 	= $fields['shipping']['shipping_address_2'];
	$fields2['shipping']['shipping_city']		= $fields['shipping']['shipping_city'];
	$fields2['shipping']['shipping_postcode'] 	= $fields['shipping']['shipping_postcode'];
	$fields2['shipping']['shipping_state'] 		= $fields['shipping']['shipping_state'];
	$fields2['shipping']['shipping_country'] 	= $fields['shipping']['shipping_country'];

	//Just copying these (keeps the standard order)
	//$fields2['shipping'] = $fields['shipping'];
	$fields2['account'] = $fields['account'];
	$fields2['order'] = $fields['order'];

	return $fields2;
}


/* This removed fields from the checkout process. */

add_filter( 'woocommerce_checkout_fields' , 'customize_fields' );
function customize_fields( $fields ) {
	// Remove order fields:
	// unset($fields['order']['order_comments']);

	// Remove billing fields
	unset($fields['billing']['billing_company']);
	unset($fields['billing']['billing_phone']);

	// Remove for Shipping too
	unset($fields['shipping']['shipping_company']);
	unset($fields['shipping']['shipping_phone']);

	return $fields;
}
