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

$hidetitle = get_post_meta( $post->ID, 'disable-title' );

if ($hidetitle == 'yes') {
	$hide = 'style="display:none;"';
} else {
	$hide = '';
}
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
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<?php beyond2016_excerpt(); ?>

	<?php beyond2016_post_thumbnail($size = 'post-thumbnail'); ?>

	<div id="give-form-content-<?php the_ID(); ?>">

			<?php
				give_get_donation_form( $args = array() );
			?>

	</div><!-- #give-form-<?php the_ID(); ?> -->
	<footer class="entry-footer">
		<span class="byline"><span class="author vcard"><img alt="" src="http://0.gravatar.com/avatar/3e6428778674fc59ff824f341d868d59?s=49&amp;r=pg" srcset="http://0.gravatar.com/avatar/3e6428778674fc59ff824f341d868d59?s=98&amp;r=pg 2x" class="avatar avatar-49 photo" height="49" width="49"><span class="screen-reader-text">Author </span> <a class="url fn n" href="http://mattcromwell.dev/author/matt/">Matt</a></span></span><span class="posted-on"><span class="screen-reader-text">Posted on </span><a href="http://mattcromwell.dev/rofawp-2-free-script-management-plugins/" rel="bookmark"><time class="entry-date published" datetime="2015-10-14T16:49:59+00:00">October 14, 2015</time><time class="updated" datetime="2016-04-06T20:59:07+00:00">April 6, 2016</time></a></span><span class="cat-links"><span class="screen-reader-text">Categories </span><a href="http://mattcromwell.dev/category/webdev/" rel="category tag">WebDev</a></span>		<span class="edit-link"><a class="post-edit-link" href="http://mattcromwell.dev/wp-admin/post.php?post=2081&amp;action=edit">Edit<span class="screen-reader-text"> "ROFAWP #2: Free Script Management Plugins"</span></a></span>	</footer>
</article>
<?php do_action( 'give_after_single_form' ); ?>
