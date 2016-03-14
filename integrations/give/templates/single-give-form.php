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

$hidebottomsidebar = get_post_meta( $post->ID, 'hide-bottom-sidebar' );
$hidefooter = get_post_meta( $post->ID, 'hide-footer' );

get_header(); ?>

<div id="primary" class="content-area <?php echo $alignment; ?>">
	<main id="main" class="site-main" role="main">

<?php
/**
 * give_before_main_content hook
 *
 * @hooked give_output_content_wrapper - 10 (outputs opening divs for the content)
 */
do_action( 'give_before_main_content' );

while ( have_posts() ) : the_post();

	include_once( B16ECOM_GIVE_TEMPLATES . '/single-give-form/content-single-give-form.php' );

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
//do_action( 'give_sidebar' ); ?>

</main><!-- .site-main -->

<?php
if ($hidebottomsidebar[0] == 'yes') {
	//display nothing here
} else {
	get_sidebar( 'content-bottom' );
} ?>

</div><!-- .content-area -->

<?php
get_footer();
