<?php
/**
 * Services section
 *
 * @package SolidGuard
 */

$img = get_template_directory_uri() . '/images/pictures/';

$services = array(
    array(
        'title'  => 'Residential Glass Services',
        'desc'   => 'Expert glass repair and replacement for homes across the GTA: windows, doors, patio sliders, and more.',
        'image'  => $img . 'work/resedential-glass-services/foggy_before_after_combined(1)-1_70reduced.webp',
        'alt'    => 'Residential glass repair before and after',
        'bullets' => array(
            'Glass unit replacement',
            'Window water leak repair',
            'Cracked, foggy or shattered glass',
        ),
        'w'     => 614,
        'h'     => 429,
        'slug'  => 'residential-glass-repair',
        'modal' => 'modal-residential',
    ),
    array(
        'title'  => 'Commercial Glass Services',
        'desc'   => 'Comprehensive glass solutions for offices, retail, and multi-unit properties, minimising downtime.',
        'image'  => $img . 'work/commercial-glass-services/before_after_combined(1)_70reduced.webp',
        'alt'    => 'Commercial glass repair before and after',
        'bullets' => array(
            'Storefront glass repair and replacement',
            'Cracked or shattered commercial doors',
            'Emergency board-up after break-ins or damage',
        ),
        'w'     => 614,
        'h'     => 497,
        'slug'  => 'commercial-glass-repair',
        'modal' => 'modal-commercial',
    ),
    array(
        'title'  => 'Emergency Glass Services',
        'desc'   => 'Around-the-clock rapid response to secure your property after a break-in, accident, or storm damage.',
        'image'  => $img . 'work/emergency-glass-services/backyard_before_after_polished(1)_70reduced.webp',
        'alt'    => 'Emergency glass repair before and after',
        'bullets' => array(
            'Emergency board-up',
            'Break-in damage',
            'Unsafe doors and windows',
        ),
        'w'     => 564,
        'h'     => 614,
        'slug'  => 'emergency-glass-repair',
        'modal' => 'modal-emergency',
    ),
    array(
        'title'  => 'Storefront Glass Services',
        'desc'   => 'Custom storefront glazing, repairs, and replacements that keep your business looking sharp and secure.',
        'image'  => $img . 'work/storefront-glass-services/dogstore_before_after_combined(1)_70reduced.webp',
        'alt'    => 'Storefront glass repair before and after',
        'bullets' => array(
            'Storefront glass repair and replacement',
            'Large tempered glass panels',
            'Aluminum frame and door glass',
        ),
        'w'     => 614,
        'h'     => 406,
        'slug'  => 'storefront-glass-repair',
        'modal' => 'modal-storefront',
    ),
);
?>

<section class="section section--white" id="services" aria-label="Our services">
    <div class="container">

        <h2 class="section-heading">Our Services</h2>
        <p class="body-sm text-muted">Professional glass repair and replacement across the GTA, backed by our workmanship warranty. We fix it right, or we come back for free.</p>

        <div class="services-grid">
            <?php foreach ( $services as $service ) : ?>
                <article
                    class="service-card"
                    data-modal-trigger="<?php echo esc_attr( $service['modal'] ); ?>"
                    id="service-card-<?php echo esc_attr( $service['slug'] ); ?>"
                    role="button"
                    tabindex="0"
                    aria-label="Learn more about <?php echo esc_attr( $service['title'] ); ?>"
                >

                    <div class="service-card__media">
                        <img
                            src="<?php echo esc_url( $service['image'] ); ?>"
                            alt="<?php echo esc_attr( $service['alt'] ); ?>"
                            width="<?php echo esc_attr( $service['w'] ); ?>"
                            height="<?php echo esc_attr( $service['h'] ); ?>"
                            loading="lazy"
                            decoding="async"
                        >
                    </div>

                    <div class="service-card__body">
                        <h3 class="service-card__title"><?php echo esc_html( $service['title'] ); ?></h3>
                        <p class="service-card__desc"><?php echo esc_html( $service['desc'] ); ?></p>

                        <ul class="check-list" role="list">
                            <?php foreach ( $service['bullets'] as $bullet ) : ?>
                                <li class="check-list__item">
                                    <?php echo sg_icon( 'check_circle', 'icon-sm' ); ?>
                                    <?php echo wp_kses( $bullet, array() ); ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                        <div class="btn btn--outline btn--full" aria-hidden="true">Learn More</div>
                    </div>

                </article>
            <?php endforeach; ?>
        </div>

    </div>
</section>
