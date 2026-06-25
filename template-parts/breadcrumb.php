<?php
/**
 * Breadcrumb — mirrors the page hierarchy (Home › ancestors › current).
 * Driven by post_parent, so it matches the URL path automatically.
 * RankMath emits the BreadcrumbList JSON-LD separately; this is the visible trail.
 *
 * @package SolidGuard
 */

if ( is_front_page() ) {
    return;
}

$current_id = get_queried_object_id();
if ( ! $current_id ) {
    return;
}

$ancestors = array_reverse( get_post_ancestors( $current_id ) );
?>
<nav class="breadcrumb" aria-label="Breadcrumb">
    <div class="container">
        <ol class="breadcrumb__list">
            <li class="breadcrumb__item">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
            </li>
            <?php foreach ( $ancestors as $ancestor_id ) : ?>
                <li class="breadcrumb__item">
                    <a href="<?php echo esc_url( get_permalink( $ancestor_id ) ); ?>"><?php echo esc_html( get_the_title( $ancestor_id ) ); ?></a>
                </li>
            <?php endforeach; ?>
            <li class="breadcrumb__item" aria-current="page">
                <?php echo esc_html( get_the_title( $current_id ) ); ?>
            </li>
        </ol>
    </div>
</nav>
