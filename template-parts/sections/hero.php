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
            The GTA's Top <span class="text-orange">Glass Repair</span> and Installation Services
        </h1>

        <ul class="hero__bullets" aria-label="Key benefits">
            <li class="hero__bullet">
                <span class="material-symbols-outlined icon-filled" aria-hidden="true">check_circle</span>
                Expert Emergency Glass Repair
            </li>
            <li class="hero__bullet">
                <span class="material-symbols-outlined icon-filled" aria-hidden="true">check_circle</span>
                Same-Day On-Site Assessments
            </li>
            <li class="hero__bullet">
                <span class="material-symbols-outlined icon-filled" aria-hidden="true">check_circle</span>
                Licensed &amp; Bonded Professionals
            </li>
            <li class="hero__bullet">
                <span class="material-symbols-outlined icon-filled" aria-hidden="true">check_circle</span>
                Background-Checked Technicians
            </li>
        </ul>

        <!-- Lead capture form -->
        <div class="hero-form" id="hero-form">
            <?php echo do_shortcode( '[ninja_form id="2"]' ); ?>
        </div><!-- .hero-form -->

    </div><!-- .hero__content -->

</section>
