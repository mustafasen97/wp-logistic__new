<?php
declare(strict_types=1);

if (! defined('ABSPATH')) {
    exit;
}
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="site-header" role="banner">
    <?php if ((bool) get_theme_mod('wplog_topbar_show', 1)) : ?>
        <div class="site-header__topbar">
            <div class="site-container"><?php echo esc_html(get_option('blogdescription')); ?></div>
        </div>
    <?php endif; ?>
    <div class="site-container site-header__main">
        <div class="site-header__brand"><?php the_custom_logo(); ?><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></div>
        <nav class="site-nav" aria-label="<?php esc_attr_e('Primary menu', 'wp-logistic-pro'); ?>">
            <?php wp_nav_menu(['theme_location' => 'primary', 'container' => false, 'fallback_cb' => false]); ?>
        </nav>
        <a class="btn btn--primary" href="<?php echo esc_url(get_permalink(get_option('page_for_posts')) ?: home_url('/')); ?>"><?php echo esc_html(get_theme_mod('wplog_header_cta_text', __('Get Quote', 'wp-logistic-pro'))); ?></a>
    </div>
</header>
