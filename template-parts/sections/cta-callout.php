<?php
/**
 * CTA Callout - van + headline + estimate + call CTAs
 *
 * Reusable. Pass args to customise copy:
 *
 *   get_template_part( 'template-parts/sections/cta-callout', null, array(
 *       'eyebrow'  => 'Emergency Response',
 *       'title'    => 'Glass Broken? We\'re On Our Way.',
 *       'subtitle' => 'Same-day service across Toronto and the GTA.',
 *   ) );
 *
 * @package SolidGuard
 */

$args     = wp_parse_args( $args ?? array(), array(
    'eyebrow'  => 'Emergency Response: Toronto &amp; GTA',
    'title'    => 'Glass Broken? We\'re On Our Way.',
    'subtitle' => 'Same-day service, background-checked technicians, and a free on-site assessment. No commitment until you approve the quote.',
) );
?>

<section class="cta-callout" aria-label="Call to action">
    <div class="cta-callout__inner">

        <!-- Van image -->
        <img
            class="cta-callout__van"
            src="<?php echo esc_url( get_template_directory_uri() . '/images/pictures/solidguard-van-no-bg.webp' ); ?>"
            alt="Solid Guard service van"
            loading="lazy"
            decoding="async"
            width="560"
            height="374"
        >

        <!-- Content -->
        <div class="cta-callout__content">

            <span class="cta-callout__eyebrow">
                <?php echo wp_kses( $args['eyebrow'], array( 'br' => array() ) ); ?>
            </span>

            <h2 class="cta-callout__title">
                <?php echo esc_html( $args['title'] ); ?>
            </h2>

            <p class="cta-callout__sub">
                <?php echo esc_html( $args['subtitle'] ); ?>
            </p>

            <div class="cta-callout__actions">

                <button type="button" class="btn btn--orange btn--lg" data-modal-trigger="modal-estimate" id="btn-cta-estimate">
                    <?php echo sg_icon( 'edit_note', 'icon-sm' ); ?>
                    Get Quick Estimate
                </button>

                <a
                    href="tel:<?php echo esc_attr( SG_PHONE_RAW ); ?>"
                    class="cta-callout__phone"
                    aria-label="Call us at <?php echo esc_attr( SG_PHONE_DISPLAY ); ?>"
                    id="phone-cta"
                >
                    <?php echo sg_icon( 'call', 'icon-sm' ); ?>
                    <?php echo esc_html( SG_PHONE_DISPLAY ); ?>
                </a>

            </div>
        </div>

    </div>
</section>
