<?php
/**
 * Block: Before/After slider (img-comparison-slider — self-hosted, a11y + touch).
 *
 * Usage (single before|after composite, split L/R — matches images/pictures/work/* assets):
 *   get_template_part( 'template-parts/blocks/before-after', null, array(
 *       'combined'   => 'work/resedential-glass-services/foggy_before_after_combined(1)-1_70reduced.webp',
 *       'cap_before' => 'Before · foggy seal failure',
 *       'cap_after'  => 'After · repaired',
 *   ) );
 * Or two separate images: 'before' => '...', 'after' => '...'.
 *
 * @package SolidGuard
 */

$base     = get_template_directory_uri() . '/images/pictures/';
$cap_b    = ! empty( $args['cap_before'] ) ? $args['cap_before'] : 'Before';
$cap_a    = ! empty( $args['cap_after'] )  ? $args['cap_after']  : 'After';
$combined = ! empty( $args['combined'] ) ? esc_url( $base . $args['combined'] ) : '';
$before   = ! empty( $args['before'] )   ? esc_url( $base . $args['before'] )   : '';
$after    = ! empty( $args['after'] )    ? esc_url( $base . $args['after'] )    : '';

wp_enqueue_style( 'solidguard-components' );
wp_enqueue_style( 'imgcomparison-slider' );   // self-hosted lib — only loads on pages with this block
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
        <img src="<?php echo $before; ?>" alt="<?php echo esc_attr( $cap_b ); ?>" loading="lazy">
        <figcaption class="sg-ba__cap sg-ba__cap--before"><?php echo esc_html( $cap_b ); ?></figcaption>
    </figure>
    <figure slot="second" class="sg-ba__half">
        <img src="<?php echo $after; ?>" alt="<?php echo esc_attr( $cap_a ); ?>" loading="lazy">
        <figcaption class="sg-ba__cap sg-ba__cap--after"><?php echo esc_html( $cap_a ); ?></figcaption>
    </figure>
<?php endif; ?>
</img-comparison-slider>
