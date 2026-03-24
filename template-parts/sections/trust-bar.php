<?php
/**
 * Trust / Affiliates bar - auto-scrolling marquee
 *
 * @package SolidGuard
 */

$dir = get_template_directory_uri() . '/images/logos/affiliates/';

$items = array(
    array(
        'logo'  => $dir . 'HomeStars.webp',
        'alt'   => 'HomeStars',
        'label' => 'HomeStars Verified',
    ),
    array(
        'logo'  => $dir . 'IDN-Canada-Trusted-Partner.webp',
        'alt'   => 'IDN Canada',
        'label' => 'IDN Canada Trusted Partner',
    ),
    array(
        'logo'  => $dir . 'Ontario_Provincial_Police_Logo.webp',
        'alt'   => 'Ontario Provincial Police',
        'label' => 'Police Background Cleared',
    ),
    array(
        'logo'  => $dir . 'TPS-Police-Clearance-logo.webp',
        'alt'   => 'TPS Police Clearance',
        'label' => 'TPS Police Cleared',
    ),
    array(
        'logo'  => $dir . 'Yellow_Pages_Limited_Yellow_Pages_Announces_Winner_of_its_2026_N.webp',
        'alt'   => 'Yellow Pages 2026 Award Winner',
        'label' => '2026 Yellow Pages Award Winner',
    ),
    array(
        'logo'  => $dir . 'mywindow.webp',
        'alt'   => 'MyWindow',
        'label' => 'MyWindow Certified',
    ),
);
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
