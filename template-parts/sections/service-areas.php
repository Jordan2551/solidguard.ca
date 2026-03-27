<?php
/**
 * Service Areas section - pin grid + Google Maps embed
 *
 * @package SolidGuard
 */

$areas = array(
    'Toronto',
    'Mississauga',
    'Brampton',
    'Markham',
    'Vaughan',
    'Richmond Hill',
    'Etobicoke',
    'North York',
    'Scarborough',
    'Oakville',
    'Burlington',
    'Milton',
    'Pickering',
    'Ajax',
    'Whitby',
    'Oshawa',
    'Newmarket',
    'Aurora',
    'Barrie',
);
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
