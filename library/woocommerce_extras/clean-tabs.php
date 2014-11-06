<?php 
	
// Remove Reviews from the tabs on a single_product_page
add_filter( 'woocommerce_product_tabs', '_remove_reviews_tab', 98 );
function _remove_reviews_tab( $tabs ) {
  unset( $tabs[ 'reviews' ] );
  unset( $tabs[ 'additional_information' ] );
  return $tabs;
