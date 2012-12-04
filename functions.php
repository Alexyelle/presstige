<?php
  

/*** clean ups and enhancements, uncomment to use */
require_once('functions/wordpress_cleanup.php'); //admin cleanups 
// require_once('functions/custom_post_types.php'); // boiler template for CPT
require_once('functions/script_style_cleanups.php'); // javascript cleanups
// require_once('functions/remove-comments-absolute.php'); //to remove comments completely
require_once ( 'functions/my-theme-settings.php' );


/**
 * Make theme available for translation
 * Translations can be filed in the /languages/ directory
 */
load_theme_textdomain( 'presstige', get_template_directory() . '/languages' );

$locale = get_locale();
$locale_file = get_template_directory() . "/languages/$locale.php";
if ( is_readable( $locale_file ) )
	require_once( $locale_file );

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640;


/**
 * This theme uses wp_nav_menus() for the header menu, utility menu and footer menu.
 */
register_nav_menus( array(
	'primary' => __( 'Primary Menu', 'presstige' )
) );


/**
 *	This theme supports editor styles
 */
add_editor_style("/css/layout-style.css");



/**** Add some theme support, uncomment what you need ****/
/** 
 * Add default posts and comments RSS feed links to head
 */
add_theme_support( 'automatic-feed-links' );

/**
 * This theme uses post thumbnails
 */
add_theme_support( 'post-thumbnails' );

if ( function_exists( 'add_theme_support' ) ) {   
	// flux
	add_theme_support( 'automatic-feed-links' );
	// images à la une 
	add_theme_support( 'post-thumbnails' ); 
	add_image_size( 'post-image', 500, 9999 ); //550 pixels wide (and unlimited height)
	add_image_size( 'featured-image', 952, 200, true);
	add_image_size( 'four-up-thumbnail', 200, 100, true);

	/*
	//I have yet to have a good reason to support post formats. Disabling for now...
	  add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ) );
	  add_post_type_support( 'page', 'post-formats' );
	*/  
}
/**
 * This enables post formats. If you use this, make sure to delete any that you aren't going to use.
 */
//add_theme_support( 'post-formats', array( 'aside', 'audio', 'image', 'video', 'gallery', 'chat', 'link', 'quote', 'status' ) );


/**
 * Disable the admin bar in 3.1
 */
//show_admin_bar( false );
function scripts_styles() {
	// AJOUT DES SCRIPTS
	// paramètres => ('string:identifiant_unique', 'string:url', 'array:dépendances')
	if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
	wp_enqueue_script('jquery');
	wp_enqueue_script('modernizr', get_template_directory_uri().'/js/modernizr.custom.js');
	wp_enqueue_script('konami', get_template_directory_uri().'/js/konami.js', array('jquery'));
	wp_enqueue_script('general', get_template_directory_uri().'/js/general.js', array('jquery'));	
}
add_action('wp_enqueue_scripts', 'scripts_styles');

/**
 * Register widgetized area and update sidebar with default widgets
 */
