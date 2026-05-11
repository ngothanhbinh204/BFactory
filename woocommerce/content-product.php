<?php

/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 */

defined('ABSPATH') || exit;

global $product;

// Check if the product is a valid WooCommerce product and ensure its visibility before proceeding.
if (! is_a($product, WC_Product::class) || ! $product->is_visible()) {
	return;
}
if (isset($args["productID"])) {
	$product = wc_get_product($args["productID"]);
}

$no_price = false;
if (isset($args["no-price"]) && $args["no-price"]) {
	$no_price = true;
}
?>
<div class="product-item">
	<a class="product-item-image-wrapper" href="<?= get_the_permalink($product->get_id()) ?>">
		<?php if ($product->is_on_sale()) : ?>
			<div class="product-item-percentage">
				<?php echo get_product_discount_percentage($product) ?>
			</div>
		<?php endif; ?>
		<div class="product-item-image">
			<figure>
				<?= post_thumbnail($product->get_id(), 'full') ?>
			</figure>
		</div>
		<div class="product-item-shadow">
			<img src="<?= get_template_directory_uri() ?>/img/shadow.svg" alt="">
		</div>
	</a>
	<div class="product-item-content text-center mt-5">
		<h3 class="product-item-title body-3 text-uppercase mb-2">
			<a href="<?= get_the_permalink($product->get_id()) ?>">
				<?php echo $product->get_name() ?>
			</a>
		</h3>
		<?php if (!$no_price) : ?>
			<div class="product-item-price">
				<?php if ($product->get_price() == 0) : ?>
					<span class="body-1 font-bold text-primary-4 ">
						<?php _e('Liên hệ', 'canhcamtheme') ?>
					</span>
				<?php else : ?>
					<?php echo $product->get_price_html() ?>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</div>
</div>
<!-- do_action('woocommerce_after_shop_loop_item_title'); -->
<!-- do_action('woocommerce_after_shop_loop_item'); -->