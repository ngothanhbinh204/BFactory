<?php

add_filter('body_class', function ($classes) {

	return array_merge($classes, array('no-banner-page'));
});

?>

<?php
$keyword = isset($_GET['s']) && $_GET['s'] ? $_GET['s'] : '';

$post_types = ['product', 'post']; // Modify these post types as necessary
$search_counts = [];

if (!empty(get_search_query())) {
	foreach ($post_types as $type) {
		$search_query = new WP_Query([
			'post_type' => $type,
			's' => get_search_query(),
			'posts_per_page' => -1,
			'fields' => 'ids', // Fetch only the IDs to speed up the query
			"post_status" => "publish"
		]);
		$search_counts[$type] = $search_query->found_posts;
		wp_reset_postdata();
	}
}

?>
<?php get_header() ?>
<section class="search-page section">
	<div class="container max-w-screen-2xl">
		<h1 class="heading-2 font-bold text-center mb-lg-8 mb-4">
			<?php _e('Tìm kiếm', 'canhcamtheme') ?>
		</h1>
		<div class="wrap-form-search">
			<form class="searchbox flex items-center w-full relative" action="<?php bloginfo('url') ?>/"
				method="GET" role="form">
				<input class="w-full" name="s" class="form-control" type="text"
					placeholder="<?php _e('Tìm kiếm', 'canhcamtheme') ?>" value="<?php echo get_search_query() ?>">
				<button type="submit" class="flex items-center justify-center">
					<em class="fa-regular fa-magnifying-glass"></em>
				</button>
			</form>
		</div>
		<?php if ($search_counts['product'] > 0 || $search_counts['post'] > 0) : ?>
			<div class="search-query">
				<?php _e('Kết quả tìm kiếm từ khóa', 'canhcamtheme') ?>: " <span>
					<?php echo get_search_query() ?>
				</span> "
			</div>
			<div class="subnav mb-4">
				<ul>
					<li>
						<a href="#productList">
							<?php _e('Sản phẩm', 'canhcamtheme') ?> (<?= $search_counts['product'] ?>)
						</a>
					</li>
					<li>
						<a href="#postList">
							<?php _e('Bài viết', 'canhcamtheme') ?> (<?= $search_counts['post'] ?>)
						</a>
					</li>
				</ul>
			</div>
			<?php if ($search_counts['product'] > 0) : ?>
				<?php
				$productQuery = new WP_Query([
					'post_type' => 'product',
					's' => get_search_query(),
					'posts_per_page' => -1,
					'fields' => 'ids',
					"post_status" => "publish"
				]);
				?>
				<div class="search-product" id="productList">
					<h2 class="heading-4 font-bold mb-4">
						<?php _e('Sản phẩm', 'canhcamtheme') ?>
					</h2>
					<div class="row equal-height">
						<?php while ($productQuery->have_posts()) : $productQuery->the_post(); ?>
							<div class="col-md-3 col-sm-6">
								<?php wc_get_template_part('content', 'product'); ?>
							</div>
						<?php endwhile; ?>
					</div>
				</div>
			<?php endif; ?>
			<?php if ($search_counts['post'] > 0) : ?>
				<div class="search-post mt-10" id="postList">
					<h2 class="heading-4 font-bold mb-4">
						<?php _e('Bài viết', 'canhcamtheme') ?>
					</h2>
					<?php
					$postQuery = new WP_Query([
						'post_type' => 'post',
						's' => get_search_query(),
						'posts_per_page' => -1,
						'fields' => 'ids',
						"post_status" => "publish"
					]);
					?>
					<div class="row">
						<?php while ($postQuery->have_posts()) : $postQuery->the_post(); ?>
							<div class="col-md-3 col-sm-6">
								<?php get_template_part("./modules/news/news-item-small", null, array("id" => get_the_ID())) ?>
							</div>
						<?php endwhile; ?>
					</div>
				</div>
			<?php endif; ?>
		<?php else : ?>
			<div class="search-no-result body-1 text-center font-bold">
				<?php _e('Không tìm thấy kết quả', 'canhcamtheme') ?>
			</div>
		<?php endif; ?>
	</div>
</section>
<?php get_footer() ?>

<script>
	jQuery(document).ready(function($) {
		$('.subnav ul li a').click(function(e) {
			e.preventDefault();
			var href = $(this).attr('href');
			$("html, body").animate({
				scrollTop: $(href).offset().top
			}, 500);
		});
	});
</script>