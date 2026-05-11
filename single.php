<?php get_header() ?>

<?php

$categories = get_the_category();

$args = array(
	'post_type' => 'post',
	'posts_per_page' => 10,
	'post__not_in' => array(get_the_ID()),
	'orderby' => 'date',
	'order' => 'DESC',
);

if ($categories) {
	$args['cat'] = $categories[0]->cat_ID;
}

$the_query = new WP_Query($args);

?>
<?php get_template_part("./modules/common/breadcrumb") ?>


<section class="section-large">
	<div class="container">
		<div class="row justify-center">
			<div class="col-lg-10">
				<div class="news-detail position-relative">
					<div class="news-detail-heading mb-4">
						<h1 class="news-item-title heading-4 font-bold text-secondary-1 mb-5">
							<?php echo get_the_title(); ?>
						</h1>
						<div class="news-item-date text-secondary-300 body-3">
							<?php echo get_the_date('d.m.Y', get_the_ID()) ?>
						</div>

					</div>
					<div class="news-detail-content">
						<div class="article-content body-3 layout is-gap-20">
							<?php the_content() ?>
						</div>
					</div>
					<div class="detail-social social-list mt-4 mt-lg-0">
						<ul class="d-flex flex-lg-column gap-3 body-1 text-primary-5 ">
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
	</div>
</section>

<section class="section-large bg-secondary-50">
	<div class="container">
		<h2 class="heading-4 font-bold text-center mb-8 mb-lg-10">
			<?= __("Tin tức khác", "canhcamtheme") ?>
		</h2>
		<div class="news-slider position-relative swiper-equal-height">
			<div class="swiper">
				<div class="swiper-wrapper">
					<?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
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
</section>

<?php get_footer() ?>