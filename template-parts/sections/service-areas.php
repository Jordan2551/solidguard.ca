<?php
/**
 * Service Areas section - pin grid + Google Maps embed
 *
 * @package SolidGuard
 */

// Sitewide service-area cities — single source in inc/site-data.php.
$areas = sg_service_areas();
?>

<section class="service-areas" id="service-areas" aria-label="Service areas">
    <div class="container">

        <h2 class="section-heading">Service Areas</h2>

        <ul class="area-grid" role="list" aria-label="GTA service locations">
            <?php foreach ( $areas as $area ) : ?>
                <li class="area-item" data-modal-trigger="modal-estimate" role="button" tabindex="0">
                    <?php echo sg_icon( 'location_on', 'area-item__icon' ); ?>
                    <span class="area-item__name"><?php echo esc_html( $area ); ?></span>
                </li>
            <?php endforeach; ?>
        </ul>

    </div>
</section>
