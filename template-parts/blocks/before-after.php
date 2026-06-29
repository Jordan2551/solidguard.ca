<?php
/**
 * Block: Before/After comparison.
 *
 * Two layouts, one component:
 *   layout = 'slider'        interactive img-comparison-slider (default)
 *   layout = 'side-by-side'  two static labeled images, no slider lib
 *
 * Paths may be either a full URL (ACF upload) or a theme-relative path under
 * images/pictures/ (e.g. 'work/.../before.webp'). Full URLs pass through as-is.
 *
 * Usage:
 *   get_template_part( 'template-parts/blocks/before-after', null, array(
 *       'before'     => 'work/.../before.webp',   // or https://.../upload.webp
 *       'after'      => 'work/.../after.webp',
 *       'layout'     => 'side-by-side',
 *       'cap_before' => 'Before',
 *       'cap_after'  => 'After',
 *   ) );
 * Slider mode also accepts a single 'combined' => before|after composite.
 *
 * @package SolidGuard
 */

$base = get_template_directory_uri() . '/images/pictures/';

// Accept full URLs (ACF uploads) or theme-relative paths under images/pictures/.
$sg_ba_src = static function ( $p ) use ( $base ) {
    if ( empty( $p ) ) {
        return '';
    }
    return preg_match( '#^(https?:)?//#', $p ) ? esc_url( $p ) : esc_url( $base . $p );
};

$layout   = ! empty( $args['layout'] ) ? $args['layout'] : 'slider';
$cap_b    = ! empty( $args['cap_before'] ) ? $args['cap_before'] : 'Before';
$cap_a    = ! empty( $args['cap_after'] )  ? $args['cap_after']  : 'After';
// Descriptive alt text for SEO/a11y; falls back to the visible caption.
$alt_b    = ! empty( $args['alt_before'] ) ? $args['alt_before'] : $cap_b;
$alt_a    = ! empty( $args['alt_after'] )  ? $args['alt_after']  : $cap_a;
$before   = $sg_ba_src( $args['before']   ?? '' );
$after    = $sg_ba_src( $args['after']    ?? '' );
$combined = $sg_ba_src( $args['combined'] ?? '' );

wp_enqueue_style( 'solidguard-components' );

// ---- Static side-by-side (no slider lib) --------------------------------
if ( 'side-by-side' === $layout && $before && $after ) : ?>
    <div class="sg-ba-sxs">
        <figure class="sg-ba-sxs__item">
            <img src="<?php echo $before; ?>" alt="<?php echo esc_attr( $alt_b ); ?>" loading="lazy" decoding="async">
            <figcaption class="sg-ba-sxs__cap sg-ba-sxs__cap--before"><?php echo esc_html( $cap_b ); ?></figcaption>
        </figure>
        <figure class="sg-ba-sxs__item">
            <img src="<?php echo $after; ?>" alt="<?php echo esc_attr( $alt_a ); ?>" loading="lazy" decoding="async">
            <figcaption class="sg-ba-sxs__cap sg-ba-sxs__cap--after"><?php echo esc_html( $cap_a ); ?></figcaption>
        </figure>
    </div>
    <?php
    return;
endif;

// ---- Interactive slider -------------------------------------------------
wp_enqueue_style( 'imgcomparison-slider' );   // self-hosted lib — only on pages with this block
wp_enqueue_script( 'imgcomparison-slider' );
?>
<img-comparison-slider class="sg-ba">
<?php if ( $combined ) : // one composite, split into before (left) / after (right) ?>
    <figure slot="first" class="sg-ba__half sg-ba__half--before" style="background-image:url('<?php echo $combined; ?>');background-position:left center;">
        <figcaption class="sg-ba__cap sg-ba__cap--before"><?php echo esc_html( $cap_b ); ?></figcaption>
    </figure>
    <figure slot="second" class="sg-ba__half sg-ba__half--after" style="background-image:url('<?php echo $combined; ?>');background-position:right center;">
        <figcaption class="sg-ba__cap sg-ba__cap--after"><?php echo esc_html( $cap_a ); ?></figcaption>
    </figure>
<?php else : // two separate images ?>
    <figure slot="first" class="sg-ba__half">
        <img src="<?php echo $before; ?>" alt="<?php echo esc_attr( $alt_b ); ?>" loading="lazy">
        <figcaption class="sg-ba__cap sg-ba__cap--before"><?php echo esc_html( $cap_b ); ?></figcaption>
    </figure>
    <figure slot="second" class="sg-ba__half">
        <img src="<?php echo $after; ?>" alt="<?php echo esc_attr( $alt_a ); ?>" loading="lazy">
        <figcaption class="sg-ba__cap sg-ba__cap--after"><?php echo esc_html( $cap_a ); ?></figcaption>
    </figure>
<?php endif; ?>
</img-comparison-slider>
