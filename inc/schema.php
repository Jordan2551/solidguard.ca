<?php
/**
 * JSON-LD schema for SEO templates.
 *
 * Path B: RankMath owns the sitewide Organization / LocalBusiness / BreadcrumbList.
 * The templates emit the page-specific Service + FAQPage here. We deliberately do
 * NOT auto-emit AggregateRating: fabricating a review count violates Google's
 * review-snippet policy. Wire it to a real count (Google/Elfsight) before adding.
 *
 * @package SolidGuard
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Echo Service (+ FAQPage when the page has FAQs) JSON-LD for a glass page.
 *
 * @param int    $post_id     The page.
 * @param string $service_type Optional serviceType override (else focus kw / H1).
 */
function sg_schema( $post_id = 0, $service_type = '' ) {
    $post_id = $post_id ? $post_id : get_the_ID();
    if ( ! $post_id ) {
        return;
    }

    $h1      = function_exists( 'get_field' ) ? (string) get_field( 'hero_h1', $post_id ) : '';
    $h1      = $h1 !== '' ? $h1 : get_the_title( $post_id );
    $subhead = function_exists( 'get_field' ) ? (string) get_field( 'hero_subhead', $post_id ) : '';

    $focus = (string) get_post_meta( $post_id, 'rank_math_focus_keyword', true );
    if ( $focus !== '' ) {
        $focus = trim( explode( ',', $focus )[0] ); // RankMath stores focus kws comma-separated
    }
    $desc = (string) get_post_meta( $post_id, 'rank_math_description', true );
    $desc = $desc !== '' ? $desc : $subhead;

    if ( $service_type === '' ) {
        $service_type = $focus !== '' ? $focus : $h1;
    }

    $blocks = array();

    // --- Service ---
    $blocks[] = array(
        '@context'    => 'https://schema.org',
        '@type'       => 'Service',
        'name'        => $h1,
        'serviceType' => $service_type,
        'url'         => get_permalink( $post_id ),
        'description' => $desc,
        'areaServed'  => array(
            '@type' => 'AdministrativeArea',
            'name'  => 'Toronto and the Greater Toronto Area',
        ),
        'provider'    => array(
            '@type'     => 'LocalBusiness',
            'name'      => 'SolidGuard Glass & Windows',
            'telephone' => '+1-' . SG_PHONE_RAW,
            'url'       => home_url( '/' ),
        ),
    );

    // --- FAQPage (only if the page has FAQs) ---
    $faqs = function_exists( 'get_field' ) ? get_field( 'faqs', $post_id ) : array();
    if ( ! empty( $faqs ) && is_array( $faqs ) ) {
        $entities = array();
        foreach ( $faqs as $faq ) {
            if ( empty( $faq['question'] ) || empty( $faq['answer'] ) ) {
                continue;
            }
            $entities[] = array(
                '@type'          => 'Question',
                'name'           => wp_strip_all_tags( $faq['question'] ),
                'acceptedAnswer' => array(
                    '@type' => 'Answer',
                    'text'  => wp_strip_all_tags( $faq['answer'] ),
                ),
            );
        }
        if ( $entities ) {
            $blocks[] = array(
                '@context'   => 'https://schema.org',
                '@type'      => 'FAQPage',
                'mainEntity' => $entities,
            );
        }
    }

    foreach ( $blocks as $block ) {
        echo "\n" . '<script type="application/ld+json">' . wp_json_encode( $block, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
    }
}

/**
 * On glass templates, drop RankMath's default page rich-snippet (Article/WebPage)
 * so only our Service + FAQPage remain. RankMath still emits the sitewide
 * Organization / LocalBusiness / BreadcrumbList, which we keep.
 */
add_filter( 'rank_math/json_ld', 'sg_prune_rankmath_schema', 99, 2 );
function sg_prune_rankmath_schema( $data, $jsonld ) {
    if ( ! is_page_template( array( 'template-glass-spoke.php', 'template-glass-root.php', 'template-glass-hub.php' ) ) ) {
        return $data;
    }
    $drop = array( 'Article', 'BlogPosting', 'WebPage', 'CollectionPage', 'ItemPage' );
    foreach ( $data as $key => $piece ) {
        $types = isset( $piece['@type'] ) ? (array) $piece['@type'] : array();
        if ( array_intersect( $types, $drop ) ) {
            unset( $data[ $key ] );
        }
    }
    return $data;
}
