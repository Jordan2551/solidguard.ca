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
function sg_schema( $args = array() ) {
    $args = wp_parse_args( $args, array(
        'name'         => '',
        'service_type' => '',
        'url'          => '',
        'description'  => '',
        'faqs'         => array(),
    ) );

    if ( '' === $args['name'] ) {
        return;
    }

    $service_type = '' !== $args['service_type'] ? $args['service_type'] : $args['name'];

    $blocks = array();

    // --- Service ---
    $blocks[] = array(
        '@context'    => 'https://schema.org',
        '@type'       => 'Service',
        'name'        => $args['name'],
        'serviceType' => $service_type,
        'url'         => $args['url'],
        'description' => $args['description'],
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
    if ( ! empty( $args['faqs'] ) && is_array( $args['faqs'] ) ) {
        $entities = array();
        foreach ( $args['faqs'] as $faq ) {
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
