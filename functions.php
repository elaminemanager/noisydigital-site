<?php
/**
 * Thème Noisy, NOISY DIGITAL.
 * Squelette initial : sera complété au fil de la refonte.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'after_setup_theme', function () {
    load_theme_textdomain( 'noisy', get_template_directory() . '/languages' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'search-form', 'gallery', 'caption', 'script', 'style' ] );
    register_nav_menus( [ 'primary' => 'Menu principal', 'footer' => 'Pied de page' ] );
} );
