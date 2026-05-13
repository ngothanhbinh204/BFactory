<?php
/*
Template name: Page - Hệ thống phân phối
*/
?>
<?php get_header() ?>
<?php get_template_part('./modules/common/banner'); ?>
<?php
$dealerQuery = new WP_Query([
	'post_type' => 'dealer',
	'posts_per_page' => -1,
	'orderby' => 'date',
	'order' => 'DESC',
	'facetwp' => true,
]);

?>

<section class="section-large section-dealer">
	<div class="container">
		<h1 class="heading-2 section-title text-center mb-lg-10 mb-6">
			<?php the_title() ?>
		</h1>
		<div class="dealer-filter mb-6">
			<div class="row">
				<?php echo do_shortcode('[facetwp facet="dealer_filter"]') ?>
			</div>
		</div>
		<div class="dealer-result-wrap overflow-hidden">
			<div class="row no-gutter equal-height">
				<div class="col-md-5">
					<div class="result-list-wrap">
						<div class="dealer-result-list vstack gap-2">
							<?php if ($dealerQuery->have_posts()) : ?>
								<?php while ($dealerQuery->have_posts()) : $dealerQuery->the_post(); ?>
									<div class="dealer-item" data-iframe="<?php echo get_field('iframe_url', $post->ID) ?>">
										<div class="dealer-item-info body-4">
											<div class="body-2 font-bold name">
												<?php the_title() ?>
											</div>
											<?php if ($address = get_field('address', $post->ID)) : ?>
												<div class="address">
													<span class="fas fa-map-marker-alt"></span>
													<?php echo $address ?>
												</div>
											<?php endif; ?>
											<?php if ($phone = get_field('phone', $post->ID)) : ?>
												<div class="phone">
													<span class="fas fa-phone"></span>
													<a href="tel:<?php echo $phone ?>"><?php echo $phone ?></a>
												</div>
											<?php endif; ?>
										</div>
									</div>
								<?php endwhile; ?>
								<?php wp_reset_postdata(); ?>
							<?php else : ?>
								<div class="no-result-wrap">
									<div class="no-result-content">
										<h3 class="heading-5 font-bold ">Khu vực bạn vừa chọn hiện không có kết quả nào.</h3>
									</div>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<div class="col-md-7">
					<div class="result-map">
						<iframe src="" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"> </iframe>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_footer() ?>

<?php
$popup = get_field('popup');
?>

<div id="no-results-popup" class="text-center" style="display:none; max-width: 600px;">
	<h3 class="heading-4 font-bold"><?php echo $popup['title'] ?></h3>
	<div class="body-2 mt-5"><?php echo $popup['content'] ?></div>
</div>
<!-- <div class="btn-wrap">
	<button onclick="Fancybox.close();" class="btn btn-primary mt-5">
		<?php _e('Đóng', 'canhcamtheme') ?>
	</button>
</div> -->
</div>

<!-- <script>
	(function($) {
		$(function() {
			if ('undefined' !== typeof FWP) {
				FWP.auto_refresh = false;
			}
		});
	})(fUtil);
</script> -->