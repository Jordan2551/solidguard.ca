<?php
/**
 * Bootstrap manifests from the hand-built DB pages (the reverse of seed.php).
 *
 * Walks the /glass/ page tree and writes seeder/manifest/<slug>.json per page,
 * capturing post fields + ACF content + RankMath meta + (if available) the
 * keyword cluster. Use it once to turn a hand-built prototype into a versioned
 * manifest; after that, the manifest is the source of truth and you edit JSON.
 *
 * Run: wp eval-file seeder/export.php
 *
 * @package SolidGuard
 */

if ( ! function_exists( 'get_fields' ) ) {
    fwrite( STDERR, "ACF not active.\n" );
    return;
}

$out_dir = __DIR__ . '/manifest';
if ( ! is_dir( $out_dir ) ) {
    mkdir( $out_dir, 0775, true );
}

// Optional: pull the keyword cluster from the marketing repo if it's on disk.
$clusters_dir = '/Users/jordancohen/Documents/dev/personal/marketing/clients/solidguard.ca/seo/tools/clusters';

$pages = get_pages( array( 'sort_column' => 'menu_order', 'hierarchical' => false ) );
$count = 0;

foreach ( $pages as $pg ) {
    $path = get_page_uri( $pg->ID );
    if ( strpos( $path, 'glass' ) !== 0 ) {
        continue; // only the glass tree
    }

    $slug = $pg->post_name;
    $tpl  = get_post_meta( $pg->ID, '_wp_page_template', true );
    $tpl  = ( $tpl && 'default' !== $tpl ) ? $tpl : '';

    $entry = array(
        'path'       => $path,
        'parent'     => $pg->post_parent ? get_page_uri( $pg->post_parent ) : '',
        'template'   => $tpl,
        'title'      => $pg->post_title,
        'menu_order' => (int) $pg->menu_order,
    );

    // Hero window-graphic key.
    $hero = get_post_meta( $pg->ID, '_sg_hero', true );
    if ( $hero ) {
        $entry['hero'] = $hero;
    }

    // Before/after work photo (theme-relative path).
    $work_photo = get_post_meta( $pg->ID, '_sg_work_photo', true );
    if ( $work_photo ) {
        $entry['work_photo'] = $work_photo;
    }

    // RankMath meta.
    $rm = array_filter( array(
        'title'         => get_post_meta( $pg->ID, 'rank_math_title', true ),
        'description'   => get_post_meta( $pg->ID, 'rank_math_description', true ),
        'focus_keyword' => get_post_meta( $pg->ID, 'rank_math_focus_keyword', true ),
    ) );
    if ( $rm ) {
        $entry['rank_math'] = $rm;
    }

    // Keyword cluster (bootstrap from the marketing repo; afterwards it lives here).
    $cluster_file = $clusters_dir . '/' . $slug . '.json';
    if ( is_readable( $cluster_file ) ) {
        $c = json_decode( file_get_contents( $cluster_file ), true );
        unset( $c['slug'] );
        if ( $c ) {
            $entry['cluster'] = $c;
        }
    }

    // ACF content fields (drop empties + image URL fields, handled when real assets exist).
    $fields = get_fields( $pg->ID );
    if ( is_array( $fields ) ) {
        $fields = array_filter(
            $fields,
            static function ( $v ) {
                return $v !== '' && $v !== false && $v !== null && $v !== array();
            }
        );
        // Image fields store attachment ids; skip exporting URL strings for now.
        unset( $fields['hero_asset'], $fields['before_image'], $fields['after_image'] );
        if ( $fields ) {
            $entry['fields'] = $fields;
        }
    }

    $json = json_encode( $entry, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
    // Make internal links portable: strip this site's origin so URLs are root-relative.
    $json = str_replace( untrailingslashit( home_url() ), '', $json );
    file_put_contents( $out_dir . '/' . $slug . '.json', $json . "\n" );
    echo "exported /{$path}/ -> manifest/{$slug}.json\n";
    $count++;
}

echo "\nDone. $count page(s) exported to seeder/manifest/.\n";
