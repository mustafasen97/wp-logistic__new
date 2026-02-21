<?php
declare(strict_types=1);

if (! defined('ABSPATH')) {
    exit;
}

$theme_includes = [
    'inc/setup.php',
    'inc/sanitization.php',
    'inc/security.php',
    'inc/performance.php',
    'inc/enqueue.php',
    'inc/customizer.php',
    'inc/admin-pages.php',
    'inc/form-handler.php',
];

foreach ($theme_includes as $file) {
    $path = get_template_directory() . '/' . $file;
    if (file_exists($path)) {
        require_once $path;
    }
}
