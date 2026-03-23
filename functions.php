<?php
/**
 * SolidGuard theme functions and definitions
 *
 * @package SolidGuard
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function solidguard_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'solidguard' ),
        'footer'  => __( 'Footer Menu', 'solidguard' ),
    ) );
}
add_action( 'after_setup_theme', 'solidguard_setup' );

function solidguard_scripts() {
    wp_enqueue_style( 'solidguard-style', get_stylesheet_uri(), array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'solidguard_scripts' );
