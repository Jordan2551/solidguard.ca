<?php
/**
 * Trust / Affiliates bar - auto-scrolling marquee
 *
 * @package SolidGuard
 */

// Sitewide affiliation badges — single source in inc/site-data.php.
$items = sg_affiliations();
?>

<section class="section section--white trust-bar" id="trust-bar" aria-label="Certifications and affiliations">

    <div class="container">
        <h2 class="section-heading">Trusted &amp; Verified</h2>
        <p class="body-sm text-muted">Vetted technicians, recognised affiliations, and award-winning service.</p>
    </div>

    <!-- Marquee rail -->
    <div class="trust-rail">
        <div class="trust-rail__track">

            <?php foreach ( $items as $item ) : ?>
                <article class="trust-chip">
                    <div class="trust-chip__logo-wrap">
                        <img
                            src="<?php echo esc_url( $item['logo'] ); ?>"
                            alt="<?php echo esc_attr( $item['alt'] ); ?>"
                            loading="lazy"
                            decoding="async"
                        >
                    </div>
                    <div class="trust-chip__divider" aria-hidden="true"></div>
                    <p class="trust-chip__label"><?php echo esc_html( $item['label'] ); ?></p>
                </article>
            <?php endforeach; ?>

            <!-- Duplicate set - visual only, keeps the loop seamless -->
            <?php foreach ( $items as $item ) : ?>
                <article class="trust-chip" aria-hidden="true">
                    <div class="trust-chip__logo-wrap">
                        <img
                            src="<?php echo esc_url( $item['logo'] ); ?>"
                            alt=""
                            loading="lazy"
                            decoding="async"
                        >
                    </div>
                    <div class="trust-chip__divider" aria-hidden="true"></div>
                    <p class="trust-chip__label"><?php echo esc_html( $item['label'] ); ?></p>
                </article>
            <?php endforeach; ?>

        </div>
    </div>

</section>
