<?php
/**
 * Template Name: Thank You
 * Template Post Type: page
 *
 * Displayed after form submission at /thank-you
 *
 * @package SolidGuard
 */

get_header();
?>

<main id="primary" class="page-main thankyou">

    <section class="thankyou__hero">

        <!-- Road / track line -->
        <div class="thankyou__road" aria-hidden="true">
            <div class="thankyou__road-line"></div>
        </div>

        <div class="container thankyou__inner">

            <!-- Copy -->
            <div class="thankyou__copy">

                <span class="thankyou__badge">
                    <span class="material-symbols-outlined" aria-hidden="true">check_circle</span>
                    Request Received
                </span>

                <h1 class="thankyou__title">
                    We're <span class="thankyou__title--orange">On Our Way.</span>
                </h1>

                <p class="thankyou__sub">
                    Your estimate request has been received. A member of our team will be in touch shortly, usually within the hour.
                </p>

                <ul class="thankyou__promises" role="list">
                    <li>
                        <span class="material-symbols-outlined" aria-hidden="true">schedule</span>
                        Response within 1 hour
                    </li>
                    <li>
                        <span class="material-symbols-outlined" aria-hidden="true">payments</span>
                        Clear, upfront pricing. No surprises.
                    </li>
                    <li>
                        <span class="material-symbols-outlined" aria-hidden="true">verified</span>
                        Backed by our workmanship warranty
                    </li>
                </ul>

                <div class="thankyou__actions">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--primary btn--lg">
                        <span class="material-symbols-outlined icon-sm" aria-hidden="true">home</span>
                        Back to Home
                    </a>
                    <a href="tel:<?php echo esc_attr( SG_PHONE_RAW ); ?>" class="btn btn--orange btn--lg">
                        <span class="material-symbols-outlined icon-sm" aria-hidden="true">call</span>
                        <?php echo esc_html( SG_PHONE_DISPLAY ); ?>
                    </a>
                </div>

            </div>

            <!-- Van -->
            <div class="thankyou__van-wrap" aria-hidden="true">
                <img
                    class="thankyou__van"
                    src="<?php echo esc_url( get_template_directory_uri() . '/images/pictures/no-bg-van-reverse.webp' ); ?>"
                    alt=""
                >
                <div class="thankyou__van-shadow"></div>
            </div>

        </div>

    </section>

</main>

<?php get_footer(); ?>
