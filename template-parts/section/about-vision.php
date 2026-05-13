<?php
$about_vision_title   = get_field('about_vision_title');
$about_vision_icon    = get_field('about_vision_icon');
$about_vision_quote   = get_field('about_vision_quote');
?>
	<section class="section-vision">
		<div class="container">
			<div class="group-title">
                <?php if($about_vision_title): ?>
				<h2 class="section-title"><?php echo wp_kses_post($about_vision_title); ?></h2>
                <?php endif; ?>
				<div class="vision-divider"></div>
			</div>
            <?php if($about_vision_quote): ?>
			<div class="vision-quote">
                <?php if($about_vision_icon): ?>
				<img class="vision-quote__icon" src="<?php echo esc_url($about_vision_icon['url']); ?>" alt="<?php echo esc_attr($about_vision_icon['alt']); ?>">
                <?php endif; ?>
				<p class="vision-quote__text"><?php echo wp_kses_post($about_vision_quote); ?></p>
			</div>
            <?php endif; ?>
		</div>
	</section>
