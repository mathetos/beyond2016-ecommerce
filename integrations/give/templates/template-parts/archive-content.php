<?php
/**
 * The template part for displaying content
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
	
	$give_options = give_get_settings();
	
	if( $give_options['enable_categories'] == 'on' ) {
		$givecat = get_the_terms($post->id, 'give_forms_category');
		$catlink = get_term_link($givecat[0]->term_id);
	} else {
		$givecat = '';
		$catlink = '';
	}

	if( $give_options['enable_tags'] == 'on' ) {
		if (has_term('','give_forms_tag')) {
			$givetag = get_the_terms($post->id, 'give_forms_tag');
			$taglink = get_term_link($givetag[0]->term_id);
		}
	} else {
		$givetag = '';
		$taglink = '';
	}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?>>

	<?php beyond2016_post_thumbnail( $size = 'medium' ); ?>

	<?php the_title( sprintf( '<h4 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>

	<?php 

	if( $give_options['enable_categories'] == 'on' || $give_options['enable_tags'] == 'on') : ?>
	
		<div class="entry-meta">
			<p>
				<?php if (!empty($catlink)) { ?>
				<span class="genericon genericon-category"></span> <a href="<?php echo $catlink; ?>"><?php echo $givecat[0]->name; ?></a>
				<?php } if (!empty($taglink)) { ?>
				<span class="genericon genericon-tag"></span> <a href="<?php echo $taglink; ?>"><?php echo $givetag[0]->name; ?></a>
				<?php } ?>
			</p>
		</div><!-- .entry-footer -->
	
	<?php endif; ?>

	<?php beyond2016_excerpt(); ?>

</article><!-- #post-## -->
