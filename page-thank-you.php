<?php
/**
 * Template Name: Thank You
 * Template Post Type: page
 *
 * Displayed after form submission at /thank-you
 *
 * @package SolidGuard
 */

$GLOBALS['sg_meta'] = array(
    'title'       => 'Request Received | SolidGuard Glass & Windows',
    'description' => 'Your service request has been received. A member of the SolidGuard team will be in touch shortly, usually within the hour.',
    'url'         => home_url( '/thank-you/' ),
);

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
                    <?php echo sg_icon( 'check_circle' ); ?>
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
                        <?php echo sg_icon( 'schedule' ); ?>
                        Response within 1 hour
                    </li>
                    <li>
                        <?php echo sg_icon( 'payments' ); ?>
                        Clear, upfront pricing. No surprises.
                    </li>
                    <li>
                        <?php echo sg_icon( 'verified' ); ?>
                        Backed by our workmanship warranty
                    </li>
                </ul>

                <div class="thankyou__actions">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--primary btn--lg">
                        <?php echo sg_icon( 'home', 'icon-sm' ); ?>
                        Back to Home
                    </a>
                    <a href="tel:<?php echo esc_attr( SG_PHONE_RAW ); ?>" class="btn btn--orange btn--lg">
                        <?php echo sg_icon( 'call', 'icon-sm' ); ?>
                        <?php echo esc_html( SG_PHONE_DISPLAY ); ?>
                    </a>
                </div>

            </div>

            <!-- Van -->
            <div class="thankyou__van-wrap" aria-hidden="true">
                <img
                    class="thankyou__van"
                    src="<?php echo esc_url( get_template_directory_uri() . '/images/pictures/solidguard-van-no-bg.webp' ); ?>"
                    alt=""
                >
                <div class="thankyou__van-shadow"></div>
            </div>

        </div>

    </section>

</main>

<?php get_footer(); ?>
