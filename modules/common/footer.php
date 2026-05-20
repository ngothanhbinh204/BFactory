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
$popup_subscribe_enabled = get_field('popup_subscribe_enabled', 'option');
$popup_subscribe_enabled = $popup_subscribe_enabled === null ? true : (bool) $popup_subscribe_enabled;
$popup_subscribe_media = get_field('popup_subscribe_media', 'option') ?: THEME_URI . '/UI/img/popup-img.jpg';
$popup_subscribe_logo = get_field('popup_subscribe_logo', 'option') ?: THEME_URI . '/UI/img/logo_main.svg';
$popup_subscribe_title = get_field('popup_subscribe_title', 'option') ?: 'Đăng ký nhận thông tin';
$popup_subscribe_desc = get_field('popup_subscribe_desc', 'option') ?: 'Bạn quan tâm đến dịch vụ tại BF-BIKE, gửi thông tin về cho các chuyên viên tư vấn của BF-BIKE để được hỗ trợ tức thì.';
$popup_subscribe_form_shortcode = get_field('popup_subscribe_form_shortcode', 'option');
$popup_subscribe_email_placeholder = get_field('popup_subscribe_email_placeholder', 'option') ?: 'Nhập Email của bạn...';
$popup_subscribe_consent_text = get_field('popup_subscribe_consent_text', 'option') ?: 'Tôi đồng ý với điều khoản điều kiện.';
$popup_subscribe_submit_text = get_field('popup_subscribe_submit_text', 'option') ?: 'Gửi';
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



<?php if ($popup_subscribe_enabled): ?>
<div class="popup-subscribe" id="popup-subscribe" aria-hidden="true" role="dialog" aria-modal="true"
	aria-labelledby="popup-subscribe-title">
	<div class="popup-subscribe__backdrop" data-popup-close></div>
	<div class="popup-subscribe__dialog">
		<button class="popup-subscribe__close" type="button" aria-label="Đóng popup" data-popup-close><i
				class="fa-solid fa-xmark"></i></button>
		<div class="popup-subscribe__inner">
			<div class="popup-subscribe__media"><img class="lozad" data-src="<?= esc_url($popup_subscribe_media) ?>"
					alt="" />
			</div>
			<div class="popup-subscribe__content">
				<div class="popup-subscribe__logo"><img class="lozad" data-src="<?= esc_url($popup_subscribe_logo) ?>"
						alt="" />
				</div>
				<h2 class="popup-subscribe__title" id="popup-subscribe-title"><?= esc_html($popup_subscribe_title) ?>
				</h2>
				<p class="popup-subscribe__desc"><?= esc_html($popup_subscribe_desc) ?></p>
				<?php if (!empty($popup_subscribe_form_shortcode)): ?>
				<div class="wpcf7"><?= do_shortcode($popup_subscribe_form_shortcode) ?></div>
				<?php else: ?>
				<div class="wpcf7">
					<form class="wpcf7-form" novalidate action=""><span class="wpcf7-form-control-wrap"
							data-name="your-email">
							<input
								class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email"
								type="email" name="your-email"
								placeholder="<?= esc_attr($popup_subscribe_email_placeholder) ?>" aria-required="true"
								aria-invalid="false"></span><span class="wpcf7-form-control-wrap"
							data-name="acceptance-consent"><span class="wpcf7-form-control wpcf7-acceptance">
								<label>
									<input class="wpcf7-form-control" type="checkbox" name="acceptance-consent"
										value="1" checked><span
										class="wpcf7-list-item-label"><?= esc_html($popup_subscribe_consent_text) ?></span>
								</label></span></span>
						<button class="wpcf7-form-control wpcf7-submit btn-popup-submit"
							type="submit"><span><?= esc_html($popup_subscribe_submit_text) ?></span><i
								class="fa-regular fa-arrow-right"></i></button>
					</form>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>