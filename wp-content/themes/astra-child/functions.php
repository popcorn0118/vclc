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


// 客製化 post type
function create_post_type() {
	register_post_type( 'service',
		array(
			'labels' 				=> array(
				'name' 				=> __( '服務項目' ),
				'singular_name' 	=> __( '服務項目' )
			),
			'public' 				=> true,
			'has_archive' 			=> true,
			'menu_icon' 			=> 'dashicons-groups',
			'supports' 				=> array('title', 'editor', 'thumbnail', 'excerpt', 'revisions'),
			'taxonomies' 			=> array('service-type', 'service-tag'),
			'capability_type' 		=> 'page',
			'map_meta_cap'			=> true,
			// 'show_in_rest'      	=> true, // To use Gutenberg editor.
		)
	);

	flush_rewrite_rules();
}
add_action( 'init', 'create_post_type' );

// 新增 Taxonomy 給客製化的 post type
function create_custom_taxonomy() {
	  
	// 分類
	register_taxonomy('service-type', array('service'), 
		array(
			'labels' 				=> array(
			'name' 				=> __( '服務項目分類' ),
			'singular_name' 	=> __( '服務項目分類' )
		),
		'show_ui' 				=> true,
		'show_admin_column' 	=> true,
		'query_var' 			=> true,
		'hierarchical' 			=> true,
		'rewrite' 				=> array( 'slug' => 'service-type' ),
		)
	);

}
add_action( 'init', 'create_custom_taxonomy', 0 );

//文章單頁上方"發布日期"
add_action( 'astra_single_post_banner_title_before', function () {
    if ( ! is_singular( 'post' ) ) {
        return;
    }
    echo '<div class="article-date">' .
        esc_html( get_the_date( 'Y.m.d' ) ) .
    '</div>';

} );

// 文章單頁上/下篇導覽：改用 Astra 新版樣式（PREVIOUS/NEXT + 文章標題），僅影響「文章」(post)
add_filter( 'astra_single_post_navigation', function ( $args ) {
    if ( ! is_singular( 'post' ) ) {
        return $args;
    }

    $args['prev_text'] = '<span class="ast-post-nav" aria-hidden="true">'
        . Astra_Builder_UI_Controller::fetch_svg_icon( 'long-arrow-alt-left' )
        . ' ' . esc_html__( 'Previous', 'astra' ) . '</span> <p>%title</p>';

    $args['next_text'] = '<span class="ast-post-nav" aria-hidden="true">'
        . esc_html__( 'Next', 'astra' )
        . ' ' . Astra_Builder_UI_Controller::fetch_svg_icon( 'long-arrow-alt-right' ) . '</span> <p>%title</p>';

    return $args;
} );