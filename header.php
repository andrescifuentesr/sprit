<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Sprit
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>

<!-- Redirection mobile :(  -->
<script> var url = 'http://m.lespritdu12eme.com'; var redirect_ipad = false;</script>
<script src="http://detect.mobimenu.fr/mobile.js"></script>

<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> onload="initialize()" >
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		</div>

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<h1 class="menu-toggle"><?php _e( '&#9776; Menu', 'sprit' ); ?></h1>
			<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'sprit' ); ?></a>

			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
		</nav><!-- #site-navigation -->
	
		<div class="nav-footer">

			<div class="bt-newsletter">
				<?php $icl_object_id = icl_object_id('137', 'page', true); ?>
				<a href="<?php echo esc_url( get_permalink( $icl_object_id ) ); ?>">Newsletter</a>
			</div>

			<!-- #social menu -->
			<?php get_template_part( 'menu', 'social' ); ?>

			<!-- #lang nav -->
			<div class="menu-lang clearfix">
				<?php do_action('icl_language_selector'); ?>
			</div>
			
			<div class="button-copyright">
				<a href="http://www.food2vous.com/">©Copyright <?php echo date('Y'); ?><br/>
				Food 2 Vous. Tous droits réservés</a>
			</div>
		</div>

	</header><!-- #masthead --><!--

 --><div id="content" class="site-content">