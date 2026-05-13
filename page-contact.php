<?php
/*
Template name: Page - Liên hệ
*/
?>
<?php get_header() ?>
<?php get_template_part("./modules/common/breadcrumb") ?>

<?php
$info_list = get_field("info_list");
$contactform_shortcode = get_field('contactform_shortcode');
?>

<section class="section-large">
	<div class="container">
		<h1 class="heading-2 text-center mb-lg-10 mb-8 section-title">
			<?php the_title() ?>
		</h1>
		<div class="row equal-height">
			<?php foreach ($info_list as $item) : ?>
				<div class="col-lg-3 col-6">
					<div class="contact-info-item bg-gray-100 p-6 p-lg-10 text-center">
						<div class="icon icon-48 fz-24 bg-primary-4 text-white ">
							<?= $item["icon"] ?>
						</div>
						<div class="content mt-4 text-center">
							<div class="body-1 font-bold">
								<?= $item["title"] ?>
							</div>
							<div class="body-2 mt-2">
								<?= $item["content"] ?>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="row equal-height mt-lg-15 mt-10">
			<div class="col-lg-6">
				<div class="contact-map">
					<?php echo get_field("map_iframe") ?>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="contact-form p-lg-10 p-8 bg-gray-100 body-1 text-center">
					<?php $contactform_shortcode = get_field('contactform_shortcode'); ?>
					<?php echo do_shortcode($contactform_shortcode) ?>
				</div>
			</div>
		</div>
	</div>
</section>


<?php get_footer() ?>