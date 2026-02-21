<?php
declare(strict_types=1);

if (! defined('ABSPATH')) {
    exit;
}

function wplog_filter_wp_headers(array $headers): array
{
    if (is_admin()) {
        return $headers;
    }

    $headers['X-Content-Type-Options'] = 'nosniff';
    $headers['X-Frame-Options'] = 'SAMEORIGIN';
    $headers['Referrer-Policy'] = 'strict-origin-when-cross-origin';

    return $headers;
}
add_filter('wp_headers', 'wplog_filter_wp_headers');
