<?php
$id = get_the_ID();

if (isset($args["id"])) {
	$id = $args["id"];
}

?>

<div class="news-item news-item-small">
	<div class="news-item-image">
		<figure>
			<?php echo post_thumbnail($id, 'w-100') ?>
		</figure>
	</div>
	<div class="news-item-caption mt-5">
		<a href="<?php echo get_the_permalink($id) ?>" class="stretched-link"></a>
		<div class="news-item-title body-1 clamp-3 font-bold ">
			<?php echo get_the_title($id) ?>
		</div>
		<div class="body-3 clamp-3 mt-3">
			<?php echo get_the_excerpt($id) ?>
		</div>
	</div>
</div>