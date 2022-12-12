<?php
/**
 * eltl5esbookskw functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package eltl5esbookskw
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function eltl5esbookskw_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on eltl5esbookskw, use a find and replace
		* to change 'eltl5esbookskw' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'eltl5esbookskw', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'eltl5esbookskw' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'eltl5esbookskw_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'eltl5esbookskw_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function eltl5esbookskw_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'eltl5esbookskw_content_width', 640 );
}
add_action( 'after_setup_theme', 'eltl5esbookskw_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function eltl5esbookskw_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'eltl5esbookskw' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'eltl5esbookskw' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'eltl5esbookskw_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function eltl5esbookskw_scripts() {
	wp_enqueue_style( 'eltl5esbookskw-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'eltl5esbookskw-style', 'rtl', 'replace' );

	wp_enqueue_script( 'eltl5esbookskw-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_style( 'eltl5esbookskw-main', get_template_directory_uri() . '/assets/css/main.css', array(), _S_VERSION);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'eltl5esbookskw_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

if ( ! function_exists( 'elt_plugin_scripts' ) ) {
    function elt_plugin_scripts(){

        global $post;
       // if( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'elt-product-cat') ) {

            wp_enqueue_script('elt-product-cat-js', ELT_URI . '/assets/js/elt-scripts.js', array('jquery'));

            wp_add_inline_script( 'elt-product-cat-js', 
                    '
                     var display_category_url_based = "' . get_option('qc_woo_tabbed_display_category_url_based') . '";
                     var qc_scroll_category_clickable = "' . get_option('qc_woo_tabbed_scroll_category_clickable') . '";

                    ', 'before');
      //  }

    }

}


/**
 * Loading the plugin specific stylesheet files.
 */
if ( ! function_exists( 'elt_plugin_styles' ) ) {
    function elt_plugin_styles(){

        global $post;
       // if( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'elt-product-cat') ) {

            wp_register_style('elt_plugin_style', ELT_URI . '/assets/css/elt-styles.css');
            wp_enqueue_style('elt_plugin_style');

            // Override Global Stylesheet from admin settings.
            wp_add_inline_style( 'elt_plugin_style', get_option('custom_global_css') );

        //}

    }

}