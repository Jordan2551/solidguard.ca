<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-M4S0Y3B78Y"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-M4S0Y3B78Y');
      gtag('config', 'AW-17670100208');
      gtag('config', 'AW-17579846282/eEnbCPuSg48cEIrV3L5B', {
        'phone_conversion_number': '(647)-230-2725'
      });
    </script>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<?php
$sg = isset( $GLOBALS['sg_meta'] ) ? $GLOBALS['sg_meta'] : array();
if ( ! empty( $sg ) ) :
    $og_image = get_template_directory_uri() . '/images/logos/landing-page.png';
?>
    <title><?php echo esc_html( $sg['title'] ); ?></title>
    <meta name="description" content="<?php echo esc_attr( $sg['description'] ); ?>">
    <meta name="robots" content="index, follow">
    <meta property="og:type"        content="website">
    <meta property="og:site_name"   content="SolidGuard Glass &amp; Windows">
    <meta property="og:title"       content="<?php echo esc_attr( $sg['title'] ); ?>">
    <meta property="og:description" content="<?php echo esc_attr( $sg['description'] ); ?>">
    <meta property="og:url"         content="<?php echo esc_url( $sg['url'] ); ?>">
    <meta property="og:image"       content="<?php echo esc_url( $og_image ); ?>">
    <meta property="og:locale"      content="en_CA">
    <meta name="twitter:card"        content="summary_large_image">
    <meta name="twitter:title"       content="<?php echo esc_attr( $sg['title'] ); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr( $sg['description'] ); ?>">
    <meta name="twitter:image"       content="<?php echo esc_url( $og_image ); ?>">
<?php endif; ?>
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
        <div class="site-header__inner">
            <a href="#hero-form" class="site-header__topbar-cta" data-modal-trigger="modal-estimate" id="btn-topbar-estimate">
                <span class="material-symbols-outlined icon-xs" aria-hidden="true">edit_note</span>
                Quick Estimate
            </a>
            <a
                href="tel:<?php echo esc_attr( SG_PHONE_RAW ); ?>"
                class="site-header__topbar-phone"
                aria-label="Call us at <?php echo esc_attr( SG_PHONE_DISPLAY ); ?>"
                id="phone-topbar"
            >
                <span class="material-symbols-outlined" aria-hidden="true">call</span>
                <?php echo esc_html( SG_PHONE_DISPLAY ); ?>
            </a>
        </div>
    </div>

    <!-- Nav bar: logo + hamburger -->
    <div class="site-header__navbar">
        <div class="site-header__inner">
        <div class="site-header__logo">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="Solid Guard Home">
                <img
                    src="<?php echo esc_url( get_template_directory_uri() . '/images/logos/logo.webp' ); ?>"
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
                        array( 'Residential Glass Services', 'modal-residential' ),
                        array( 'Commercial Glass Services',  'modal-commercial'  ),
                        array( 'Emergency Glass Services',   'modal-emergency'   ),
                        array( 'Storefront Glass Services',  'modal-storefront'  ),
                    );
                    foreach ( $desktop_services as $svc ) : ?>
                        <li>
                            <button class="desktop-nav__submenu-link" data-modal-trigger="<?php echo esc_attr( $svc[1] ); ?>" id="btn-nav-desktop-<?php echo esc_attr( $svc[1] ); ?>">
                                <?php echo wp_kses( $svc[0], array() ); ?>
                            </button>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Direct links — in page order -->
            <a href="#reviews"       class="desktop-nav__link">Reviews</a>
            <a href="#offers"        class="desktop-nav__link">Special Offers</a>
            <a href="#guarantee"     class="desktop-nav__link">Warranty</a>
            <a href="#service-areas" class="desktop-nav__link">Service Areas</a>

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
        </div><!-- .site-header__inner -->
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
                    src="<?php echo esc_url( get_template_directory_uri() . '/images/logos/logo.webp' ); ?>"
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
                    // label, modal id (null = estimate fallback)
                    $mobile_services = array(
                        array( 'Residential Glass Services', 'modal-residential' ),
                        array( 'Commercial Glass Services',  'modal-commercial'  ),
                        array( 'Emergency Glass Services',   'modal-emergency'   ),
                        array( 'Storefront Glass Services',  'modal-storefront'  ),
                    );
                    foreach ( $mobile_services as $svc ) : ?>
                        <li>
                            <button class="nav-overlay__sub-link" data-modal-trigger="<?php echo esc_attr( $svc[1] ); ?>" id="btn-nav-mobile-<?php echo esc_attr( $svc[1] ); ?>">
                                <span class="material-symbols-outlined" aria-hidden="true">arrow_forward</span>
                                <?php echo esc_html( $svc[0] ); ?>
                            </button>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </li>

            <!-- Direct links -->
            <?php
            $nav_links = array(
                array( 'Get Quick Estimate', '#hero-form',          'edit_note' ),
                array( 'Call Now',          'tel:' . SG_PHONE_RAW, 'call' ),
                array( 'Reviews',           '#reviews',            'star' ),
                array( 'Special Offers',    '#offers',             'local_offer' ),
                array( 'Warranty',          '#guarantee',          'verified' ),
                array( 'Service Areas',     '#service-areas',      'location_on' ),
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
            <a href="#hero-form" class="btn btn--orange btn--full btn--lg" data-modal-trigger="modal-estimate" id="btn-nav-estimate">
                Get Quick Estimate
            </a>
            <a href="tel:<?php echo esc_attr( SG_PHONE_RAW ); ?>" class="btn btn--outline-white btn--full btn--lg" id="phone-nav">
                <span class="material-symbols-outlined icon-sm" aria-hidden="true">call</span>
                <?php echo esc_html( SG_PHONE_DISPLAY ); ?>
            </a>
        </div>

    </div>
</div>
