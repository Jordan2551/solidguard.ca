<?php
/**
 * Reusable SEO hero — CTA variant (no form).
 *
 * Used by every SEO page type. Pure view: content injected by the template from
 * ACF + sg_trust_bullets(). Optional floating transparent asset (e.g. a cutout
 * window) renders on the right, Nordik-style.
 *
 * @package SolidGuard
 *
 * Expected $args:
 *   h1       string  H1 heading (required)
 *   subhead  string  supporting line
 *   bullets  array   trust bullets (plain strings)
 *   image_id int     optional full-bleed background image attachment id
 *   asset    string  optional transparent cutout URL, floats on the right
 */

$h1       = isset( $args['h1'] ) ? $args['h1'] : '';
$subhead  = isset( $args['subhead'] ) ? $args['subhead'] : '';
$bullets  = isset( $args['bullets'] ) ? (array) $args['bullets'] : array();
$image_id = isset( $args['image_id'] ) ? (int) $args['image_id'] : 0;
$asset    = isset( $args['asset'] ) ? $args['asset'] : '';
$frames   = isset( $args['asset_frames'] ) ? array_filter( (array) $args['asset_frames'] ) : array();

if ( '' === $h1 ) {
    return;
}

$bg = $image_id ? wp_get_attachment_image_url( $image_id, 'full' ) : '';

$classes = 'page-hero';
if ( $bg )                  { $classes .= ' page-hero--image'; }
if ( $asset || $frames )    { $classes .= ' page-hero--asset'; }
?>

<section class="<?php echo esc_attr( $classes ); ?>" aria-label="Hero">

    <?php if ( $bg ) : ?>
        <div class="page-hero__bg" aria-hidden="true">
            <img src="<?php echo esc_url( $bg ); ?>" alt="" loading="eager" fetchpriority="high">
            <div class="page-hero__overlay"></div>
        </div>
    <?php endif; ?>

    <div class="container page-hero__inner">

        <div class="page-hero__copy">

            <h1 class="page-hero__title"><?php echo esc_html( $h1 ); ?></h1>

            <?php if ( '' !== $subhead ) : ?>
                <p class="page-hero__subhead"><?php echo esc_html( $subhead ); ?></p>
            <?php endif; ?>

            <div class="page-hero__ctas">
                <a class="btn btn--orange btn--lg" href="tel:<?php echo esc_attr( SG_PHONE_RAW ); ?>" id="hero-call">
                    <?php echo sg_icon( 'call', 'icon-sm' ); ?>
                    Call Now <?php echo esc_html( SG_PHONE_DISPLAY ); ?>
                </a>
                <a class="btn btn--outline-white btn--lg" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" id="hero-estimate">
                    Get a Quick Estimate
                </a>
            </div>

            <?php if ( $bullets ) : ?>
                <ul class="page-hero__trust" aria-label="Why choose us">
                    <?php foreach ( $bullets as $bullet ) : ?>
                        <li><?php echo sg_icon( 'check_circle' ); ?> <?php echo esc_html( $bullet ); ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

        </div>

        <?php if ( $frames ) : ?>
            <div class="page-hero__asset" aria-hidden="true">
                <div class="page-hero__seq">
                    <?php foreach ( $frames as $frame ) : ?>
                        <img src="<?php echo esc_url( $frame ); ?>" alt="" loading="eager">
                    <?php endforeach; ?>
                </div>
            </div>
        <?php elseif ( $asset ) : ?>
            <div class="page-hero__asset" aria-hidden="true">
                <img src="<?php echo esc_url( $asset ); ?>" alt="" loading="eager">
            </div>
        <?php endif; ?>

    </div>
</section>
