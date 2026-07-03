<?php
/**
 * astra-child Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package astra-child
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define( 'CHILD_THEME_ASTRA_CHILD_VERSION', '1.0.0' );

/**
 * Enqueue styles
 */
function child_enqueue_styles() {

	wp_enqueue_style( 'slick-css', get_stylesheet_directory_uri() . '/assets/css/slick.css', array(), '1.8.1' );
	wp_enqueue_style( 'slick-theme-css', get_stylesheet_directory_uri() . '/assets/css/slick-theme.css', array( 'slick-css' ), '1.8.1' );
	wp_enqueue_style( 'astra-child-theme-css', get_stylesheet_directory_uri() . '/style.css', array( 'astra-theme-css', 'slick-css', 'slick-theme-css' ), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );

	wp_enqueue_script( 'slick-js', get_stylesheet_directory_uri() . '/assets/js/slick.min.js', array( 'jquery' ), '1.8.1', true );
	wp_enqueue_script( 'main', get_stylesheet_directory_uri() . '/assets/js/main.js', array( 'jquery', 'slick-js' ), CHILD_THEME_ASTRA_CHILD_VERSION, true );
}

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );


// footer copyright
add_shortcode('copyright', function () {
    $year = date_i18n('Y');
    $name = get_bloginfo('name');

    return
        '<small class="site-copyright">' .
            '<span class="copyright-prefix">' . esc_html("Copyright © {$year} {$name}") . '</span> ' .
            '<span class="line">|</span> ' .
            '<span class="copyright-powered">Power by </span>' .
            '<a href="https://eoscreative.co/" target="_blank">Eos Creative Ltd.,</a>' .
        '</small>';
});