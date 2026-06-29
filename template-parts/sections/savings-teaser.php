<?php
/**
 * Section: Repair-first savings teaser.
 *
 * Ranges render server-side (good for SEO); components.js handles tab switching.
 * Data source: assets/data/pricing.php (shared with the future estimator tool).
 *
 * @package SolidGuard
 *
 * Expected $args:
 *   keyword string  service keyword woven into the lead (default "glass repair")
 */

$pricing = require get_template_directory() . '/assets/data/pricing.php';
$types   = $pricing['types'];
$default = array_key_first( $types );
$d       = $types[ $default ];

$keyword = ! empty( $args['keyword'] ) ? $args['keyword'] : 'glass repair';

$money = function ( $n ) { return '$' . number_format( round( $n ) ); };
$range = function ( $a ) use ( $money ) { return $money( $a[0] ) . ' to ' . $money( $a[1] ); };
$mid   = function ( $a ) { return ( $a[0] + $a[1] ) / 2; };
$save  = round( $mid( $d['replace'] ) - $mid( $d['repair'] ) );
$pct   = round( $save / $mid( $d['replace'] ) * 100 );
$rwid  = round( $mid( $d['repair'] ) / $mid( $d['replace'] ) * 100, 1 );

wp_enqueue_style( 'solidguard-components' );
wp_enqueue_script( 'solidguard-components' ); // teaser tab logic, only where this section renders
?>

<section class="sg-teaser" id="savings-teaser" aria-label="Repair-first savings"
         data-sg-cmp data-sg-pricing="<?php echo esc_attr( wp_json_encode( $types ) ); ?>">
    <div class="container">

        <p class="sg-eyebrow">Repair-first. We work with what you have.</p>
        <h2 class="sg-teaser__title">Replace only if you really need to.</h2>
        <p class="sg-teaser__lead">We do it all: <?php echo esc_html( $keyword ); ?>, sealed-unit replacement, and full window replacement. We are repair-first. If your frame is still sound, we fix the glass instead of replacing the whole window, and save you the difference.</p>

        <div class="sg-cmp">
            <div class="sg-cmp__tabs" role="tablist" aria-label="Job type">
                <?php foreach ( $types as $id => $t ) : ?>
                    <button class="sg-cmp__tab<?php echo $id === $default ? ' is-active' : ''; ?>" type="button" role="tab"
                            aria-selected="<?php echo $id === $default ? 'true' : 'false'; ?>" data-job="<?php echo esc_attr( $id ); ?>">
                        <?php echo esc_html( $t['label'] ); ?>
                    </button>
                <?php endforeach; ?>
            </div>

            <p class="sg-cmp__desc" data-sg-desc><?php echo esc_html( $d['desc'] ); ?></p>

            <div class="sg-cmp__rows">
                <div class="sg-cmp__row">
                    <div class="sg-cmp__rowhead">
                        <span class="sg-cmp__label">Full window replacement</span>
                        <span class="sg-cmp__price" data-sg-price-replace><?php echo esc_html( $range( $d['replace'] ) ); ?></span>
                    </div>
                    <div class="sg-cmp__track"><div class="sg-cmp__fill sg-cmp__fill--replace" data-sg-bar-replace style="width:100%"></div></div>
                </div>
                <div class="sg-cmp__row">
                    <div class="sg-cmp__rowhead">
                        <span class="sg-cmp__label sg-cmp__label--win">Glass repair (frame is good)</span>
                        <span class="sg-cmp__price sg-cmp__price--win" data-sg-price-repair><?php echo esc_html( $range( $d['repair'] ) ); ?></span>
                    </div>
                    <div class="sg-cmp__track"><div class="sg-cmp__fill sg-cmp__fill--repair" data-sg-bar-repair style="width:<?php echo esc_attr( $rwid ); ?>%"></div></div>
                </div>
            </div>

            <div class="sg-cmp__save">
                <span class="sg-cmp__save-label">You could save</span>
                <span class="sg-cmp__save-amt" data-sg-save><?php echo esc_html( $money( $save ) ); ?></span>
                <span class="sg-cmp__save-pct" data-sg-pct>around <?php echo esc_html( $pct ); ?>% off a full replacement</span>
            </div>

            <p class="sg-cmp__fine"><?php echo esc_html( $pricing['meta']['region'] ); ?> market ranges (<?php echo esc_html( $pricing['meta']['currency'] ); ?>). <?php echo esc_html( ucfirst( $pricing['meta']['caveat'] ) ); ?></p>
        </div>

    </div>
</section>
