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
    // Title tag handled directly in page templates via $GLOBALS['sg_meta']
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
