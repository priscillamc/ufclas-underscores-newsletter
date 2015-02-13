<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package ufclas-newsletter
 */

get_header(); ?>


<?php 
	// Remove articles tagged as 'sidebar' from the main area
	$issue_args = array(
		'post_type' => 'article',
		'tax_query' => array(
			'relation' => 'AND',
			array(
				'taxonomy' => 'issuem_issue',
				'field' => 'slug',
				'terms' => $wp_query->get('issuem_issue')
			),
			array(
				'taxonomy' => 'post_format',
				'field' => 'slug',
				'terms' => 'post-format-aside',
				'operator' => 'NOT IN'
			),
		)
	);
	$issue_query = new WP_Query( $issue_args );
?>
<div id="issue-toc" class="container_12" <?php echo get_ufclas_newsletter_issue_cover_style(); ?>>	
	<div class="toc-content grid_4">
    <h2 class="entry-title hidden">In the current issue:</h2>
    <?php while ( $issue_query->have_posts() ) : $issue_query->the_post(); ?>
		<div class="article-link-<?php the_ID(); ?>">
			<a href="<?php the_permalink(); ?>" class="issuem_article_link"><?php the_title(); ?></a>
		</div>
    <?php endwhile; ?>
	</div><!-- toc-content -->
</div><!-- #issue-toc -->

<div class="clear"></div>
<div class="container_12">

	<section id="primary" class="content-area grid_8">
		<main id="main" class="site-main" role="main">

		<?php 
			if ( $issue_query->have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php single_term_title(); ?></h1>
				<?php
					// Show an optional term description.
					$term_description = term_description();
					if ( ! empty( $term_description ) ) :
						printf( '<div class="taxonomy-description">%s</div>', $term_description );
					endif;
				?>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( $issue_query->have_posts() ) : $issue_query->the_post(); ?>

				<?php
					get_template_part( 'content', get_post_type() );
				?>

			<?php endwhile; ?>

			<?php ufclas_newsletter_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_sidebar('issue'); ?>
<?php get_footer(); ?>
