<?php

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

defined('ABSPATH') || exit;

get_header();
?>
<?php get_template_part("./modules/common/banner") ?>

<?php
$term_description = term_description();
?>

<section class="section-product-list">
	<div class="container">
		<div class="product-layout">
			<aside class="product-sidebar">
				<div class="filter-group filter-item" data-filter-group>
					<button class="filter-group__toggle filter-item-title" type="button"
						aria-expanded="true"><span><?= __('Theo thương hiệu', 'canhcamtheme') ?></span><i
							class="fa-regular fa-chevron-down"></i></button>
					<div class="filter-group__body filter-item-content">
						<?php echo do_shortcode('[facetwp facet="brands"]') ?>
					</div>
				</div>
				<div class="filter-group filter-item" data-filter-group>
					<button class="filter-group__toggle filter-item-title" type="button"
						aria-expanded="true"><span><?= __('Theo dòng xe', 'canhcamtheme') ?></span><i
							class="fa-regular fa-chevron-down"></i></button>
					<div class="filter-group__body filter-item-content">
						<?php echo do_shortcode('[facetwp facet="categories_product"]') ?>
					</div>
				</div>
				<div class="filter-group filter-item" data-filter-group>
					<button class="filter-group__toggle filter-item-title" type="button"
						aria-expanded="true"><span><?= __('Theo giá', 'canhcamtheme') ?></span><i
							class="fa-regular fa-chevron-down"></i></button>
					<div class="filter-group__body filter-item-content">
						<div class="filter-price">

							<?php echo do_shortcode('[facetwp facet="filter_price"]') ?>

							<div class="filter-price__display">
								<div class="filter-price__val is-min"></div>
								<div class="filter-price__val is-max"></div>
							</div>

						</div>

					</div>
				</div>
			</aside>
			<div class="product-main">
				<div class="product-head">
					<h1 class="product-heading"><?php woocommerce_page_title(); ?></h1>
					<div class="product-sort">
						<span class="product-sort__label"><?= __('Sắp xếp', 'canhcamtheme') ?></span>
						<div class="sort-dropdown" data-sort-dropdown>
							<?php echo do_shortcode('[facetwp facet="sort_by"]') ?>
						</div>
					</div>
				</div>
				<?php if ($term_description) : ?>
				<div class="body-1 mb-lg-8 mb-6">
					<?php echo $term_description ?>
				</div>
				<?php endif; ?>
				<div class="facetwp-template">
					<div class="spinner-loading"></div>
					<div class="product-grid">
						<?php
						if (wc_get_loop_prop('total')) {
							while (have_posts()) {
								the_post();
								do_action('woocommerce_shop_loop');
								echo '<div class="product-grid__item">';
								wc_get_template_part('content', 'product');
								echo '</div>';
							}
						}
						?>
					</div>
				</div>
				<div class="facetwp-pager">
					<?php echo do_shortcode('[facetwp facet="pagination"]') ?>
				</div>
			</div>
		</div>
	</div>
</section>




<?php
get_footer();
?>