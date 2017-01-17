<?php
/**
 * Define our settings sections
 *
 * array key=$id, array value=$title in: add_settings_section( $id, $title, $callback, $page );
 * @return array
 */
function presstige_options_page_sections() {
	
	$sections = array();
	$sections['social_section'] 		= __('Social networks', 'theme_name');
	$sections['maintenance_section'] 	= __('Maintenance', 'theme_name');
	
	return $sections;	
}

/**
 * Define our form fields (settings) 
 *
 * @return array
 */
function presstige_options_page_fields() {
	// Text Form Fields section
		
	$options[] = array(
		"section" => "social_section",
		"id"      => PRESSTIGE_SHORTNAME . "_icon_social",
		"title"   => __( 'Social icons', 'theme_name' ),
		"desc"    => __( 'Social icons url', 'theme_name' ),
		"type"    => "multi-text",
		"choices" => array( __('Facebook URL','theme_name') . "|txt_input1", __('Twitter URL','theme_name') . "|txt_input2", __('Google Plus','theme_name') . "|txt_input3", __('Linkedin','theme_name') . "|txt_input4"),
		"std"     => ""
	);
	// Checkbox Form Fields section
	$options[] = array(
		"section" => "maintenance_section",
		"id"      => PRESSTIGE_SHORTNAME . "_maintenance",
		"title"   => __( 'Website in maintenance', 'theme_name' ),
		"desc"    => __( 'Check this box if you want to hide your website.', 'theme_name' ),
		"type"    => "checkbox",
		"std"     => 1 // 0 for off
	);
	return $options;	
}
 ?>