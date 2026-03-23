<?php
/**
 * Service Areas section — pin grid + Google Maps embed
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

    <h2 class="section-heading">Service Areas</h2>

    <ul class="area-grid" role="list" aria-label="GTA service locations">
        <?php foreach ( $areas as $area ) : ?>
            <li class="area-item">
                <span
                    class="material-symbols-outlined area-item__icon"
                    style="font-variation-settings:'FILL' 1,'wght' 400,'GRAD' 0,'opsz' 24;"
                    aria-hidden="true"
                >location_on</span>
                <span class="area-item__name"><?php echo esc_html( $area ); ?></span>
            </li>
        <?php endforeach; ?>
    </ul>

</section>
