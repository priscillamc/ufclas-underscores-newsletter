<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package ufclas-newsletter
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
<script type="text/javascript">
	$(document).ready(function(){
		$("a[rel^='prettyPhoto']").prettyPhoto();
	});
</script>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'ufclas-newsletter' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding container_12" style="background-image:url('<?php header_image(); ?>');">
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
            <?php echo do_shortcode('[issuem_issue_title]'); ?>
		</div>
		<nav id="site-navigation" class="main-navigation container_12" role="navigation">
			<button class="menu-toggle"><?php _e( 'Primary Menu', 'ufclas-newsletter' ); ?></button>
			<?php //wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'menu', 'container_class' => 'grid_12'  ) ); ?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content container_12">