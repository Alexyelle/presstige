<?php
/********************  custom post type ************************/     
/** We are going to create a custom post type for **** !!! **/
add_action( 'init', 'add_cpt' );
function add_cpt() {
  $labels = array(
    'name' => _('Name', 'presstige'),
    'singular_name' => _('Name', 'presstige'),
    'add_new' => _('Add a ... ', 'presstige'),
    'add_new_item' => __('Add a new ... ', 'presstige'),
    'edit_item' => __('Edit the ... ', 'presstige'),
    'new_item' => __('New ', 'presstige'),
    'view_item' => __('See the', 'presstige'),
    'search_items' => __('Find a ... ', 'presstige'),
    'not_found' =>  __('No ... found', 'presstige'),
    'not_found_in_trash' => __('No ... found in trash', 'presstige'),
    'parent_item_colon' => ''
  );

  $supports = array('title', 'page-attributes', 'editor', 'thumbnail' );

  register_post_type( 'nom',
    array(
      'labels' => $labels,
      'description' => ' description goes here',
      'public' => true,
      'supports' => $supports,
      'capability_type' => 'page',
      //'rewrite' => array( 'slug' => 'nom ', 
      //'hierarchical'=> true ),      
      //'exclude_from_search' => true,
      'has_archive' => true,
               
    )
  );
}


//create taxonomy type
add_action( 'init', 'create_type_taxonomies', 0 );
function create_type_taxonomies() 
{
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name' => _x( 'Name  ', 'taxonomy general name' ),
    'singular_name' => _x( 'Name ', 'taxonomy singular name' , 'presstige'),
    'search_items' =>  __( 'Search item  ' , 'presstige'),
    'all_items' => __( ' All items  ', 'presstige' ),
    'parent_item' => __( 'Parent item ', 'presstige' ),
    'parent_item_colon' => __( 'Parent item colon ' , 'presstige'),
    'edit_item' => __( 'Edit item ' , 'presstige'), 
    'update_item' => __( 'Update item', 'presstige' ),
    'add_new_item' => __( 'Add new item' , 'presstige'),
    'new_item_name' => __( 'New item name', 'presstige' ),
    'menu_name' => __( 'Menu name', 'presstige' ),
  ); 	

  register_taxonomy('type',array('nom'), 
	array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_tagcloud' => false,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'type'),
  ));
  
 }
/*----------------------------------------------------------------------- **/



?>
