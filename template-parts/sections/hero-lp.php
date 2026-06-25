<?php
/**
 * Landing-page hero — conversion variant (Ninja lead form).
 *
 * Pure view: content is supplied by the caller (front-page.php via
 * sg_lp_content()), no hardcoded defaults. The SEO pages use the separate
 * reusable hero.php (CTA variant) instead.
 *
 * @package SolidGuard
 *
 * Expected $args:
 *   h1_html        string  H1 markup (may contain a highlight <span>)
 *   assurance_copy string  copy beside the 5.0 rating (may contain <strong>)
 *   bullets        array   benefit bullets (plain strings)
 *   form_id        int     Ninja Forms id for the lead form
 */

$h1_html        = isset( $args['h1_html'] ) ? $args['h1_html'] : '';
$assurance_copy = isset( $args['assurance_copy'] ) ? $args['assurance_copy'] : '';
$bullets        = isset( $args['bullets'] ) ? (array) $args['bullets'] : array();
$form_id        = isset( $args['form_id'] ) ? (int) $args['form_id'] : 0;

if ( '' === $h1_html ) {
    return;
}
?>

<section class="hero" aria-label="Hero">

    <!-- Background image + overlay -->
    <div class="hero__bg" aria-hidden="true">
        <img
            src="<?php echo esc_url( get_template_directory_uri() . '/images/pictures/solidguard-glass-repair-van.webp' ); ?>"
            alt=""
            loading="eager"
            fetchpriority="high"
        >
        <div class="hero__overlay"></div>
    </div>

    <!-- Content -->
    <div class="hero__content">

      <div class="hero__copy">
        <h1 class="hero__title"><?php echo wp_kses_post( $h1_html ); ?></h1>

        <div class="hero__assurance" aria-label="5-star rating from customers across the GTA">
            <div class="hero__assurance-rating">
                <span class="hero__assurance-value">5.0</span>
                <span class="hero__assurance-stars" aria-hidden="true">
                    <?php for ( $i = 0; $i < 5; $i++ ) : ?>
                        <?php echo sg_icon( 'star' ); ?>
                    <?php endfor; ?>
                </span>
                <span class="hero__assurance-label">Star Rating</span>
            </div>
            <span class="hero__assurance-divider" aria-hidden="true"></span>
            <?php if ( '' !== $assurance_copy ) : ?>
                <p class="hero__assurance-copy"><?php echo wp_kses_post( $assurance_copy ); ?></p>
            <?php endif; ?>
        </div>

        <?php if ( $bullets ) : ?>
            <ul class="hero__bullets" aria-label="Key benefits">
                <?php foreach ( $bullets as $bullet ) : ?>
                    <li class="hero__bullet">
                        <?php echo sg_icon( 'check_circle' ); ?>
                        <?php echo esc_html( $bullet ); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
      </div><!-- .hero__copy -->

        <!-- Lead capture form -->
        <div class="hero-form" id="hero-form">
            <?php echo do_shortcode( '[ninja_form id="' . $form_id . '"]' ); ?>
        </div><!-- .hero-form -->

    </div><!-- .hero__content -->

</section>
