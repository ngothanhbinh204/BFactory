<?php get_header() ?>
<?php get_template_part("./modules/common/banner") ?>
<?php

$term = get_queried_object();

$termId = $term->term_id;

$parent_id = $term->parent ? $term->parent : $termId;

$parent_term = get_term($parent_id);

$allCategories = get_terms(array(
	"taxonomy" => "category",
	"hide_empty" => false,
	"parent" => $parent_id,
	"orderby" => "term_order",
	"order" => "DESC"
));


$paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;

$args = array(
	'post_type' => "post",
	'cat' => $termId,
	'posts_per_page' => 10,
	'paged' => $paged,
);

$the_query = new WP_Query($args);

?>

<section class="section-large">
	<div class="container">
		<h1 class="heading-1 text-center section-title mb-6">
			<?= $parent_term->name ?>
		</h1>
		<div class="subnav text-center mb-lg-10 mb-8">
			<ul>
				<li class="<?= $parent_term->term_id == $termId ? "active" : "" ?>">
					<a href="<?= get_term_link($parent_term) ?>">
						<?= __("Tất cả", "canhcamtheme") ?>
					</a>
				</li>
				<?php foreach ($allCategories as $category) : ?>
					<li class="<?= $category->term_id == $termId ? "active" : "" ?>">
						<a href="<?= get_term_link($category) ?>"><?= $category->name ?></a>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<div class="news-list">
			<?php if ($the_query->have_posts()) : ?>
				<div class="row">
					<?php $index = 0 ?>
					<?php while ($the_query->have_posts()):
						$the_query->the_post(); ?>
						<?php $index++; ?>
						<?php if ($index == 1) : ?>
							<div class="col-lg-8">
								<?php get_template_part("./modules/news/news-item-big") ?>
							</div>
						<?php elseif ($index == 2) : ?>
							<div class="col-lg-4 col-6">
								<?php get_template_part("./modules/news/news-item-small") ?>
							</div>
						<?php else : ?>
							<div class="col-6 col-lg-3">
								<?php get_template_part("./modules/news/news-item-small") ?>
							</div>
						<?php endif; ?>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				</div>
				<div class="flex items-center justify-center">
					<?php echo glw_custom_pagination($the_query) ?>
				</div>
			<?php else : ?>
				<div class="heading-4 font-bold text-center">
					<?= __("Không có bài viết nào", "canhcamtheme") ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>

<?php get_footer() ?>