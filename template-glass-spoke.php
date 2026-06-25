<?php
/**
 * Template Name: Glass — Service Spoke
 * Template Post Type: page
 *
 * Template 4, the conversion workhorse (~17 pages). Composes the SEO hero +
 * ACF-driven prose sections + global helper sections, then emits Service +
 * FAQPage schema. RankMath owns title/meta/breadcrumb/LocalBusiness.
 *
 * @package SolidGuard
 */

get_header();

$id = get_the_ID();

// --- Hero (CTA variant) ---
get_template_part( 'template-parts/sections/hero', null, array(
    'h1'       => get_field( 'hero_h1' ) ?: get_the_title(),
    'subhead'  => get_field( 'hero_subhead' ),
    'bullets'  => sg_trust_bullets(),
    'image_id' => get_field( 'hero_image' ),
) );
?>

<main id="primary" class="page-main">

    <?php get_template_part( 'template-parts/breadcrumb' ); ?>

    <!-- Credential bar -->
    <?php get_template_part( 'template-parts/sections/trust-bar' ); ?>

    <?php
    $overview_heading    = get_field( 'overview_heading' );
    $overview_body       = get_field( 'overview_body' );
    $repairfirst_heading = get_field( 'repairfirst_heading' );
    $repairfirst_body    = get_field( 'repairfirst_body' );
    $handle_heading      = get_field( 'whatwehandle_heading' );
    $handle_items        = get_field( 'whatwehandle_items' );
    $cost_heading        = get_field( 'cost_heading' );
    $cost_body           = get_field( 'cost_body' );
    $related             = get_field( 'related_services' );
    $final_cta_heading   = get_field( 'final_cta_heading' );

    $faqs = get_field( 'faqs' );
    ?>

    <!-- Overview -->
    <?php if ( $overview_body ) : ?>
        <section class="glass-section">
            <div class="container glass-section__narrow">
                <?php if ( $overview_heading ) : ?>
                    <h2 class="section-heading"><?php echo esc_html( $overview_heading ); ?></h2>
                <?php endif; ?>
                <div class="prose"><?php echo wp_kses_post( $overview_body ); ?></div>
            </div>
        </section>
    <?php endif; ?>

    <!-- Repair-first -->
    <?php if ( $repairfirst_body ) : ?>
        <section class="glass-section glass-section--accent">
            <div class="container glass-section__narrow">
                <?php if ( $repairfirst_heading ) : ?>
                    <h2 class="section-heading"><?php echo esc_html( $repairfirst_heading ); ?></h2>
                <?php endif; ?>
                <div class="prose"><?php echo wp_kses_post( wpautop( $repairfirst_body ) ); ?></div>
            </div>
        </section>
    <?php endif; ?>

    <!-- What we handle -->
    <?php if ( $handle_items ) : ?>
        <section class="glass-section">
            <div class="container glass-section__narrow">
                <?php if ( $handle_heading ) : ?>
                    <h2 class="section-heading"><?php echo esc_html( $handle_heading ); ?></h2>
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
        </section>
    <?php endif; ?>

    <!-- Offers (global) -->
    <?php get_template_part( 'template-parts/sections/special-offers' ); ?>

    <!-- Cost honesty -->
    <?php if ( $cost_body ) : ?>
        <section class="glass-section">
            <div class="container glass-section__narrow">
                <?php if ( $cost_heading ) : ?>
                    <h2 class="section-heading"><?php echo esc_html( $cost_heading ); ?></h2>
                <?php endif; ?>
                <div class="prose"><?php echo wp_kses_post( wpautop( $cost_body ) ); ?></div>
                <a class="btn btn--outline" href="<?php echo esc_url( home_url( '/glass/window-replacement-cost/' ) ); ?>">
                    See cost ranges and estimate your job
                </a>
            </div>
        </section>
    <?php endif; ?>

    <!-- Service areas (global) -->
    <?php get_template_part( 'template-parts/sections/service-areas-linked' ); ?>

    <!-- Social proof (global) -->
    <?php get_template_part( 'template-parts/sections/reviews' ); ?>

    <!-- Guarantee (global) -->
    <?php get_template_part( 'template-parts/sections/guarantee' ); ?>

    <!-- FAQ -->
    <?php if ( $faqs ) : ?>
        <?php get_template_part( 'template-parts/sections/faq', null, array(
            'faqs'    => $faqs,
            'heading' => 'Frequently Asked Questions',
        ) ); ?>
    <?php endif; ?>

    <!-- Related services -->
    <?php if ( $related ) : ?>
        <section class="glass-section">
            <div class="container glass-section__narrow">
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

    <!-- Final CTA band -->
    <section class="glass-cta">
        <div class="container">
            <?php if ( $final_cta_heading ) : ?>
                <h2 class="glass-cta__heading"><?php echo esc_html( $final_cta_heading ); ?></h2>
            <?php endif; ?>
            <p class="glass-cta__sub">Around the clock rapid response, same or next day across the GTA.</p>
            <div class="glass-cta__btns">
                <a class="btn btn--orange btn--lg" href="tel:<?php echo esc_attr( SG_PHONE_RAW ); ?>">
                    <?php echo sg_icon( 'call', 'icon-sm' ); ?>
                    Call Now <?php echo esc_html( SG_PHONE_DISPLAY ); ?>
                </a>
                <a class="btn btn--outline-white btn--lg" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">
                    Get a Quick Estimate
                </a>
            </div>
        </div>
    </section>

</main>

<?php
sg_schema( $id );
get_footer();
