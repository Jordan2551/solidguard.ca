<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- =====================================================================
     Site Header
     ===================================================================== -->
<header id="masthead" class="site-header">

    <!-- Top bar: CTAs -->
    <div class="site-header__topbar">
        <a href="#hero-form" class="site-header__topbar-cta" data-modal-trigger="modal-estimate">
            <span class="material-symbols-outlined" style="font-size:var(--icon-xs);" aria-hidden="true">edit_note</span>
            Quick Estimate
        </a>
        <a
            href="tel:<?php echo esc_attr( SG_PHONE_RAW ); ?>"
            class="site-header__topbar-phone"
            aria-label="Call us at <?php echo esc_attr( SG_PHONE_DISPLAY ); ?>"
        >
            <span class="material-symbols-outlined" aria-hidden="true">call</span>
            <?php echo esc_html( SG_PHONE_DISPLAY ); ?>
        </a>
    </div>

    <!-- Nav bar: logo + hamburger -->
    <div class="site-header__navbar">
        <div class="site-header__logo">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="Solid Guard — Home">
                <img
                    src="<?php echo esc_url( get_template_directory_uri() . '/images/logos/logo.png' ); ?>"
                    alt="Solid Guard Logo"
                    width="160"
                    height="48"
                >
            </a>
        </div>

        <!-- Desktop nav -->
        <nav class="site-header__desktop-nav" aria-label="Primary navigation">

            <!-- Services dropdown -->
            <div class="desktop-nav__dropdown">
                <button class="desktop-nav__link desktop-nav__link--trigger" aria-expanded="false">
                    Services
                    <span class="material-symbols-outlined" aria-hidden="true">expand_more</span>
                </button>
                <ul class="desktop-nav__submenu" role="list">
                    <?php
                    // modal = null means link to page; modal = 'id' opens the modal
                    $desktop_services = array(
                        array( 'Emergency Glass Repair',     '/emergency-glass-repair',        'modal-emergency'  ),
                        array( 'Insulated Glass Units',      '/insulated-glass-units',          null               ),
                        array( 'Tempered Glass',             '/tempered-glass',                 null               ),
                        array( 'Board-up Services',          '/board-up-services',              null               ),
                        array( 'Storefront Glass',           '/storefront-glass-repair',        'modal-storefront' ),
                        array( 'Patio &amp; Sliding Door Glass', '/patio-door-glass-replacement', null             ),
                        array( 'Commercial Glass Repair',    '/commercial-glass-repair',        'modal-commercial' ),
                        array( 'Residential Glass Repair',   '/residential-glass-repair',       'modal-residential'),
                        array( '24/7 Emergency Service',     '/emergency-glass-repair',         'modal-emergency'  ),
                    );
                    foreach ( $desktop_services as $svc ) :
                        if ( $svc[2] ) : ?>
                            <li>
                                <button class="desktop-nav__submenu-link" data-modal-trigger="<?php echo esc_attr( $svc[2] ); ?>">
                                    <?php echo wp_kses( $svc[0], array() ); ?>
                                </button>
                            </li>
                        <?php else : ?>
                            <li>
                                <a href="<?php echo esc_url( home_url( $svc[1] ) ); ?>" class="desktop-nav__submenu-link">
                                    <?php echo wp_kses( $svc[0], array() ); ?>
                                </a>
                            </li>
                        <?php endif;
                    endforeach; ?>
                </ul>
            </div>

            <!-- Direct links — mirror mobile nav -->
            <a href="#reviews"       class="desktop-nav__link">Testimonials</a>
            <a href="#offers"        class="desktop-nav__link">Special Offers</a>
            <a href="#guarantee"     class="desktop-nav__link">Warranty</a>
            <a href="#service-areas" class="desktop-nav__link">Service Areas</a>
            <a href="#faq"           class="desktop-nav__link">FAQ</a>

        </nav>

        <button
            class="nav-toggle"
            id="nav-toggle"
            aria-label="Open navigation menu"
            aria-expanded="false"
            aria-controls="site-nav"
        >
            <span class="nav-toggle__bar"></span>
            <span class="nav-toggle__bar"></span>
            <span class="nav-toggle__bar"></span>
        </button>
    </div>

