<?php
declare(strict_types=1);

if (! defined('ABSPATH')) {
    exit;
}

function wplog_theme_setup(): void
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
    add_theme_support('custom-logo', ['height' => 80, 'width' => 240, 'flex-height' => true, 'flex-width' => true]);
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('automatic-feed-links');

    register_nav_menus([
        'primary' => __('Primary Menu', 'wp-logistic-pro'),
        'footer'  => __('Footer Menu', 'wp-logistic-pro'),
    ]);
}
add_action('after_setup_theme', 'wplog_theme_setup');

function wplog_register_sidebars(): void
{
    $sidebars = [
        'page-sidebar' => __('Page Sidebar', 'wp-logistic-pro'),
        'sidebar-quote' => __('Sidebar Quick Quote', 'wp-logistic-pro'),
        'sidebar-faq' => __('Sidebar FAQ', 'wp-logistic-pro'),
        'sidebar-services' => __('Sidebar Services', 'wp-logistic-pro'),
        'footer-newsletter' => __('Footer Newsletter Area', 'wp-logistic-pro'),
    ];

    foreach ($sidebars as $id => $name) {
        register_sidebar([
            'name'          => $name,
            'id'            => $id,
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h3 class="widget__title">',
            'after_title'   => '</h3>',
        ]);
    }
}
add_action('widgets_init', 'wplog_register_sidebars');
