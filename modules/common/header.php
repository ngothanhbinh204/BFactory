<?php
$searchUrl = home_url() . "/?s=";
$header_logo_main = get_field('header_logo_main', 'option') ?: THEME_URI . '/UI/img/logo_main.svg';
$header_logo_mobile = get_field('header_logo_mobile', 'option') ?: THEME_URI . '/UI/img/logo-default.png';
?>
<header class="global-header">
	<div class="container-header">
		<div class="header-child">
			<div class="header-logo"><a href="<?= home_url() ?>"><img class="lozad" data-src="<?= $header_logo_main ?>"
						alt="" /></a></div>
			<nav class="header-menu">
				<?php wp_nav_menu([
					"theme_location" => "header-menu",
					"container" => false,
				]); ?>
			</nav>
			<div class="header-right">
				<form class="header-search-box" action="<?= home_url() ?>">
					<input type="text" name="s" placeholder="Tìm kiếm...">
					<button type="submit" aria-label="Tìm kiếm"><i class="fa-regular fa-magnifying-glass"></i></button>
				</form>
				<div class="header-action">
					<div class="header-language">
						<!-- <?php if ( shortcode_exists( 'custom_wpml_switcher' ) ) : ?>
                            <?php echo do_shortcode('[custom_wpml_switcher]'); ?>
                        <?php endif; ?> -->
						<div class="google-translate-wrapper">
							<div class="google-language">
								<div id="google_translate_element"></div>
							</div>

						</div>
					</div>

					<?php
                    $woo_account_page = get_option('woocommerce_myaccount_page_id');
                    $woo_account_page_url = $woo_account_page ? get_permalink($woo_account_page) : '#!';
                    ?>
					<a class="header-account" href="<?= $woo_account_page_url ?>" aria-label="Tài khoản"><i
							class="fa-regular fa-user"></i></a>
					<a class="header-cart cart-toggle" href="#!" aria-label="Giỏ hàng"><i
							class="fa-regular fa-cart-shopping"></i><span class="qty"><?php
                            $items_count = WC()->cart->get_cart_contents_count();
                            echo ($items_count) ? $items_count : 0; 
                        ?></span></a>
					<div class="header-hamburger">
						<div class="hamburger-inner">
							<div class="hamburger-front"><i class="fa-regular fa-bars"></i></div>
							<div class="hamburger-back"><i class="fa-solid fa-xmark"></i></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>

<div class="mini-cart-popup">
	<?php woocommerce_mini_cart(); ?>
</div>
<div class="mini-cart-backdrop backdrop cart-toggle"></div>

<div class="wrap-menu-mobile">
	<div class="menu-mobile">
		<div class="mm-header">
			<a class="mm-logo" href="<?= home_url() ?>">
				<img class="lozad" data-src="<?= $header_logo_main ?>" alt="">
			</a>
			<button class="mm-close" type="button" aria-label="Đóng menu"><i class="fa-regular fa-xmark"></i></button>
		</div>
		<div class="mm-body">
			<?php 
            wp_nav_menu([
                "theme_location" => "header-menu",
                "container" => false,
                "menu_class" => "mm-nav",
                "walker" => new Mobile_Menu_Walker() // Gọi Walker tuỳ chỉnh
            ]); 
            ?>
		</div>
	</div>
	<div class="modal-menu"></div>
</div>
<div id="container-toast"></div>