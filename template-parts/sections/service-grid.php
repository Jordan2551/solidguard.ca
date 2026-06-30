<?php
/**
 * Child-service grid — auto-generated from the page tree (post_parent).
 *
 * Lists the published children of a page as linked cards (title + blurb + arrow).
 * Used by the hub (lists category roots) and roots (list their spokes). New pages
 * seeded under the parent appear automatically; no manual link lists.
 *
 * @package SolidGuard
 *
 * Expected $args:
 *   parent_id int     parent page id whose children to list
 *   heading   string  section H2
 *   intro     string  optional intro paragraph
 */

$parent_id = isset( $args['parent_id'] ) ? (int) $args['parent_id'] : 0;
$heading   = isset( $args['heading'] ) ? $args['heading'] : '';
$intro     = isset( $args['intro'] ) ? $args['intro'] : '';

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
?>

<section class="section section--white" aria-label="<?php echo esc_attr( $heading ?: 'Services' ); ?>">
    <div class="container">

        <?php if ( '' !== $heading ) : ?>
            <h2 class="section-heading"><?php echo esc_html( $heading ); ?></h2>
        <?php endif; ?>
        <?php if ( '' !== $intro ) : ?>
            <p class="body-sm text-muted service-grid__intro"><?php echo esc_html( $intro ); ?></p>
        <?php endif; ?>

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

    </div>
</section>
