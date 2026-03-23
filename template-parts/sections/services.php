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
        'desc'   => 'Expert glass repair and replacement for homes across the GTA — windows, doors, patio sliders, and more.',
        'image'  => $img . 'work/resedential-glass-services/foggy_before_after_combined(1)-1_70reduced.webp',
        'alt'    => 'Residential glass repair before and after',
        'bullets' => array(
            'Windows &amp; Patio Doors',
            'Insulated Glass Units',
            'Same-Day Assessment',
        ),
        'slug'  => 'residential-glass-repair',
        'modal' => 'modal-residential',
    ),
    array(
        'title'  => 'Commercial Glass Services',
        'desc'   => 'Comprehensive glass solutions for offices, retail, and multi-unit properties — minimising downtime.',
        'image'  => $img . 'work/commercial-glass-services/before_after_combined(1)_70reduced.webp',
        'alt'    => 'Commercial glass repair before and after',
        'bullets' => array(
            'Office &amp; Retail Buildings',
            'Tempered &amp; Safety Glass',
            'After-Hours Availability',
        ),
        'slug'  => 'commercial-glass-repair',
        'modal' => 'modal-commercial',
    ),
    array(
        'title'  => 'Emergency Glass Services',
        'desc'   => 'Around-the-clock rapid response to secure your property after a break-in, accident, or storm damage.',
        'image'  => $img . 'work/emergency-glass-services/backyard_before_after_polished(1)_70reduced.webp',
        'alt'    => 'Emergency glass repair before and after',
        'bullets' => array(
            '24 / 7 Dispatch',
            'Board-up &amp; Secure',
            'Debris Cleanup Included',
        ),
        'slug'  => 'emergency-glass-repair',
        'modal' => 'modal-emergency',
    ),
    array(
        'title'  => 'Storefront Glass Services',
        'desc'   => 'Custom storefront glazing, repairs, and replacements that keep your business looking sharp and secure.',
        'image'  => $img . 'work/storefront-glass-services/dogstore_before_after_combined(1)_70reduced.webp',
        'alt'    => 'Storefront glass repair before and after',
        'bullets' => array(
            'Custom-Cut Panels',
            'Automatic Door Glass',
            'Rapid Turnaround',
        ),
        'slug'  => 'storefront-glass-repair',
        'modal' => 'modal-storefront',
    ),
);
?>

<section class="section section--white" id="services" aria-label="Our services">
    <div class="container">

        <h2 class="section-heading" style="margin-bottom: var(--space-2);">Our Services</h2>
        <p class="body-sm text-muted" style="margin-bottom: var(--space-10);">Professional glass repair and replacement across the GTA — backed by our workmanship warranty. We fix it right, or we come back for free.</p>

        <div class="services-grid">
            <?php foreach ( $services as $service ) : ?>
                <article
                    class="service-card"
                    data-modal-trigger="<?php echo esc_attr( $service['modal'] ); ?>"
                    role="button"
                    tabindex="0"
                    aria-label="Learn more about <?php echo esc_attr( $service['title'] ); ?>"
                >

                    <div class="service-card__media">
                        <img
                            src="<?php echo esc_url( $service['image'] ); ?>"
                            alt="<?php echo esc_attr( $service['alt'] ); ?>"
                            loading="lazy"
                            decoding="async"
                        >
                    </div>

                    <div class="service-card__body">
                        <h3 class="service-card__title"><?php echo esc_html( $service['title'] ); ?></h3>
                        <p class="service-card__desc"><?php echo esc_html( $service['desc'] ); ?></p>

                        <ul class="check-list" style="margin-bottom: var(--space-6);" role="list">
                            <?php foreach ( $service['bullets'] as $bullet ) : ?>
                                <li class="check-list__item">
                                    <span class="material-symbols-outlined icon-sm" style="font-variation-settings:'FILL' 1,'wght' 400,'GRAD' 0,'opsz' 24;" aria-hidden="true">check_circle</span>
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