</header>

<!-- =====================================================================
     Navigation Overlay
     ===================================================================== -->
<div class="nav-overlay" id="site-nav" aria-hidden="true" role="dialog" aria-modal="true" aria-label="Site navigation">

    <div class="nav-overlay__backdrop" id="nav-backdrop"></div>

    <div class="nav-overlay__drawer">

        <div class="nav-overlay__header">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-overlay__logo" tabindex="-1">
                <img
                    src="<?php echo esc_url( get_template_directory_uri() . '/images/logos/logo.png' ); ?>"
                    alt="Solid Guard"
                    width="120"
                    height="36"
                >
            </a>
            <button class="nav-overlay__close" id="nav-close" aria-label="Close navigation menu">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        <ul class="nav-overlay__list" role="list">

            <!-- Services — expandable -->
            <li class="nav-overlay__item">
                <button
                    class="nav-overlay__trigger"
                    aria-expanded="false"
                    aria-controls="nav-services"
                    id="nav-services-btn"
                >
                    <span class="material-symbols-outlined" aria-hidden="true">window</span>
                    Services
                    <span class="material-symbols-outlined nav-overlay__chevron" aria-hidden="true">expand_more</span>
                </button>
                <ul class="nav-overlay__sub" id="nav-services" role="list">
                    <?php
                    $services = array(
                        array( 'Emergency Glass Repair',     '/emergency-glass-repair' ),
                        array( 'Insulated Glass Units',      '/insulated-glass-units' ),
                        array( 'Tempered Glass',             '/tempered-glass' ),
                        array( 'Board-up Services',          '/board-up-services' ),
                        array( 'Storefront Glass',           '/storefront-glass-repair' ),
                        array( 'Patio & Sliding Door Glass', '/patio-door-glass-replacement' ),
                        array( 'Commercial Glass Repair',    '/commercial-glass-repair' ),
                        array( 'Residential Glass Repair',   '/residential-glass-repair' ),
                        array( '24/7 Emergency Service',     '/emergency-glass-repair' ),
                    );
                    foreach ( $services as $svc ) :
                    ?>
                        <li>
                            <a
                                href="<?php echo esc_url( home_url( $svc[1] ) ); ?>"
                                class="nav-overlay__sub-link"
                            >
                                <span class="material-symbols-outlined" aria-hidden="true">arrow_forward</span>
                                <?php echo esc_html( $svc[0] ); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </li>

            <!-- Direct links -->
            <?php
            $nav_links = array(
                array( 'Get Quick Estimate', '#hero-form',          'edit_note' ),
                array( 'Call Now',          'tel:' . SG_PHONE_RAW, 'call' ),
                array( 'Testimonials',      '#reviews',            'star' ),
                array( 'Special Offers',    '#offers',             'local_offer' ),
                array( 'Warranty',          '#guarantee',          'verified' ),
                array( 'Service Areas',     '#service-areas',      'location_on' ),
                array( 'FAQ',               '#faq',                'help' ),
            );
            foreach ( $nav_links as $link ) :
                $href = strpos( $link[1], 'tel:' ) === 0
                    ? esc_attr( $link[1] )
                    : esc_url( $link[1] );
            ?>
                <li class="nav-overlay__item">
                    <a href="<?php echo $href; ?>" class="nav-overlay__link">
                        <span class="material-symbols-outlined" aria-hidden="true"><?php echo esc_html( $link[2] ); ?></span>
                        <?php echo esc_html( $link[0] ); ?>
                    </a>
                </li>
            <?php endforeach; ?>

        </ul>

        <div class="nav-overlay__cta">
            <a href="#hero-form" class="btn btn--orange btn--full btn--lg" data-modal-trigger="modal-estimate">
                Get Quick Estimate
            </a>
            <a href="tel:<?php echo esc_attr( SG_PHONE_RAW ); ?>" class="btn btn--outline-white btn--full btn--lg">
                <span class="material-symbols-outlined icon-sm" aria-hidden="true">call</span>
                <?php echo esc_html( SG_PHONE_DISPLAY ); ?>
            </a>
        </div>

    </div>
</div>
