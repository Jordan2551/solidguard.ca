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

// Landing-page content (this page is not a seeded WP page, so content comes
// from the LP provider, not ACF). Partials are pure views fed from here.
$lp = sg_lp_content();

get_header( 'lp' );
?>

<main id="primary" class="page-main">

    <?php get_template_part( 'template-parts/sections/hero-lp', null, $lp['hero'] ); ?>

    <?php get_template_part( 'template-parts/sections/services', null, $lp['services'] ); ?>

    <?php get_template_part( 'template-parts/sections/cta-callout' ); ?>

    <?php get_template_part( 'template-parts/sections/reviews' ); ?>

    <?php get_template_part( 'template-parts/sections/trust-bar' ); ?>

    <?php get_template_part( 'template-parts/sections/special-offers' ); ?>

    <?php get_template_part( 'template-parts/sections/guarantee' ); ?>

    <?php get_template_part( 'template-parts/sections/service-areas' ); ?>


</main>

<?php get_template_part( 'template-parts/sections/modals' ); ?>

<?php get_footer( 'lp' ); ?>
