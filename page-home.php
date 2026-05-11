<?php
/*
Template name: Page - Trang chủ
*/

add_filter('body_class', function ($classes) {
	$classes[] = 'has-banner';
	return $classes;
});

?>
<?php get_header() ?>

<?php

$banner_list = get_field('banner_list');
$section_1 = get_field('section_1');
$section_2 = get_field('section_2');
$section_3 = get_field('section_3');
$section_4 = get_field('section_4');
$section_5 = get_field('section_5');
?>

<section class="section-home-banner">
	<div class="home-banner-slider">
		<div class="swiper">
			<div class="swiper-wrapper">
				<?php foreach ($banner_list as $banner) : ?>
					<?php
					$desktop_image = $banner["image"];
					$mobile_image = $banner["mobile_image"];
					?>
					<div class="swiper-slide">
						<div class="banner-item">
							<div class="banner-item-image">
								<?php if ($mobile_image) : ?>
									<figure class="d-none d-lg-block">
										<img class="w-100 lazy" src="<?= $desktop_image["url"] ?>" alt="<?= $desktop_image["alt"] ?>">
									</figure>
									<figure class="d-block d-lg-none">
										<img class="w-100 lazy" src="<?= $mobile_image["url"] ?>" alt="<?= $mobile_image["alt"] ?>">
									</figure>
								<?php else : ?>
									<figure>
										<img class="w-100 lazy" src="<?= $desktop_image["url"] ?>" alt="<?= $desktop_image["alt"] ?>">
									</figure>
								<?php endif; ?>
							</div>
							<div class="banner-item-content">
								<div class="container">
									<div class="w-lg-5">
										<div class="body-1">
											<?= $banner["sub_title"] ?>
										</div>
										<h2 class="heading-xlarge mt-5 text-uppercase font-bold">
											<?= $banner["title"] ?>
										</h2>
										<?php if ($banner["link"]) : ?>
											<a href="<?= $banner["link"]["url"] ?>" class="btn btn-border-secondary mt-6 mt-lg-10">
												<?= $banner["link"]["title"] ?>
												<em class="fal fa-arrow-right"></em>
											</a>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<div class="swiper-navigation">
			<div class="swiper-btn swiper-btn-prev "><span class="fal fa-arrow-left"></span></div>
			<div class="swiper-btn swiper-btn-next "><span class="fal fa-arrow-right"></span></div>
		</div>
	</div>
</section>

<h1 class="visually-hidden">
	<?php echo get_bloginfo('name') ?>
</h1>

<?php if (acf_group_has_values($section_1)) : ?>
	<?php
	$selected_products = $section_1["selected_products"];
	?>
	<section class="section-large section-home-1">
		<div class="container">
			<div class="w-lg-10 mx-auto mb-lg-10 mb-8">
				<h2 class="section-title text-center heading-2">
					<?= $section_1["title"] ?>
				</h2>
				<div class="body-3 mt-5 text-center article-content">
					<?= $section_1["description"] ?>
				</div>
			</div>

			<div class="row">
				<?php foreach ($selected_products as $productID) : ?>
					<div class="col-lg-4 col-6 product-home-item">
						<?php
						$product = wc_get_product($productID);
						?>
						<?= wc_get_template_part('content', 'product', array('product' => $product)); ?>
					</div>
				<?php endforeach; ?>
			</div>
			<div class="btn-wrap text-center mt-lg-10 mt-8">
				<a href="<?= $section_1["link"]["url"] ?>" class="btn btn-border-secondary">
					<?= $section_1["link"]["title"] ?>
					<em class="fal fa-arrow-right"></em>
				</a>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php if (acf_group_has_values($section_2)) : ?>
	<section class="section-large section-home-2 background-cover lazy" data-bg="<?= $section_2["bg"] ?>">
		<div class="container">
			<div class="row items-center">
				<div class="col-lg-12">
					<h2 class="section-title heading-2">
						<?= $section_2["title"] ?>
					</h2>
					<div class="body-3 mt-5">
						<?= $section_2["description"] ?>
					</div>
					<?php if ($section_2["link"]) : ?>
						<a href="<?= $section_2["link"]["url"] ?>" class="btn btn-border-secondary mt-6 mt-lg-10">
							<?= $section_2["link"]["title"] ?>
							<em class="fal fa-arrow-right"></em>
						</a>
					<?php endif; ?>
				</div>
				<div class="col-lg-12">
					<div class="image">
						<figure>
							<?php echo field_image($section_2["image"], "w-100") ?>
						</figure>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>




