<?php get_header() ?>

<?php get_template_part("./modules/common/breadcrumb") ?>

<?php
$otherCatalogueQuery = new WP_Query([
	"post_type" => "catalogue",
	"posts_per_page" => -1,
	"orderby" => "date",
	"order" => "DESC",
	"post__not_in" => [get_the_ID()],
]);

$google_drive_link = get_field("google_drive_link", get_the_ID());

?>

<section class="section-large">
	<div class="container">
		<div class="row">
			<div class="col-lg-3">
				<div class="catalogue-sidebar">
					<h2 class="heading-5 font-bold mb-6">
						<?= __("Danh sách catalogue", "canhcamtheme") ?>
					</h2>
					<ul class="catalogue-sidebar-list">
						<?php while ($otherCatalogueQuery->have_posts()) : $otherCatalogueQuery->the_post(); ?>
							<li><a href="<?php the_permalink() ?>"><?php the_title() ?></a></li>

						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
					</ul>
				</div>
			</div>
			<div class="col-lg-8 offset-lg-1">
				<div class="heading-4 font-bold text-secondary-1 mb-lg-10 mb-8">
					<?php echo get_the_title(); ?>
				</div>
				<div class="iframe-wrapper">
					<iframe src="<?php echo $google_drive_link ?>" width="100%" height="840"></iframe>
				</div>
			</div>
		</div>
	</div>
</section>
<?php get_footer() ?>