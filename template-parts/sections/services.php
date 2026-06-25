<?php
/**
 * Services card grid — pure view.
 *
 * Each card either links to a page ('href', used by site pages) or opens a
 * modal ('modal', used by the landing page). Content supplied by the caller;
 * no hardcoded defaults.
 *
 * @package SolidGuard
 *
 * Expected $args:
 *   heading string  section H2
 *   intro   string  intro paragraph
 *   items   array   cards: title, desc, image, alt, bullets[], w, h, slug, and
 *                   either 'modal' (modal id) or 'href' (URL)
 */

$heading = isset( $args['heading'] ) ? $args['heading'] : '';
$intro   = isset( $args['intro'] ) ? $args['intro'] : '';
$items   = isset( $args['items'] ) ? (array) $args['items'] : array();

if ( empty( $items ) ) {
    return;
}
?>

<section class="section section--white" id="services" aria-label="Our services">
    <div class="container">

        <?php if ( '' !== $heading ) : ?>
            <h2 class="section-heading"><?php echo esc_html( $heading ); ?></h2>
        <?php endif; ?>
        <?php if ( '' !== $intro ) : ?>
            <p class="body-sm text-muted"><?php echo esc_html( $intro ); ?></p>
        <?php endif; ?>

        <div class="services-grid">
            <?php
            foreach ( $items as $service ) :
                $slug    = isset( $service['slug'] ) ? $service['slug'] : sanitize_title( $service['title'] );
                $is_link = ! empty( $service['href'] );
                $tag     = $is_link ? 'a' : 'article';
                ?>
                <<?php echo $tag; ?>
                    class="service-card"
                    id="service-card-<?php echo esc_attr( $slug ); ?>"
                    <?php if ( $is_link ) : ?>
                    href="<?php echo esc_url( $service['href'] ); ?>"
                    <?php else : ?>
                    data-modal-trigger="<?php echo esc_attr( $service['modal'] ); ?>"
                    role="button"
                    tabindex="0"
                    <?php endif; ?>
                    aria-label="Learn more about <?php echo esc_attr( $service['title'] ); ?>"
                >

                    <div class="service-card__media">
                        <img
                            src="<?php echo esc_url( $service['image'] ); ?>"
                            alt="<?php echo esc_attr( $service['alt'] ); ?>"
                            width="<?php echo esc_attr( $service['w'] ); ?>"
                            height="<?php echo esc_attr( $service['h'] ); ?>"
                            loading="lazy"
                            decoding="async"
                        >
                    </div>

                    <div class="service-card__body">
                        <h3 class="service-card__title"><?php echo esc_html( $service['title'] ); ?></h3>
                        <p class="service-card__desc"><?php echo esc_html( $service['desc'] ); ?></p>

                        <ul class="check-list" role="list">
                            <?php foreach ( (array) $service['bullets'] as $bullet ) : ?>
                                <li class="check-list__item">
                                    <?php echo sg_icon( 'check_circle', 'icon-sm' ); ?>
                                    <?php echo wp_kses( $bullet, array() ); ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                        <div class="btn btn--outline btn--full" aria-hidden="true">Learn More</div>
                    </div>

                </<?php echo $tag; ?>>
            <?php endforeach; ?>
        </div>

    </div>
</section>
