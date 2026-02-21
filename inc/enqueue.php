<?php
declare(strict_types=1);

if (! defined('ABSPATH')) {
    exit;
}

function wplog_enqueue_assets(): void
{
    wp_enqueue_style('wplog-main', get_template_directory_uri() . '/assets/css/theme.css', [], wplog_asset_version('/assets/css/theme.css'));

    if (is_front_page()) {
        wp_enqueue_script('wplog-theme', get_template_directory_uri() . '/assets/js/theme.js', [], wplog_asset_version('/assets/js/theme.js'), true);
    }
}
add_action('wp_enqueue_scripts', 'wplog_enqueue_assets');
