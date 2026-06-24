<?php
/**
 * Hero section
 *
 * @package SolidGuard
 */
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
        <h1 class="hero__title">
            The GTA's Top <span class="text-orange">Window Glass Repair</span> &amp; Replacement Services
        </h1>

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
            <p class="hero__assurance-copy">Helped <strong>thousands</strong> across the GTA</p>
        </div>

        <ul class="hero__bullets" aria-label="Key benefits">
            <li class="hero__bullet">
                <?php echo sg_icon( 'check_circle' ); ?>
                Window Glass Repair &amp; Replacement
            </li>
            <li class="hero__bullet">
                <?php echo sg_icon( 'check_circle' ); ?>
                Same-Day On-Site Assessments
            </li>
            <li class="hero__bullet">
                <?php echo sg_icon( 'check_circle' ); ?>
                Licensed &amp; Background-Checked Technicians
            </li>
        </ul>
      </div><!-- .hero__copy -->

        <!-- Lead capture form -->
        <div class="hero-form" id="hero-form">
            <?php echo do_shortcode( '[ninja_form id="2"]' ); ?>
        </div><!-- .hero-form -->

    </div><!-- .hero__content -->

</section>
