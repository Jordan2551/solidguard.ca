<?php
/**
 * Site data — single source of truth for sitewide config.
 *
 * These are NOT page content (which is injected per-page via ACF or the LP
 * provider). They are global facts that are identical on every page: the glass
 * service tree used by the mega-menu + footer, the service-area cities, the
 * affiliation badges, and the standing offers.
 *
 * Partials read from these helpers instead of carrying their own copies, so
 * there is exactly one place to edit each list. Data is returned raw; callers
 * escape at output.
 *
 * @package SolidGuard
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Glass service navigation tree (mega-menu + footer columns).
 *
 * Each category root links to /glass/{root}/; each spoke links DIRECT to its
 * /glass/{root}/{slug}/ page (one click, never routed through the root).
 *
 * @return array<string,array{label:string,root:string,accent:bool,spokes:array<array{label:string,slug:string}>}>
 */
function sg_glass_nav() {
    return array(
        'residential' => array(
            'label'  => 'Residential',
            'root'   => 'residential',
            'accent' => false,
            'spokes' => array(
                array( 'label' => 'Window Glass Repair',        'slug' => 'window-glass-repair' ),
                array( 'label' => 'Window Glass Replacement',   'slug' => 'window-glass-replacement' ),
                array( 'label' => 'Foggy & Double-Pane Repair', 'slug' => 'double-pane-window-repair' ),
                array( 'label' => 'Patio & Sliding Door Glass', 'slug' => 'patio-sliding-door-glass' ),
                array( 'label' => 'Window Crank Repair',        'slug' => 'window-crank-repair' ),
                array( 'label' => 'Window Screens',             'slug' => 'window-screens' ),
                array( 'label' => 'Porch Enclosures',           'slug' => 'porch-enclosures' ),
                array( 'label' => 'Window Restoration',         'slug' => 'window-restoration' ),
                array( 'label' => 'Custom Glass & Mirrors',     'slug' => 'custom-glass-mirrors' ),
            ),
        ),
        'commercial' => array(
            'label'  => 'Commercial',
            'root'   => 'commercial',
            'accent' => false,
            'spokes' => array(
                array( 'label' => 'Storefront Glass',            'slug' => 'storefront-glass' ),
                array( 'label' => 'Commercial Storefront Doors', 'slug' => 'commercial-storefront-doors' ),
                array( 'label' => 'Commercial Window Replacement', 'slug' => 'commercial-window-replacement' ),
                array( 'label' => 'Glass Partitions',            'slug' => 'glass-partitions' ),
                array( 'label' => 'Curtain Wall',                'slug' => 'curtain-wall' ),
                array( 'label' => 'Glass Vestibules',            'slug' => 'glass-vestibules' ),
            ),
        ),
        'emergency' => array(
            'label'  => 'Emergency · 24/7',
            'root'   => 'emergency',
            'accent' => true, // styled orange across nav/footer per navigation.md
            'spokes' => array(
                // "Emergency Glass Repair" is the root page itself (slug '' = link to root).
                array( 'label' => 'Emergency Glass Repair', 'slug' => '' ),
                array( 'label' => 'Board-Up Service',       'slug' => 'board-up-service' ),
                array( 'label' => 'Broken Window Repair',   'slug' => 'broken-window-repair' ),
            ),
        ),
    );
}

/**
 * Build the URL for a glass nav item. Empty slug → the category root.
 *
 * @param string $root  Category root slug (residential|commercial|emergency).
 * @param string $slug  Spoke slug, or '' for the root page.
 * @return string Absolute URL.
 */
function sg_glass_url( $root, $slug = '' ) {
    $path = 'glass/' . $root . '/';
    if ( $slug !== '' ) {
        $path .= $slug . '/';
    }
    return home_url( '/' . $path );
}

/**
 * Service areas, grouped by GTA region (mega-menu + footer).
 * Tier A cities are flagged for emphasis. 19 cities total.
 *
 * @return array<string,array<array{name:string,tier:string}>>
 */
function sg_service_area_regions() {
    return array(
        'Toronto' => array(
            array( 'name' => 'Toronto',     'tier' => 'A' ),
            array( 'name' => 'Etobicoke',   'tier' => 'B' ),
            array( 'name' => 'Scarborough', 'tier' => 'A' ),
            array( 'name' => 'North York',  'tier' => 'B' ),
        ),
        'York Region' => array(
            array( 'name' => 'Vaughan',       'tier' => 'B' ),
            array( 'name' => 'Markham',       'tier' => 'B' ),
            array( 'name' => 'Richmond Hill', 'tier' => 'B' ),
            array( 'name' => 'Newmarket',     'tier' => 'C' ),
            array( 'name' => 'Aurora',        'tier' => 'C' ),
        ),
        'Peel & Halton' => array(
            array( 'name' => 'Mississauga', 'tier' => 'A' ),
            array( 'name' => 'Brampton',    'tier' => 'A' ),
            array( 'name' => 'Oakville',    'tier' => 'B' ),
            array( 'name' => 'Burlington',  'tier' => 'B' ),
            array( 'name' => 'Milton',      'tier' => 'B' ),
        ),
        'Durham & Simcoe' => array(
            array( 'name' => 'Ajax',     'tier' => 'C' ),
            array( 'name' => 'Pickering', 'tier' => 'C' ),
            array( 'name' => 'Whitby',   'tier' => 'C' ),
            array( 'name' => 'Oshawa',   'tier' => 'C' ),
            array( 'name' => 'Barrie',   'tier' => 'C' ),
        ),
    );
}

