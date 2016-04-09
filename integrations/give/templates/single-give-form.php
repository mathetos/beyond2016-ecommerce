<?php
/**
 * The Template for displaying all single Give Forms.
 *
 * Override this template by copying it to yourtheme/give/single-give-forms.php
 *
 * @package       Give/Templates
 * @version       1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header();

/**
 * give_before_main_content hook
 *
 * @hooked give_output_content_wrapper - 10 (outputs opening divs for the content)
 */
do_action( 'give_before_main_content' );

while ( have_posts() ) : the_post();
	echo '<h1>TEST!</h1>';
	b16ecom_give_templates_dir( 'single-give-form/content', 'single-give-form' );

endwhile; // end of the loop.

/**
 * give_after_main_content hook
 *
 * @hooked give_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'give_after_main_content' );

/**
 * give_sidebar hook
 *
 * @hooked give_get_sidebar - 10
 */
do_action( 'give_sidebar' );

get_footer();