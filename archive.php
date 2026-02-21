<?php
declare(strict_types=1);

if (! defined('ABSPATH')) {
    exit;
}

get_header();
?>
<main class="site-page" role="main">
    <div class="site-container content-layout">
        <section class="content-main">
            <h1><?php the_archive_title(); ?></h1>
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <article <?php post_class(); ?>>
                    <?php the_title('<h2><a href="' . esc_url(get_permalink()) . '">', '</a></h2>'); ?>
                    <?php the_excerpt(); ?>
                </article>
            <?php endwhile; the_posts_pagination(); else : ?>
                <p><?php esc_html_e('No posts found.', 'wp-logistic-pro'); ?></p>
            <?php endif; ?>
        </section>
        <?php get_sidebar(); ?>
    </div>
</main>
<?php
get_footer();
