<?php

function override_mce_options($initArray)
{
	$opts = '*[*]';
	$initArray['valid_elements'] = $opts;
	$initArray['extended_valid_elements'] = $opts;

	return $initArray;
}

add_filter('tiny_mce_before_init', 'override_mce_options');

function dateFormatOnLayout($id)
{
	$day = get_the_date("d", $id);
	$month = get_the_date("m", $id);
	$year = get_the_date("Y", $id);
	$language_active = do_shortcode('[language]');

	if ($language_active == 'vi') {
		$dateFormat = $day . '/' . $month . '/' . $year;
	} else {
		$dateFormat = $month . '/' . $day . '/' . $year;
	}
	return $dateFormat;
}

function get_top_parent_term($term, $taxonomy)
{
	// Start from the current term
	$parent_term = get_term($term, $taxonomy);

	// Climb up the hierarchy until we reach the top
	while ($parent_term->parent != 0) {
		$parent_term = get_term($parent_term->parent, $taxonomy);
	}

	return $parent_term;
}

function acf_group_has_values($acf_group)
{
	if (is_array($acf_group)) {
		foreach ($acf_group as $key => $value) {
			// Check if the value is non-empty (ignoring false/empty strings/arrays)
			if (!empty($value) && $value !== false) {
				return true; // Found a meaningful value
			}
		}
	}
	return false; // All subfields are empty or false
}

function has_child_terms($term_id, $taxonomy)
{
	$child_terms = get_terms([
		'taxonomy' => $taxonomy,
		'parent'   => $term_id,
		'hide_empty' => false, // Set to true if you only want non-empty terms
	]);

	return !empty($child_terms); // Returns true if there are child terms, false otherwise
}

add_filter('facetwp_is_main_query', function ($is_main_query, $query) {
	if ($query->is_archive() && $query->is_main_query()) {
		// Exclude WooCommerce queries
		$is_main_query = true;
	}

	return $is_main_query;
}, 10, 2);


add_filter('facetwp_facet_dropdown_show_counts', '__return_false');
add_filter('facetwp_load_css', '__return_false');

add_filter('facetwp_facet_html', function ($output, $params) {
	$output = preg_replace('/<span class="facetwp-counter">[^<]*<\/span>/', '', $output);
	return $output;
}, 10, 2);

add_action('facetwp_scripts', function () {
?>
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			if ('undefined' !== typeof FWP && 'undefined' !== typeof FWP.hooks) {
				if ('undefined' !== typeof FWP) {
					FWP.hooks.addFilter('facetwp/set_options/slider', function(opts, facet) {

						var suffix = ' ' + FWP.settings[facet.facet_name]['suffix']; // adds a space + the suffix, e.g. m2
						if (facet.facet_name == 'filter_price') { // Change 'price_slider' to your slider facet's name
							opts.tooltips = {
								to: function(value) {
									return value.toLocaleString("vi-VN") + suffix;
								},
								from: function(value) {
									return value.toLocaleString("vi-VN") + suffix;
								}
							};
						}
						return opts;
					});
				}
			}
		});
	</script>
<?php
}, 100);

/**
 * Chuyển đổi URL YouTube "watch" hoặc "youtu.be" sang URL "embed".
 *
 * @param string $youtube_url URL YouTube đầu vào.
 * @return string|false URL "embed" nếu thành công, ngược lại trả về false.
 */
function convert_youtube_url_to_embed($youtube_url)
{
	if (empty($youtube_url)) {
		return false;
	}

	$video_id = '';

	// Biểu thức chính quy (regex) để lấy video ID từ các định dạng URL YouTube phổ biến
	// Hỗ trợ:
	// - youtube.com/watch?v=VIDEO_ID
	// - youtu.be/VIDEO_ID
	// - youtube.com/embed/VIDEO_ID (trường hợp này thì không cần chuyển nữa nhưng vẫn bắt được ID)
	// - youtube.com/v/VIDEO_ID
	$patterns = [
		'/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com|m\.youtube\.com)\/(?:watch\?v=|v\/|embed\/|shorts\/)([a-zA-Z0-9_-]{11})/',
		'/(?:https?:\/\/)?(?:www\.)?youtu\.be\/([a-zA-Z0-9_-]{11})/'
	];

	foreach ($patterns as $pattern) {
		if (preg_match($pattern, $youtube_url, $matches)) {
			if (isset($matches[1])) {
				$video_id = $matches[1];
				break; // Tìm thấy ID, thoát khỏi vòng lặp
			}
		}
	}

	if ($video_id) {
		return 'https://www.youtube.com/embed/' . $video_id;
	}

	return false; // Không tìm thấy video ID hợp lệ
}

add_filter('wpcf7_autop_or_not', '__return_false');

