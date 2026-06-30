<?php
/**
 * Template Name: Glass — Service Spoke
 * Template Post Type: page
 *
 * Template 4, the conversion workhorse (~17 pages). Composes the SEO hero +
 * ACF-driven sections + global helpers, then emits Service + FAQPage schema.
 * RankMath owns title/meta/breadcrumb/LocalBusiness.
 *
 * @package SolidGuard
 */

// Resolve the page id from the global $post (reliable here; the queried-object
// id is 0 at template top on this site, see the id-gotcha memory). Pass it
// explicitly to every get_field() and to sg_schema().
$id = ! empty( $GLOBALS['post'] ) ? (int) $GLOBALS['post']->ID : get_queried_object_id();

get_header();

$overview_heading    = get_field( 'overview_heading', $id );
$overview_body       = get_field( 'overview_body', $id );
$repairfirst_body    = get_field( 'repairfirst_body', $id );
$handle_heading      = get_field( 'whatwehandle_heading', $id );
$handle_items        = get_field( 'whatwehandle_items', $id );
$related             = get_field( 'related_services', $id );
$final_cta_heading   = get_field( 'final_cta_heading', $id );
$faqs                = get_field( 'faqs', $id );
$hero_h1             = get_field( 'hero_h1', $id );
$hero_subhead        = get_field( 'hero_subhead', $id );

// Before/after pair. Only renders when both real images are uploaded (ACF);
// otherwise the overview runs full-width. No placeholder images.
$before_img          = get_field( 'before_image', $id );
$after_img           = get_field( 'after_image', $id );

// The spoke's post title is its service keyword (e.g. "Window Glass Repair").
// get_the_title() with no arg reads the global $post (reliable; the queried
// object id is 0 at template top on this site — see the id gotcha memory).
$page_kw = wp_strip_all_tags( get_the_title() );
?>

<main id="primary" class="page-main">

    <?php get_template_part( 'template-parts/breadcrumb' ); ?>

    <!-- Hero (CTA variant). Uploaded cutout overrides the default animated casement. -->
    <?php
    $hero_args = array_merge(
        array(
            'h1'      => $hero_h1 ?: $page_kw,
            'subhead' => $hero_subhead,
            'bullets' => sg_trust_bullets(),
        ),
        sg_hero_visual_args( $id )
    );
    get_template_part( 'template-parts/sections/hero', null, $hero_args );
    ?>

    <!-- Credential bar -->
    <?php get_template_part( 'template-parts/sections/trust-bar' ); ?>

    <!-- Service detail: benefit copy + what we fix (left) + real before/after (right) -->
    <?php if ( $overview_body || $handle_items ) : ?>
        <section class="glass-section">
            <div class="container">
                <div class="glass-overview<?php echo ( $before_img && $after_img ) ? '' : ' glass-overview--solo'; ?>">

                    <div class="glass-overview__copy">

                        <?php if ( $overview_heading ) : ?>
                            <h2 class="section-heading"><?php echo esc_html( $overview_heading ); ?></h2>
                        <?php endif; ?>

                        <?php if ( $overview_body ) : ?>
                            <div class="prose">
                                <?php echo wp_kses_post( wpautop( $overview_body ) ); ?>
                                <?php if ( $repairfirst_body ) : ?>
                                    <?php echo wp_kses_post( wpautop( $repairfirst_body ) ); ?>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <?php if ( $handle_items ) : ?>
                            <div class="glass-handle">
                                <?php if ( $handle_heading ) : ?>
                                    <h3 class="glass-handle__title"><?php echo esc_html( $handle_heading ); ?></h3>
                                <?php endif; ?>
                                <ul class="check-list check-list--cols" role="list">
                                    <?php foreach ( $handle_items as $row ) : ?>
                                        <li class="check-list__item">
                                            <?php echo sg_icon( 'check_circle', 'icon-sm' ); ?>
                                            <?php echo esc_html( $row['item'] ); ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                    </div>

                    <?php if ( $before_img && $after_img ) : ?>
                        <div class="glass-overview__media">
                            <?php get_template_part( 'template-parts/blocks/before-after', null, array(
                                'before'     => $before_img,
                                'after'      => $after_img,
                                'layout'     => 'side-by-side',
                                'cap_before' => 'Before',
                                'cap_after'  => 'After',
                                // Descriptive, keyword-aware alt (caption stays Before/After).
                                'alt_before' => 'Damaged glass before ' . strtolower( $page_kw ),
                                'alt_after'  => 'Finished ' . strtolower( $page_kw ) . ' in Toronto',
                            ) ); ?>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- Social proof (lifted above offers, so trust precedes the ask) -->
    <?php get_template_part( 'template-parts/sections/reviews' ); ?>

    <!-- Offers (global) -->
    <?php get_template_part( 'template-parts/sections/special-offers' ); ?>

    <!-- Cost: repair-first savings calculator (reads pricing.php) -->
    <?php get_template_part( 'template-parts/sections/savings-teaser', null, array(
        'keyword' => strtolower( $page_kw ),
    ) ); ?>

    <!-- Service areas (global) -->
    <?php get_template_part( 'template-parts/sections/service-areas-linked' ); ?>

    <!-- Guarantee (global) -->
    <?php get_template_part( 'template-parts/sections/guarantee' ); ?>

    <!-- FAQ -->
    <?php if ( $faqs ) : ?>
        <?php get_template_part( 'template-parts/sections/faq', null, array(
            'faqs'    => $faqs,
            'heading' => 'Frequently Asked Questions',
        ) ); ?>
    <?php endif; ?>

    <!-- CTA: van callout, keyword-optimized (above related services) -->
    <?php get_template_part( 'template-parts/sections/cta-callout', null, array(
        'eyebrow'      => $page_kw . ' &middot; Toronto &amp; the GTA',
        'title'        => $final_cta_heading ?: 'Glass broken? We are on our way.',
        'subtitle'     => 'Fast ' . strtolower( $page_kw ) . ' across the GTA. Repair-first, police-cleared technicians, same or next day. No commitment until you approve the quote.',
        'estimate_url' => home_url( '/contact/' ),
    ) ); ?>

    <!-- Related services -->
    <?php if ( $related ) : ?>
        <section class="glass-section glass-section--muted">
            <div class="container">
                <h2 class="section-heading">Related services</h2>
                <ul class="related-links" role="list">
                    <?php foreach ( $related as $r ) : ?>
                        <li>
                            <a href="<?php echo esc_url( $r['url'] ); ?>">
                                <?php echo esc_html( $r['label'] ); ?>
                                <?php echo sg_icon( 'arrow_forward', 'icon-xs' ); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </section>
    <?php endif; ?>

</main>

<?php
sg_schema( array(
    'name'         => $hero_h1 ?: $page_kw,
    'service_type' => $page_kw,
    'url'          => get_permalink( get_the_ID() ),
    'description'  => $hero_subhead,
    'faqs'         => $faqs,
) );
get_footer();
