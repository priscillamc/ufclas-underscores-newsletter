<?php
/**
 * ufclas-newsletter functions and definitions
 *
 * @package ufclas-newsletter
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 502; /* pixels */
}

if ( ! function_exists( 'ufclas_newsletter_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function ufclas_newsletter_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on ufclas-newsletter, use a find and replace
	 * to change 'ufclas-newsletter' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'ufclas-newsletter', get_template_directory() . '/languages' );

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
		'primary' => __( 'Primary Menu', 'ufclas-newsletter' ),
	) );
	
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside'
	) );

	// Setup the WordPress core custom header feature.
	add_theme_support( 'custom-header', apply_filters( 'ufclas_newsletter_custom_header_args', array(
		'flex-width' => true,
		'width' => 800,
		'flex-height' => true,
		'height' => '105',
		'uploads' => true,
		'header-text' => false,
	) ) );
	
	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'ufclas_newsletter_custom_background_args', array(
		'default-color' => 'dddddd',
		'default-image' => '',
	) ) );
}
endif; // ufclas_newsletter_setup
add_action( 'after_setup_theme', 'ufclas_newsletter_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function ufclas_newsletter_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'ufclas-newsletter' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer', 'ufclas-newsletter' ),
		'id'            => 'footer-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'ufclas_newsletter_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ufclas_newsletter_scripts() {
	wp_enqueue_style( 'ufclas-newsletter-style', get_stylesheet_uri() );
	
	wp_enqueue_script( 'ufclas-newsletter-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'ufclas-newsletter-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	// Add grid and custom styles
	wp_enqueue_style( 'grid', get_template_directory_uri() . '/css/grid.css');
	wp_enqueue_style( 'newsletter', get_template_directory_uri() . '/css/newsletter.css');
}
add_action( 'wp_enqueue_scripts', 'ufclas_newsletter_scripts' );

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

// Add a read more link for article excerpts
function ufclas_newsletter_readmore( $more ) {
	return '... <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">' . __('Read More', 'ufclas_newsletter') . '</a>';
}
add_filter('excerpt_more', 'ufclas_newsletter_readmore');

// Get the current issue cover image
function get_ufclas_newsletter_issue_cover_url( $issue_id = false ){
	if(is_tax('issuem_issue')){
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		$issue_id = $term->term_id;		
	}
	$image_src = wp_get_attachment_image_src( get_issuem_issue_cover( $issue_id ), 'full' );
	return $image_src[0];
}

// Get the background image style for the cover image
function get_ufclas_newsletter_issue_cover_style( $issue_id = false ){
	$toc_background = get_ufclas_newsletter_issue_cover_url();
	return ( !empty($toc_background) )? 'style="background-image:url(' . $toc_background . ');"':'';
}

// Get the current issue cover image
function get_ufclas_newsletter_issue_title( $issue_title = false ){
	if(is_tax('issuem_issue')){
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		$issue_title = $term->name;		
	}
	return $issue_title;
}
