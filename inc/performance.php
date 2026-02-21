<?php
declare(strict_types=1);

if (! defined('ABSPATH')) {
    exit;
}

function wplog_asset_version(string $relative_path): string
{
    $file = get_template_directory() . $relative_path;
    return file_exists($file) ? (string) filemtime($file) : wp_get_theme()->get('Version');
}

function wplog_defer_scripts(string $tag, string $handle): string
{
    $deferred = ['wplog-theme'];
    if (in_array($handle, $deferred, true)) {
        return str_replace(' src', ' defer src', $tag);
    }

    return $tag;
}
add_filter('script_loader_tag', 'wplog_defer_scripts', 10, 2);
