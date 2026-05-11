<?php

/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
// do_action('woocommerce_before_single_product');

if (post_password_required()) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>

<?php
$product_gallery = get_field("product_gallery", $product->get_id());
$product_technical_stat = get_field("product_technical_stat", $product->get_id());
$product_tab = get_field("product_tab", $product->get_id());
$faq_list = get_field("faq_list", $product->get_id());
$related_products = get_field("related_products", $product->get_id());

$productOtherQuery = new WP_Query(array(
	"post_type" => "product",
	"post__not_in" => array($product->get_id()),
	"posts_per_page" => 10,
	"orderby" => "date",
	"order" => "DESC",
	"tax_query" => array(
		array(
			"taxonomy" => "product_cat",
			"field" => "term_id",
			"terms" => $product->get_category_ids(),
		),
	),
));
?>


<section <?php wc_product_class('section-large ', $product); ?>>
	<div class="container">
		<div class="row">
			<div class="col-lg-7">
				<?php if ($product_gallery) : ?>
					<div class="product-image-slider-wrap">
						<div class="product-detail-thumbnail position-relative">
							<div class="swiper">
								<div class="swiper-wrapper">
									<?php foreach ($product_gallery as $item) : ?>
										<?php
										$video_url = $item["video_url"];
										?>
										<div class="swiper-slide">
											<figure class="<?php echo $video_url ? "has-video" : "" ?>">
												<?php echo field_image($item["image"], "full") ?>
												<?php if ($video_url) : ?>
													<div class="icon-play">
														<i class="fas fa-play"></i>
													</div>
												<?php endif; ?>
											</figure>
										</div>
									<?php endforeach; ?>
								</div>
							</div>
						</div>
						<div class="product-detail-images">
							<div class="swiper">
								<div class="swiper-wrapper">
									<?php foreach ($product_gallery as $item) : ?>
										<?php
										$video_url = $item["video_url"];
										$format_youtube_url = convert_youtube_url_to_embed($video_url);
										?>
										<div class="swiper-slide">
											<figure class="<?php echo $video_url ? "has-video" : "" ?>">
												<?php if ($video_url) : ?>
													<iframe src="<?php echo $format_youtube_url ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
												<?php else : ?>
													<?php echo field_image($item["image"], "full") ?>
												<?php endif; ?>
											</figure>
										</div>
									<?php endforeach; ?>
								</div>
							</div>
							<div class="swiper-navigation d-flex gap-6">
								<div class="swiper-btn swiper-btn-prev">
									<i class="far fa-arrow-left"></i>
								</div>
								<div class="swiper-btn swiper-btn-next">
									<i class="far fa-arrow-right"></i>
								</div>
							</div>
						</div>
					</div>
				<?php endif; ?>
			</div>
			<div class="col-lg-5">
				<h1 class="heading-4 font-bold text-uppercase">
					<?php echo $product->get_name() ?>
				</h1>
				<div class="body-3 font-medium text-secondary-500 mt-4">
					<?php echo $product->get_short_description() ?>
				</div>
				<div class="body-2 mt-5 article-content">
					<?php echo $product->get_description() ?>
				</div>
				<?php if ($product_technical_stat) : ?>
					<div class="product-detail-stat mt-5">
						<?php foreach ($product_technical_stat as $item) : ?>
							<div class="stat-item">
								<div class="title">
									<?php echo $item["title"] ?>
								</div>
								<div class="value">
									<?php echo $item["content"] ?>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
				<?php if ($product->get_price() != 0) : ?>
					<div class="product-detail-price mt-5">
						<?php if ($product->is_on_sale()) : ?>
							<?php echo $product->get_price_html(); ?>
							<div class="product-item-percentage">
								<?php echo get_product_discount_percentage($product) ?>
							</div>
						<?php else : ?>
							<div class="heading-5 font-bold text-primary-3">
								<?php echo $product->get_price_html(); ?>
							</div>
						<?php endif; ?>
					</div>
				<?php endif; ?>
				<div class="product-detail-action mt-6">
					<?php do_action('woocommerce_single_product_summary'); ?>
				</div>
				<div class="product-detail-share mt-6 pt-5 border-t-1 border-solid border-secondary-200">
					<div class="social-list d-flex items-center gap-6">
						<div class="body-3">
							<?= __("Theo dõi ngay:", "canhcamtheme") ?>
						</div>
						<ul class="hstack gap-3">
							<li>
								<a href="https://www.facebook.com/sharer/sharer.php?u=<?= get_the_permalink() ?>" target="_blank">
									<span class="fab fa-facebook-f"></span>
								</a>
							</li>
							<li>
								<a href="javascript:void(0)" class="copy-link">
									<span class="far fa-copy"></span>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<?php if ($product_tab || $faq_list) : ?>
			<div class="product-detail-bottom">
				<div class="row">
					<div class="col-lg-9">
						<div class="product-detail-tab tabnav" data-toggle="tab" data-target="#product-detail-tab">
							<ul>
								<?php if ($product_tab) : ?>
									<?php foreach ($product_tab as $key => $item) : ?>
										<li>
											<a href="#tab-<?= $key + 1 ?>">
												<?= $item["title"] ?>
											</a>
										</li>
									<?php endforeach; ?>
								<?php endif; ?>
								<?php if ($faq_list) : ?>
									<li>
										<a href="#tab-faq">
											<?= __("Q&A", "canhcamtheme") ?>
										</a>
									</li>
								<?php endif; ?>
							</ul>
						</div>
						<div id="product-detail-tab" class="mt-6">
							<?php if ($product_tab) : ?>
								<?php foreach ($product_tab as $key => $item) : ?>
									<div class="tab-content p-lg-10 p-8 bg-secondary-50" id="tab-<?= $key + 1 ?>">
										<div class="heading-5 font-bold mb-4">
											<?= $item["title"] ?>
										</div>
										<div class="article-content body-2">
											<?= $item["content"] ?>
										</div>
									</div>
								<?php endforeach; ?>
							<?php endif; ?>
							<?php if ($faq_list) : ?>
								<div class="tab-content p-lg-10 p-8 bg-secondary-50" id="tab-faq">
									<div class="heading-5 font-bold mb-4">
										<?= __("Q&A", "canhcamtheme") ?>
									</div>
									<div class="faq-list vstack gap-4 " data-toggle="accordion" data-active-index="0">
										<?php foreach ($faq_list as $item) : ?>
											<div class="accordion-item faq-item">
												<div class="accordion-trigger d-flex items-start justify-between body-1 font-bold">
													<div class="title">
														<span class="text"><?= $item["title"] ?></span>
													</div>
													<div class="icon ">
														<em class="far fa-plus"></em>
													</div>
												</div>
												<div class="accordion-content">
													<div class="body-2 article-content">
														<?= $item["content"] ?>
													</div>
												</div>
											</div>
										<?php endforeach; ?>
									</div>
								</div>
							<?php endif; ?>
						</div>
					</div>
					<div class="col-lg-3">
						<?php if ($related_products) : ?>
							<div class="heading-5 font-bold mb-lg-10 mb-6">
								<?= __("Có thể bạn quan tâm", "canhcamtheme") ?>
							</div>
							<div class="row equal-height related-products">
								<?php foreach ($related_products as $id) : ?>
									<div class="col-lg-12 col-6">
										<?php get_template_part("./woocommerce/content", "product", array("productID" => $id, "no-price" => true)); ?>
									</div>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</div>
