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

<section class="section-large overflow-hidden">
	<div class="container">
		<div class="row">
			<div class="col-lg-3">
				<div class="filter-list">
					<div class="filter-item">
						<div class="filter-item-title d-flex items-center justify-between mb-4">
							<span class="heading-5 font-bold">
								<?= __('Theo Thương hiệu', 'canhcamtheme') ?>
							</span>
							<em class="fal fa-chevron-up"></em>
						</div>
						<div class="filter-item-content">
							<?php echo do_shortcode('[facetwp facet="filter_brand"]') ?>
						</div>
					</div>
					<div class="filter-item">
						<div class="filter-item-title d-flex items-center justify-between mb-4">
							<span class="heading-5 font-bold">
								<?= __('Theo Dòng xe', 'canhcamtheme') ?>
							</span>
							<em class="fal fa-chevron-up"></em>
						</div>
						<div class="filter-item-content">
							<?php echo do_shortcode('[facetwp facet="filter_car_type"]') ?>
						</div>
					</div>
					<div class="filter-item">
						<div class="filter-item-title d-flex items-center justify-between mb-4">
							<span class="heading-5 font-bold">
								<?= __('Theo giá', 'canhcamtheme') ?>
							</span>
							<em class="fal fa-chevron-up"></em>
						</div>
						<div class="filter-item-content">
							<?php echo do_shortcode('[facetwp facet="filter_price"]') ?>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-9">
				<div class="d-flex product-list-toolbar gap-lg-10 gap-4 justify-lg-end mb-5">
					<div class="product-sort">
						<span class="body-1">
							<?= __('Chế độ xem', 'canhcamtheme') ?>
						</span>
						<?php echo do_shortcode('[facetwp facet="display_mode"]') ?>
					</div>
					<div class="product-sort is-sort">
						<span class="body-1">
							<?= __('Sắp xếp', 'canhcamtheme') ?>
						</span>
						<?php echo do_shortcode('[facetwp facet="sort_by"]') ?>
					</div>
				</div>
				<div class="body-1 mb-lg-8 mb-6">
					<?php echo $term_description ?>
				</div>
				<div class="row equal-height">
					<?php
					if (wc_get_loop_prop('total')) {
						while (have_posts()) {
							the_post();

							do_action('woocommerce_shop_loop');

							echo '<div class="col-md-4 col-6">';
							wc_get_template_part('content', 'product');
							echo '</div>';
						}
					}
					?>
				</div>
				<?php echo do_shortcode('[facetwp facet="pagination"]') ?>
			</div>
		</div>
	</div>
</section>




<?php
get_footer();
?>