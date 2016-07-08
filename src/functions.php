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

// ==== Soon to be plugins ==== //

// post type for services offered buy admin
// has a metabox for an attached image
function post_type_service_init(){
  $labels = array(
        'name'                  => 'Services',
        'singular_name'         => 'Service',
    );

    $args = array(
        'labels'               => $labels,
        'public'               => true,
        'publicly_queryable'   => true,
        'show_ui'              => true,
        'show_in_menu'         => true,
        'query_var'            => true,
        'rewrite'              => array( 'slug' => 'service' ),
        'capability_type'      => 'post',
        'has_archive'          => true,
        'hierarchical'         => false,
        'menu_position'        => null,
        'taxonomies'           => array('category'),
        'supports'             => array( 'title', 'editor', 'excerpt'),
        'register_metabox_cb'  => 'add_service_metaboxes',
    );

  register_post_type('service', $args);
}
add_action('init','post_type_service_init');

// metaboxes -----------------------------

// add meta boxes in the admin panel for services
function add_service_metaboxes(){
  add_meta_box('service-metabox', 'Service Meta',
    'service_callback', 'service',
    'normal','high');
}
add_action('add_meta_boxes', 'add_service_metaboxes');

function service_callback(){
  global $post;

  // creates the nonce we will recieve later,
  echo '<input type="hidden" name="servicemeta_noncename"
    id="softwareprojectmeta_noncename" value="'.wp_create_nonce(plugin_basename(__FILE__)).'">';

  // get the link if it's allready been entered
  $image = get_post_meta($post->ID,'_image', true);

  // the input fields, potentially prefilled with previous data
  echo '
        <h2>Image</h2>
        <p>The address to a representative image of the service, with the "http://" part </p>
        <input type="text" name="_image" value="'.$image.'" class="widefat"
        placeholder="http://imagehost.com/image.jpg" />
      ';
}

function save_servicemeta($post_id, $post){
  if (!isset($_POST['servicemeta_noncename'])){
    return $post->ID;
  }

  // verify this is the right call we're handling
  if (!wp_verify_nonce($_POST['servicemeta_noncename'], plugin_basename(__FILE__) )){
    return $post->ID;
  }

  //verify permissions
  if (!current_user_can('edit_post', $post->ID)) {
    return $post->ID;
  }

  $events_meta['_image'] = $_POST['_image'];

  foreach($events_meta as $key => $value){
    //don't store custom data twice
    if ($post->post_type == 'revision') {
      return;
    }

    // If $value is an array, make it a CSV (unlikely)
    $value = implode(',', (array)$value);

    // If the custom field already has a value, we update it,
    // otherwise we add a new meta, or destroy it
    if(get_post_meta($post->ID, $key, FALSE)) {
      update_post_meta($post->ID, $key, $value);
    } else {
      // the custom field doesn't have a value so add it
      add_post_meta($post->ID, $key, $value);
    }

    // if we got an empty value, the user
    // wanted to delete that field
    if(!$value) {
      delete_post_meta($post->ID, $key);
    }
  }
}
add_action('save_post', 'save_servicemeta', 1, 2);

