<?php
/**
 * Landing-page content provider.
 *
 * The ad landing page (front-page.php) is NOT a seeded WP page, so its content
 * lives here as plain PHP rather than in ACF. front-page.php pulls from this and
 * passes it into the section partials, which are pure views with no defaults.
 *
 * @package SolidGuard
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Content for the landing page, keyed by section.
 *
 * @return array
 */
function sg_lp_content() {
    $pictures = get_template_directory_uri() . '/images/pictures/';

    return array(

        'hero' => array(
            // H1 carries an inline highlight span, rendered with wp_kses_post.
            'h1_html'        => 'The GTA\'s Top <span class="text-orange">Window Glass Repair</span> &amp; Replacement Services',
            'assurance_copy' => 'Helped <strong>thousands</strong> across the GTA',
            'bullets'        => array(
                'Window Glass Repair & Replacement',
                'Same-Day On-Site Assessments',
                'Licensed & Background-Checked Technicians',
            ),
            'form_id'        => 2,
        ),

        'services' => array(
            'heading' => 'Our Services',
            'intro'   => 'Professional glass repair and replacement across the GTA, backed by our workmanship warranty. We fix it right, or we come back for free.',
            'items'   => array(
                array(
                    'title'   => 'Residential Glass Services',
                    'desc'    => 'Expert glass repair and replacement for homes across the GTA: windows, doors, patio sliders, and more.',
                    'image'   => $pictures . 'work/resedential-glass-services/foggy_before_after_combined(1)-1_70reduced.webp',
                    'alt'     => 'Residential glass repair before and after',
                    'bullets' => array(
                        'Glass unit replacement',
                        'Window water leak repair',
                        'Cracked, foggy or shattered glass',
                    ),
                    'w'       => 614,
                    'h'       => 429,
                    'slug'    => 'residential-glass-repair',
                    'modal'   => 'modal-residential',
                ),
                array(
                    'title'   => 'Commercial Glass Services',
                    'desc'    => 'Comprehensive glass solutions for offices, retail, and multi-unit properties, minimising downtime.',
                    'image'   => $pictures . 'work/commercial-glass-services/before_after_combined(1)_70reduced.webp',
                    'alt'     => 'Commercial glass repair before and after',
                    'bullets' => array(
                        'Storefront glass repair and replacement',
                        'Cracked or shattered commercial doors',
                        'Emergency board-up after break-ins or damage',
                    ),
                    'w'       => 614,
                    'h'       => 497,
                    'slug'    => 'commercial-glass-repair',
                    'modal'   => 'modal-commercial',
                ),
                array(
                    'title'   => 'Emergency Glass Services',
                    'desc'    => 'Around-the-clock rapid response to secure your property after a break-in, accident, or storm damage.',
                    'image'   => $pictures . 'work/emergency-glass-services/backyard_before_after_polished(1)_70reduced.webp',
                    'alt'     => 'Emergency glass repair before and after',
                    'bullets' => array(
                        'Emergency board-up',
                        'Break-in damage',
                        'Unsafe doors and windows',
                    ),
                    'w'       => 564,
                    'h'       => 614,
                    'slug'    => 'emergency-glass-repair',
                    'modal'   => 'modal-emergency',
                ),
                array(
                    'title'   => 'Storefront Glass Services',
                    'desc'    => 'Custom storefront glazing, repairs, and replacements that keep your business looking sharp and secure.',
                    'image'   => $pictures . 'work/storefront-glass-services/dogstore_before_after_combined(1)_70reduced.webp',
                    'alt'     => 'Storefront glass repair before and after',
                    'bullets' => array(
                        'Storefront glass repair and replacement',
                        'Large tempered glass panels',
                        'Aluminum frame and door glass',
                    ),
                    'w'       => 614,
                    'h'       => 406,
                    'slug'    => 'storefront-glass-repair',
                    'modal'   => 'modal-storefront',
                ),
            ),
        ),

    );
}
