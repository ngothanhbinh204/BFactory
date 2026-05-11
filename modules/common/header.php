<?php
$searchUrl = home_url() . "/?s=";
?>
<header>
    <div class="container-header">
        <div class="header-child">
            <div class="header-logo"><a href="<?= home_url() ?>"><img class="lozad" data-src="<?= THEME_URI ?>/UI/img/logo_main.svg" alt="" /></a>
            </div>
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
                        <!-- WPML or similar logic -->
                         <div id="google_translate_element"></div>
                    </div>
                    <?php
                    $woo_account_page = get_option('woocommerce_myaccount_page_id');
                    $woo_account_page_url = get_permalink($woo_account_page);
                    ?>
                    <a class="header-account" href="<?= $woo_account_page_url ?>" aria-label="Tài khoản"><i class="fa-regular fa-user"></i></a>
                    <a class="header-cart cart-toggle"><i class="fa-regular fa-cart-shopping"></i><span class="qty"><?php
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
<div class="menu-mobile-backdrop backdrop "></div>
<div class="menu-mobile">
	<div class="menu-mobile-wrapper">
		<div class="menu-mobile-header">
			<div class="close-menu close-menu-mobile"><span class="far fa-xmark"></span></div>
			<div class="logo">
				<?php echo get_custom_logo(); ?>
			</div>
		</div>
		<div class="menu-mobile-body"></div>
	</div>
</div>
<div class="wrap-menu-mobile">
    <div class="menu-mobile">
        <div class="menu-logo"> <a href="<?= home_url() ?>"><img class="lozad" data-src="<?= THEME_URI ?>/UI/img/logo-default.png" alt="" /></a>
        </div>
        <div class="menu-list">
            <?php wp_nav_menu([
                "theme_location" => "header-menu",
                "container" => false,
                "menu_class" => "wrap-item-toggle",
            ]); ?>
        </div>
    </div>
    <div class="modal-menu"></div>
</div>
<div id="container-toast"></div>