# WP Logistic Pro Theme

## Installation
1. Copy theme files into `wp-content/themes/wp-logistic-pro`.
2. Activate **WP Logistic Pro** in Appearance → Themes.
3. Open Appearance → Customize to adjust visual settings.
4. Open **Theme Management** in wp-admin to configure Services, FAQ, Testimonials, Forms, Contact, Why Choose Us, Newsletter, and Map Embed.

## Security Notes
- No raw SQL or direct command execution is used.
- Form submission uses nonce verification, capability checks, honeypot, and transient-based rate limiting.
- Store any external API secrets in `wp-config.php`, not in theme files.

## Customization Guide
- Colors: Appearance → Customize → Theme Colors.
- Hero copy and top bar: Appearance → Customize.
- Sidebar content: Appearance → Widgets for Quick Quote, FAQ, and Services.
- Homepage service cards: Theme Management → Services using JSON array.

## Performance
- Assets are versioned with `filemtime`.
- Frontend script loads only on the front page.
- Deferred script loading is enabled for theme JS.
