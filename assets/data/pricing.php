<?php
/**
 * Pricing data — market estimate ranges (CAD, Toronto/GTA).
 * Single source of truth for the savings teaser AND the future estimator tool.
 * Solid Guard does BOTH; repair-first: repair = glass-only (keep the frame),
 * replace = full unit (frame + glass). [low, high].
 *
 * @package SolidGuard
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

return array(
    'meta' => array(
        'currency' => 'CAD',
        'region'   => 'Toronto / GTA',
        'updated'  => '2026-06',
        'caveat'   => 'estimate only; every job confirmed with an on-site quote.',
    ),
    'types' => array(
        'standard'   => array( 'label' => 'Standard window',      'desc' => 'Double-pane sealed unit, up to ~3×4 ft',        'repair' => array( 350, 650 ),  'replace' => array( 600, 1200 ) ),
        'bay'        => array( 'label' => 'Bay / bow',            'desc' => '3-panel — we replace the failed sealed unit(s)', 'repair' => array( 700, 1500 ), 'replace' => array( 2800, 6000 ) ),
        'patio'      => array( 'label' => 'Patio / sliding door', 'desc' => 'Sealed glass panel in the existing door',        'repair' => array( 500, 1000 ), 'replace' => array( 1500, 5500 ) ),
        'storefront' => array( 'label' => 'Storefront pane',      'desc' => 'Commercial tempered/plate glass, per panel',     'repair' => array( 600, 1500 ), 'replace' => array( 1500, 3000 ) ),
    ),
    // For the full estimator tool — applied on top of the glass-only base range.
    'modifiers' => array(
        'low_e_argon' => array( 'label' => 'Low-E / argon glass',    'factor' => array( 1.15, 1.20 ) ),
        'tempered'    => array( 'label' => 'Tempered safety glass',   'add'    => array( 100, 200 ) ),
        'laminated'   => array( 'label' => 'Laminated safety glass',  'add'    => array( 150, 300 ) ),
        'same_day'    => array( 'label' => 'Same-day / after-hours',  'factor' => array( 1.20, 1.30 ) ),
        'board_up'    => array( 'label' => 'Emergency board-up',      'flat'   => array( 300, 600 ) ),
    ),
);
