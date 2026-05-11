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
<article class="product-item">
	<a class="product-item__thumb" href="<?= get_the_permalink($product->get_id()) ?>">
		<div class="product-item__img img-ratio ratio:pt-[1_1]">
            <img class="lozad" data-src="<?= get_the_post_thumbnail_url($product->get_id(), 'full') ?>" alt="<?= esc_attr($product->get_name()) ?>" />
		</div>
	</a>
	<div class="product-item__body">
		<div class="summary">
            <a class="product-item__name" href="<?= get_the_permalink($product->get_id()) ?>">
                <?= $product->get_name() ?>
            </a>
			<div class="product-item__badges">
                <?php if ($product->is_on_sale()) : ?>
                <span class="badge-discount"><?php echo get_product_discount_percentage($product) ?></span>
                <?php endif; ?>
                <?php if ($product->is_featured()) : ?>
                <span class="badge-bestseller">bestseller</span>
                <?php endif; ?>
			</div>
            <?php if (!$no_price) : ?>
                <?= bfactory_get_dual_price_html($product) ?>
            <?php endif; ?>
		</div>
		<ul class="product-item__specs">
            <?php 
            $manufacturer = get_field('product_manufacturer', $product->get_id()) ?: 'Vingroup';
            $origin = get_field('product_origin', $product->get_id()) ?: 'Made in Viet Nam';
            $sku = $product->get_sku() ?: 'N/A';
            ?>
			<li><i class="fa-solid fa-check"></i><span>Nhà sản xuất: <?= esc_html($manufacturer) ?></span></li>
			<li><i class="fa-solid fa-check"></i><span>Mã sản phẩm: <?= esc_html($sku) ?></span></li>
			<li><i class="fa-solid fa-check"></i><span><?= esc_html($origin) ?></span></li>
		</ul>
	</div>
</article>
<!-- do_action('woocommerce_after_shop_loop_item_title'); -->
<!-- do_action('woocommerce_after_shop_loop_item'); -->