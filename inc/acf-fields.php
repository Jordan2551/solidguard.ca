<?php
/**
 * ACF field groups — registered in PHP (infra-as-code).
 *
 * The code is the single source of truth: no dashboard-built groups, no
 * acf-json sync step. Field keys are hand-set and stable so the WP-CLI seeder
 * can write them deterministically.
 *
 * Only per-page content lives in fields. Global sections (credential bar,
 * offers, service areas, reviews, guarantee, CTAs) render from sg_* helpers and
 * static partials, so they are NOT fields.
 *
 * Groups:
 *   - Glass Service Page (hub / root / spoke)   ← this file
 *   - Location Page, Cost Page                  ← added in Stage 3 with their templates
 *
 * @package SolidGuard
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'acf/init', 'sg_register_acf_fields' );

function sg_register_acf_fields() {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }

    acf_add_local_field_group( array(
        'key'    => 'group_sg_glass_service',
        'title'  => 'Page Content — Glass Service',
        'fields' => array(

            // ---- Hero ----------------------------------------------------
            array(
                'key'   => 'field_sg_tab_hero',
                'label' => 'Hero',
                'type'  => 'tab',
            ),
            array(
                'key'          => 'field_sg_hero_h1',
                'label'        => 'H1 (hero heading)',
                'name'         => 'hero_h1',
                'type'         => 'text',
                'required'     => 1,
                'instructions' => 'Visible page heading. May differ from the SEO title (RankMath) and the short page title.',
            ),
            array(
                'key'          => 'field_sg_hero_subhead',
                'label'        => 'Subhead',
                'name'         => 'hero_subhead',
                'type'         => 'textarea',
                'rows'         => 2,
                'instructions' => 'Repair-first value prop + GTA + speed. No em dashes.',
            ),
            array(
                'key'           => 'field_sg_hero_asset',
                'label'         => 'Hero cutout image (optional)',
                'name'          => 'hero_asset',
                'type'          => 'image',
                'return_format' => 'url',
                'preview_size'  => 'medium',
                'library'       => 'all',
                'instructions'  => 'Transparent window cutout that floats in the hero. Leave empty to use the default animated casement window.',
            ),

            // ---- Overview ------------------------------------------------
            array(
                'key'   => 'field_sg_tab_overview',
                'label' => 'Overview',
                'type'  => 'tab',
            ),
            array(
                'key'   => 'field_sg_overview_heading',
                'label' => 'Overview heading',
                'name'  => 'overview_heading',
                'type'  => 'text',
            ),
            array(
                'key'          => 'field_sg_overview_body',
                'label'        => 'Overview body',
                'name'         => 'overview_body',
                'type'         => 'wysiwyg',
                'tabs'         => 'visual',
                'media_upload' => 0,
                'instructions' => 'Primary keyword within the first 100 words.',
            ),
            array(
                'key'           => 'field_sg_before_image',
                'label'         => 'Before image',
                'name'          => 'before_image',
                'type'          => 'image',
                'return_format' => 'url',
                'preview_size'  => 'medium',
                'instructions'  => 'Real "before" photo (damaged glass). Pair with the After image, same crop/angle. Renders side-by-side beside the overview.',
            ),
            array(
                'key'           => 'field_sg_after_image',
                'label'         => 'After image',
                'name'          => 'after_image',
                'type'          => 'image',
                'return_format' => 'url',
                'preview_size'  => 'medium',
                'instructions'  => 'Real "after" photo (repaired glass), same crop/angle as Before.',
            ),
            array(
                'key'          => 'field_sg_comparison',
                'label'        => 'Comparison / detail table',
                'name'         => 'comparison',
                'type'         => 'wysiwyg',
                'tabs'         => 'visual',
                'media_upload' => 0,
                'instructions' => 'Optional table (e.g. repair vs replace). Renders below the "what we fix" list.',
            ),

            // ---- Repair-first --------------------------------------------
            array(
                'key'   => 'field_sg_tab_repairfirst',
                'label' => 'Repair-first',
                'type'  => 'tab',
            ),
            array(
                'key'          => 'field_sg_repairfirst_body',
                'label'        => 'Repair-first body',
                'name'         => 'repairfirst_body',
                'type'         => 'textarea',
                'rows'         => 3,
                'instructions' => 'They do repair, glass replacement AND full window replacement, but work with what the client has. Never imply they do not replace.',
            ),

            // ---- What we handle ------------------------------------------
            array(
                'key'   => 'field_sg_tab_handle',
                'label' => 'What we handle',
                'type'  => 'tab',
            ),
            array(
                'key'   => 'field_sg_handle_heading',
                'label' => 'Heading',
                'name'  => 'whatwehandle_heading',
                'type'  => 'text',
            ),
            array(
                'key'        => 'field_sg_handle_items',
                'label'      => 'Items',
                'name'       => 'whatwehandle_items',
                'type'       => 'repeater',
                'layout'     => 'table',
                'button_label' => 'Add item',
                'sub_fields' => array(
                    array(
                        'key'   => 'field_sg_handle_item',
                        'label' => 'Item',
                        'name'  => 'item',
                        'type'  => 'text',
                    ),
                ),
            ),

            // ---- FAQ -----------------------------------------------------
            array(
                'key'   => 'field_sg_tab_faq',
                'label' => 'FAQ',
                'type'  => 'tab',
            ),
            array(
                'key'          => 'field_sg_faqs',
                'label'        => 'FAQs',
                'name'         => 'faqs',
                'type'         => 'repeater',
                'layout'       => 'block',
                'button_label' => 'Add FAQ',
                'instructions' => 'Drives both the on-page accordion and the FAQPage schema. 4 to 8 Q&As.',
                'sub_fields'   => array(
                    array(
                        'key'   => 'field_sg_faq_q',
                        'label' => 'Question',
                        'name'  => 'question',
                        'type'  => 'text',
                    ),
                    array(
                        'key'   => 'field_sg_faq_a',
                        'label' => 'Answer',
                        'name'  => 'answer',
                        'type'  => 'textarea',
                        'rows'  => 3,
                    ),
                ),
            ),

            // ---- Related & CTA -------------------------------------------
            array(
                'key'   => 'field_sg_tab_related',
                'label' => 'Related & CTA',
                'type'  => 'tab',
            ),
            array(
                'key'          => 'field_sg_related',
                'label'        => 'Related services',
                'name'         => 'related_services',
                'type'         => 'repeater',
                'layout'       => 'table',
                'button_label' => 'Add related service',
                'instructions' => '2 to 3 sibling spokes + the category root.',
                'sub_fields'   => array(
                    array(
                        'key'   => 'field_sg_related_label',
                        'label' => 'Label',
                        'name'  => 'label',
                        'type'  => 'text',
                    ),
                    array(
                        'key'   => 'field_sg_related_url',
                        'label' => 'URL',
                        'name'  => 'url',
                        'type'  => 'text',
                    ),
                ),
            ),
            array(
                'key'          => 'field_sg_final_cta_heading',
                'label'        => 'Final CTA heading',
                'name'         => 'final_cta_heading',
                'type'         => 'text',
                'instructions' => 'Heading for the closing call-to-action band.',
            ),
        ),

        'location' => array(
            array(
                array( 'param' => 'page_template', 'operator' => '==', 'value' => 'template-glass-hub.php' ),
            ),
            array(
                array( 'param' => 'page_template', 'operator' => '==', 'value' => 'template-glass-root.php' ),
            ),
            array(
                array( 'param' => 'page_template', 'operator' => '==', 'value' => 'template-glass-spoke.php' ),
            ),
        ),
        'menu_order'            => 0,
        'position'              => 'normal',
        'style'                 => 'default',
        'label_placement'       => 'top',
        'active'                => true,
        'description'           => 'Per-page content for the glass hub, category roots, and service spokes. Global sections (offers, areas, certs, reviews) render from sg_* helpers, not fields.',
        'show_in_rest'          => 0,
    ) );
}
