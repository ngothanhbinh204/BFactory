<?php
if (!function_exists('glw_custom_pagination')) {
	function glw_custom_pagination(WP_Query $wp_query = null, $echo = true)
	{
		if ($wp_query === null) {
			global $wp_query;
		}
		$pages = paginate_links(
			array(
				'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
				'format' => '?paged=%#%',
				'current' => max(1, get_query_var('paged')),
				'total' => $wp_query->max_num_pages,
				'type' => 'array',
				'show_all' => false,
				'end_size' => 2,
				'mid_size' => 1,
				'prev_next' => false,
				'prev_text' => '<i class="fal fa-chevron-left"></i>',
				'next_text' => '<i class="fal fa-chevron-right"></i>',
				'add_args' => false,
				'add_fragment' => ''
			)
		);
		if (is_array($pages)) {
			$pagination = '<div class="pager"><ul class="pagination">';
			foreach ($pages as $page) {
				$pagination .= '<li' . (strpos($page, 'current') !== false ? ' class="active" ' : '') . '>';

				// Find the page number from the link
				preg_match("/\b\d+\b/", strip_tags($page), $matches);
				$page_number = isset($matches[0]) ? $matches[0] : 1;

				// Adding leading zero to the page number if it is less than 10
				$page_number_with_zero = str_pad($page_number, 2, '0', STR_PAD_LEFT);

				if (strpos($page, 'current') !== false) {
					$pagination .= '<a>' . $page_number_with_zero . '</a>';
				} else {
					// Replace the page number with the padded one
					$page = preg_replace("/\b\d+\b/", $page_number_with_zero, $page);
					$pagination .= str_replace('class="page-numbers"', '', $page);
				}

				$pagination .= '</li>';
			}
			$pagination .= '</ul></div>';
			if ($echo === true) {
				echo $pagination;
			} else {
				return $pagination;
			}
		}
		return null;
	}
}