</section>

<?php if ($productOtherQuery->have_posts()) : ?>
	<section class="section-large bg-secondary-50">
		<div class="container">
			<div class="heading-4 font-bold mb-lg-10 mb-6 text-center ">
				<?= __("Sản phẩm khác", "canhcamtheme") ?>
			</div>
			<div class="quadruple-slider swiper-equal-height position-relative">
				<div class="swiper">
					<div class="swiper-wrapper">
						<?php while ($productOtherQuery->have_posts()) : $productOtherQuery->the_post(); ?>
							<div class="swiper-slide">
								<?php wc_get_template_part("content", "product"); ?>
							</div>
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
					</div>
				</div>
				<div class="swiper-navigation is-between">
					<div class="swiper-btn swiper-btn-prev">
						<i class="far fa-arrow-left"></i>
					</div>
					<div class="swiper-btn swiper-btn-next">
						<i class="far fa-arrow-right"></i>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php
$viewed_product_ids = get_recently_viewed_product_ids(10);
?>

<?php if ($viewed_product_ids) : ?>
	<section class="section-large">
		<div class="container">
			<div class="heading-4 font-bold mb-lg-10 mb-6 text-center">
				<?= __("Sản phẩm đã xem", "canhcamtheme") ?>
			</div>
			<div class="quadruple-slider position-relative  swiper-equal-height">
				<div class="swiper">
					<div class="swiper-wrapper">
						<?php foreach ($viewed_product_ids as $id) : ?>
							<div class="swiper-slide">
								<?php get_template_part("./woocommerce/content", "product", array("productID" => $id)); ?>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="swiper-navigation is-between">
					<div class="swiper-btn swiper-btn-prev">
						<i class="far fa-arrow-left"></i>
					</div>
					<div class="swiper-btn swiper-btn-next">
						<i class="far fa-arrow-right"></i>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>

<div class="product-detail-modal" id="product-detail-modal" style="display: none;">
	<div class="heading-4 section-title font-bold mb-5">
		<?php the_title() ?>
	</div>
	<div class="form-product-detail body-3">
		<?php echo do_shortcode('[contact-form-7 id="4b2e199" title="Form sản phẩm"]') ?>
	</div>
</div>