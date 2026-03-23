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
            The GTA's Top <span style="color: var(--color-orange);">Glass Repair</span> and Installation Services
        </h1>

        <ul class="hero__bullets" aria-label="Key benefits">
            <li class="hero__bullet">
                <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1,'wght' 400,'GRAD' 0,'opsz' 24;" aria-hidden="true">check_circle</span>
                Expert Emergency Glass Repair
            </li>
            <li class="hero__bullet">
                <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1,'wght' 400,'GRAD' 0,'opsz' 24;" aria-hidden="true">check_circle</span>
                Same-Day On-Site Assessments
            </li>
            <li class="hero__bullet">
                <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1,'wght' 400,'GRAD' 0,'opsz' 24;" aria-hidden="true">check_circle</span>
                Licensed &amp; Bonded Professionals
            </li>
            <li class="hero__bullet">
                <span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1,'wght' 400,'GRAD' 0,'opsz' 24;" aria-hidden="true">check_circle</span>
                Background-Checked Technicians
            </li>
        </ul>

        <!-- Lead capture form -->
        <div class="hero-form" id="hero-form">
            <h2 class="hero-form__title">Request a Service</h2>

            <form class="form-stack" action="#" method="post" novalidate>

                <div class="form-group">
                    <label class="form-label" for="hero-name">Name</label>
                    <input
                        class="form-input"
                        id="hero-name"
                        type="text"
                        name="name"
                        placeholder="Full Name"
                        autocomplete="name"
                        required
                    >
                </div>

                <div class="form-grid-2">
                    <div class="form-group">
                        <label class="form-label" for="hero-phone">Phone</label>
                        <input
                            class="form-input"
                            id="hero-phone"
                            type="tel"
                            name="phone"
                            placeholder="(416) 000-0000"
                            autocomplete="tel"
                            required
                        >
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="hero-email">Email</label>
                        <input
                            class="form-input"
                            id="hero-email"
                            type="email"
                            name="email"
                            placeholder="email@address.com"
                            autocomplete="email"
                        >
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="hero-service">Service Request</label>
                    <div class="form-select-wrap">
                        <select class="form-select" id="hero-service" name="service">
                            <option value="emergency">Emergency Glass Repair</option>
                            <option value="icu">Insulated Glass Units</option>
                            <option value="tempered">Tempered Glass</option>
                            <option value="boardup">Board-up Services</option>
                            <option value="storefront">Storefront Glass</option>
                            <option value="patio">Patio / Sliding Door Glass</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn--primary btn--full btn--lg">
                    Get Quick Estimate
                </button>

            </form>
        </div><!-- .hero-form -->

    </div><!-- .hero__content -->

</section>
