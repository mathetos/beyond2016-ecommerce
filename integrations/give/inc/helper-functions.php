<?php

/* 
 *  Enqueue Scripts/Styles
 */

add_action( 'admin_enqueue_scripts', 'b16ecom_enqueue_admin_css' );
add_action('wp_enqueue_scripts', 'b16ecom_give_styles');

function b16ecom_enqueue_admin_css($hook) {
    global $post;

    if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
        if ( 'give_forms' === $post->post_type ) {  
          wp_enqueue_style( 'b16ecom-admin-css', B16ECOM_URL . 'integrations/give/assets/css/b16ecom-admin-css.css' );
        }
      }
}

function b16ecom_give_styles() {

  wp_enqueue_style('b16ecom-give-css', B16ECOM_URL . 'integrations/give/assets/css/b16ecom-give.css', 'beyond2016-main');
}

/*
 *  Point Give templates to B16ECOM templates folder
 *
 */

// Helper function for getting the B16ECOM Give Template Directory Path
function b16ecom_give_templates_dir() {
  return B16ECOM_PATH . '/integrations/give/templates/';
}

// Hijack the Give Templating to use our templates AFTER themes but BEFORE Give's core templates
add_filter('give_template_paths', 'b16ecom_give_template_paths', 99);

function b16ecom_give_template_paths() {

  $template_dir = give_get_theme_template_dir_name();

  $file_paths = array(
    1     => trailingslashit( get_stylesheet_directory() ) . $template_dir,
    10    => trailingslashit( get_template_directory() ) . $template_dir,
    100   => B16ECOM_PATH . '/integrations/give/templates/',
    200   => give_get_templates_dir()
  );

  return $file_paths;
}

/*
 * Give Template Functions
 *
 */

add_filter('give_default_wrapper_start', 'b16ecom_give_wrapper_start');
add_filter('give_default_wrapper_end', 'b16ecom_give_wrapper_end');


function b16ecom_give_wrapper_start() {
  $wrapper = '<div id="primary" class="content-area">
  	<main id="main" class="site-main" role="main">';

    return $wrapper;
}

function b16ecom_give_wrapper_end() {
  $wrapper = '</main></div><!-- End #primary -->';

  return $wrapper;
}

function b16ecom_give_sidebar() {
  $sidebar = get_sidebar();

  return $sidebar;
}

// Add body classes depending on Main Sidebar setting
add_filter('body_class', 'b16ecom_give_bodyclasses');

function b16ecom_give_bodyclasses( $classes ) {
  global $post;
  
  $sidebar = get_post_meta( $post->ID, 'beyond2016-main-sidebar-layout', true );
  $givesidebar = get_post_meta( $post->ID, 'hide-give-sidebar', true );

  if ( $sidebar == 'disable' ) {
    $classes[] = 'no-sidebar';
  } elseif ($sidebar == 'right') {
    $classes[] = 'give-sidebar-right';
  } elseif ( $sidebar == 'left') {
    $classes[] = 'give-sidebar-left';
  }

  if ( $givesidebar == 'yes') {
    $classes[] = 'no-give-sidebar';
  } else {
    $classes[] = '';
  }
  
  // return the $classes array
  return $classes;
}

