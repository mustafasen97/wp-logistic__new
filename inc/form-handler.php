<?php
declare(strict_types=1);

if (! defined('ABSPATH')) {
    exit;
}

function wplog_handle_quote_form(): void
{
    if (! isset($_POST['wplog_quote_nonce'])) {
        return;
    }

    if (! wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['wplog_quote_nonce'])), 'wplog_quote_submit')) {
        wp_die(esc_html__('Security validation failed.', 'wp-logistic-pro'));
    }

    if (! empty($_POST['company_name'])) {
        wp_safe_redirect(add_query_arg('quote_status', 'spam', wp_get_referer() ?: home_url('/')));
        exit;
    }

    $ip = sanitize_text_field((string) ($_SERVER['REMOTE_ADDR'] ?? '0.0.0.0'));
    $rate_key = 'wplog_quote_' . md5($ip);
    $attempts = (int) get_transient($rate_key);

    if ($attempts > 5) {
        wp_safe_redirect(add_query_arg('quote_status', 'limited', wp_get_referer() ?: home_url('/')));
        exit;
    }

    set_transient($rate_key, $attempts + 1, MINUTE_IN_SECONDS * 30);

    $name = isset($_POST['name']) ? sanitize_text_field(wp_unslash($_POST['name'])) : '';
    $email = isset($_POST['email']) ? sanitize_email(wp_unslash($_POST['email'])) : '';
    $message = isset($_POST['message']) ? sanitize_textarea_field(wp_unslash($_POST['message'])) : '';

    if ($name === '' || ! is_email($email) || $message === '') {
        wp_safe_redirect(add_query_arg('quote_status', 'invalid', wp_get_referer() ?: home_url('/')));
        exit;
    }

    wp_mail(get_option('admin_email'), __('New quote request', 'wp-logistic-pro'), "Name: {$name}\nEmail: {$email}\nMessage: {$message}");
    wp_safe_redirect(add_query_arg('quote_status', 'success', wp_get_referer() ?: home_url('/')));
    exit;
}
add_action('admin_post_nopriv_wplog_quote_submit', 'wplog_handle_quote_form');
add_action('admin_post_wplog_quote_submit', 'wplog_handle_quote_form');
