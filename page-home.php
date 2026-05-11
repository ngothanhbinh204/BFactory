<?php
/*
Template name: Page - Trang chủ
*/

add_filter('body_class', function ($classes) {
	$classes[] = 'has-banner';
	return $classes;
});

get_header();

?>
<main>
    <?php get_template_part('template-parts/section/home-banner'); ?>
    <?php get_template_part('template-parts/section/home-about'); ?>
    <?php get_template_part('template-parts/section/home-products'); ?>
    <?php get_template_part('template-parts/section/home-video'); ?>
    <?php get_template_part('template-parts/section/home-posts'); ?>
    <?php get_template_part('template-parts/section/home-help'); ?>
</main>
<?php
get_footer();