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
define( 'SG_PHONE_RAW',     '4165550000' );
define( 'SG_PHONE_DISPLAY', '(416) 555-0000' );
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

    // Google Fonts — Rajdhani + Inter
    wp_enqueue_style(
        'solidguard-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Rajdhani:wght@600;700&display=swap',
        array(),
        null
    );

    // Material Symbols Outlined
    wp_enqueue_style(
        'solidguard-icons',
        'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap',
        array(),
        null
    );

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
// Preconnect to Google Fonts for performance
// ---------------------------------------------------------------------------
function solidguard_preconnect() {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
}
add_action( 'wp_head', 'solidguard_preconnect', 1 );
