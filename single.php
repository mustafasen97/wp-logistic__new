<?php
declare(strict_types=1);

if (! defined('ABSPATH')) {
    exit;
}

get_header();
?>
<main class="site-page" role="main">
    <div class="site-container content-layout">
        <article <?php post_class('content-main'); ?>>
            <?php while (have_posts()) : the_post(); ?>
                <?php the_title('<h1>', '</h1>'); ?>
                <?php the_content(); ?>
            <?php endwhile; ?>
        </article>
        <?php get_sidebar(); ?>
    </div>
</main>
<?php
get_footer();
