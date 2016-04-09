<?php
/**
 * The template for displaying product content in the single-give-form.php template
 *
 * Override this template by copying it to yourtheme/give/content-single-give-form.php
 *
 * @package       Give/Templates
 * @version       1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

//Form Layout Options

$sidebar = get_post_meta( $post->ID, 'beyond2016-main-sidebar-layout', true );
$hidetitle = get_post_meta( $post->ID, 'disable-give-title', true );
$sidebar = get_post_meta( $post->ID, 'beyond2016-sidebar-layout', true );
$givesidebar = get_post_meta( $post->ID, 'hide-give-sidebar', true );
$hidebottomsidebar = get_post_meta( $post->ID, 'hide-give-bottom-sidebar', true );
$hidefooter = get_post_meta( $post->ID, 'hide-footer', true );

do_action('b16ecom_give_nosidebar');

if ( $sidebar != 'disable') {
    add_filter('give_after_main_content', 'b16ecom_give_sidebar');
  } 


$hide = ($hidetitle == 'yes' ? 'style="display:none;"' : '');

?>

<?php
/**
 * give_before_single_product hook
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'give_before_single_form' );

if ( post_password_required() ) {
	echo get_the_password_form();

	return;
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header" <?php echo $hide; ?>>
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<?php give_get_template_part( 'single-give-form/featured-image' ); ?>
	
	<?php beyond2016_excerpt(); ?>

	<div id="give-form-content-<?php the_ID(); ?>">

			<?php
				give_get_donation_form( $args = array() );
			?>

	</div><!-- #give-form-<?php the_ID(); ?> -->
	
	<?php if ($givesidebar != 'yes') : ?>
		<footer class="entry-footer">
			<?php give_get_template_part( 'single-give-form/sidebar' ); ?>
		</footer>
	<?php endif; ?>

</article>

<?php do_action( 'give_after_single_form' ); ?>

<?php
	if ($hidebottomsidebar == 'yes') {
	//display nothing here
	} else {
	get_sidebar( 'content-bottom' );
	} 
?>

