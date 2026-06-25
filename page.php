<?php
/**
 * Default page template — generic content pages (About, legal, etc.).
 *
 * The SEO page types (hub, root, spoke, location, cost) get their own
 * Template Name templates; this is the fallback so WordPress pages render with
 * the site chrome instead of dropping to index.php. Uses the bare get_header()/
 * get_footer(), i.e. the new mega-menu chrome.
 *
 * @package SolidGuard
 */

get_header();
?>

<main id="primary" class="page-main">

    <?php get_template_part( 'template-parts/breadcrumb' ); ?>

    <div class="container">
        <?php
        while ( have_posts() ) :
            the_post();
            ?>
            <article class="page-article">
                <header class="page-article__header">
                    <h1 class="page-article__title"><?php the_title(); ?></h1>
                </header>
                <div class="page-article__content prose">
                    <?php the_content(); ?>
                </div>
            </article>
            <?php
        endwhile;
        ?>
    </div>

</main>

<?php get_footer(); ?>
