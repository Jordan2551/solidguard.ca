<?php
/**
 * Block: Floating van — brand signature element.
 *
 * Usage: get_template_part( 'template-parts/blocks/floating-van', null, array(
 *     'img' => 'solidguard-van-no-bg.webp',   // optional, file in images/pictures/
 *     'alt' => 'Solid Guard branded service van',
 * ) );
 *
 * @package SolidGuard
 */

$img = ! empty( $args['img'] ) ? $args['img'] : 'solidguard-van-no-bg.webp';
$alt = ! empty( $args['alt'] ) ? $args['alt'] : 'Solid Guard branded service van';

wp_enqueue_style( 'solidguard-components' ); // load block styles only where this block renders
?>
<div class="sg-van" data-sg-van>
    <img class="sg-van__img"
         src="<?php echo esc_url( get_template_directory_uri() . '/images/pictures/' . $img ); ?>"
         alt="<?php echo esc_attr( $alt ); ?>"
         loading="lazy" decoding="async" width="640" height="360">
    <div class="sg-van__shadow" aria-hidden="true"></div>
</div>
