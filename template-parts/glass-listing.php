<?php
/**
 * Shared body for listing pages (hub + category root).
 *
 * Self-contained: resolves the page id from the global $post, reads its ACF
 * content, renders one intro-and-grid section + global trust sections, and emits
 * Service (+ FAQPage) schema. Both template-glass-hub.php and template-glass-root.php
 * are thin wrappers around this. No credential marquee here (it lives on the
 * conversion spokes); the hero bullets + reviews carry trust on category pages.
 *
 * @package SolidGuard
 */

$id = ! empty( $GLOBALS['post'] ) ? (int) $GLOBALS['post']->ID : get_queried_object_id();

$overview_heading  = get_field( 'overview_heading', $id );
$overview_body     = get_field( 'overview_body', $id );
$final_cta_heading = get_field( 'final_cta_heading', $id );
$faqs              = get_field( 'faqs', $id );
$hero_h1           = get_field( 'hero_h1', $id );
$hero_subhead      = get_field( 'hero_subhead', $id );

$page_kw = wp_strip_all_tags( get_the_title() );
?>

<main id="primary" class="page-main page-main--listing">

    <?php get_template_part( 'template-parts/breadcrumb' ); ?>

    <!-- Hero (CTA variant) -->
    <?php
    $hero_args = array_merge(
        array(
            'h1'        => $hero_h1 ?: $page_kw,
            'subhead'   => $hero_subhead,
            'bullets'   => sg_trust_bullets(),
            'highlight' => get_post_meta( $id, 'rank_math_focus_keyword', true ),
        ),
        sg_hero_visual_args( $id )
    );
    get_template_part( 'template-parts/sections/hero', null, $hero_args );
    ?>

    <!-- Intro + child-service grid (one section) -->
    <section class="section section--white">
        <div class="container">
            <?php if ( $overview_heading ) : ?>
                <h2 class="section-heading"><?php echo esc_html( $overview_heading ); ?></h2>
            <?php endif; ?>
            <?php if ( $overview_body ) : ?>
                <div class="prose service-grid__intro"><?php echo wp_kses_post( wpautop( $overview_body ) ); ?></div>
            <?php endif; ?>
            <?php get_template_part( 'template-parts/sections/service-grid', null, array( 'parent_id' => $id ) ); ?>
        </div>
    </section>

    <!-- Social proof -->
    <?php get_template_part( 'template-parts/sections/reviews' ); ?>

    <!-- Offers (global) -->
    <?php get_template_part( 'template-parts/sections/special-offers' ); ?>

    <!-- Guarantee (global) — sits between the two grey card sections for contrast -->
    <?php get_template_part( 'template-parts/sections/guarantee' ); ?>

    <!-- Service areas (global) -->
    <?php get_template_part( 'template-parts/sections/service-areas-linked' ); ?>

    <!-- FAQ -->
    <?php if ( $faqs ) : ?>
        <?php get_template_part( 'template-parts/sections/faq', null, array(
            'faqs'    => $faqs,
            'heading' => 'Frequently Asked Questions',
        ) ); ?>
    <?php endif; ?>

    <!-- CTA -->
    <?php get_template_part( 'template-parts/sections/cta-callout', null, array(
        'eyebrow'      => $page_kw . ' &middot; Toronto &amp; the GTA',
        'title'        => $final_cta_heading ?: 'Need ' . strtolower( $page_kw ) . '?',
        'subtitle'     => strtolower( $page_kw ) . ' across the GTA. Police-cleared technicians, same or next day. No commitment until you approve the quote.',
        'estimate_url' => home_url( '/contact/' ),
    ) ); ?>

</main>

<?php
sg_schema( array(
    'name'         => $hero_h1 ?: $page_kw,
    'service_type' => $page_kw,
    'url'          => get_permalink( get_the_ID() ),
    'description'  => $hero_subhead,
    'faqs'         => $faqs,
) );
