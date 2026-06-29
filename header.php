<?php
/**
 * Default site header — SEO / content pages (the "site" chrome).
 *
 * This is the multi-page chrome: a Glass mega-menu, a Service Areas mega-menu,
 * and a mobile accordion drawer, all driven by sg_glass_nav() /
 * sg_service_area_regions() from inc/site-data.php.
 *
 * The ad landing page uses header-lp.php instead (get_header('lp')); SEO meta on
 * these pages is owned by RankMath via wp_head(), so this file does NOT print
 * $GLOBALS['sg_meta'].
 *
 * @package SolidGuard
 */

$glass_nav = sg_glass_nav();
$regions   = sg_service_area_regions();
$logo      = get_template_directory_uri() . '/images/logos/logo.webp';

// Featured rail in the Glass mega-menu — the high-value non-spoke destinations.
$glass_featured = array(
    array(
        'icon'  => 'payments',
        'label' => 'Cost Estimate Calculator',
        'desc'  => 'Estimate a repair or replacement cost',
        'href'  => home_url( '/glass/window-replacement-cost/' ),
        'accent' => false,
    ),
    array(
        'icon'  => 'local_offer',
        'label' => 'Current Offers',
        'desc'  => 'Save on your glass service',
        'href'  => home_url( '/offers/' ),
        'accent' => false,
    ),
    array(
        'icon'  => 'schedule',
        'label' => 'Emergency 24/7',
        'desc'  => 'Broken glass right now? Call us.',
        'href'  => home_url( '/glass/emergency/' ),
        'accent' => true,
    ),
);
?>
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
    </script>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- =====================================================================
     Site Header (SEO chrome)
     ===================================================================== -->
