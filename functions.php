<?php
/**
 * SolidGuard theme functions and definitions
 *
 * @package SolidGuard
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// ---------------------------------------------------------------------------
// Site-wide constants — edit here to update everywhere
// ---------------------------------------------------------------------------
define( 'SG_PHONE_RAW',     '6472302725' );
define( 'SG_PHONE_DISPLAY', '(647)-230-2725' );
define( 'SG_EMAIL',         'info@solidguard.ca' );
define( 'SG_EMAIL_DISPATCH','emergency@solidguard.ca' );


// ---------------------------------------------------------------------------
// Theme setup
// ---------------------------------------------------------------------------
function solidguard_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
    ) );

    register_nav_menus( array(
        'primary'    => __( 'Primary Menu', 'solidguard' ),
        'footer'     => __( 'Footer Menu', 'solidguard' ),
        'bottom-nav' => __( 'Bottom Nav', 'solidguard' ),
    ) );
}
add_action( 'after_setup_theme', 'solidguard_setup' );


// ---------------------------------------------------------------------------
// Enqueue styles & scripts
// ---------------------------------------------------------------------------
function solidguard_scripts() {
    $v = '1.2.0';
    $uri = get_template_directory_uri();

    // Design tokens
    wp_enqueue_style(
        'solidguard-tokens',
        $uri . '/assets/css/design-system.css',
        array(),
        $v
    );

    // Component styles (depends on tokens)
    wp_enqueue_style(
        'solidguard-style',
        $uri . '/assets/css/style.css',
        array( 'solidguard-tokens' ),
        $v
    );

    // Main JS — hamburger nav, accordion
    wp_enqueue_script(
        'solidguard-main',
        $uri . '/assets/js/main.js',
        array(),
        $v,
        true   // load in footer
    );
}
add_action( 'wp_enqueue_scripts', 'solidguard_scripts' );


// ---------------------------------------------------------------------------
// Load Google Fonts as preload (non-render-blocking)
// ---------------------------------------------------------------------------
function solidguard_preload_fonts() {
    $fonts = 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Rajdhani:wght@600;700&display=swap';
    $icons = 'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap';

    printf(
        '<link rel="preload" as="style" href="%s">' . "\n" .
        '<link rel="stylesheet" href="%s" media="print" onload="this.media=\'all\'">' . "\n" .
        '<noscript><link rel="stylesheet" href="%s"></noscript>' . "\n",
        esc_url( $fonts ), esc_url( $fonts ), esc_url( $fonts )
    );
    printf(
        '<link rel="preload" as="style" href="%s">' . "\n" .
        '<link rel="stylesheet" href="%s" media="print" onload="this.media=\'all\'">' . "\n" .
        '<noscript><link rel="stylesheet" href="%s"></noscript>' . "\n",
        esc_url( $icons ), esc_url( $icons ), esc_url( $icons )
    );
}
add_action( 'wp_head', 'solidguard_preload_fonts', 3 );


// ---------------------------------------------------------------------------
// Remove dashicons for logged-out visitors
// ---------------------------------------------------------------------------
function solidguard_dequeue_dashicons() {
    if ( ! is_user_logged_in() ) {
        wp_deregister_style( 'dashicons' );
    }
}
add_action( 'wp_enqueue_scripts', 'solidguard_dequeue_dashicons', 100 );


// ---------------------------------------------------------------------------
// Favicon
// ---------------------------------------------------------------------------
function solidguard_favicon() {
    $uri = get_template_directory_uri();
    ?>
    <link rel="icon" type="image/png" href="<?php echo esc_url( $uri . '/images/logos/favicon.png' ); ?>">
    <link rel="shortcut icon" href="<?php echo esc_url( $uri . '/images/logos/favicon.png' ); ?>">
    <link rel="apple-touch-icon" href="<?php echo esc_url( $uri . '/images/logos/favicon.png' ); ?>">
    <?php
}
add_action( 'wp_head', 'solidguard_favicon', 1 );


// ---------------------------------------------------------------------------
// Meta description + Open Graph + Twitter Card
// ---------------------------------------------------------------------------
function solidguard_meta_tags() {
    $uri        = get_template_directory_uri();
    $site_name  = 'SolidGuard Glass &amp; Windows';
    $og_image   = $uri . '/images/logos/landing-page.png';
    $site_url   = home_url( '/' );

    // Per-page overrides
    if ( is_page( 'thank-you' ) ) {
        $title       = 'Request Received | SolidGuard Glass &amp; Windows';
        $description = 'Your service request has been received. A member of the SolidGuard team will be in touch shortly, usually within the hour.';
        $url         = home_url( '/thank-you/' );
    } else {
        $title       = 'SolidGuard Glass &amp; Windows | Toronto\'s Emergency Glass Repair Experts';
        $description = 'Fast, professional glass repair and replacement across the GTA. Residential, commercial, emergency, and storefront glass services. Licensed, insured, and background-checked technicians.';
        $url         = $site_url;
    }
    ?>
    <!-- SEO -->
    <meta name="description" content="<?php echo esc_attr( $description ); ?>">
    <meta name="robots" content="index, follow">

    <!-- Open Graph -->
    <meta property="og:type"        content="website">
    <meta property="og:site_name"   content="<?php echo esc_attr( html_entity_decode( $site_name ) ); ?>">
    <meta property="og:title"       content="<?php echo esc_attr( html_entity_decode( $title ) ); ?>">
    <meta property="og:description" content="<?php echo esc_attr( $description ); ?>">
    <meta property="og:url"         content="<?php echo esc_url( $url ); ?>">
    <meta property="og:image"       content="<?php echo esc_url( $og_image ); ?>">
    <meta property="og:locale"      content="en_CA">

    <!-- Twitter Card -->
    <meta name="twitter:card"        content="summary_large_image">
    <meta name="twitter:title"       content="<?php echo esc_attr( html_entity_decode( $title ) ); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr( $description ); ?>">
    <meta name="twitter:image"       content="<?php echo esc_url( $og_image ); ?>">
    <?php
}
add_action( 'wp_head', 'solidguard_meta_tags', 2 );


// ---------------------------------------------------------------------------
// Preconnect to Google Fonts for performance
// ---------------------------------------------------------------------------
function solidguard_preconnect() {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
}
add_action( 'wp_head', 'solidguard_preconnect', 1 );


// ---------------------------------------------------------------------------
// Microsoft Clarity analytics
// ---------------------------------------------------------------------------
function solidguard_clarity() {
    ?>
    <script type="text/javascript">
        (function(c,l,a,r,i,t,y){
            c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
            t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
            y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
        })(window, document, "clarity", "script", "w0z5qw2ob5");
    </script>
    <?php
}
add_action( 'wp_head', 'solidguard_clarity' );
