<?php
declare(strict_types=1);

if (! defined('ABSPATH')) {
    exit;
}

get_header();
?>
<main class="front-page" role="main">
    <section class="hero">
        <div class="site-container">
            <h1><?php echo esc_html(get_theme_mod('wplog_hero_heading', __('Reliable Logistics Solutions', 'wp-logistic-pro'))); ?></h1>
            <p><?php echo esc_html(get_bloginfo('description')); ?></p>
            <a class="btn btn--primary" href="#quote"><?php esc_html_e('Request a Quote', 'wp-logistic-pro'); ?></a>
        </div>
    </section>

    <section class="services" aria-label="<?php esc_attr_e('Services', 'wp-logistic-pro'); ?>">
        <div class="site-container">
            <h2><?php esc_html_e('Our Services', 'wp-logistic-pro'); ?></h2>
            <?php
            $services = get_option('wplog_services', []);
            $rows = [];
            if (is_array($services) && ! empty($services['json'])) {
                $decoded = json_decode((string) $services['json'], true);
                if (is_array($decoded)) {
                    $rows = $decoded;
                }
            }
            ?>
            <div class="services__grid">
                <?php if ($rows !== []) : foreach ($rows as $service) : ?>
                    <article class="service-card">
                        <h3><?php echo esc_html((string) ($service['title'] ?? __('Service', 'wp-logistic-pro'))); ?></h3>
                        <p><?php echo esc_html((string) ($service['description'] ?? '')); ?></p>
                    </article>
                <?php endforeach; else : ?>
                    <p><?php esc_html_e('Add services from Theme Management → Services.', 'wp-logistic-pro'); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>
<?php
get_footer();
