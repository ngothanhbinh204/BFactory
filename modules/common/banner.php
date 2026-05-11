<?php



$object = get_queried_object();
$id_category = $object->term_id;
$taxonomy = $object->taxonomy;
if ($id_category) {
	$id = $taxonomy . '_' . $id_category;
} else {
	$id = get_the_ID();
}
$banner = get_field('banner_select_page', $id);
// if object is any taxonomy, get the name of the taxonomy
if (isset($object->taxonomy)) {
	$title = $object->name;
} else {
	$title = get_the_title();
}
?>
<?php if ($banner) : ?>
	<section class="section-sub-banner">
		<?php foreach ($banner as $item) : ?>
			<div class="sub-banner-item">
				<div class=" sub-banner-item-image">
					<?php echo post_thumbnail($item->ID, "w-100") ?>
				</div>
			</div>
		<?php endforeach; ?>
		<div class="page-title-wrapper">
			<div class="container">
				<h1 class="heading-xlarge text-primary-2 text-center font-black text-uppercase mb-6"><?= $title ?></h1>
			</div>
			<?php get_template_part("./modules/common/breadcrumb") ?>
		</div>
	</section>
<?php else : ?>
	<?php get_template_part("./modules/common/breadcrumb") ?>
<?php endif; ?>