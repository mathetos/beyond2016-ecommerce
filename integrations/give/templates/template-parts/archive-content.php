<?php
/**
 * The template part for displaying content
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
		
	$giveterm = get_the_terms($post->id, 'give_forms_category');

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('by16-col'); ?>>

	<?php beyond2016_post_thumbnail( $size = 'medium-large' ); ?>

	<?php the_title( sprintf( '<h4 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>

	<?php beyond2016_excerpt(); ?>

	<footer class="entry-footer">
		<p><?php echo $giveterm[0]->name; ?></p>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
