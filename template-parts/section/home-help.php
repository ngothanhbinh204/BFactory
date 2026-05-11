<?php
$home_help_title = get_field('home_help_title');
$home_help_list = get_field('home_help_list');
?>
	<section class="section-help">
		<div class="container">
            <?php if($home_help_title): ?>
			<h2 class="section-title"><?php echo wp_kses_post($home_help_title); ?></h2>
            <?php endif; ?>
            
            <?php if($home_help_list): ?>
			<div class="help-list">
                <?php foreach($home_help_list as $item): ?>
                <a class="help-item" href="#!">
					<div class="help-item__top">
						<h3 class="help-item__title"><?php echo wp_kses_post($item['title']); ?></h3>
                        <?php if($item['icon']): ?>
                        <img class="help-item__icon" src="<?php echo esc_url($item['icon']['url']); ?>" alt="<?php echo esc_attr($item['icon']['alt']); ?>">
                        <?php endif; ?>
					</div>
					<div class="help-item__desc"><?php echo wp_kses_post($item['desc']); ?></div>
				</a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
		</div>
	</section>
