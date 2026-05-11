<?php

/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.9.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_mini_cart'); ?>

<div class="mini-cart-header">
	<a href="#" class="btn-close-cart" tabindex="0">
		<span class="icon">
			<em class="far fa-xmark"></em>
		</span>
	</a>
	<h3 class="heading-4 mb-5 font-bold">
		<em class="far fa-shopping-cart"></em>
		<?php _e('Giỏ hàng', 'canhcamtheme'); ?>
	</h3>
</div>
<div class="mini-cart-content-wrapper">
	<div class="mini-cart-content">
		<?php if (!WC()->cart->is_empty()) : ?>
			<ul class="woocommerce-mini-cart cart_list product_list_widget <?php echo esc_attr($args['list_class']); ?>">
				<?php
				do_action('woocommerce_before_mini_cart_contents');

				foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
					$_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
					$product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

					if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key)) {
						$product_name      = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key);
						$thumbnail         = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);
						$product_price     = apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);
						$product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
						$variation_data = isset($cart_item['variation']) ? $cart_item['variation'] : array();

				?>
						<li class="woocommerce-mini-cart-item <?php echo esc_attr(apply_filters('woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key)); ?>">
							<?php if (empty($product_permalink)) : ?>
								<?php echo $thumbnail;
								?>
							<?php else : ?>
								<a href="<?php echo esc_url($product_permalink); ?>" class="product-thumbnail">
									<?php echo $thumbnail; ?>
								</a>
							<?php endif; ?>
							<div class="product-info">
								<?php echo wc_get_formatted_cart_item_data($cart_item); ?>
								<a href="<?php echo esc_url($product_permalink); ?>" class="product-name">
									<?php echo $product_name;  ?>
								</a>
								<?php
								foreach ($variation_data as $attr_key => $value_slug) {
									// $attr_key will look like 'attribute_pa_color'
									// Strip the 'attribute_' part:
									$taxonomy = str_replace('attribute_', '', $attr_key);

									// Get human-readable attribute name:
									$attribute_label = wc_attribute_label($taxonomy, $_product);

									// If it’s a taxonomy-based attribute (like pa_color), get the term name by slug:
									if ($value_slug && term_exists($value_slug, $taxonomy)) {
										$term = get_term_by('slug', $value_slug, $taxonomy);
										$attribute_value = $term ? $term->name : $value_slug;
									} else {
										// Otherwise, it might be a custom attribute, so just show the raw value
										$attribute_value = $value_slug;
									}

									echo '<p>' . esc_html($attribute_label) . ': ' . esc_html($attribute_value) . '</p>';
								}
								?>
								<?php echo apply_filters('woocommerce_widget_cart_item_quantity', '<span class="quantity body-2 font-medium">' . sprintf('%s &times; %s', $cart_item['quantity'], $product_price) . '</span>', $cart_item, $cart_item_key);
								?>
							</div>


						</li>
				<?php
					}
				}
				do_action('woocommerce_mini_cart_contents');
				?>
			</ul>
		<?php else : ?>
			<div class="cart-empty">
				<p class="cart-empty-icon">
					<svg width="26" viewBox="0 0 26 26" aria-hidden="true">
						<defs>
							<style>
								.path {
									fill: none;
									stroke: #333;
									stroke-miterlimit: 10;
									stroke-width: 1.5px;
								}
							</style>
						</defs>
						<polygon class="path" points="20.4 20.4 5.6 20.4 6.83 10.53 19.17 10.53 20.4 20.4"></polygon>
						<path class="path" d="M9.3,10.53V9.3a3.7,3.7,0,1,1,7.4,0v1.23"></path>
					</svg>
				</p>
				<p>
					<?php _e('Chưa có sản phẩm nào trong giỏ hàng.', 'canhcamtheme'); ?>
				</p>
			</div>

		<?php endif; ?>
	</div>
</div>
<div class="mini-cart-footer">
	<p class="woocommerce-mini-cart__total total mini-footer-totals">
		<?php
		/**
		 * Hook: woocommerce_widget_shopping_cart_total.
		 *
		 * @hooked woocommerce_widget_shopping_cart_subtotal - 10
		 */
		do_action('woocommerce_widget_shopping_cart_total');
		?>
	</p>
	<?php if (!WC()->cart->is_empty()) : ?>
		<?php do_action('woocommerce_widget_shopping_cart_before_buttons'); ?>

		<p class="woocommerce-mini-cart__buttons buttons mini-footer-buttons">
			<a href="<?= get_permalink(get_option('woocommerce_cart_page_id')) ?>" class="btn btn-secondary">
				<span class="btn-inner">
					<?php _e('Xem giỏ hàng', 'canhcamtheme'); ?>
				</span>
			</a>
			<a href="<?= get_permalink(get_option('woocommerce_checkout_page_id')) ?>" class="btn btn-primary">
				<span class="btn-inner">
					<?php _e('Thanh toán', 'canhcamtheme'); ?>
				</span>
			</a>
		</p>

		<?php do_action('woocommerce_widget_shopping_cart_after_buttons'); ?>
	<?php endif; ?>
</div>

<?php do_action('woocommerce_after_mini_cart'); ?>