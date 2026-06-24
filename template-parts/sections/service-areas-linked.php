<?php
/**
 * Service Areas — LINKED variant (for SEO / site pages)
 *
 * Identical look to service-areas.php, but each city links to its
 * /glass/locations/{slug}/ page instead of opening the estimate modal.
 *
 * The ORIGINAL service-areas.php (estimate-modal on click) stays in use on the
 * ads landing page — that conversion behaviour is deliberate. Use THIS variant on
 * the homepage, /glass/ hub, category roots, and location pages.
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

        <div class="area-grid" role="list" aria-label="GTA service locations">
            <?php foreach ( $areas as $area ) :
                $slug = sanitize_title( $area ); // "Richmond Hill" → "richmond-hill"
                ?>
                <a class="area-item" role="listitem" href="<?php echo esc_url( home_url( '/glass/locations/' . $slug . '/' ) ); ?>">
                    <?php echo sg_icon( 'location_on', 'area-item__icon' ); ?>
                    <span class="area-item__name"><?php echo esc_html( $area ); ?></span>
                </a>
            <?php endforeach; ?>
        </div>

    </div>
</section>
