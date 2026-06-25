<?php
/**
 * Special offers - horizontal scroll rail
 *
 * @package SolidGuard
 */

$logo = get_template_directory_uri() . '/images/logos/logo-sm.webp';

// Standing offers — single source in inc/site-data.php.
$offers = sg_offers();
?>

<section class="section section--muted" id="offers" aria-label="Special offers">

    <div class="container section-header--center">
        <h2 class="section-heading section-heading--center">Special Offers</h2>
        <p class="section-intro">Check out the latest savings on glass repair and replacement services.</p>
    </div>

    <div class="scroll-rail" role="list" aria-label="Offers carousel">
        <?php foreach ( $offers as $offer ) : ?>
            <div class="offer-card" role="listitem">

                <div class="offer-card__body">
                    <img
                        src="<?php echo esc_url( $logo ); ?>"
                        alt=""
                        aria-hidden="true"
                        width="48"
                        height="48"
                        class="offer-card__logo"
                    >
                    <p class="h2 text-primary offer-card__headline"><?php echo esc_html( $offer['headline'] ); ?></p>
                    <p class="offer-card__subhead"><?php echo esc_html( $offer['subhead'] ); ?></p>
                    <p class="body-xs text-muted offer-card__desc"><?php echo esc_html( $offer['desc'] ); ?></p>
                    <div class="offer-card__expiry">
                        <strong>Expires:</strong> <span class="js-offer-expiry"><?php echo esc_html( $offer['expires'] ); ?></span>
                    </div>
                </div>

                <button class="btn btn--primary btn--full" type="button" data-modal-trigger="modal-estimate" id="btn-offer-<?php echo sanitize_title( $offer['subhead'] ); ?>">
                    Claim Offer
                </button>

            </div>
        <?php endforeach; ?>
    </div>

</section>
