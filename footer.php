<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package ufclas-newsletter
 */
?>
	</div><!-- .content-wrap -->
	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info container_12 clearfix">
			<div class="footer-content grid_8">
            	<?php 
					dynamic_sidebar( 'footer-1' ); 
				?>
            </div>
            <div class="footer-logo grid_4">
            	<a href="http://www.ufl.edu/"><img alt="University of Florida" src="<?php echo get_stylesheet_directory_uri(); ?>/images/UFsignature_white.png"></a>
            </div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
