<footer class="footer">
    <div class="bg-footer"> <img class="lozad" data-src="<?= THEME_URI ?>/UI/img/bg-footer.png" alt="" />
    </div>
    <div class="footer-body">
        <div class="container">
            <div class="row footer-row">
                <div class="col footer-left lg:w-5/12">
                    <div class="footer-logo"><a href="<?= home_url() ?>"><img class="lozad" data-src="<?= THEME_URI ?>/UI/img/logo_main.svg" alt="" /></a></div>
                    <p class="footer-tagline">Thương hiệu phụ kiện xe máy điện Việt Nam</p>
                    <div class="footer-partner"><span class="partner-label">Liên kết với<br>BFACTORY</span><a
                            class="partner-logo-box" href="#!" target="_blank" rel="noopener"><img class="lozad"
                                data-src="<?= THEME_URI ?>/UI/img/bfactory.png" alt="" /></a></div>
                    <ul class="footer-socials">
                        <li><a href="#!" aria-label="Facebook" target="_blank" rel="noopener"><span class="icon"><i
                                        class="fa-brands fa-facebook-f"></i></span><span
                                    class="label">Facebook</span></a></li>
                        <li><a href="#!" aria-label="Instagram" target="_blank" rel="noopener"><span class="icon"><i
                                        class="fa-brands fa-instagram"></i></span><span
                                    class="label">Instagram</span></a></li>
                        <li><a href="#!" aria-label="Tiktok" target="_blank" rel="noopener"><span class="icon"><i
                                        class="fa-brands fa-tiktok"></i></span><span class="label">Tiktok</span></a>
                        </li>
                    </ul>
                </div>
                <div class="col footer-right lg:w-7/12">
                    <div class="footer-info-block">
                        <h3 class="info-title">Công ty TNHH B-FACTORY</h3>
                        <p class="info-text">Số 519F, Ấp Ngũ Phúc, Phường Hố Nai, Tỉnh Đồng Nai, Việt Nam</p>
                    </div>
                    <div class="footer-info-block">
                        <h4 class="info-title">Hotline</h4>
                        <ul class="info-list">
                            <li><strong>Zalo:</strong> 0901 995 421</li>
                            <li><strong>Miền Bắc:</strong> 0988 886 674</li>
                            <li><strong>Miền Nam:</strong> 0906 323 217</li>
                        </ul>
                    </div>
                    <div class="footer-info-block">
                        <p class="info-text">Thứ 2 - 6: 09:00 - 17:30 - <strong>Sat - Sun:</strong> Closed</p><a
                            class="info-email"
                            href="mailto:contact.bfbike@bfactoryvn.com">contact.bfbike@bfactoryvn.com</a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p class="footer-copyright">© 2026 Bfactorybike. All Rights Reserved. Thiết kế web bởi Cánh Cam.</p>
                <nav class="footer-terms">
                    <?php wp_nav_menu([
                        "theme_location" => "footer-1",
                        "container" => false,
                    ]); ?>
                </nav>
            </div>
        </div>
    </div>
    <div class="footer-brand"><span class="brand-text">BFBIKE - BFBIKE</span></div>
    <div class="tool-fixed-cta">
        <div class="button-to-top"><i class="fa-light fa-arrow-up"></i></div><a class="btn-slide btn-phone" href="">
            <div class="btn-icon"><i class="fa-light fa-phone"></i></div>
            <div class="btn-content"><span>1900 2273 – (028) 7100 0001</span></div>
        </a>
        <div class="btn-slide btn-social">
            <div class="btn-icon"><i class="fa-light fa-messages"></i></div>
            <div class="btn-content">
                <ul>
                    <li><a href=""><i class="fa-light fa-envelope"></i></a></li>
                    <li><a href=""><i class="fa-brands fa-facebook-messenger"></i></a></li>
                    <li><a href=""><i class="fa-brands fa-line"></i></a></li>
                </ul>
            </div>
        </div>
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