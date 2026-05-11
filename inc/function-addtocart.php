<?php

function enqueue_custom_js()
{
	wp_enqueue_script('custom-add-to-cart', get_template_directory_uri() . '/scripts/ajaxCart.js', array('jquery'), '', true);
	wp_localize_script('custom-add-to-cart', 'my_ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'enqueue_custom_js');

add_action('wp_ajax_woocommerce_ajax_add_to_cart', 'custom_ajax_add_to_cart_handler');
add_action('wp_ajax_nopriv_woocommerce_ajax_add_to_cart', 'custom_ajax_add_to_cart_handler');

function custom_ajax_add_to_cart_handler()
{
	// Your code to add the product to the cart
	// Don't forget to return a proper response and call wp_die() at the end
	$product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
	$quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
	$variation_id = absint($_POST['variation_id']);
	$passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
	$product_status = get_post_status($product_id);

	if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && 'publish' === $product_status) {
		do_action('woocommerce_ajax_added_to_cart', $product_id);
		if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
			wc_add_to_cart_message(array($product_id => $quantity), true);
		}
		$data = array(
			'success' => true,
			'product_id' => $product_id,
			'product_sku' => '',
			'quantity' => $quantity,
		);
	} else {
		$data = array(
			'error' => true,
			'product_id' => $product_id,
			'product_sku' => '',
			'quantity' => $quantity,
		);
	}

	ob_start();
	woocommerce_mini_cart();
	$mini_cart_html = ob_get_clean();

	// Add to your existing data array
	$data['mini_cart_html'] = $mini_cart_html;

	$cart_contents_count = WC()->cart->get_cart_contents_count();
	$data['cart_contents_count'] = $cart_contents_count;

	wp_send_json($data);
	wp_die();
}
