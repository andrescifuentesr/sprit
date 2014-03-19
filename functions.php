<?php
/**
 * Sprit functions and definitions
 *
 * @package Sprit
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'sprit_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function sprit_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Sprit, use a find and replace
	 * to change 'sprit' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'sprit', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'sprit' ),
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link','post-thumbnails' ) );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 */
	add_theme_support( 'post-thumbnails' );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'sprit_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form', ) );
}
endif; // sprit_setup
add_action( 'after_setup_theme', 'sprit_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function sprit_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'sprit' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'sprit_widgets_init' );

/**
 * Register Socail Menu
 */
add_action( 'init', 'social_register_nav_menus' );

function social_register_nav_menus() {
	register_nav_menu( 'social', __( 'Social', 'example-textdomain' ) );
}

/**
 * Enqueue scripts and styles.
 */
function sprit_scripts() {
	//wp_enqueue_style( 'sprit-style', get_stylesheet_uri() );
	wp_enqueue_style( 'sprit-style', get_template_directory_uri() . '/css/build/minified/global.css', array(), '20140208', 'all' );

	//modernizr
	//wp_enqueue_script( 'sprit-modernizr', get_template_directory_uri() . '/js/libs/modernizr.custom.72808.js', array(), '20140304', false );

	wp_enqueue_script( 'sprit-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	//wp_enqueue_script( 'sprit-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	// Enqueue Google maps
	wp_enqueue_script( 'sprit-GoogleMaps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyArEmbqneDepMsMr0aZAYE-XAVxRsl2B9E&sensor=false', false );


	//Main JS
	wp_enqueue_script( 'sprit-main', get_template_directory_uri() . '/js/build/production.min.js', array('jquery'), '20140208', false );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'sprit_scripts' );


//Editorial shorcuts

function border_rouge_shortcode( $atts ) {
	return '<div class="border-rouge">&nbsp;</div>';
}
add_shortcode( 'border_rouge', 'border_rouge_shortcode' );

function border_gris_shortcode( $atts ) {
	return '<div class="border-gris">&nbsp;</div>';
}
add_shortcode( 'border_gris', 'border_gris_shortcode' );


//-------------------------------------------------  
//function pour les images de la presse
//-------------------------------------------------
if ( function_exists( 'add_image_size' ) ) {
    add_image_size( 'imgPresse', 150, 210, true );
}


/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
