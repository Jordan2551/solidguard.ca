<?php
/**
 * SolidGuard glass page seeder (idempotent).
 *
 * Reads every seeder/manifest/*.json and upserts the page tree: hub -> roots ->
 * spokes -> locations. Re-running never duplicates (upsert by path); it overwrites
 * the page with the manifest, so the JSON is the source of truth. Run it whenever
 * content changes.
 *
 * Run: wp eval-file seeder/seed.php
 *
 * Each manifest entry:
 *   path        full URI, e.g. "glass/residential/window-glass-repair"
 *   parent      parent URI ("" for the hub), used to wire post_parent
 *   template    page template file ("" = default), e.g. "template-glass-spoke.php"
 *   title       post_title (also the breadcrumb label)
 *   menu_order  int
 *   rank_math   { title, description, focus_keyword }   -> RankMath post meta
 *   cluster     { primary, secondary[], semantic[] }    -> coverage gate (not stored)
 *   fields      { acf_field_name: value, ... }          -> ACF (update_field)
 *
 * @package SolidGuard
 */

if ( ! function_exists( 'update_field' ) ) {
    fwrite( STDERR, "ACF not active; cannot seed fields.\n" );
    return;
}

$dir   = __DIR__ . '/manifest';
$files = glob( $dir . '/*.json' );
if ( ! $files ) {
    echo "No manifests in $dir\n";
    return;
}

// Load + sort shallow-to-deep so a parent is always seeded before its children.
$manifests = array();
foreach ( $files as $f ) {
    $m = json_decode( file_get_contents( $f ), true );
    if ( is_array( $m ) && ! empty( $m['path'] ) ) {
        $manifests[] = $m;
    } else {
        fwrite( STDERR, "Skipping invalid manifest: " . basename( $f ) . "\n" );
    }
}
usort(
    $manifests,
    static function ( $a, $b ) {
        return substr_count( trim( $a['path'], '/' ), '/' ) <=> substr_count( trim( $b['path'], '/' ), '/' );
    }
);

$seeded = array(); // path => id, for reliable in-run parent resolution.

foreach ( $manifests as $m ) {
    $path = trim( $m['path'], '/' );
    $slug = basename( $path );

    // Resolve parent from this run first, then the DB.
    $parent_id = 0;
    if ( ! empty( $m['parent'] ) ) {
        $pp = trim( $m['parent'], '/' );
        if ( isset( $seeded[ $pp ] ) ) {
            $parent_id = $seeded[ $pp ];
        } else {
            $parent = get_page_by_path( $pp );
            if ( ! $parent ) {
                fwrite( STDERR, "  ! parent not found for /$path/ (parent: /$pp/) — skipped\n" );
                continue;
            }
            $parent_id = $parent->ID;
        }
    }

    // Upsert by path.
    $existing = get_page_by_path( $path );
    $postarr  = array(
        'post_type'   => 'page',
        'post_status' => 'publish',
        'post_title'  => $m['title'],
        'post_name'   => $slug,
        'post_parent' => $parent_id,
        'menu_order'  => isset( $m['menu_order'] ) ? (int) $m['menu_order'] : 0,
    );
    if ( $existing ) {
        $postarr['ID'] = $existing->ID;
    }
    $id = wp_insert_post( $postarr, true );
    if ( is_wp_error( $id ) ) {
        fwrite( STDERR, "  ! insert failed for /$path/: " . $id->get_error_message() . "\n" );
        continue;
    }
    clean_post_cache( $id );
    $seeded[ $path ] = $id;

    // Page template.
    if ( ! empty( $m['template'] ) ) {
        update_post_meta( $id, '_wp_page_template', $m['template'] );
    } else {
        delete_post_meta( $id, '_wp_page_template' );
    }

    // Hero window-graphic key (design directive, not client-editable content).
    if ( ! empty( $m['hero'] ) ) {
        update_post_meta( $id, '_sg_hero', $m['hero'] );
    } else {
        delete_post_meta( $id, '_sg_hero' );
    }

    // ACF content fields.
    if ( ! empty( $m['fields'] ) && is_array( $m['fields'] ) ) {
        foreach ( $m['fields'] as $name => $value ) {
            update_field( $name, $value, $id );
        }
    }

    // RankMath meta.
    if ( ! empty( $m['rank_math'] ) ) {
        $rm = $m['rank_math'];
        if ( ! empty( $rm['title'] ) ) {
            update_post_meta( $id, 'rank_math_title', $rm['title'] );
        }
        if ( ! empty( $rm['description'] ) ) {
            update_post_meta( $id, 'rank_math_description', $rm['description'] );
        }
        if ( ! empty( $rm['focus_keyword'] ) ) {
            update_post_meta( $id, 'rank_math_focus_keyword', $rm['focus_keyword'] );
        }
    }

    printf( "  seeded /%s/ (id %d, %s)\n", $path, $id, $existing ? 'updated' : 'created' );
}

echo "\nDone. " . count( $seeded ) . " page(s) seeded. Run the coverage gate next:\n";
echo "  php tools/coverage-check.php <url> <manifest-or-cluster.json>\n";
