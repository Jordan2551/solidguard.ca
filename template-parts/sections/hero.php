<?php
/**
 * Reusable SEO hero — CTA variant (no form).
 *
 * Used by every SEO page type (hub, root, spoke, location, cost). Pure view:
 * content injected by the template from ACF + sg_trust_bullets(). The landing
 * page uses the separate hero-lp.php (form variant) instead.
 *
 * @package SolidGuard
 *
 * Expected $args:
 *   h1       string  H1 heading (required)
 *   subhead  string  supporting line
 *   bullets  array   trust bullets (plain strings)
 *   image_id int     optional hero image attachment id
 */

$h1       = isset( $args['h1'] ) ? $args['h1'] : '';
$subhead  = isset( $args['subhead'] ) ? $args['subhead'] : '';
$bullets  = isset( $args['bullets'] ) ? (array) $args['bullets'] : array();
$image_id = isset( $args['image_id'] ) ? (int) $args['image_id'] : 0;

if ( '' === $h1 ) {
    return;
}

$bg = $image_id ? wp_get_attachment_image_url( $image_id, 'full' ) : '';
?>

<section class="page-hero<?php echo $bg ? ' page-hero--image' : ''; ?>" aria-label="Hero">

    <?php if ( $bg ) : ?>
        <div class="page-hero__bg" aria-hidden="true">
            <img src="<?php echo esc_url( $bg ); ?>" alt="" loading="eager" fetchpriority="high">
            <div class="page-hero__overlay"></div>
        </div>
    <?php endif; ?>

    <div class="container page-hero__inner">

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
</section>
