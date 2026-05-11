<?php
$home_about_label = get_field('home_about_label');
$home_about_title = get_field('home_about_title');
$home_about_image = get_field('home_about_image');
$home_about_intro = get_field('home_about_intro');
$home_about_content = get_field('home_about_content');
$home_about_stats = get_field('home_about_stats');
$home_about_button = get_field('home_about_button');
?>
	<section class="section-about">
		<div class="container-about">
			<div class="row">
				<div class="about-left lg:w-6/12">
					<div class="group-header">
                        <?php if($home_about_label): ?>
						<p class="about-label"><?php echo esc_html($home_about_label); ?></p>
                        <?php endif; ?>
                        <?php if($home_about_title): ?>
						<h2 class="about-heading"><?php echo wp_kses_post($home_about_title); ?></h2>
                        <?php endif; ?>
					</div>
					<div class="about-image">
						<div class="img-ratio ratio:pt-[596_860]">
                            <?php if($home_about_image): ?>
                            <img class="lozad" data-src="<?php echo esc_url($home_about_image['url']); ?>" alt="<?php echo esc_attr($home_about_image['alt']); ?>" />
                            <?php endif; ?>
						</div>
					</div>
				</div>
				<div class="about-right lg:w-6/12">
                    <?php if($home_about_intro): ?>
					<p class="about-intro"><?php echo esc_html($home_about_intro); ?></p>
                    <?php endif; ?>
                    <?php if($home_about_content): ?>
					<div class="about-text">
						<?php echo wp_kses_post($home_about_content); ?>
					</div>
                    <?php endif; ?>
                    
                    <?php if($home_about_stats): ?>
					<div class="about-stats">
                        <?php foreach($home_about_stats as $stat): ?>
						<div class="stat-item">
							<p class="stat-number"><span data-countup="<?php echo esc_attr($stat['number']); ?>"><?php echo esc_html($stat['number']); ?></span><span
									class="stat-suffix"><?php echo esc_html($stat['suffix']); ?></span></p>
							<div class="stat-desc">
								<div class="dot"></div><span class="stat-unit"><?php echo esc_html($stat['unit']); ?></span><span class="desc"> <?php echo esc_html($stat['desc']); ?></span>
							</div>
						</div>
                        <?php endforeach; ?>
					</div>
                    <?php endif; ?>
                    
                    <?php if($home_about_button): ?>
                    <a class="btn btn-primary-outline" href="<?php echo esc_url($home_about_button['url']); ?>"><span><?php echo esc_html($home_about_button['title']); ?></span><i
							class="fa-regular fa-arrow-right"></i></a>
                    <?php endif; ?>
					<div class="about-brand-text" aria-hidden="true">BFBIKE</div>
				</div>
			</div>
		</div>
	</section>
