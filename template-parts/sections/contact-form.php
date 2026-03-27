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
                        <?php echo sg_icon( 'schedule' ); ?>
                        Response within 1 hour
                    </li>
                    <li>
                        <?php echo sg_icon( 'payments' ); ?>
                        Free on-site assessment
                    </li>
                    <li>
                        <?php echo sg_icon( 'verified' ); ?>
                        Backed by our workmanship warranty
                    </li>
                    <li>
                        <?php echo sg_icon( 'shield_person' ); ?>
                        Background-checked technicians
                    </li>
                </ul>

                <a href="tel:<?php echo esc_attr( SG_PHONE_RAW ); ?>" class="contact-form-wrap__phone">
                    <?php echo sg_icon( 'call' ); ?>
                    <?php echo esc_html( SG_PHONE_DISPLAY ); ?>
                </a>
            </div>

            <div class="contact-form-wrap__form">
                <?php echo do_shortcode( '[ninja_form id="2"]' ); ?>
            </div>

        </div>

    </div>
</section>