add_filter('facetwp_facet_html', function ($output, $params) {

	if ('dealer_filter' == $params['facet']['name']) { // Replace 'my_hierarchy_select_facet' with the name of your Hierarchy Select facet.
		$selects = explode('<select', $output);
		$output = '';

		if (empty($selects[0])) {
			array_shift($selects);
		}
		$output .= '<div class="row form-group ">';
		foreach ($selects as $index => $select) {
			$output .= '<div class="col-md-4"><select' . $select . '</select></div>';
		}
		$output .= '<div class="form-group col-md-4"><button class="btn btn-primary w-100" type="submit" onclick="FWP.refresh()">Tìm kiếm</button></div>';
		$output .= '</div>';
	}

	return $output;
}, 10, 2);

function bfactory_get_dual_price_html($product) {
    $price_html = '';
    $exchange_rate = get_field('usd_exchange_rate', 'option');
    if (!$exchange_rate) $exchange_rate = 25000;
    
    $price = $product->get_price();
    $regular_price = $product->get_regular_price();
    $sale_price = $product->get_sale_price();
    
    if ('' === $price) return '';

    if ($product->is_on_sale() && $regular_price) {
        $price_vnd = strip_tags(wc_price($sale_price));
        $price_usd = round((float)$sale_price / $exchange_rate, 2) . '$';
        
        $old_price_vnd = strip_tags(wc_price($regular_price));
        $old_price_usd = round((float)$regular_price / $exchange_rate, 2) . '$';

        $price_html = '
            <div class="span price-current">
                <span class="price-current-vnd">' . $price_vnd . '</span> - 
                <span class="price-current-usd">' . $price_usd . '</span>
            </div>
            <span class="price-old">
                <span class="price-old-vnd">' . $old_price_vnd . '</span> - 
                <span class="price-old-usd">' . $old_price_usd . '</span>
            </span>
        ';
    } else {
        $price_vnd = strip_tags(wc_price($price));
        $price_usd = round((float)$price / $exchange_rate, 2) . '$';

        $price_html = '
            <div class="span price-current">
                <span class="price-current-vnd">' . $price_vnd . '</span> - 
                <span class="price-current-usd">' . $price_usd . '</span>
            </div>
        ';
    }

    return '<div class="product-item__price">' . $price_html . '</div>' ;
}


add_shortcode('custom_wpml_switcher', function() {
    // Kiểm tra xem WPML có đang hoạt động không
    if (!function_exists('icl_get_languages')) {
        return '';
    }

    // Lấy danh sách ngôn ngữ từ WPML
    // skip_missing = 0 để hiển thị cả ngôn ngữ chưa có bản dịch (nếu muốn)
    $languages = icl_get_languages('skip_missing=0');

    if (empty($languages)) {
        return '';
    }

    // Tách ngôn ngữ hiện tại và các ngôn ngữ còn lại
    $current_lang = null;
    $other_langs = [];

    foreach ($languages as $l) {
        if ($l['active']) {
            $current_lang = $l;
        } else {
            $other_langs[] = $l;
        }
    }

    ob_start();
    ?>
    <div class="header-language">
        <div class="wpml-ls">
            <ul>
                <?php if ($current_lang): ?>
                <li class="wpml-ls-item wpml-ls-item-<?php echo esc_attr($current_lang['language_code']); ?> wpml-ls-current-language">
                    <a class="wpml-ls-link" href="<?php echo esc_url($current_lang['url']); ?>">
                        <span class="wpml-ls-flag">
                            <img src="<?php echo esc_url($current_lang['country_flag_url']); ?>" alt="<?php echo esc_attr($current_lang['native_name']); ?>" />
                        </span>
                        <span class="wpml-ls-native"><?php echo esc_html(strtoupper($current_lang['language_code'] == 'vi' ? 'VN' : $current_lang['language_code'])); ?></span>
                    </a>
                    
                    <?php if (!empty($other_langs)): ?>
                    <ul class="wpml-ls-sub-menu">
                        <?php foreach ($other_langs as $lang): ?>
                        <li class="wpml-ls-item wpml-ls-item-<?php echo esc_attr($lang['language_code']); ?>">
                            <a class="wpml-ls-link" href="<?php echo esc_url($lang['url']); ?>">
                                <span class="wpml-ls-flag">
                                    <img src="<?php echo esc_url($lang['country_flag_url']); ?>" alt="<?php echo esc_attr($lang['native_name']); ?>" />
                                </span>
                                <span class="wpml-ls-native"><?php echo esc_html(strtoupper($lang['language_code'] == 'vi' ? 'VN' : $lang['language_code'])); ?></span>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
    <?php
    return ob_get_clean();
});