<?php if (acf_group_has_values($section_3)) : ?>
	<?php
	$image_list = $section_3["image_list"];
	?>
	<section class="section-large pb-0 section-home-3">
		<div class="container">
			<div class="section-heading">
				<div class="row items-center">
					<div class="col-lg-4">
						<h2 class="section-title heading-2">
							<?= $section_3["title"] ?>
						</h2>
						<div class="logo-image mt-5">
							<figure>
								<?php echo field_image($section_3["logo_image"]) ?>
							</figure>
						</div>
						<?php if ($section_3["link"]) : ?>
							<a href="<?= $section_3["link"]["url"] ?>" class="btn btn-border-secondary mt-6 mt-lg-10">
								<?= $section_3["link"]["title"] ?>
								<em class="fal fa-arrow-right"></em>
							</a>
						<?php endif; ?>
					</div>
					<div class="col-lg-8">
						<div class="body-3 pl-lg-22 text-justify">
							<?= $section_3["description"] ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="single-slider mt-lg-10 mt-8 position-relative">
			<div class="swiper">
				<div class="swiper-wrapper">
					<?php foreach ($image_list as $image) : ?>
						<div class="swiper-slide">
							<div class="image">
								<figure>
									<?php echo field_image($image, "w-100") ?>
								</figure>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="swiper-navigation">
				<div class="swiper-btn swiper-btn-prev "><span class="fal fa-arrow-left"></span></div>
				<div class="swiper-btn swiper-btn-next "><span class="fal fa-arrow-right"></span></div>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php if (acf_group_has_values($section_4)) : ?>
	<?php
	$selected_categories = $section_4["selected_categories"];
	?>
	<section class="section-large section-home-4">
		<div class="container">
			<h2 class="section-title text-center heading-2 mb-5">
				<?= $section_4["title"] ?>
			</h2>
			<div class="subnav text-center mb-lg-10 mb-8" data-toggle="tab" data-target="#newsContainer">
				<ul>
					<?php foreach ($selected_categories as $key => $categoryID) : ?>
						<?php
						$term = get_term($categoryID, 'category');
						?>
						<li>
							<a href="#tab-<?= $categoryID ?>">
								<?= $key == 0 ? __('Tất c', 'canhcamtheme') : $term->name ?>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
			<div id="newsContainer">
				<?php foreach ($selected_categories as $categoryID) : ?>
					<?php
					$term = get_term($categoryID, 'category');
					$post_query = new WP_Query(array(
						"post_type" => "post",
						"posts_per_page" => 10,
						"cat" => $categoryID,
						"orderby" => "date",
						"order" => "DESC"
					));
					?>
					<?php if ($post_query->have_posts()) : ?>
						<div id="tab-<?= $categoryID ?>">
							<div class="news-slider position-relative swiper-equal-height">
								<div class="swiper">
									<div class="swiper-wrapper">
										<?php while ($post_query->have_posts()) : $post_query->the_post(); ?>
											<div class="swiper-slide">
												<?php get_template_part("./modules/news/news-item", "small") ?>
											</div>
										<?php endwhile; ?>
										<?php wp_reset_postdata(); ?>
									</div>
								</div>
								<div class="swiper-navigation is-between">
									<div class="swiper-btn swiper-btn-prev "><span class="fal fa-arrow-left"></span></div>
									<div class="swiper-btn swiper-btn-next "><span class="fal fa-arrow-right"></span></div>
								</div>
							</div>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php if (acf_group_has_values($section_5)) : ?>
	<section class="section-large pb-0 section-home-5 bg-primary-1 text-primary-2">
		<div class="content-container">
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
						<div class="pr-lg-15">
							<h2 class="section-title heading-2">
								<?= $section_5["title"] ?>
							</h2>
							<div class="body-3 mt-5 form-consultation">
								<?php echo do_shortcode('[contact-form-7 id="a2dccae" title="Form tư vấn"]') ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="image-container">
			<div class="image">
				<figure>
					<?php echo field_image($section_5["image"]) ?>
				</figure>
			</div>
		</div>
	</section>
<?php endif; ?>
<?php get_footer() ?>