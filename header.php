<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _s
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php 
	global $options;
	wp_head(); 
?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="container">
	<div class="skip-links"><a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'theme_name' ); ?></a></div>

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			<?php
			if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php
			endif;

			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php
			endif; ?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'theme_name' ); ?></button>
			<?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'primary-menu' ) ); ?>
		</nav><!-- #site-navigation -->		

		<!-- A supprimer si option réseaux sociaux non utilisé -->			
		<ul class="social">
			<?php if ($options['presstige_icon_social']['txt_input1'] != "") echo "<li><a class='icon-facebook icon' href='".$options['presstige_icon_social']['txt_input1']."'><span class='visually-hidden'>Facebook</span></a></li>"; ?>
			<?php if ($options['presstige_icon_social']['txt_input2'] != "") echo "<li><a class='icon-twitter icon' href='".$options['presstige_icon_social']['txt_input2']."'><span class='visually-hidden'>Twitter</span></a></li>"; ?>
			<?php if ($options['presstige_icon_social']['txt_input3'] != "") echo "<li><a class='icon-gplus icon' href='".$options['presstige_icon_social']['txt_input3']."'><span class='visually-hidden'>Google Plus</span></a></li>"; ?>
			<?php if ($options['presstige_icon_social']['txt_input4'] != "") echo "<li><a class='icon-linkedin icon' href='".$options['presstige_icon_social']['txt_input4']."'><span class='visually-hidden'>Linkedin</span></a></li>"; ?>
		</ul>
		<!-- END option réseaux sociaux  -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
