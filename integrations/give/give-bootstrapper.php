<?php

/*
 *  Give Boostrapper
 *  Since @1.0.0
 *  This loads up all the relevant files for integrating with the Give Donations plugin
 *
 */
//add_filter('give_templates_dir', 'b16ecom_templates_dir', 99);
add_filter('give_template_paths', 'b16ecom_give_template_paths', 99);

function b16ecom_give_templates_dir() {
  return B16ECOM_PATH . '/integrations/give/templates/';
}

function b16ecom_give_template_paths() {

  $template_dir = give_get_theme_template_dir_name();

  $file_paths = array(
    1   => B16ECOM_PATH . '/integrations/give/templates/',
    10     => trailingslashit( get_stylesheet_directory() ) . $template_dir,
    100    => trailingslashit( get_template_directory() ) . $template_dir,
    200   => give_get_templates_dir()
  );

  return $file_paths;
}

add_filter('give_default_wrapper_start', 'b16ecom_give_wrapper_start');
add_filter('give_default_wrapper_end', 'b16ecom_give_wrapper_end');
add_filter('give_after_main_content', 'b16ecom_give_sidebar');

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

add_action('wp_enqueue_scripts', 'b16ecom_give_styles');

function b16ecom_give_styles() {

  wp_enqueue_style('b16ecom-give-css', B16ECOM_URL . 'integrations/give/assets/css/b16ecom-give.css', 'beyond2016-main');
}
