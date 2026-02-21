<?php
declare(strict_types=1);

if (! defined('ABSPATH')) {
    exit;
}
?>
<aside class="content-sidebar" aria-label="<?php esc_attr_e('Page sidebar', 'wp-logistic-pro'); ?>">
    <?php if (is_active_sidebar('sidebar-quote')) {
        dynamic_sidebar('sidebar-quote');
    } ?>
    <?php if (is_active_sidebar('sidebar-faq')) {
        dynamic_sidebar('sidebar-faq');
    } ?>
    <?php if (is_active_sidebar('sidebar-services')) {
        dynamic_sidebar('sidebar-services');
    } ?>
</aside>