<header id="masthead" class="site-header site-header--seo">

    <!-- Top bar: Quick Estimate + phone (matches the LP) -->
    <div class="site-header__topbar">
        <div class="site-header__inner">
            <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="site-header__topbar-cta" id="btn-topbar-estimate">
                <?php echo sg_icon( 'edit_note', 'icon-xs' ); ?>
                Quick Estimate
            </a>
            <a
                href="tel:<?php echo esc_attr( SG_PHONE_RAW ); ?>"
                class="site-header__topbar-phone"
                aria-label="Call us at <?php echo esc_attr( SG_PHONE_DISPLAY ); ?>"
                id="phone-topbar"
            >
                <?php echo sg_icon( 'call' ); ?>
                <?php echo esc_html( SG_PHONE_DISPLAY ); ?>
            </a>
        </div>
    </div>

    <!-- Nav bar: logo + mega-menu (desktop) + hamburger (mobile) -->
    <div class="site-header__navbar">
        <div class="site-header__inner">

            <div class="site-header__logo">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="SolidGuard Home">
                    <img src="<?php echo esc_url( $logo ); ?>" alt="SolidGuard" width="160" height="48">
                </a>
            </div>

            <!-- Desktop nav -->
            <nav class="site-header__desktop-nav" aria-label="Primary navigation">

                <!-- Glass mega-menu -->
                <div class="mega" data-mega>
                    <a href="<?php echo esc_url( home_url( '/glass/' ) ); ?>" class="mega__trigger" aria-expanded="false" aria-controls="mega-glass">
                        Glass
                        <?php echo sg_icon( 'expand_more', 'mega__chevron' ); ?>
                    </a>

                    <div class="mega__panel" id="mega-glass" role="region" aria-label="Glass services">
                        <div class="mega__inner">
                            <div class="mega__cols">
                                <?php foreach ( $glass_nav as $cat ) : ?>
                                    <div class="mega__col<?php echo $cat['accent'] ? ' mega__col--accent' : ''; ?>">
                                        <a class="mega__col-head" href="<?php echo esc_url( sg_glass_url( $cat['root'] ) ); ?>">
                                            <?php echo esc_html( $cat['label'] ); ?>
                                        </a>
                                        <ul class="mega__links" role="list">
                                            <?php foreach ( $cat['spokes'] as $spoke ) : ?>
                                                <li>
                                                    <a href="<?php echo esc_url( sg_glass_url( $cat['root'], $spoke['slug'] ) ); ?>">
                                                        <?php echo esc_html( $spoke['label'] ); ?>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <a class="mega__all" href="<?php echo esc_url( sg_glass_url( $cat['root'] ) ); ?>">
                                            All <?php echo esc_html( strtolower( $cat['root'] ) ); ?> glass
                                            <?php echo sg_icon( 'arrow_forward', 'icon-xs' ); ?>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <!-- Featured rail -->
                            <div class="mega__rail" role="list" aria-label="Featured">
                                <?php foreach ( $glass_featured as $feat ) : ?>
                                    <a class="mega__feat<?php echo $feat['accent'] ? ' mega__feat--accent' : ''; ?>" href="<?php echo esc_url( $feat['href'] ); ?>" role="listitem">
                                        <span class="mega__feat-icon"><?php echo sg_icon( $feat['icon'] ); ?></span>
                                        <span class="mega__feat-text">
                                            <span class="mega__feat-label"><?php echo esc_html( $feat['label'] ); ?></span>
                                            <span class="mega__feat-desc"><?php echo esc_html( $feat['desc'] ); ?></span>
                                        </span>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Service Areas mega-menu -->
                <div class="mega" data-mega>
                    <a href="<?php echo esc_url( home_url( '/glass/locations/' ) ); ?>" class="mega__trigger" aria-expanded="false" aria-controls="mega-areas">
                        Service Areas
                        <?php echo sg_icon( 'expand_more', 'mega__chevron' ); ?>
                    </a>

                    <div class="mega__panel mega__panel--areas" id="mega-areas" role="region" aria-label="Service areas">
                        <div class="mega__inner">
                            <p class="mega__eyebrow">Serving the Greater Toronto Area</p>
                            <div class="mega__cols mega__cols--areas">
                                <?php foreach ( $regions as $region => $cities ) : ?>
                                    <div class="mega__col">
                                        <p class="mega__col-head mega__col-head--static"><?php echo esc_html( $region ); ?></p>
                                        <ul class="mega__links" role="list">
                                            <?php foreach ( $cities as $city ) : ?>
                                                <li>
                                                    <a href="<?php echo esc_url( sg_location_url( $city['name'] ) ); ?>"<?php echo 'A' === $city['tier'] ? ' class="is-tier-a"' : ''; ?>>
                                                        <?php echo esc_html( $city['name'] ); ?>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <a class="mega__all" href="<?php echo esc_url( home_url( '/glass/locations/' ) ); ?>">
                                View all service areas
                                <?php echo sg_icon( 'arrow_forward', 'icon-xs' ); ?>
                            </a>
                        </div>
                    </div>
                </div>

                <a href="<?php echo esc_url( home_url( '/reviews/' ) ); ?>" class="desktop-nav__link">Reviews</a>
                <a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" class="desktop-nav__link">Blog</a>
                <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="desktop-nav__link">About</a>

            </nav>

            <!-- Mobile hamburger -->
            <button class="nav-toggle" id="nav-toggle" aria-label="Open navigation menu" aria-expanded="false" aria-controls="site-nav">
                <span class="nav-toggle__bar"></span>
                <span class="nav-toggle__bar"></span>
                <span class="nav-toggle__bar"></span>
            </button>

        </div><!-- .site-header__inner -->
    </div>

</header>

<!-- =====================================================================
     Mobile Navigation Drawer (accordion)
     ===================================================================== -->
