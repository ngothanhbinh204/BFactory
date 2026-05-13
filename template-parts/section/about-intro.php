<?php
$about_intro_label   = get_field('about_intro_label');
$about_intro_title   = get_field('about_intro_title');
$about_intro_col1    = get_field('about_intro_col1');
$about_intro_col2    = get_field('about_intro_col2');
$about_intro_image   = get_field('about_intro_image');
?>
	<section class="section-about-intro">
		<div class="container-full">
			<div class="about-content">
                <?php if($about_intro_label): ?>
				<p class="about-label"><?php echo esc_html($about_intro_label); ?></p>
                <?php endif; ?>
                <?php if($about_intro_title): ?>
				<h2 class="about-title"><?php echo wp_kses_post($about_intro_title); ?></h2>
                <?php endif; ?>
                <?php if($about_intro_col1 || $about_intro_col2): ?>
				<div class="about-body">
                    <?php if($about_intro_col1): ?>
					<div class="about-body__col">
						<?php echo wp_kses_post($about_intro_col1); ?>
					</div>
                    <?php endif; ?>
                    <?php if($about_intro_col2): ?>
					<div class="about-body__col">
						<?php echo wp_kses_post($about_intro_col2); ?>
					</div>
                    <?php endif; ?>
				</div>
                <?php endif; ?>
			</div>
            <?php if($about_intro_image): ?>
			<div class="about-image">
				<img class="lozad" data-src="<?php echo esc_url($about_intro_image['url']); ?>" alt="<?php echo esc_attr($about_intro_image['alt']); ?>" />
			</div>
            <?php endif; ?>
		</div>
	</section>
