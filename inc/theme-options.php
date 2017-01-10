<?php
/**
 * Define our settings sections
 *
 * array key=$id, array value=$title in: add_settings_section( $id, $title, $callback, $page );
 * @return array
 */
function presstige_options_page_sections() {
	
	$sections = array();
	// $sections[$id] 				= __($title, 'theme_name');
	$sections['social_section'] 		= __('Social networks', 'theme_name');
	// $sections['txtarea_section'] 	= __('Textarea Form Fields', 'theme_name');
	$sections['maintenance_section'] 	= __('Maintenance', 'theme_name');
	// $sections['files_section'] 	= __('Files Form Fields', 'theme_name');
	
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
	
	// Textarea Form Fields section
	// $options[] = array(
	// 	"section" => "txtarea_section",
	// 	"id"      => PRESSTIGE_SHORTNAME . "_analytics",
	// 	"title"   => __( 'Google analytics', 'theme_name' ),
	// 	"desc"    => __( 'Copy paste your own code Google analytics', 'theme_name' ),
	// 	"type"    => "textarea",
	// 	"std"     => ""
	// );

	// $options[] = array(
	// 	"section" => "txtarea_section",
	// 	"id"      => PRESSTIGE_SHORTNAME . "_copy",
	// 	"title"   => __( 'Copyright', 'theme_name' ),
	// 	"desc"    => __( 'A textarea for a block of text in the footer. 
	// 	Only some inline HTML 
	// 	(&lt;a&gt;, &lt;b&gt;, &lt;em&gt;, &lt;strong&gt;, &lt;abbr&gt;, &lt;acronym&gt;, &lt;blockquote&gt;, &lt;cite&gt;, &lt;code&gt;, &lt;del&gt;, &lt;q&gt;, &lt;strike&gt;)  
	// 	is allowed!', 'theme_name' ),
	// 	"type"    => "textarea",
	// 	"std"     => "",
	// 	"class"   => "inlinehtml"
	// );	
	
	// Select Form Fields section	
	// $options[] = array(
	// 	"section" => "select_section",
	// 	"id"      => PRESSTIGE_SHORTNAME . "_select2_input",
	// 	"title"   => __( 'Select (type two)', 'theme_name' ),
	// 	"desc"    => __( 'A select field with a label for the option and a corresponding value.', 'theme_name' ),
	// 	"type"    => "select2",
	// 	"std"    => "",
	// 	"choices" => array( __('Option 1','theme_name') . "|opt1", __('Option 2','theme_name') . "|opt2", __('Option 3','theme_name') . "|opt3", __('Option 4','theme_name') . "|opt4")
	// );
	
	// Checkbox Form Fields section
	$options[] = array(
		"section" => "maintenance_section",
		"id"      => PRESSTIGE_SHORTNAME . "_maintenance",
		"title"   => __( 'Website in maintenance', 'theme_name' ),
		"desc"    => __( 'Check this box if you want to hide your website.', 'theme_name' ),
		"type"    => "checkbox",
		"std"     => 1 // 0 for off
	);
	
	// $options[] = array(
	// 	"section" => "checkbox_section",
	// 	"id"      => PRESSTIGE_SHORTNAME . "_multicheckbox_inputs",
	// 	"title"   => __( 'Multi-Checkbox', 'theme_name' ),
	// 	"desc"    => __( 'Some Description', 'theme_name' ),
	// 	"type"    => "multi-checkbox",
	// 	"std"     => '',
	// 	"choices" => array( __('Checkbox 1','theme_name') . "|chckbx1", __('Checkbox 2','theme_name') . "|chckbx2", __('Checkbox 3','theme_name') . "|chckbx3", __('Checkbox 4','theme_name') . "|chckbx4")	
	// );

	// File Form Fields section
	// $options[] = array(
	// 	"section" => "files_section",
	// 	"id"      => PRESSTIGE_SHORTNAME . "_favicon",
	// 	"title"   => __( 'Favicon', 'theme_name' ),
	// 	"desc"    => __( 'Upload your favicon', 'theme_name' ),
	// 	"type"    => "file"
	// );
	
	return $options;	
}

/**
 * Contextual Help
 */
function presstige_options_page_contextual_help() {
	
	$text 	= "<h3>" . __('Presstige Settings - Contextual Help','theme_name') . "</h3>";
	$text 	.= "<p>" . __('Contextual help goes here. You may want to use different html elements to format your text as you want.','theme_name') . "</p>";
	
	// return text
	return $text;
} ?>