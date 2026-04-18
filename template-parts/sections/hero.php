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

        <h1 class="hero__title">
            The GTA's Top <span class="text-orange">Window Glass Repair</span> &amp; Replacement Services
        </h1>

        <ul class="hero__bullets" aria-label="Key benefits">
            <li class="hero__bullet">
                <?php echo sg_icon( 'check_circle' ); ?>
                Window Glass Repair &amp; Replacement
            </li>
            <li class="hero__bullet">
                <?php echo sg_icon( 'check_circle' ); ?>
                Residential, Commercial &amp; Storefront
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

        <!-- Lead capture form -->
        <div class="hero-form" id="hero-form">
            <?php echo do_shortcode( '[ninja_form id="2"]' ); ?>
        </div><!-- .hero-form -->

    </div><!-- .hero__content -->

</section>