/**
 * Flat ordered list of service-area city names, derived from the regions.
 * Replaces the hardcoded arrays in service-areas.php / service-areas-linked.php.
 *
 * @return string[]
 */
function sg_service_areas() {
    $flat = array();
    foreach ( sg_service_area_regions() as $cities ) {
        foreach ( $cities as $city ) {
            $flat[] = $city['name'];
        }
    }
    return $flat;
}

/**
 * Location page URL for a city name. "Richmond Hill" → /glass/locations/richmond-hill/.
 *
 * @param string $city City display name.
 * @return string Absolute URL.
 */
function sg_location_url( $city ) {
    return home_url( '/glass/locations/' . sanitize_title( $city ) . '/' );
}

/**
 * Affiliation / trust badges (trust-bar marquee). Logo files live in
 * /images/logos/affiliates/.
 *
 * @return array<array{logo:string,alt:string,label:string}>
 */
function sg_affiliations() {
    $dir = get_template_directory_uri() . '/images/logos/affiliates/';
    return array(
        array( 'logo' => $dir . 'HomeStars.webp',                                                          'alt' => 'HomeStars',                       'label' => 'HomeStars Verified' ),
        array( 'logo' => $dir . 'IDN-Canada-Trusted-Partner.webp',                                         'alt' => 'IDN Canada',                      'label' => 'IDN Canada Trusted Partner' ),
        array( 'logo' => $dir . 'Ontario_Provincial_Police_Logo.webp',                                     'alt' => 'Ontario Provincial Police',       'label' => 'Police Background Cleared' ),
        array( 'logo' => $dir . 'TPS-Police-Clearance-logo.webp',                                          'alt' => 'TPS Police Clearance',            'label' => 'TPS Police Cleared' ),
        array( 'logo' => $dir . 'Yellow_Pages_Limited_Yellow_Pages_Announces_Winner_of_its_2026_N.webp',   'alt' => 'Yellow Pages 2026 Award Winner',  'label' => '2026 Yellow Pages Award Winner' ),
        array( 'logo' => $dir . 'mywindow.webp',                                                           'alt' => 'MyWindow',                        'label' => 'MyWindow Certified' ),
    );
}

/**
 * Standard hero trust bullets (brand-global, shown on every SEO hero).
 *
 * @return string[]
 */
function sg_trust_bullets() {
    return array(
        '5.0 Google rating',
        'Police-cleared technicians',
        'Same or next day',
        '3-month workmanship warranty',
    );
}

/**
 * Resolve a hero window-graphic key (e.g. "slider-window") to its frame URLs.
 *
 * Reads images/hero/<key>/*.webp in natural order. A folder with one file is a
 * static cutout; multiple files animate via the .page-hero__seq cross-fade.
 * Returns an empty array if the key is blank or the folder is missing.
 *
 * @param string $key Folder name under images/hero/.
 * @return string[]   Ordered frame URLs.
 */
function sg_hero_frames( $key ) {
    $key = trim( (string) $key, '/' );
    if ( '' === $key || preg_match( '#[^a-z0-9_-]#i', $key ) ) {
        return array();
    }
    $dir = get_template_directory() . '/images/hero/' . $key;
    if ( ! is_dir( $dir ) ) {
        return array();
    }
    $files = glob( $dir . '/*.webp' );
    if ( ! $files ) {
        return array();
    }
    natsort( $files );
    $uri = get_template_directory_uri() . '/images/hero/' . $key . '/';
    return array_values( array_map(
        static function ( $f ) use ( $uri ) {
            return $uri . basename( $f );
        },
        $files
    ) );
}

/**
 * Hero visual args for a glass page: client upload > _sg_hero key > casement default.
 *
 * Returns the asset/asset_frames slice for template-parts/sections/hero.php; the
 * caller merges in h1/subhead/bullets. Shared by hub/root/spoke templates.
 *
 * @param int $id Page id.
 * @return array{asset?:string,asset_frames?:string[]}
 */
function sg_hero_visual_args( $id ) {
    $upload = get_field( 'hero_asset', $id );
    if ( $upload ) {
        return array( 'asset' => $upload );
    }
    $key    = get_post_meta( $id, '_sg_hero', true );
    $frames = $key ? sg_hero_frames( $key ) : array();
    if ( ! $frames ) {
        $frames = sg_hero_frames( 'casement-window' );
    }
    if ( count( $frames ) > 1 ) {
        return array( 'asset_frames' => $frames );
    }
    if ( $frames ) {
        return array( 'asset' => $frames[0] );
    }
    return array();
}

/**
 * Standing promotional offers (special-offers rail).
 *
 * @return array<array{headline:string,subhead:string,desc:string,expires:string}>
 */
function sg_offers() {
    // Rolling 7-day expiry. main.js also sets this client-side (.js-offer-expiry);
    // computing it here keeps the SSR / no-JS value correct too (was a stale
    // hardcoded date). Format matches the JS output (n/j/Y).
    $expires = date( 'n/j/Y', strtotime( '+7 days' ) );

    return array(
        array(
            'headline' => '10% Off',
            'subhead'  => 'Any Glass Service',
            'desc'     => 'Available for new clients and first responders. Maximum discount $200. Valid ID required.',
            'expires'  => $expires,
        ),
        array(
            'headline' => '15% Off',
            'subhead'  => 'Returning Clients',
            'desc'     => 'Loyalty discount for repeat commercial and residential maintenance clients. No minimum spend.',
            'expires'  => $expires,
        ),
        array(
            'headline' => '$25 Off',
            'subhead'  => 'Window Repairs',
            'desc'     => 'Valid on any residential glass window repair over $200. Cannot be combined with other offers.',
            'expires'  => $expires,
        ),
    );
}