<div class="nav-overlay" id="site-nav" aria-hidden="true" role="dialog" aria-modal="true" aria-label="Site navigation">

    <div class="nav-overlay__backdrop" id="nav-backdrop"></div>

    <div class="nav-overlay__drawer">

        <div class="nav-overlay__header">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-overlay__logo" tabindex="-1">
                <img src="<?php echo esc_url( $logo ); ?>" alt="SolidGuard" width="120" height="36">
            </a>
            <button class="nav-overlay__close" id="nav-close" aria-label="Close navigation menu">
                <?php echo sg_icon( 'close' ); ?>
            </button>
        </div>

        <ul class="nav-overlay__list" role="list">

            <!-- Glass: expands to grouped spokes -->
            <li class="nav-overlay__item">
                <button class="nav-overlay__trigger" aria-expanded="false" aria-controls="nav-glass" data-accordion>
                    <?php echo sg_icon( 'window' ); ?>
                    Glass
                    <?php echo sg_icon( 'expand_more', 'nav-overlay__chevron' ); ?>
                </button>
                <div class="nav-overlay__sub" id="nav-glass">
                    <?php foreach ( $glass_nav as $cat ) : ?>
                        <p class="nav-overlay__subhead<?php echo $cat['accent'] ? ' is-accent' : ''; ?>"><?php echo esc_html( $cat['label'] ); ?></p>
                        <?php foreach ( $cat['spokes'] as $spoke ) : ?>
                            <a class="nav-overlay__sub-link" href="<?php echo esc_url( sg_glass_url( $cat['root'], $spoke['slug'] ) ); ?>">
                                <?php echo sg_icon( 'arrow_forward' ); ?>
                                <?php echo esc_html( $spoke['label'] ); ?>
                            </a>
                        <?php endforeach; ?>
                        <a class="nav-overlay__sub-link nav-overlay__sub-link--all" href="<?php echo esc_url( sg_glass_url( $cat['root'] ) ); ?>">
                            All <?php echo esc_html( strtolower( $cat['root'] ) ); ?> glass
                        </a>
                    <?php endforeach; ?>
                </div>
            </li>

            <!-- Service Areas: expands to cities -->
            <li class="nav-overlay__item">
                <button class="nav-overlay__trigger" aria-expanded="false" aria-controls="nav-areas" data-accordion>
                    <?php echo sg_icon( 'location_on' ); ?>
                    Service Areas
                    <?php echo sg_icon( 'expand_more', 'nav-overlay__chevron' ); ?>
                </button>
                <div class="nav-overlay__sub" id="nav-areas">
                    <?php foreach ( $regions as $region => $cities ) : ?>
                        <p class="nav-overlay__subhead"><?php echo esc_html( $region ); ?></p>
                        <?php foreach ( $cities as $city ) : ?>
                            <a class="nav-overlay__sub-link" href="<?php echo esc_url( sg_location_url( $city['name'] ) ); ?>">
                                <?php echo sg_icon( 'arrow_forward' ); ?>
                                <?php echo esc_html( $city['name'] ); ?>
                            </a>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                    <a class="nav-overlay__sub-link nav-overlay__sub-link--all" href="<?php echo esc_url( home_url( '/glass/locations/' ) ); ?>">
                        View all service areas
                    </a>
                </div>
            </li>

            <!-- Direct links -->
            <li class="nav-overlay__item">
                <a href="<?php echo esc_url( home_url( '/glass/window-replacement-cost/' ) ); ?>" class="nav-overlay__link">
                    <?php echo sg_icon( 'payments' ); ?>
                    Cost Estimator
                </a>
            </li>
            <li class="nav-overlay__item">
                <a href="<?php echo esc_url( home_url( '/offers/' ) ); ?>" class="nav-overlay__link">
                    <?php echo sg_icon( 'local_offer' ); ?>
                    Special Offers
                </a>
            </li>
            <li class="nav-overlay__item">
                <a href="<?php echo esc_url( home_url( '/reviews/' ) ); ?>" class="nav-overlay__link">
                    <?php echo sg_icon( 'star' ); ?>
                    Reviews
                </a>
            </li>
            <li class="nav-overlay__item">
                <a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" class="nav-overlay__link">
                    <?php echo sg_icon( 'edit_note' ); ?>
                    Blog
                </a>
            </li>
            <li class="nav-overlay__item">
                <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="nav-overlay__link">
                    <?php echo sg_icon( 'shield_person' ); ?>
                    About
                </a>
            </li>

        </ul>

        <div class="nav-overlay__cta">
            <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn--orange btn--full btn--lg" id="btn-nav-estimate">
                Get a Quick Estimate
            </a>
            <a href="tel:<?php echo esc_attr( SG_PHONE_RAW ); ?>" class="btn btn--outline-white btn--full btn--lg" id="phone-nav">
                <?php echo sg_icon( 'call', 'icon-sm' ); ?>
                <?php echo esc_html( SG_PHONE_DISPLAY ); ?>
            </a>
        </div>

    </div>
</div>
