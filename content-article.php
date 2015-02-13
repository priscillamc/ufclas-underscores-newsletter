<?php
/**
 * @package ufclas-newsletter
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
    <?php if( is_single() ){ ?>
			<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
            <div class="entry-meta">
			<span class="byline">By <?php echo esc_html( get_the_author() ) ?></span>, <?php echo get_the_term_list( $post->ID, 'issuem_issue', '', ', ' ); ?>
		</div><!-- .entry-meta -->
	<?php } else { 
			the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); 
		} 
	?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php 
			if( is_archive() || is_front_page() ){
				the_excerpt();
			}
			else {
				the_content();
			} 
			
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'ufclas-newsletter' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php
			if( !is_archive() ){
				/* translators: used between list items, there is a space after the comma */
				$category_list = get_the_term_list( $post->ID, 'issuem_issue_tags', '', ', ' );
	
				if ( '' != $category_list ) {
					$meta_text = __( 'This article was posted in %1$s. Bookmark the <a href="%2$s" rel="bookmark">permalink</a>.', 'ufclas-newsletter' );
				} else {
					$meta_text = '';
				} // end check for categories on this blog
	
				printf(
					$meta_text,
					$category_list,
					get_permalink()
				);
			}
		?>

		<?php edit_post_link( __( 'Edit Article', 'ufclas-newsletter' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
