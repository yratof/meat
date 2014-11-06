<?php

/**
* start the customisation
*/
function custom_woo_before_shop_link() {
    add_filter('woocommerce_loop_add_to_cart_link', 'custom_woo_loop_add_to_cart_link', 10, 2);
    add_action('woocommerce_after_shop_loop', 'custom_woo_after_shop_loop');
}
add_action('woocommerce_before_shop_loop', 'custom_woo_before_shop_link');

/**
* customise Add to Cart link/button for product loop
* @param string $button
* @param object $product
* @return string
*/
function custom_woo_loop_add_to_cart_link($button, $product) {
    // not for variable, grouped or external products
    if (!in_array($product->product_type, array('variable', 'grouped', 'external'))) {
        // only if can be purchased
        if ($product->is_purchasable()) {
            // show qty +/- with button
            ob_start();
            woocommerce_simple_add_to_cart();
            $button = ob_get_clean();

            // modify button so that AJAX add-to-cart script finds it
            $replacement = sprintf('data-product_id="%d" data-quantity="1" $1 add_to_cart_button product_type_simple ', $product->id);
            $button = preg_replace('/(class="single_add_to_cart_button)/', $replacement, $button);
        }
    }

    return $button;
}

/**
* add the required JavaScript
*/
function custom_woo_after_shop_loop() {
    ?>

    <script>
    jQuery(function($) {

    <?php /* when product quantity changes, update quantity attribute on add-to-cart button */ ?>
    $(".basket-count").on("change", "input.qty", function() {
        $(this.form).find("button[data-quantity]").attr("data-quantity", this.value);
    });

    <?php /* remove old "view cart" text, only need latest one thanks! */ ?>
    $(document.body).on("adding_to_cart", function() {
        $("a.added_to_cart").remove();
    });

    });
    </script>

    <?php
}
