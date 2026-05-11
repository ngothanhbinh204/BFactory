<?php

$object = get_queried_object();

$id = null;
$title = '';

if ($object instanceof WP_Term) {

	$id = $object->taxonomy . '_' . $object->term_id;
	$title = $object->name;

} elseif (is_shop()) {

	$shop_id = wc_get_page_id('shop');

	$id = $shop_id;
	$title = get_the_title($shop_id);

} elseif (is_singular()) {

	$id = get_the_ID();
	$title = get_the_title();

}

$banner = get_field('banner_select_page', $id);

?>
<?php if ($banner) : ?>
	<section class="page-banner-main">
		<div class="img img-ratio pt-[calc(656/1920*100rem)]">
			<?php foreach ($banner as $item) : ?>
				<?php echo post_thumbnail($item->ID, "w-100") ?>
			<?php endforeach; ?>
		</div>
	</section>
	<?php get_template_part("./modules/common/breadcrumb") ?>
<?php else : ?>
	<?php get_template_part("./modules/common/breadcrumb") ?>
<?php endif; ?>

