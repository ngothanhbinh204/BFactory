<?php

/**
 * Simple Walker to add an icon after the anchor if the menu item has children.
 */
class CustomMenuWalker extends Walker_Nav_Menu
{

	/**
	 * Starts the element output.
	 *
	 * @param string   $output Passed by reference. Used to append additional content.
	 * @param WP_Post  $item   Menu item data object.
	 * @param int      $depth  Depth of menu item. Used for padding.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 * @param int      $id     Current item ID.
	 */
	public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
	{
		// Classes (li)
		$classes = empty($item->classes) ? [] : (array) $item->classes;
		$classes_str = implode(' ', array_filter($classes));

		// Open the <li> tag
		$output .= '<li class="' . esc_attr($classes_str) . '">';

		// Menu link attributes
		$attributes  = '';
		if (! empty($item->url)) {
			$attributes .= ' href="' . esc_url($item->url) . '"';
		}
		// Build the anchor title
		$title = apply_filters('the_title', $item->title, $item->ID);

		// Construct the anchor element
		$item_output = '<a' . $attributes . '>';
		$item_output .= $title;
		$item_output .= '</a>';

		if (in_array('menu-item-has-children', $classes, true)) {
			$item_output .= ' <i class="far fa-chevron-down toggle-sub-menu"></i>';
		}

		// Allow other filters to modify the output (e.g., theme or plugin filters)
		$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
	}

	/**
	 * Ends the element output, if needed.
	 *
	 * @param string   $output Passed by reference. Used to append additional content.
	 * @param WP_Post  $item   Page data object. Not used.
	 * @param int      $depth  Depth of menu item. Not Used.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 */
	public function end_el(&$output, $item, $depth = 0, $args = null)
	{
		// Close the <li> tag
		$output .= '</li>';
	}
}
