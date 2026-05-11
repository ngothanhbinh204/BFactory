<?php
/*
Template name: Page - Giới thiệu
*/

// add custom class to body tag

add_filter('body_class', function ($classes) {
	$classes[] = 'has-banner';
	return $classes;
});


?>
<?php get_header() ?>
<?php get_template_part("./modules/common/banner") ?>

<?php
$section_1 = get_field("section_1");
$section_2 = get_field("section_2");
$section_3 = get_field("section_3");

?>

<?php if (acf_group_has_values($section_1)) : ?>
	<section class="section-about-1 section-large" id="section-1">
		<div class="container">
			<div class="row">
				<div class="col-lg-5">
					<div class="pr-lg-23">
						<h2 class="section-title section-title-small heading-2 mb-4">
							<?php echo $section_1["title"] ?>
						</h2>
						<div class="heading-2 font-bold">
							<?php echo $section_1["sub_title"] ?>
						</div>
					</div>
				</div>
				<div class="col-lg-6 offset-lg-1">
					<div class="expand-content-item">
						<div class="expand-content">
							<div class="expand-content-inner">
								<div class="body-2 article-content">
									<?php echo $section_1["content"] ?>
								</div>
							</div>
						</div>
						<a href="#" class="link text-secondary-500 expand-trigger mt-4" data-more-text="<?php _e("Xem thêm", "canhcamtheme") ?>" data-less-text="<?php _e("Thu gọn", "canhcamtheme") ?>">
							<span class="text"><?php _e("Xem thêm", "canhcamtheme") ?></span>
							<em class="fal fa-chevron-down"></em>
						</a>
					</div>
				</div>
			</div>
			<div class="image mt-lg-16 mt-10">
				<figure>
					<?php echo field_image($section_1["image"], "w-100") ?>
				</figure>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php if (acf_group_has_values($section_2)) : ?>
	<section class="section-about-2 bg-primary-1 text-primary-2" id="section-2">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<h2 class="section-title section-title-small heading-2 mb-lg-16 mb-8">
						<?php echo $section_2["title"] ?>
					</h2>
					<div class="heading-4 font-bold">
						<?php echo $section_2["description"] ?>
					</div>
					<div class="mt-4 body-3">
						<?php echo $section_2["content"] ?>
					</div>
				</div>
			</div>
		</div>
		<div class="image">
			<figure>
				<?php echo field_image($section_2["image"], "w-100") ?>
			</figure>
		</div>
	</section>
<?php endif; ?>

<?php if (acf_group_has_values($section_3)) : ?>
	<section class="section-about-3 section-large" id="section-3">
		<div class="container">
			<div class="single-slider swiper-equal-height position-relative">
				<div class="swiper">
					<div class="swiper-wrapper">
						<?php foreach ($section_3["content_list"] as $item) : ?>
							<div class="swiper-slide">
								<div class="factory-item">
									<div class="factory-item-content">
										<div class="factory-item-title section-title section-title-small heading-2 font-bold">
											<?php echo $item["title"] ?>
										</div>
										<div class="factory-item-area mt-6">
											<?php echo $item["sub_title"] ?>
										</div>
										<div class="factory-item-info body-2 mt-lg-10 mt-6 pt-lg-10 pt-6 border-t-1 border-solid border-primary-2">
											<?php echo $item["content"] ?>
										</div>
									</div>
									<div class="factory-item-image">
										<figure>
											<?php echo field_image($item["image"], "w-100") ?>
										</figure>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="swiper-navigation d-flex gap-4">
					<div class="swiper-btn swiper-btn-prev "><span class="fal fa-arrow-left"></span></div>
					<div class="swiper-btn swiper-btn-next "><span class="fal fa-arrow-right"></span></div>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php
$catalogueQuery = new WP_Query([
	"post_type" => "catalogue",
	"posts_per_page" => -1,
	"orderby" => "date",
	"order" => "DESC",
]);
?>

<?php if ($catalogueQuery->have_posts()) : ?>
	<section id="section-4" class="section-about-4 lazy background-cover section-large" data-bg="<?php echo get_template_directory_uri() ?>/img/bg-about-1.png">
		<div class="container">
			<h2 class="section-title heading-2 mb-lg-10 mb-8 text-center">
				Catalogue
			</h2>
			<div class="catalogue-slider swiper-equal-height position-relative">
				<div class="swiper-navigation is-between">
					<div class="swiper-btn swiper-btn-prev "><span class="fal fa-arrow-left"></span></div>
					<div class="swiper-btn swiper-btn-next "><span class="fal fa-arrow-right"></span></div>
				</div>
				<div class="swiper">
					<div class="swiper-wrapper">
						<?php while ($catalogueQuery->have_posts()) : $catalogueQuery->the_post(); ?>
							<div class="swiper-slide">
								<div class="catalogue-item position-relative">
									<div class="catalogue-item-image">
										<figure>
											<?php echo post_thumbnail(get_the_ID(), "w-100") ?>
										</figure>
									</div>
									<div class="catalogue-item-title body-1 font-bold text-center mt-6 text-primary-4">
										<?php the_title() ?>
									</div>
									<a href="<?php the_permalink() ?>" class="stretched-link"></a>
								</div>
							</div>
						<?php endwhile; ?>
					</div>
				</div>
			</div>

		</div>
	</section>
<?php endif; ?>

<?php get_footer() ?>