function handcraftedwp_widgets_init() {
	register_sidebar( array (
		'name' => __( 'Sidebar', 'presstige' ),
		'id' => 'sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s" role="complementary">',
		'after_widget' => "</aside>",
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
	
		// Area 3, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Footer', 'presstige' ),
		'id' => 'footer-widget-area',
		'description' => __( 'The footer area', 'presstige' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );
}
add_action( 'init', 'handcraftedwp_widgets_init' );


// This theme uses wp_nav_menu() in one location.
register_nav_menu( 'primary', __( 'Primary Menu', 'presstige' ) );


/**************** Adding some html5 functionnalities to comments************/
add_filter('comment_form_default_fields', 'twentytenfive_comments');
function twentytenfive_comments() {

$req = get_option('require_name_email');

$fields =  array(
'author' => '<p>' . '<label for="author">' . __( 'Name','presstige' ) . '</label> ' . ( $req ? '<span>*</span>' : '' ) .
'<input id="author" name="author" type="text" value="' . '" size="30"' . ' placeholder ='.__( '"What shall we call you?"', 'presstige' ) . ( $req ? ' required' : '' ) . '/></p>',

'email'  => '<p><label for="email">' . __( 'Email','presstige' ) . '</label> ' . ( $req ? '<span>*</span>' : '' ) .
'<input id="email" name="email" type="email" value="' .'" size="30"' . ' placeholder ='.__( '"Leave us a valid email adress"', 'presstige' ) . ( $req ? ' required' : '' ) . ' /></p>',

'url'    => '<p><label for="url">' . __( 'Website','presstige' ) . '</label>' .
'<input id="url" name="url" type="url" value="' . '" size="30" placeholder='.__( '"Have you got a nice website ?"', 'presstige' ) . '/></p>'

);
return $fields;
}
add_filter('comment_form_field_comment', 'twentytenfive_commentfield');

function twentytenfive_commentfield() {
$commentArea = '<p><label for="comment">' . __( 'Comment', 'presstige') . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" required placeholder ='.__( '"What\'s in your mind ?"', 'presstige').'  ></textarea></p>';
return $commentArea;
}

/** Adding html5 functionnalities to searchform ***/
function html5_search_form( $form ) {
    $form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
    <p><label class="screen-reader-text" for="s">' . __('Search for:','presstige') . '</label>
    <input type="search" value="' . get_search_query() . '" name="s" id="s"  autocomplete="on" placeholder ='.__( '"What are you looking for?"', 'presstige' ) . ' />
    <input type="submit" id="searchsubmit" value="'. esc_attr__('Search') .'" />
    </p>
    </form>';
    return $form;
}

add_filter( 'get_search_form', 'html5_search_form' );


/** we need a second form not to duplicate ids on the search result page when there is no results */
function get_search_form_HTML5_bis() {
    echo '<form role="search" method="get" id="searchform_bis" action="' . home_url( '/' ) . '" >
    <p><label class="screen-reader-text" for="s2">' . __('Search for:','presstige') . '</label>
    <input type="search" value="' . get_search_query() . '" name="s" id="s2"  autocomplete="on" placeholder ='.__( '"What are you looking for?"', 'presstige' ) . ' />
    <input type="submit" id="searchsubmit_bis" value="'. esc_attr__('Search','presstige') .'" />
    </p>
    </form>';
}



/*** Add a login stylesheet and a wordpress specifiq stylesheet------------
Special thanks to Valentin Brandt :  
http://www.geekeries.fr/snippet/personnaliser-interface-ui-wordpress-3-2/ 
comment code if not needed -----------*/

function gk_ui_wp32_login() {
	echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('template_directory') . '/css/custom_login.css"/>';
}

function gk_ui_wp32_admin() {
	echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('template_directory') . '/css/custom_admin.css"/>';
}
add_action('login_head', 'gk_ui_wp32_login');
add_action('admin_head', 'gk_ui_wp32_admin');


/*----------------------------------------------------------------------- **/

/*  please don't but if you need to remove width/height on template use this */
/* add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
function remove_thumbnail_dimensions( $html ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
} */

// PAGE ATTENTE
function load_page_wait() {
	$options = get_option('presstige_options');
	$maintenance = $options['presstige_maintenance'];
	if ( $maintenance == 'true' ){
		$isLoginPage = strpos($_SERVER['REQUEST_URI'], "wp-login.php") !== false;
		$adminPage = strpos($_SERVER['REQUEST_URI'], "wp-admin") !== false;
		if($maintenance && !is_user_logged_in() && !$isLoginPage && !$adminPage) {
			include('functions/maintenance.php');
			exit();	
		}
	}
}
add_action('init','load_page_wait');

// FAVICON
function favicon() {
	$options = get_option('presstige_options');
	if ($options['presstige_favicon'] != ""){
		echo '<link rel="shortcut icon" href="'.$options['presstige_favicon'].'" type="image/vnd.microsoft.icon"/>';
		echo '<link rel="icon" href="'.$options['presstige_favicon'].'" type="image/x-ico"/>';
	} else {
		echo '<link rel="shortcut icon" href="'.get_bloginfo('template_directory').'/img/favicon.ico" type="image/vnd.microsoft.icon"/>';
		echo '<link rel="icon" href="'.get_bloginfo('template_directory').'/img/favicon.ico" type="image/x-ico"/>';
	}
}
add_action('wp_head', 'favicon');

// GOOGLE ANALYTICS
function add_google_analytics() {
	$options = get_option('presstige_options');
	if ($options['presstige_analytics'] != "")
		echo "<script type='text/javascript'>".$options['presstige_analytics']."</script>";
}
add_action('wp_footer', 'add_google_analytics');

?>