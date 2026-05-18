import os

replacements = {
    'template-parts/section/about-help.php': [
        ('<h2 class="section-title">', '<h2 class="section-title" data-ripple-text data-ripple-text-types="words" data-ripple-text-delay="0.08">'),
        ('<div class="help-list">', '<div class="help-list" data-stagger data-stagger-delay="0.14" data-stagger-duration="0.7">'),
        ('<a class="help-item" href="#!">', '<a class="help-item" href="#!" data-stagger-item>')
    ],
    'template-parts/section/about-intro.php': [
        ('<p class="about-label">', '<p class="about-label" data-aos="fade-up">'),
        ('<h2 class="about-title">', '<h2 class="about-title" data-ripple-text data-ripple-text-types="lines" data-ripple-text-delay="0.08">'),
        ('<div class="about-body">', '<div class="about-body" data-stagger data-stagger-delay="0.1" data-stagger-duration="0.7">'),
        ('<div class="about-body__col">', '<div class="about-body__col" data-stagger-item>'),
        ('<div class="about-image">', '<div class="about-image" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">')
    ],
    'template-parts/section/about-mission.php': [
        ('<div class="mission-image">', '<div class="mission-image" data-aos="fade-right" data-aos-duration="1000">'),
        ('<h2 class="section-title">', '<h2 class="section-title" data-ripple-text data-ripple-text-types="words" data-ripple-text-delay="0.07">'),
        ('<p class="mission-subtitle">', '<p class="mission-subtitle" data-aos="fade-up" data-aos-delay="100">'),
        ('<ul class="mission-list">', '<ul class="mission-list" data-stagger data-stagger-delay="0.13" data-stagger-duration="0.6">'),
        ('<li class="mission-item">', '<li class="mission-item" data-stagger-item>')
    ],
    'template-parts/section/about-tech.php': [
        ('<h2 class="section-title left">', '<h2 class="section-title left" data-ripple-text data-ripple-text-types="words" data-ripple-text-delay="0.07">'),
        ('<p class="tech-subtitle">', '<p class="tech-subtitle" data-aos="fade-up" data-aos-delay="100">'),
        ('<div class="tech-box">', '<div class="tech-box" data-aos="fade-up" data-aos-delay="200" data-aos-duration="900">'),
        ('<div class="tech-image">', '<div class="tech-image" data-aos="fade-left" data-aos-duration="1100" data-aos-delay="150">')
    ],
    'template-parts/section/about-values.php': [
        ('<h2 class="section-title white left">', '<h2 class="section-title white left" data-ripple-text data-ripple-text-types="words" data-ripple-text-delay="0.08">'),
        ('<div class="block-grid">', '<div class="block-grid" data-stagger data-stagger-delay="0.18" data-stagger-duration="0.8" data-stagger-dir="bottom">'),
        ('<div class="item-grid" data-height-options', '<div class="item-grid" data-stagger-item data-height-options')
    ],
    'template-parts/section/about-vision.php': [
        ('<div class="group-title">', '<div class="group-title" data-aos="fade-up">'),
        ('<h2 class="section-title">', '<h2 class="section-title" data-ripple-text data-ripple-text-types="words" data-ripple-text-delay="0.07">'),
        ('<div class="vision-quote">', '<div class="vision-quote" data-aos="fade-up" data-aos-delay="200" data-aos-duration="900">')
    ],
    'template-parts/section/home-about.php': [
        ('<p class="about-label">', '<p class="about-label" data-aos="fade-up">'),
        ('<h2 class="about-heading">', '<h2 class="about-heading" data-ripple-text data-ripple-text-types="lines" data-ripple-text-delay="0.08">'),
        ('<div class="about-image">', '<div class="about-image" data-aos="fade-right" data-aos-duration="900">'),
        ('<p class="about-intro">', '<p class="about-intro" data-aos="fade-up" data-aos-delay="100">'),
        ('<div class="about-text">', '<div class="about-text" data-aos="fade-up" data-aos-delay="150">'),
        ('<div class="about-stats">', '<div class="about-stats" data-stagger data-stagger-delay="0.14" data-stagger-duration="0.65">'),
        ('<div class="stat-item">', '<div class="stat-item" data-stagger-item>'),
        ('<a class="btn btn-primary-outline" href="<?php echo esc_url($home_about_button[\'url\']); ?>">', '<a class="btn btn-primary-outline" href="<?php echo esc_url($home_about_button[\'url\']); ?>" data-aos="fade-up" data-aos-delay="200">'),
        ('<div class="about-brand-text" aria-hidden="true">BFBIKE</div>', '<div class="about-brand-text" aria-hidden="true" data-aos="fade-right" data-aos-duration="1200" data-aos-delay="100">BFBIKE</div>')
    ],
    'template-parts/section/home-banner.php': [
        ('<div class="banner-controls">', '<div class="banner-controls" data-aos="fade-up" data-aos-delay="700">')
    ],
    'template-parts/section/home-help.php': [
        ('<h2 class="section-title">', '<h2 class="section-title" data-ripple-text data-ripple-text-types="chars" data-ripple-text-delay="0.05">'),
        ('<div class="help-list">', '<div class="help-list" data-stagger data-stagger-delay="0.12" data-stagger-duration="0.65">'),
        ('<a class="help-item" href="#!">', '<a class="help-item" href="#!" data-stagger-item>')
    ],
    'template-parts/section/home-posts.php': [
        ('<h2 class="section-title">', '<h2 class="section-title" data-ripple-text data-ripple-text-types="words" data-ripple-text-delay="0.07">'),
        ('<nav class="post-filter-nav" aria-label="Lọc bài viết">', '<nav class="post-filter-nav" aria-label="Lọc bài viết" data-aos="fade-up" data-aos-delay="150">'),
        ('<div class="swiper-wrap">', '<div class="swiper-wrap" data-aos="fade-up" data-aos-delay="250" data-aos-duration="800">'),
        ('<div class="section-center-cta">', '<div class="section-center-cta" data-aos="fade-up">')
    ],
    'template-parts/section/home-products.php': [
        ('<h2 class="section-title">', '<h2 class="section-title" data-ripple-text data-ripple-text-types="words" data-ripple-text-delay="0.07">'),
        ('<div class="swiper-wrap">', '<div class="swiper-wrap" data-aos="fade-up" data-aos-delay="150" data-aos-duration="800">'),
        ('<div class="section-center-cta">', '<div class="section-center-cta" data-aos="fade-up">')
    ],
    'template-parts/section/home-video.php': [
        ('<div class="container-inner">', '<div class="container-inner" data-aos="zoom-in" data-aos-duration="1000">'),
        ('<h2 class="video-title">', '<h2 class="video-title" data-ripple-text data-ripple-text-types="chars" data-ripple-text-delay="0.05">'),
        ('<a class="btn btn-white" href="<?php echo esc_url($home_video_button[\'url\']); ?>">', '<a class="btn btn-white" href="<?php echo esc_url($home_video_button[\'url\']); ?>" data-aos="fade-up" data-aos-delay="500">')
    ]
}

for file_path, reps in replacements.items():
    try:
        with open(file_path, 'r', encoding='utf-8') as f:
            content = f.read()
        for old, new in reps:
            content = content.replace(old, new)
        with open(file_path, 'w', encoding='utf-8') as f:
            f.write(content)
        print(f"Updated {file_path}")
    except Exception as e:
        print(f"Error on {file_path}: {e}")

print('Done!')
