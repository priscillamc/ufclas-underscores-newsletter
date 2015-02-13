<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package ufclas-newsletter
 */

?>

<div id="secondary" class="widget-area grid_4" role="complementary">
	<?php 
				while ( have_posts() ) : the_post(); ?>

				<?php if( has_post_format('aside') ){
						
                	get_template_part( 'content', get_post_format() );
					
                 } ?>

			<?php endwhile; ?>
</div><!-- #secondary -->
