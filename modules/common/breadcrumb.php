<?php

$object = get_queried_object();

$id = null;
$title = '';

if ($object instanceof WP_Term) {

	$id = $object->taxonomy . '_' . $object->term_id;
	$title = $object->name;

} elseif (is_shop()) {

	$shop_id = wc_get_page_id('shop');

	$id = $shop_id;
	$title = get_the_title($shop_id);

} elseif (is_singular()) {

	$id = get_the_ID();
	$title = get_the_title();

}

$banner = get_field('banner_select_page', $id);

?>
<section class="global-breadcrumb">
    <div class="container">
        <nav class="rank-math-breadcrumb" aria-label="breadcrumbs">
            <p>
                <a href="<?= home_url() ?>"><?= __('Trang chủ', 'canhcamtheme') ?></a><span class="separator"> | </span>
                <span class="last"><?= $title ?></span>
            </p>
        </nav>
    </div>
</section>