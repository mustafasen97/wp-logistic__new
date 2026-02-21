<?php
declare(strict_types=1);

if (! defined('ABSPATH')) {
    exit;
}

function wplog_admin_menu(): void
{
    add_menu_page(__('Theme Management', 'wp-logistic-pro'), __('Theme Management', 'wp-logistic-pro'), 'manage_options', 'wplog-theme-management', 'wplog_render_services_page', 'dashicons-admin-generic', 58);

    $menus = [
        'services' => __('Services', 'wp-logistic-pro'),
        'faq' => __('FAQ', 'wp-logistic-pro'),
        'testimonials' => __('Testimonials', 'wp-logistic-pro'),
        'forms' => __('Forms', 'wp-logistic-pro'),
        'contact' => __('Contact Info', 'wp-logistic-pro'),
        'why-choose-us' => __('Why Choose Us', 'wp-logistic-pro'),
        'newsletter' => __('Newsletter', 'wp-logistic-pro'),
        'map-embed' => __('Map Embed', 'wp-logistic-pro'),
    ];

    foreach ($menus as $slug => $label) {
        add_submenu_page('wplog-theme-management', $label, $label, 'manage_options', 'wplog-' . $slug, 'wplog_render_settings_page');
    }
}
add_action('admin_menu', 'wplog_admin_menu');

function wplog_register_theme_settings(): void
{
    $groups = ['services', 'faq', 'testimonials', 'forms', 'contact', 'why_choose_us', 'newsletter', 'map_embed'];

    foreach ($groups as $group) {
        register_setting('wplog_' . $group, 'wplog_' . $group, [
            'type' => 'array',
            'sanitize_callback' => 'wplog_sanitize_settings_array',
            'default' => [],
            'show_in_rest' => false,
        ]);

        add_settings_section('wplog_' . $group . '_main', __('Configuration', 'wp-logistic-pro'), '__return_false', 'wplog_' . $group);
        add_settings_field('wplog_' . $group . '_json', __('Data JSON', 'wp-logistic-pro'), 'wplog_render_json_field', 'wplog_' . $group, 'wplog_' . $group . '_main', ['group' => $group]);
    }
}
add_action('admin_init', 'wplog_register_theme_settings');

function wplog_sanitize_settings_array(mixed $input): array
{
    if (! current_user_can('manage_options')) {
        return [];
    }

    if (! is_array($input)) {
        return [];
    }

    $sanitized = [];
    foreach ($input as $key => $value) {
        $clean_key = sanitize_key((string) $key);
        if (is_array($value)) {
            $sanitized[$clean_key] = array_map(static fn ($item): string => sanitize_text_field((string) $item), $value);
        } else {
            $sanitized[$clean_key] = sanitize_text_field((string) $value);
        }
    }

    return $sanitized;
}

function wplog_render_json_field(array $args): void
{
    $group = sanitize_key((string) ($args['group'] ?? ''));
    $option = get_option('wplog_' . $group, []);
    echo '<textarea name="wplog_' . esc_attr($group) . '[json]" rows="12" class="large-text code">' . esc_textarea((string) ($option['json'] ?? '')) . '</textarea>';
    echo '<p class="description">' . esc_html__('Provide structured data in JSON format.', 'wp-logistic-pro') . '</p>';
}

function wplog_render_services_page(): void
{
    wplog_render_settings_page();
}

function wplog_render_settings_page(): void
{
    if (! current_user_can('manage_options')) {
        wp_die(esc_html__('Unauthorized.', 'wp-logistic-pro'));
    }

    $page = isset($_GET['page']) ? sanitize_key((string) wp_unslash($_GET['page'])) : 'wplog-services';
    $group = str_replace('wplog-', '', $page);
    $group = str_replace('-', '_', $group);
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('wplog_' . $group);
            do_settings_sections('wplog_' . $group);
            submit_button();
            ?>
        </form>
    </div>
    <?php
}
