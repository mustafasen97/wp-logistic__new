<?php
declare(strict_types=1);

if (! defined('ABSPATH')) {
    exit;
}

function wplog_sanitize_text(string $value): string
{
    return sanitize_text_field($value);
}

function wplog_sanitize_checkbox(mixed $value): int
{
    return $value ? 1 : 0;
}

function wplog_sanitize_hex_color(string $value): string
{
    $color = sanitize_hex_color($value);
    return $color ?: '#1e3a8a';
}

function wplog_sanitize_repeater(array $items, array $keys): array
{
    $sanitized = [];
    foreach ($items as $item) {
        if (! is_array($item)) {
            continue;
        }

        $row = [];
        foreach ($keys as $key => $type) {
            $raw = $item[$key] ?? '';
            $row[$key] = match ($type) {
                'url' => esc_url_raw((string) $raw),
                'textarea' => sanitize_textarea_field((string) $raw),
                default => sanitize_text_field((string) $raw),
            };
        }
        $sanitized[] = $row;
    }

    return $sanitized;
}
