<?php
/*
Template name: Page - Hỗ trợ
*/
?>
<?php get_header() ?>
<?php get_template_part("./modules/common/breadcrumb") ?>

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
				<h1 class="news-item-title heading-4 font-bold text-secondary-1 mb-6 mb-lg-10">
					<?php echo get_the_title(); ?>
				</h1>
				<div class="body-1 article-content">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_footer() ?>