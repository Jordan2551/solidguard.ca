<?php
/**
 * Front page template - SolidGuard landing page
 *
 * @package SolidGuard
 */

$GLOBALS['sg_meta'] = array(
    'title'       => 'SolidGuard Glass & Windows | Toronto & GTA Glass Repair',
    'description' => 'Fast, professional glass repair and replacement across the GTA. Residential, commercial, emergency, and storefront glass services. Licensed, insured, and background-checked technicians.',
    'url'         => home_url( '/' ),
);

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


</main>

<?php get_template_part( 'template-parts/sections/modals' ); ?>

<?php get_footer(); ?>
