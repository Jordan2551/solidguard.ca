<?php
/**
 * Front page template — SolidGuard landing page
 *
 * @package SolidGuard
 */

get_header();
?>

<main id="primary" class="page-main">

    <?php get_template_part( 'template-parts/sections/hero' ); ?>

    <?php get_template_part( 'template-parts/sections/services' ); ?>

    <?php get_template_part( 'template-parts/sections/cta-callout' ); ?>

    <?php get_template_part( 'template-parts/sections/reviews' ); ?>

    <?php get_template_part( 'template-parts/sections/trust-bar' ); ?>

    <?php get_template_part( 'template-parts/sections/special-offers' ); ?>

    <?php get_template_part( 'template-parts/sections/guarantee' ); ?>

    <?php get_template_part( 'template-parts/sections/service-areas' ); ?>

    <?php get_template_part( 'template-parts/sections/faq' ); ?>

</main>

<?php get_template_part( 'template-parts/sections/modals' ); ?>

<?php get_footer(); ?>
