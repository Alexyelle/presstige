<!DOCTYPE html>
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="lteie9 lteie8 lteie7 lteie6 ie6 no-js"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="lteie9 lteie8 lteie7 ie7 no-js"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="lteie9 lteie8 ie8 no-js"> <![endif]-->
<!--[if IE 9 ]>    <html <?php language_attributes(); ?> class="lteie9 ie9 no-js"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged, $options;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'presstige' ), max( $paged, $page ) );

	?>
</title>
	<!--  Mobile Viewport Fix -->
	<meta name="viewport" content="initial-scale=1.0, width=device-width">
    
	<!-- Place favicon.ico and apple-touch-icon.png in the images folder -->
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon.ico">
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/img/apple-touch-icon.png"><!--60X60-->	
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<script src="<?php echo get_template_directory_uri(); ?>/js/modernizr.custom.js"></script>
	<!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

	<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>	
	
	<?php wp_head(); ?>
	

	<!-- To use the options  -->
	<?php $options = presstige_get_global_options(); ?>
	
	</head>

<body <?php body_class(); ?> >	

	<div class="hfeed container">
		<header role="banner" id="site-header">

			<h1 class="site-title"><span><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>

			<nav class="main-menu clearfix" id="menu" role="navigation">
				<h3 class="visually-hidden"><?php _e( 'Main menu', 'presstige' ); ?></h3>
				<?php /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff. */ ?>
				
				<div class="skip-links"><a class="visually-hidden" href="#content" title="<?php esc_attr_e( 'Skip to primary content', 'presstige' ); ?>"><?php _e( 'Skip to primary content', 'presstige' ); ?></a></div>				
				<?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu. The menu assiged to the primary position is the one used. If none is assigned, the menu with the lowest ID is used. */ ?>
				<?php //wp_nav_menu( array( 'container' => '', 'theme_location' => 'primary', 'menu_id' => 'nav') ); ?>	
				
				<?php   
					// wp_nav_menu( array( 'container_class' => 'menu main-navigation', 'theme_location' => 'primary','walker' => new Has_Subnav_Walker() ) ); 					 
					wp_nav_menu( array( 'container_class' => 'menu', 'theme_location' => 'primary' ) );
				?>

			</nav>

			<!-- A supprimer si déploiement recherche non utilisé -->
			<div id="sb-search" class="sb-search">
				<form role="search" action="<?php bloginfo('url'); ?>/" method="get" >
					<div class="sb-search-input-wrap"><input class="sb-search-input" placeholder="Rechercher..." type="text" value="" name="s"  id="search"></div>
					<input class="sb-search-submit icon icon-search" type="submit" value="">
					<span class="sb-icon-search icon icon-search"></span>
				</form>
			</div>
			<!-- END déploiement recherche  -->			

			<!-- A supprimer si option réseaux sociaux non utilisé -->			
			<ul class="social">
				<?php if ($options['presstige_icon_social']['txt_input1'] != "") echo "<li><a class='icon-facebook icon' href='".$options['presstige_icon_social']['txt_input1']."'><span class='visually-hidden'>Facebook</span></a></li>"; ?>
				<?php if ($options['presstige_icon_social']['txt_input2'] != "") echo "<li><a class='icon-twitter icon' href='".$options['presstige_icon_social']['txt_input2']."'><span class='visually-hidden'>Twitter</span></a></li>"; ?>
				<?php if ($options['presstige_icon_social']['txt_input3'] != "") echo "<li><a class='icon-gplus icon' href='".$options['presstige_icon_social']['txt_input3']."'><span class='visually-hidden'>Google Plus</span></a></li>"; ?>
				<?php if ($options['presstige_icon_social']['txt_input4'] != "") echo "<li><a class='icon-linkedin icon' href='".$options['presstige_icon_social']['txt_input4']."'><span class='visually-hidden'>Linkedin</span></a></li>"; ?>
			</ul>
			<!-- END option réseaux sociaux  -->
		</header>

		<div id="main" class="line gut">
			<?php 
			//  If it's not a page (= a blog post, archive, etc) we display the sidebar on the right side 
			if (!(is_page())){?>
			<section id="content" role="region" class="content mod left w70 mr3">
			<?php } 
			