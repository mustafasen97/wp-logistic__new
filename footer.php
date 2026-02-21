<?php
declare(strict_types=1);

if (! defined('ABSPATH')) {
    exit;
}
?>
<section class="footer-newsletter" aria-label="<?php esc_attr_e('Newsletter', 'wp-logistic-pro'); ?>">
    <div class="site-container">
        <?php if (is_active_sidebar('footer-newsletter')) {
            dynamic_sidebar('footer-newsletter');
        } ?>
    </div>
</section>
<footer class="site-footer" role="contentinfo" itemscope itemtype="https://schema.org/Organization">
    <div class="site-container">
        <meta itemprop="name" content="<?php echo esc_attr(get_bloginfo('name')); ?>">
        <meta itemprop="url" content="<?php echo esc_url(home_url('/')); ?>">
        <?php wp_nav_menu(['theme_location' => 'footer', 'container' => false, 'fallback_cb' => false]); ?>
        <p class="site-footer__copyright">&copy; <?php echo esc_html(wp_date('Y')); ?> <?php bloginfo('name'); ?></p>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
