<?php
/*
Template name: Page - Giới thiệu
*/

add_filter('body_class', function ($classes) {
	$classes[] = 'has-banner';
	return $classes;
});

get_header();

?>
<main>
    <?php get_template_part('./modules/common/banner'); ?>
    <?php get_template_part('template-parts/section/about-intro'); ?>
    <?php get_template_part('template-parts/section/about-vision'); ?>
    <?php get_template_part('template-parts/section/about-mission'); ?>
    <?php get_template_part('template-parts/section/about-values'); ?>
    <?php get_template_part('template-parts/section/about-tech'); ?>
    <?php get_template_part('template-parts/section/about-help'); ?>
</main>
<?php
get_footer();