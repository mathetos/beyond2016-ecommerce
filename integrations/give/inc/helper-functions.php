<?php

/* 
 *  Enqueue Scripts/Styles
 */

add_action( 'admin_enqueue_scripts', 'b16ecom_enqueue_admin_css' );
add_action('wp_footer', 'b16ecom_give_scripts');

function b16ecom_enqueue_admin_css($hook) {
  global $post;

  if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
    if ( 'give_forms' === $post->post_type ) {  
      wp_enqueue_style( 'b16ecom-admin-css', B16ECOM_URL . 'integrations/give/assets/css/b16ecom-admin-css.css', false, mt_rand(), false );
    }
  }
}

function b16ecom_give_scripts() {

  wp_enqueue_style('b16ecom-give-css', B16ECOM_URL . 'integrations/give/assets/css/b16ecom-give.css', 'beyond2016-main', mt_rand(), false);

}


/*
 *  Point Give templates to B16ECOM templates folder
 *
 */

// Helper function for getting the B16ECOM Give Template Directory Path
function b16ecom_give_templates_dir() {
  return B16ECOM_PATH . '/integrations/give/templates/';
}

// Hijack standard themeing heirarchy just for Give templates
add_filter( 'template_include', 'b16ecom_give_template_chooser');

function b16ecom_give_template_chooser( $template ) {
 
    // Post ID
    $post_id = get_the_ID();
 
    // For all other CPT
    if ( get_post_type( $post_id ) != 'give_forms' ) {
        return $template;
    }
 
    // Else use custom template
    if ( is_singular('give_forms') ) {
        return b16ecom_give_get_template_hierarchy( 'single' );
    } elseif ( is_post_type_archive('give_forms') ) {
        return b16ecom_give_get_template_hierarchy( 'archive' );
    }
 
}

function b16ecom_give_get_template_hierarchy( $template ) {
 
    // Get the template slug
    $template_slug = rtrim( $template, '.php' );
    $template = $template_slug . '-give_forms.php';
 
    // Check if a custom template exists in the theme folder, if not, load the plugin template file
    if ( $theme_file = locate_template( array( 'give/' . $template ) ) ) {
        $file = $theme_file;
    }
    else {
        $file = B16ECOM_PATH . '/integrations/give/templates/' . $template;
    }
 
    return apply_filters( 'b16ecom_give_template_' . $template, $file );
}

// Hijack the Give Templating to use our templates AFTER themes but BEFORE Give's core templates
add_filter('give_template_paths', 'b16ecom_give_template_paths', 99);

function b16ecom_give_template_paths($file_paths) {

  $template_dir = give_get_theme_template_dir_name();

  $file_paths = array(
    1     => trailingslashit( get_stylesheet_directory() ) . $template_dir,
    10    => trailingslashit( get_template_directory() ) . $template_dir,
    50    => B16ECOM_PATH . '/integrations/give/templates/',
    100   => give_get_templates_dir()
  );

  // sort the file paths based on priority
  ksort( $file_paths, SORT_NUMERIC );

  return array_map( 'trailingslashit', $file_paths );
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

  if ( $sidebar == 'disable' || is_post_type_archive('give_forms')) {
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

