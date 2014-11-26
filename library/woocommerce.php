<?php

/*******************************************
	W O O C O M M E R C E   T H I N G S 


WooCommerce Functions
Author: Andrew Lazarus

This is where all the woocommerce helpers are. They should all be helpful to the point where
when this file is activated, nothing'll change. Nothing EXCEPT WHAT NEDS TO CHANGE! MWHAHAHAHA

*******************************************/

add_theme_support( 'woocommerce' );

require_once( 'woocommerce_extras/ajax-cart.php' ); 	// AJAX CART
require_once( 'woocommerce_extras/add-to-cart.php' ); 	// iAdd to cart on the front page
require_once( 'woocommerce_extras/custom_woo.php' ); 	// Custom woocommerce CSS in /library/css/woocommerce.css
require_once( 'woocommerce_extras/fuck-off-js.php' ); 	// Removes woocommerce js on pages its not needed
require_once( 'woocommerce_extras/clean-tabs.php' ); 	// Removes Tabs on product page

/*
	Note reguarding checkout page.
	
	You need to create another header/footer and remove all the links from them. 
	
	get_header('checkout');
	get_footer('checkout');
	
	This will create a purchase trap that stops the user from getting distracted and leaving the site. It's the same practise that amazon have taken up. 
	
*/