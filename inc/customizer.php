<?php
declare(strict_types=1);

if (! defined('ABSPATH')) {
    exit;
}

function wplog_customize_register(WP_Customize_Manager $wp_customize): void
{
    $wp_customize->add_section('wplog_topbar', ['title' => __('Topbar', 'wp-logistic-pro'), 'priority' => 20]);
    $wp_customize->add_setting('wplog_topbar_show', ['default' => 1, 'sanitize_callback' => 'wplog_sanitize_checkbox']);
    $wp_customize->add_control('wplog_topbar_show', ['label' => __('Show topbar', 'wp-logistic-pro'), 'section' => 'wplog_topbar', 'type' => 'checkbox']);

    $wp_customize->add_section('wplog_header', ['title' => __('Header', 'wp-logistic-pro'), 'priority' => 21]);
    $wp_customize->add_setting('wplog_header_cta_text', ['default' => __('Get Quote', 'wp-logistic-pro'), 'sanitize_callback' => 'wplog_sanitize_text']);
    $wp_customize->add_control('wplog_header_cta_text', ['label' => __('Header button text', 'wp-logistic-pro'), 'section' => 'wplog_header']);

    $wp_customize->add_section('wplog_hero', ['title' => __('Hero', 'wp-logistic-pro'), 'priority' => 22]);
    $wp_customize->add_setting('wplog_hero_heading', ['default' => __('Reliable Logistics Solutions', 'wp-logistic-pro'), 'sanitize_callback' => 'wplog_sanitize_text']);
    $wp_customize->add_control('wplog_hero_heading', ['label' => __('Hero heading', 'wp-logistic-pro'), 'section' => 'wplog_hero']);

    $wp_customize->add_section('wplog_theme_colors', ['title' => __('Theme Colors', 'wp-logistic-pro'), 'priority' => 40]);
    foreach (['primary' => '#fb923c', 'secondary' => '#1e3a8a', 'accent' => '#3b82f6'] as $key => $value) {
        $id = 'wplog_color_' . $key;
        $wp_customize->add_setting($id, ['default' => $value, 'sanitize_callback' => 'wplog_sanitize_hex_color']);
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $id, ['label' => ucfirst($key), 'section' => 'wplog_theme_colors']));
    }
}
add_action('customize_register', 'wplog_customize_register');

function wplog_customize_css_vars(): void
{
    $primary = get_theme_mod('wplog_color_primary', '#fb923c');
    $secondary = get_theme_mod('wplog_color_secondary', '#1e3a8a');
    $accent = get_theme_mod('wplog_color_accent', '#3b82f6');
    echo '<style>:root{--wplog-primary:' . esc_attr($primary) . ';--wplog-secondary:' . esc_attr($secondary) . ';--wplog-accent:' . esc_attr($accent) . ';}</style>';
}
add_action('wp_head', 'wplog_customize_css_vars', 99);
