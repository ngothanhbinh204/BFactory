<?php
/*
Template name: Page - Hỗ trợ
*/

global $post;
// Nếu đang ở trang cha (không có post_parent), tự động chuyển hướng sang trang con đầu tiên
if (empty($post->post_parent)) {
	$children = get_posts(array(
		'post_type'      => 'page',
		'posts_per_page' => 1,
		'post_parent'    => $post->ID,
		'orderby'        => 'menu_order',
		'order'          => 'ASC'
	));
	
	if (!empty($children)) {
		$redirect_url = get_permalink($children[0]->ID);
		if (!headers_sent()) {
			wp_redirect($redirect_url, 301);
		} else {
			echo '<script type="text/javascript">window.location.href="' . esc_url($redirect_url) . '";</script>';
			echo '<noscript><meta http-equiv="refresh" content="0;url=' . esc_attr($redirect_url) . '" /></noscript>';
		}
		exit;
	}
}

get_header(); ?>
<?php get_template_part("./modules/common/breadcrumb") ?>

<main>
	<section class="section-support">
		<div class="container">
			<div class="support-layout">
				<aside class="support-sidebar">
					<div class="support-sidebar__header">
						<h2><?php _e('Hỗ trợ khách hàng', 'canhcamtheme'); ?></h2>
					</div>
					<nav class="support-nav" aria-label="Hỗ trợ khách hàng">
						<ul class="support-nav__list">
							<?php
							global $post;
							// Lấy ID của trang cha cao nhất
							$parent_id = ($post->post_parent) ? $post->post_parent : $post->ID;
							
							$args = array(
								'post_type'      => 'page',
								'posts_per_page' => -1,
								'post_parent'    => $parent_id,
								'order'          => 'ASC',
								'orderby'        => 'menu_order'
							);
							$child_pages = new WP_Query($args);
							if ($child_pages->have_posts()) :
								while ($child_pages->have_posts()) : $child_pages->the_post();
									// Kiểm tra xem có phải trang hiện tại không
									global $wp_query;
									$current_page_id = $wp_query->post->ID;
									$is_current = (get_the_ID() == $current_page_id) ? 'current-menu-item' : '';
									
									$icon_text = get_field('support_icon');
									$icon_img = get_field('support_icon_image');
							?>
							<li class="support-nav__item <?php echo $is_current; ?>">
								<a class="support-nav__link" href="<?php the_permalink(); ?>">
									<span class="support-nav__icon">
										<?php if ($icon_img): ?>
											<img src="<?php echo esc_url($icon_img); ?>" alt="">
										<?php elseif ($icon_text): ?>
											<?php if (strpos($icon_text, '<img') !== false || strpos($icon_text, '<svg') !== false || strpos($icon_text, '<i') !== false): ?>
												<?php echo $icon_text; ?>
											<?php else: ?>
												<i class="<?php echo esc_attr($icon_text); ?>"></i>
											<?php endif; ?>
										<?php else: ?>
											<i class="fa-regular fa-file"></i>
										<?php endif; ?>
									</span>
									<span class="support-nav__text"><?php the_title(); ?></span>
								</a>
							</li>
							<?php
								endwhile;
								wp_reset_postdata();
							endif;
							?>
						</ul>
					</nav>
				</aside>
				<div class="support-content">
					<article class="support-article">
						<?php
						// Lấy lại dữ liệu của trang hiện tại sau vòng lặp query
						global $wp_query;
						$current_post = $wp_query->post;
						?>
						<h1 class="support-article__title"><?php echo get_the_title($current_post->ID); ?></h1>
						<div class="support-article__divider"></div>
						<div class="support-article__body entry-content">
							<?php echo apply_filters('the_content', $current_post->post_content); ?>
						</div>
					</article>
					
					<?php if (get_field('enable_faqs', $current_post->ID) && have_rows('support_faqs', $current_post->ID)) : ?>
					<article class="support-article support-article--faqs">
						<h1 class="support-article__title">FAQs</h1>
						<div class="support-article__divider"></div>
						<div class="accordion-list" data-toggle="accordion" data-active-index="0">
							<?php 
							$count = 1;
							while (have_rows('support_faqs', $current_post->ID)) : the_row(); 
								$question = get_sub_field('question');
								$answer = get_sub_field('answer');
								$num = str_pad($count, 2, '0', STR_PAD_LEFT);
							?>
							<div class="accordion-item">
								<button class="accordion-trigger" type="button">
									<span class="accordion-trigger__num"><?php echo $num; ?></span>
									<span class="accordion-trigger__text"><?php echo esc_html($question); ?></span>
									<span class="accordion-trigger__icon"><i class="fa-regular fa-chevron-down"></i></span>
								</button>
								<div class="accordion-content">
									<div class="accordion-content__inner">
										<?php echo $answer; ?>
									</div>
								</div>
							</div>
							<?php $count++; endwhile; ?>
						</div>
					</article>
					<?php endif; ?>

				</div>
			</div>
		</div>
	</section>
</main>

<?php get_footer() ?>