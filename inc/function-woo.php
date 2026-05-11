<?php

/**
 * Woo - add theme support
 */

add_action('after_setup_theme', 'woocommerce_support');
function woocommerce_support()
{
	add_theme_support('woocommerce');
}

function disable_gutenberg_for_woocommerce($can_edit, $post_type)
{
	if ($post_type === 'product') {
		$can_edit = false;
	}
	return $can_edit;
}
add_filter('use_block_editor_for_post_type', 'disable_gutenberg_for_woocommerce', 10, 2);


// alternatively, use 'title', 'date', 'modified', 'menu_order' or 'price', see wc_products_array_orderby()
function custom_woocommerce_change_sort_order($query)
{
	if (! is_admin() && $query->is_main_query() && (is_shop() || is_product_category() || is_product_tag())) {
		// Change the sort order to your preferred setting
		$query->set('orderby', 'date');  // Options: 'date', 'title', 'price', 'rand', etc.
		$query->set('order', 'DESC');    // Options: 'ASC' or 'DESC'
	}
}
add_action('pre_get_posts', 'custom_woocommerce_change_sort_order');

// change quantity of product per page
add_filter('loop_shop_per_page', function () {
	return 12;
}, 20);

add_filter('facetwp_facet_pager_link', function ($html) {
	return str_replace(['<a', '/a>'], ['<li><a', '/a></li>'], $html);
});

add_filter('woocommerce_format_sale_price', 'invert_formatted_sale_price', 10, 3);

function invert_formatted_sale_price($price_html, $regular_price, $sale_price)
{
	// Ensure prices are numeric before formatting, or use them as is if already formatted (e.g., by other plugins)
	$regular_price_formatted = is_numeric($regular_price) ? wc_price($regular_price) : $regular_price;
	$sale_price_formatted = is_numeric($sale_price) ? wc_price($sale_price) : $sale_price;

	// Construct the new price HTML with sale price first
	$price_html = '<span class="sale-price">' . $sale_price_formatted . '</span> <del class="regular-price">' . $regular_price_formatted . '</del>';

	return $price_html;
}

/**
 * Tính toán và trả về phần trăm giảm giá của sản phẩm.
 *
 * @param WC_Product $product Đối tượng sản phẩm.
 * @return string|null Chuỗi phần trăm giảm giá (ví dụ: "-30%") hoặc null nếu không có giảm giá.
 */
function get_product_discount_percentage($product)
{
	if (! $product->is_on_sale() || ! $product->get_regular_price() || ! $product->get_sale_price()) {
		return null;
	}

	$regular_price = floatval($product->get_regular_price());
	$sale_price    = floatval($product->get_sale_price());

	if ($regular_price <= $sale_price) { // Đảm bảo giá gốc lớn hơn giá sale
		return null;
	}

	$discount_percentage = round((($regular_price - $sale_price) / $regular_price) * 100);

	if ($discount_percentage > 0) {
		return '-' . $discount_percentage . '%';
		// Hoặc bạn có thể trả về chỉ số: return $discount_percentage;
		// Và thêm dấu '-' và '%' khi hiển thị
	}

	return null;
}


/**
 * Theo dõi sản phẩm người dùng đã xem và lưu vào cookie.
 */
function vnsa_track_product_view()
{
	// Chỉ chạy trên trang chi tiết sản phẩm
	if (! is_product()) {
		return;
	}

	global $post;
	$product_id = $post->ID;

	// Nếu sản phẩm không có ID (trường hợp hiếm) thì bỏ qua
	if (empty($product_id)) {
		return;
	}

	$cookie_name = 'woocommerce_recently_viewed';
	$viewed_products = array();
	$limit = 10; // Số lượng sản phẩm đã xem tối đa muốn lưu trữ

	// Lấy danh sách sản phẩm đã xem từ cookie nếu có
	if (isset($_COOKIE[$cookie_name])) {
		// stripslashes() được dùng vì wc_setcookie có thể thêm Slashes
		$viewed_products = json_decode(stripslashes($_COOKIE[$cookie_name]), true);
		// Đảm bảo $viewed_products luôn là một mảng
		if (! is_array($viewed_products)) {
			$viewed_products = array();
		}
	}

	// Loại bỏ sản phẩm hiện tại khỏi danh sách nếu nó đã tồn tại (để đưa lên đầu)
	if (($key = array_search($product_id, $viewed_products)) !== false) {
		unset($viewed_products[$key]);
	}

	// Thêm sản phẩm hiện tại vào đầu danh sách
	array_unshift($viewed_products, $product_id);

	// Giới hạn số lượng sản phẩm trong danh sách
	$viewed_products = array_slice($viewed_products, 0, $limit);

	// Lưu lại vào cookie trong 30 ngày
	// wc_setcookie sẽ tự động xử lý COOKIEPATH, COOKIE_DOMAIN
	wc_setcookie($cookie_name, json_encode($viewed_products), time() + (86400 * 30));
}
add_action('template_redirect', 'vnsa_track_product_view'); // Hook 'template_redirect' chạy sớm và phù hợp


/**
 * Lấy danh sách ID các sản phẩm người dùng đã xem từ cookie.
 *
 * @param int $limit Số lượng ID sản phẩm tối đa muốn lấy.
 * Mặc định là 5. Nếu đặt là 0 hoặc số âm, sẽ lấy tất cả ID có trong cookie (theo giới hạn đã đặt trong hàm track).
 * @return array Mảng chứa ID sản phẩm đã xem (đã được sắp xếp từ mới nhất đến cũ nhất),
 * hoặc mảng rỗng nếu không có sản phẩm nào hoặc cookie không tồn tại.
 */
function get_recently_viewed_product_ids($limit = 10)
{
	$cookie_name = 'woocommerce_recently_viewed'; // Tên cookie này PHẢI GIỐNG với tên cookie trong hàm vnsa_track_product_view
	$viewed_product_ids = array();

	if (isset($_COOKIE[$cookie_name])) {
		// stripslashes() được dùng vì wc_setcookie có thể thêm slashes
		$saved_ids = json_decode(stripslashes($_COOKIE[$cookie_name]), true);

		if (is_array($saved_ids) && ! empty($saved_ids)) {
			// Đảm bảo tất cả ID là số nguyên để bảo mật và tương thích query
			$viewed_product_ids = array_map('intval', $saved_ids);

			// Áp dụng giới hạn nếu $limit được đặt và là số dương
			if (is_numeric($limit) && $limit > 0) {
				$viewed_product_ids = array_slice($viewed_product_ids, 0, $limit);
			}
			// Nếu $limit <= 0, hàm sẽ trả về toàn bộ ID có trong cookie (đã được giới hạn bởi hàm track)
		}
	}
	return $viewed_product_ids;
}

function remove_single_product_summary_hooks()
{
	// Remove product title (priority 5)
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);

	// Remove product rating (priority 10)
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);

	// Remove product price (priority 10)
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);

	// Remove product excerpt (priority 20)
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);

	// NOTE: We do NOT remove the Add to Cart (priority 30)

	// Remove product meta (priority 40)
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

	// Remove product sharing (priority 50)
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);
}

/**
 * Hook our removal function into `woocommerce_single_product_summary` at a lower priority.
 * Using priority 1 ensures it runs before the default hooks are executed.
 */
add_action('woocommerce_single_product_summary', 'remove_single_product_summary_hooks', 1);
