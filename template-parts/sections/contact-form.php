<?php
/**
 * Contact Form section - Ninja Forms shortcode
 *
 * @package SolidGuard
 */
?>

<section class="section section--white" id="contact" aria-label="Contact us">
    <div class="container">

        <div class="contact-form-wrap">

            <div class="contact-form-wrap__copy">
                <h2 class="section-heading">Get In Touch</h2>
                <p class="body-sm text-muted">Fill out the form and a member of our team will get back to you within the hour. No pressure, no hidden fees.</p>

                <ul class="contact-form-wrap__promises" role="list">
                    <li>
                        <span class="material-symbols-outlined" aria-hidden="true">schedule</span>
                        Response within 1 hour
                    </li>
                    <li>
                        <span class="material-symbols-outlined" aria-hidden="true">payments</span>
                        Free on-site assessment
                    </li>
                    <li>
                        <span class="material-symbols-outlined" aria-hidden="true">verified</span>
                        Backed by our workmanship warranty
                    </li>
                    <li>
                        <span class="material-symbols-outlined" aria-hidden="true">shield_person</span>
                        Background-checked technicians
                    </li>
                </ul>

                <a href="tel:<?php echo esc_attr( SG_PHONE_RAW ); ?>" class="contact-form-wrap__phone">
                    <span class="material-symbols-outlined" aria-hidden="true">call</span>
                    <?php echo esc_html( SG_PHONE_DISPLAY ); ?>
                </a>
            </div>

            <div class="contact-form-wrap__form">
                <?php echo do_shortcode( '[ninja_form id="2"]' ); ?>
            </div>

        </div>

    </div>
</section>
