<?php
declare(strict_types=1);

if (! defined('ABSPATH')) {
    exit;
}

get_header();
?>
<main class="site-page" role="main">
    <div class="site-container">
        <nav class="breadcrumb" aria-label="<?php esc_attr_e('Breadcrumb', 'wp-logistic-pro'); ?>">
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'wp-logistic-pro'); ?></a> &gt; <span><?php the_title(); ?></span>
        </nav>
        <div class="content-layout">
            <article <?php post_class('content-main'); ?>>
                <?php
                while (have_posts()) :
                    the_post();
                    the_title('<h1>', '</h1>');
                    the_content();
                endwhile;
                ?>
            </article>
            <?php get_sidebar(); ?>
        </div>
    </div>
</main>
<?php
get_footer();
