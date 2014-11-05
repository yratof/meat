<?php

/*
WooCommerce Functions
Author: Andrew Lazarus

This is where all the woocommerce helpers are. 
They should all be helpful to the point where
when this file is activated, nothing'll change. 
Nothing EXCEPT WHAT NEDS TO CHANGE! MWHAHAHAHA

*/

/*****************************************************
Remove all the Default WooCommerce Styles.
******************************************************/

// Remove each style one by one
add_filter( 'woocommerce_enqueue_styles', 'jk_dequeue_styles' );
function jk_dequeue_styles( $enqueue_styles ) {
	unset( $enqueue_styles['woocommerce-general'] );	// Remove the gloss
	//unset( $enqueue_styles['woocommerce-layout'] );		// Remove the layout
	//unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
	return $enqueue_styles;
}

// Or just remove them all in one line
add_filter( 'woocommerce_enqueue_styles', '__return_false' );


/*****************************************************
Add Types field on a products page, then add that to tabs
******************************************************

	//Add a tab for a types field
	// Add types field to custom post type of product
	
	
	add_filter( 'woocommerce_product_tabs', 'db_woo_delivery_tab');
		function db_woo_delivery_tab_content() {
		echo types_render_field('delivery-and-returns-information', array('arg1' => 'val1'));
	}
	
	function db_woo_delivery_tab($tabs) {
		$tabs['delivery_tab'] = array(
			'title' => __( 'Delivery / Returns', 'woocommerce' ),
			'priority' => 30,
			'callback' => 'db_woo_delivery_tab_content'
		);
		return $tabs;
	}

**********************************************************/



/*****************************************************
Reposition WooCommerce breadcrumb 
******************************************************/

function woocommerce_remove_breadcrumb(){
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);}
	add_action('woocommerce_before_main_content', 'woocommerce_remove_breadcrumb');
	
	function woocommerce_custom_breadcrumb(){
	    woocommerce_breadcrumb();
	}
	
	add_action( 'woo_custom_breadcrumb', 'woocommerce_custom_breadcrumb' );
	
	// To echo on site, use this:
	// do_action('woo_custom_breadcrumb');




/**
 * Optimize WooCommerce Scripts
 * Remove WooCommerce Generator tag, styles, and scripts from non WooCommerce pages.
 */
add_action( 'wp_enqueue_scripts', 'child_manage_woocommerce_styles', 99 );

function child_manage_woocommerce_styles() {
	//remove generator meta tag
	remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );

	//first check that woo exists to prevent fatal errors
	if ( function_exists( 'is_woocommerce' ) ) {
		//dequeue scripts and styles
		if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() ) {
			wp_dequeue_style( 'woocommerce_frontend_styles' );
			wp_dequeue_style( 'woocommerce_fancybox_styles' );
			wp_dequeue_style( 'woocommerce_chosen_styles' );
			wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
			wp_dequeue_script( 'wc_price_slider' );
			wp_dequeue_script( 'wc-single-product' );
			wp_dequeue_script( 'wc-add-to-cart' );
			wp_dequeue_script( 'wc-cart-fragments' );
			wp_dequeue_script( 'wc-checkout' );
			wp_dequeue_script( 'wc-add-to-cart-variation' );
			wp_dequeue_script( 'wc-single-product' );
			wp_dequeue_script( 'wc-cart' );
			wp_dequeue_script( 'wc-chosen' );
			wp_dequeue_script( 'woocommerce' );
			wp_dequeue_script( 'prettyPhoto' );
			wp_dequeue_script( 'prettyPhoto-init' );
			wp_dequeue_script( 'jquery-blockui' );
			wp_dequeue_script( 'jquery-placeholder' );
			wp_dequeue_script( 'fancybox' );
			wp_dequeue_script( 'jqueryui' );
		}
	}

}

// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');

function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	
	ob_start();
	
	?>
	<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>
	<?php
	
	$fragments['a.cart-contents'] = ob_get_clean();
	
	return $fragments;
	
}
	
	
// Sort The checkout form

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
	$fields2['shipping']['shipping_email'] 		= $fields['shipping']['shipping_email'];
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



?>