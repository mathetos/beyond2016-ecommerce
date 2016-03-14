<?php

/*
 *  Give Boostrapper
 *  Since @1.0.0
 *  This loads up all the relevant files for integrating with the Give Donations plugin
 *
 */

//add_filter('body_class', 'give_nosidebar_body_class');

 function give_nosidebar_body_class($classes){
   if (is_singular('give_forms')) {
     $classes[] = 'no-sidebar';
   }
   return $classes;
 }

add_filter('give_template_paths', 'b16ecom_template_location', 99);

function b16ecom_template_location() {

  $template_dir = give_get_theme_template_dir_name();

  $file_paths = array(
    1     => trailingslashit( get_stylesheet_directory() ) . $template_dir,
    10    => trailingslashit( get_template_directory() ) . $template_dir,
    100   => WB16ECOM_PATH . '/integrations/give/templates/',
    200   => give_get_templates_dir()
  );

  return $file_paths;
}
