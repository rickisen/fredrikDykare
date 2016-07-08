<?php // ==== FUNCTIONS ==== //

// Switch for WP AJAX Page Loader; true/false
defined( 'VOIDX_SCRIPTS_PAGELOAD' )       || define( 'VOIDX_SCRIPTS_PAGELOAD', true );

// An example of how to manage loading front-end assets (scripts, styles, and fonts)
require_once( trailingslashit( get_stylesheet_directory() ) . 'inc/assets.php' );

// Required to demonstrate WP AJAX Page Loader (as WordPress doesn't ship with simple post navigation functions)
require_once( trailingslashit( get_stylesheet_directory() ) . 'inc/navigation.php' );

// the bare minimum to get the theme up and running
function descent_setup() {
  // Language loading
  load_theme_textdomain( 'descent', trailingslashit( get_template_directory() ) . 'languages' );

  // HTML5 support; mainly here to get rid of some nasty default styling that WordPress used to inject
  add_theme_support( 'html5', array( 'search-form', 'gallery' ) );

  // Automatic feed links
  add_theme_support( 'automatic-feed-links' );

  // $content_width limits the size of the largest image size available via the media uploader
  // It should be set once and left alone apart from that; don't do anything fancy with it; it is part of WordPress core
  global $content_width;
  if ( !isset( $content_width ) || !is_int( $content_width ) )
    $content_width = (int) 960;

  // Register header and footer menus
  register_nav_menu( 'header', __( 'Header menu', 'descent' ) );
  register_nav_menu( 'footer', __( 'Footer menu', 'descent' ) );
}
add_action( 'after_setup_theme', 'descent_setup', 11 );

// Footer widget area declaration
function footer_widgets_init() {
  register_sidebar( array(
    'name'          => __( 'Footer Widget Area', 'descent' ),
    'id'            => 'footer-widget-area',
    'description'   => __( 'General widget area', 'descent' ),
    'before_widget' => '<section class="widget">',
    'after_widget'  => '</section>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>'
  ));
}
add_action( 'widgets_init', 'footer_widgets_init' );
