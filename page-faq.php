<?php
/*
Template name: Page - FAQ
*/
?>
<?php get_header() ?>
<?php get_template_part("./modules/common/breadcrumb") ?>

<?php

$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$faqQuery = new WP_Query(array(
	'post_type' => 'faq',
	'posts_per_page' => 10,
	'orderby' => 'date',
	'order' => 'DESC',
	'paged' => $paged,
));

?>

<section class="section-large">
	<div class="container">
		<div class="row">
			<div class="col-lg-3">
				<div class="sidebar-menu">
					<h2 class="sidebar-menu-title heading-4 font-bold text-secondary-1">
						<?php _e('Hỗ trợ khách hàng', 'canhcamtheme'); ?>
					</h2>
					<?php wp_nav_menu(array(
						'theme_location' => 'support-menu',
						'container' => false,
						'menu_class' => 'sidebar-menu-list',
					)); ?>
				</div>
			</div>
			<div class="col-lg-9">
				<h1 class="heading-4 font-bold text-secondary-1 mb-6 mb-lg-10">
					<?php the_title(); ?>
				</h1>
				<div class="faq-list vstack gap-4 " data-toggle="accordion" data-active-index="0">
					<?php while ($faqQuery->have_posts()) : $faqQuery->the_post(); ?>
						<div class="accordion-item faq-item">
							<div class="accordion-trigger d-flex items-start justify-between body-1 font-bold">
								<div class="title">
									<span class="text"><?= get_the_title(); ?></span>
								</div>
								<div class="icon ">
									<em class="far fa-plus"></em>
								</div>
							</div>
							<div class="accordion-content">
								<div class="body-2 article-content">
									<?= the_content(); ?>
								</div>
							</div>
						</div>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				</div>
				<div class="flex items-center justify-center">
					<?php echo glw_custom_pagination($faqQuery) ?>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_footer() ?>