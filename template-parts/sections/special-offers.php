<?php
/**
 * Special offers — horizontal scroll rail
 *
 * @package SolidGuard
 */

$logo = get_template_directory_uri() . '/images/logos/logo-sm.png';

$offers = array(
    array(
        'headline' => '10% Off',
        'subhead'  => 'Any Glass Service',
        'desc'     => 'Available for new clients and first responders. Maximum discount $200. Valid ID required.',
        'expires'  => '12/31/2025',
    ),
    array(
        'headline' => '15% Off',
        'subhead'  => 'Returning Clients',
        'desc'     => 'Loyalty discount for repeat commercial and residential maintenance clients. No minimum spend.',
        'expires'  => '12/31/2025',
    ),
    array(
        'headline' => '$25 Off',
        'subhead'  => 'Window Repairs',
        'desc'     => 'Valid on any residential glass window repair over $200. Cannot be combined with other offers.',
        'expires'  => '12/31/2025',
    ),
);
?>

<section class="section section--muted" id="offers" aria-label="Special offers">

    <div class="container" style="margin-bottom: var(--space-8);">
        <h2 class="h2 text-navy section-heading--accented" style="margin-bottom: var(--space-2);">Special Offers</h2>
        <p class="body-sm text-muted">Check out the latest savings on glass repair and replacement services.</p>
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
                        style="opacity: 0.25; margin-bottom: var(--space-6); width: 3rem; height: 3rem; object-fit: contain;"
                    >
                    <p class="h2 text-primary" style="margin-bottom: var(--space-2);"><?php echo esc_html( $offer['headline'] ); ?></p>
                    <p style="font-weight: var(--font-bold); color: var(--color-navy); margin-bottom: var(--space-4);"><?php echo esc_html( $offer['subhead'] ); ?></p>
                    <p class="body-xs text-muted" style="margin-bottom: var(--space-6);"><?php echo esc_html( $offer['desc'] ); ?></p>
                    <div class="offer-card__expiry">
                        <strong>Expires:</strong> <span class="js-offer-expiry"><?php echo esc_html( $offer['expires'] ); ?></span>
                    </div>
                </div>

                <button class="btn btn--primary btn--full" type="button">
                    Claim Offer
                </button>

            </div>
        <?php endforeach; ?>
    </div>

</section>
