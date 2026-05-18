<?php
$footer_bg = get_field('footer_bg', 'option') ?: THEME_URI . '/UI/img/bg-footer.png';
$footer_logo = get_field('footer_logo', 'option') ?: THEME_URI . '/UI/img/logo_main.svg';
$footer_tagline = get_field('footer_tagline', 'option') ?: 'Thương hiệu phụ kiện xe máy điện Việt Nam';
$footer_partner_label = get_field('footer_partner_label', 'option') ?: "Liên kết với<br>BFACTORY";
$footer_partner_logo = get_field('footer_partner_logo', 'option') ?: THEME_URI . '/UI/img/bfactory.png';
$footer_partner_url = get_field('footer_partner_url', 'option') ?: '#!';
$footer_socials = get_field('footer_socials', 'option');
$footer_company_name = get_field('footer_company_name', 'option') ?: 'Công ty TNHH B-FACTORY';
$footer_address = get_field('footer_address', 'option') ?: 'Số 519F, Ấp Ngũ Phúc, Phường Hố Nai, Tỉnh Đồng Nai, Việt Nam';
$footer_hotline_title = get_field('footer_hotline_title', 'option') ?: 'Hotline';
$footer_hotline_content = get_field('footer_hotline_content', 'option') ?: '<div class="info-list"><ul><li><strong>Zalo:</strong> 0901 995 421</li><li><strong>Miền Bắc:</strong> 0988 886 674</li><li><strong>Miền Nam:</strong> 0906 323 217</li></ul></div>';
$footer_working_hours = get_field('footer_working_hours', 'option') ?: 'Thứ 2 - 6: 09:00 - 17:30 - <strong>Sat - Sun:</strong> Closed';
$footer_email = get_field('footer_email', 'option') ?: 'contact.bfbike@bfactoryvn.com';
$footer_copyright = get_field('footer_copyright', 'option') ?: '© 2026 Bfactorybike. All Rights Reserved. Thiết kế web bởi Cánh Cam.';
$footer_brand_text = get_field('footer_brand_text', 'option') ?: 'BFBIKE - BFBIKE';
$cta_phone = get_field('cta_phone', 'option') ?: '1900 2273 – (028) 7100 0001';
$cta_socials = get_field('cta_socials', 'option');
?>
<footer class="footer">
	<div class="bg-footer"> <img class="lozad" data-src="<?= $footer_bg ?>" alt="" />
	</div>
	<div class="footer-body">
		<div class="container">
			<div class="row footer-row">
				<div class="col footer-left lg:w-5/12">
					<div class="footer-logo"><a href="<?= home_url() ?>"><img class="lozad"
								data-src="<?= $footer_logo ?>" alt="" /></a></div>
					<p class="footer-tagline"><?= $footer_tagline ?></p>
					<div class="footer-partner"><span class="partner-label"><?= $footer_partner_label ?></span><a
							class="partner-logo-box" href="<?= $footer_partner_url ?>" target="_blank"
							rel="noopener"><img class="lozad" data-src="<?= $footer_partner_logo ?>" alt="" /></a></div>
					<ul class="footer-socials">
						<?php if ($footer_socials): ?>
						<?php foreach ($footer_socials as $social): 
                                $icon = $social['icon'];
                                $link = $social['link'];
                                if ($link):
                                    $link_url = $link['url'];
                                    $link_title = $link['title'];
                                    $link_target = $link['target'] ? $link['target'] : '_self';
                            ?>
						<li><a href="<?= esc_url($link_url) ?>" aria-label="<?= esc_attr($link_title) ?>"
								target="<?= esc_attr($link_target) ?>" rel="noopener"><span class="icon"><i
										class="<?= esc_attr($icon) ?>"></i></span><span
									class="label"><?= esc_html($link_title) ?></span></a></li>
						<?php endif; endforeach; ?>
						<?php endif; ?>
					</ul>
				</div>
				<div class="col footer-right lg:w-7/12">
					<div class="footer-info-block">
						<h3 class="info-title"><?= $footer_company_name ?></h3>
						<p class="info-text"><?= $footer_address ?></p>
					</div>
					<div class="footer-info-block">
						<h4 class="info-title"><?= $footer_hotline_title ?></h4>
						<div class="info-list">
							<?php echo wp_kses_post($footer_hotline_content) ?>
						</div>
					</div>
					<div class="footer-info-block">
						<div class="info-text"><?= $footer_working_hours ?></div><a class="info-email"
							href="mailto:<?= $footer_email ?>"><?= $footer_email ?></a>
					</div>
				</div>
			</div>
			<div class="footer-bottom">
				<p class="footer-copyright"><?= $footer_copyright ?></p>
				<nav class="footer-terms">
					<?php wp_nav_menu([
                        "theme_location" => "footer-1",
                        "container" => false,
                    ]); ?>
				</nav>
			</div>
		</div>
	</div>
	<div class="footer-brand"><span class="brand-text"><?= $footer_brand_text ?></span></div>
	<div class="tool-fixed-cta">
		<div class="button-to-top"><i class="fa-light fa-arrow-up"></i></div>

		<?php if ($cta_phone) : ?>
		<div class="btn-slide btn-phone">
			<div class="btn-icon"><i class="fa-light fa-phone"></i></div>
			<div class="btn-content">
				<?= wp_kses_post($cta_phone) ?>
			</div>
		</div>
		<?php endif; ?>

		<?php if ($cta_socials) : ?>
		<div class="btn-slide btn-social">
			<div class="btn-icon"><i class="fa-light fa-messages"></i></div>
			<div class="btn-content">
				<ul>
					<?php foreach ($cta_socials as $social) : ?>
					<li><a href="<?= esc_url($social['link']) ?>" target="_blank" rel="noopener"><i
								class="<?= esc_attr($social['icon']) ?>"></i></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
		<?php endif; ?>
	</div>
</footer>
<div class="header-search-form">
	<div class="close"><i class="fa-light fa-xmark"></i></div>
	<div class="container">
		<div class="wrap-form-search-product">
			<form class="productsearchbox" action="<?= home_url() ?>">
				<input type="text" name="s" placeholder="Tìm kiếm...">
				<button type="submit" class="btn-search">Tìm</button>
			</form>
			<div class="message-search">
				Nhấn <span>Esc </span> để đóng</div>
		</div>
	</div>
</div>