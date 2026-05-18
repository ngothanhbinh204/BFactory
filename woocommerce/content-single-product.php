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
$product_advantages = get_field("product_advantages", $product->get_id());
$video_guide_list = get_field("video_guide_list", $product->get_id());

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


<section class="section-product-detail">
	<div class="container">
		<div class="product-detail-layout">
			<div class="product-gallery woocommerce-product-gallery">
				<div class="product-gallery__top">
					<div class="product-gallery__thumbs swiper" data-gallery-thumbs>
						<div class="swiper-wrapper">
							<?php 
                            $attachment_ids = $product->get_gallery_image_ids();
                            $featured_id = $product->get_image_id();
                            $all_images = array_merge(array($featured_id), $attachment_ids);
                            foreach($all_images as $img_id): 
                                if(!$img_id) continue;
                                $img_url = wp_get_attachment_image_url($img_id, 'medium');
                            ?>
							<div class="swiper-slide">
								<div class="product-thumb">
									<div class="img-ratio ratio:pt-[1_1]"><img class="lozad"
											data-src="<?= esc_url($img_url) ?>" alt="" /></div>
								</div>
							</div>
							<?php endforeach; ?>
						</div>
					</div>
					<div class="product-gallery__slider-frame">
						<div class="product-gallery__slider swiper" data-gallery-main>
							<div class="swiper-wrapper">
								<?php 
                                foreach($all_images as $img_id): 
                                    if(!$img_id) continue;
                                    $img_full = wp_get_attachment_image_url($img_id, 'full');
                                ?>
								<div class="swiper-slide">
									<a class="gallery-slide-link" href="<?= esc_url($img_full) ?>"
										data-fancybox="product-gallery" aria-label="Xem ảnh lớn">
										<div class="img-ratio ratio:pt-[1_1]"><img class="lozad"
												data-src="<?= esc_url($img_full) ?>" alt="" /></div>
									</a>
								</div>
								<?php endforeach; ?>
							</div>
							<div class="wrapper-controll">
								<button
									class="btn btn-slide btn-swiper-prev btn-product-prev btn-slide-inner btn-slide"><i
										class="fa-regular fa-angle-left"></i></button>
								<button
									class="btn btn-slide btn-swiper-next btn-product-next btn-slide-inner btn-slide"><i
										class="fa-regular fa-angle-right"></i></button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="product-detail-info entry-summary">
				<h1 class="product_title entry-title"><?= $product->get_name() ?></h1>
				<div class="product-detail-badges">
					<?php if ($product->is_on_sale()) : ?>
					<span class="badge-discount"><?php echo get_product_discount_percentage($product) ?></span>
					<?php endif; ?>
					<?php if ($product->is_featured()) : ?>
					<span class="badge-bestseller">
						<?php _e('bestseller', 'canhcamtheme') ?>
					</span>
					<?php endif; ?>
				</div>

				<div class="product-detail-price price">
					<?= bfactory_get_dual_price_html($product) ?>
				</div>

				<div class="divider"></div>
				<div class="product-detail-desc woocommerce-product-details__short-description">
					<?= apply_filters('the_content', $product->get_description()) ?>
				</div>

				<?php if ($product_advantages) : ?>
				<div class="product-advantages">
					<div class="product-advantages__header">Ưu điểm</div>
					<div class="product-advantages__body">
						<ul>
							<?php foreach ($product_advantages as $item) : 
								$advantage = $item['advantage'];
							?>
							<li><?= wp_kses_post($advantage) ?></li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
				<?php endif; ?>

				<form class="cart product-actions" method="post" enctype='multipart/form-data'>
					<button class="btn btn-primary-outline btn-add-to-cart add_to_cart_button" type="submit"
						name="add-to-cart" value="<?= esc_attr($product->get_id()); ?>">
						<span>Thêm vào giỏ hàng</span><i class="fa-regular fa-cart-shopping"></i>
					</button>
					<a class="btn btn-primary btn-buy-now"
						href="?add-to-cart=<?= esc_attr($product->get_id()); ?>&buy_now=1">
						<span>Mua ngay</span><i class="fa-regular fa-arrow-right"></i>
					</a>
				</form>
			</div>
		</div>
	</div>
</section>

<?php if ($video_guide_list): ?>
<section class="section-video-guide">
	<div class="container">
		<h2 class="section-title h30"><strong>VIDEO</strong> HƯỚNG DẪN LẮP ĐẶT</h2>
	</div>
	<div class="video-guide-outer">
		<div class="swiper swiper-video-guide">
			<div class="swiper-wrapper">
				<?php foreach($video_guide_list as $video): 
							$video_url = $video['video_url'];
							$thumbnail = $video['video_thumbnail'];
						?>
				<div class="swiper-slide">
					<a class="video-guide-item" href="<?= esc_url($video_url) ?>" data-fancybox="video-guide"
						data-type="iframe">
						<div class="img-ratio ratio:pt-[600_1170]">
							<?php if ($thumbnail): ?>
							<img class="lozad" data-src="<?= esc_url($thumbnail['url']) ?>"
								alt="<?= esc_attr($thumbnail['alt']) ?>" />
							<?php endif; ?>
						</div>
					</a>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
		<div class="wrapper-controll">
			<button class="btn btn-slide btn-swiper-prev btn-video-prev btn-slide-1 btn-slide"><i
					class="fa-regular fa-angle-left"></i></button>
			<button class="btn btn-slide btn-swiper-next btn-video-next btn-slide-1 btn-slide"><i
					class="fa-regular fa-angle-right"></i></button>
		</div>
	</div>
</section>
<?php endif; ?>

<?php if ($productOtherQuery->have_posts()): ?>
<section class="section-related-products related products">
	<div class="container">
		<h2 class="section-title h30"><strong>SẢN PHẨM</strong> LIÊN QUAN</h2>
		<div class="related-products-wrap">
			<div class="swiper swiper-related">
				<div class="swiper-wrapper">
					<?php while ($productOtherQuery->have_posts()) : $productOtherQuery->the_post(); ?>
					<div class="swiper-slide">
						<?php wc_get_template_part("content", "product"); ?>
					</div>
					<?php endwhile; wp_reset_postdata(); ?>
				</div>
			</div>
			<button class="btn btn-slide btn-related-prev"><i class="fa-regular fa-angle-left"></i></button>
			<button class="btn btn-slide btn-related-next"><i class="fa-regular fa-angle-right"></i></button>
		</div>
	</div>
</section>
<?php endif; ?>
<?php get_template_part('template-parts/section/home-help'); ?>