<!DOCTYPE html>
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="lteie9 lteie8 lteie7 lteie6 ie6 no-js"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="lteie9 lteie8 lteie7 ie7 no-js"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="lteie9 lteie8 ie8 no-js"> <![endif]-->
<!--[if IE 9 ]>    <html <?php language_attributes(); ?> class="lteie9 ie9 no-js"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<title><?php
	global $page, $paged, $options;
	wp_title();
?></title>
	<!--  Mobile Viewport Fix -->
	<meta name="viewport" content="initial-scale=1.0, width=device-width">
    
	<!-- Place favicon.ico and apple-touch-icon.png in the images folder -->
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon.ico">
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/img/apple-touch-icon.png"><!--60X60-->	
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

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

			<h1 class="site-title">
				<a itemprop="url" href="<?php echo home_url( '/' ); ?>" rel="home">
					<img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" width="" height="" alt="<?php bloginfo( 'name' ); ?>" itemprop="logo" />
				</a>
			</h1>
			<div class="site-description"><?php bloginfo( 'description' ); ?></div>

			<nav class="main-menu clearfix" id="menu" role="navigation">				
				<div class="skip-links"><a href="#primary" rel="nofollow"><?php _e( 'Skip to primary content', 'presstige' ); ?></a> <a href="#menu-navigation-principale" rel="nofollow">Allez à la navigation</a></div>
				<?php wp_nav_menu( array( 'container_class' => 'menu', 'theme_location' => 'primary', 'items_wrap' => '<button type="button" class="menu-link navtoggle">Menu</button><ul id="%1$s" class="%2$s">%3$s</ul>' ) ); ?>
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

		<main class="line gut">