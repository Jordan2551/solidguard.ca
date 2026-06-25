<?php
/**
 * FAQ accordion — pure view. Native <details>/<summary>, no JS.
 *
 * Content supplied by the caller (SEO templates pass the page's FAQ from ACF);
 * no hardcoded defaults. The FAQ items also drive the FAQPage JSON-LD elsewhere,
 * so this stays the single render of the same data.
 *
 * @package SolidGuard
 *
 * Expected $args:
 *   faqs    array   items with 'q' and 'a'
 *   heading string  optional section heading
 */

$faqs    = isset( $args['faqs'] ) ? (array) $args['faqs'] : array();
$heading = isset( $args['heading'] ) ? $args['heading'] : 'Frequently Asked Questions';

if ( empty( $faqs ) ) {
    return;
}
?>

<section class="faq" id="faq" aria-label="Frequently asked questions">
    <div class="container">

    <h2 class="section-heading"><?php echo esc_html( $heading ); ?></h2>

    <dl class="faq__list">
        <?php foreach ( $faqs as $i => $item ) : ?>
            <div class="faq__item">
                <details <?php echo 0 === $i ? 'open' : ''; ?>>
                    <summary class="faq__question" aria-expanded="<?php echo 0 === $i ? 'true' : 'false'; ?>">
                        <span class="faq__question-text"><?php echo esc_html( $item['q'] ); ?></span>
                        <?php echo sg_icon( 'add', 'faq__icon' ); ?>
                    </summary>
                    <div class="faq__answer">
                        <p><?php echo esc_html( $item['a'] ); ?></p>
                    </div>
                </details>
            </div>
        <?php endforeach; ?>
    </dl>

    </div>
</section>
