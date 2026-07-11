<?php
/**
 * Child-service grid — auto-generated from the page tree (post_parent).
 *
 * Renders the linked cards for a page's published children (title + icon + blurb
 * + arrow). The caller owns the section wrapper and heading (see glass-listing).
 * New pages seeded under the parent appear automatically; no manual link lists.
 *
 * @package SolidGuard
 *
 * Expected $args:
 *   parent_id int  parent page id whose children to list
 */

$parent_id = isset( $args['parent_id'] ) ? (int) $args['parent_id'] : 0;
if ( ! $parent_id ) {
    return;
}

$children = get_pages( array(
    'parent'      => $parent_id,
    'sort_column' => 'menu_order,post_title',
    'post_status' => 'publish',
) );
if ( empty( $children ) ) {
    return;
}

// Pick a card icon from the available set based on the service name.
$sg_card_icon = static function ( $child ) {
    $hay = strtolower( $child->post_name . ' ' . $child->post_title );
    if ( strpos( $hay, 'residential' ) !== false || strpos( $hay, 'home' ) !== false ) {
        return 'home';
    }
    if ( strpos( $hay, 'emergency' ) !== false || strpos( $hay, 'board' ) !== false || strpos( $hay, 'broken' ) !== false ) {
        return 'schedule';
    }
    return 'window'; // glass/commercial default, on-brand
};
?>

<div class="services-grid">
    <?php
    foreach ( $children as $child ) :
        $blurb = get_field( 'hero_subhead', $child->ID );
        if ( ! $blurb ) {
            $blurb = wp_strip_all_tags( get_field( 'overview_heading', $child->ID ) );
        }
        ?>
        <a class="service-card service-card--text" href="<?php echo esc_url( get_permalink( $child->ID ) ); ?>">
            <div class="service-card__body">
                <span class="service-card__icon" aria-hidden="true"><?php echo sg_icon( $sg_card_icon( $child ) ); ?></span>
                <h3 class="service-card__title"><?php echo esc_html( get_the_title( $child->ID ) ); ?></h3>
                <?php if ( $blurb ) : ?>
                    <p class="service-card__desc"><?php echo esc_html( wp_trim_words( $blurb, 24 ) ); ?></p>
                <?php endif; ?>
                <span class="service-card__more">
                    View service <?php echo sg_icon( 'arrow_forward', 'icon-xs' ); ?>
                </span>
            </div>
        </a>
    <?php endforeach; ?>
</div>
