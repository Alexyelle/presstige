<?php
/**
 * Define our settings sections
 *
 * array key=$id, array value=$title in: add_settings_section( $id, $title, $callback, $page );
 * @return array
 */
function presstige_options_page_sections() {
	
	$sections = array();
	// $sections[$id] 				= __($title, 'presstige');
	$sections['txt_section'] 		= __('Text Form Fields', 'presstige');
	$sections['txtarea_section'] 	= __('Textarea Form Fields', 'presstige');
	$sections['checkbox_section'] 	= __('Checkbox Form Fields', 'presstige');
	$sections['files_section'] 	= __('Files Form Fields', 'presstige');
	
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
		"section" => "txt_section",
		"id"      => PRESSTIGE_SHORTNAME . "_icon_social",
		"title"   => __( 'Social icons', 'presstige' ),
		"desc"    => __( 'Social icons url', 'presstige' ),
		"type"    => "multi-text",
		"choices" => array( __('Facebook URL','presstige') . "|txt_input1", __('Twitter URL','presstige') . "|txt_input2", __('Google Plus','presstige') . "|txt_input3", __('Linkedin','presstige') . "|txt_input4"),
		"std"     => ""
	);
	
	// Textarea Form Fields section
	$options[] = array(
		"section" => "txtarea_section",
		"id"      => PRESSTIGE_SHORTNAME . "_analytics",
		"title"   => __( 'Google analytics', 'presstige' ),
		"desc"    => __( 'Copy paste your own code Google analytics', 'presstige' ),
		"type"    => "textarea",
		"std"     => ""
	);

	$options[] = array(
		"section" => "txtarea_section",
		"id"      => PRESSTIGE_SHORTNAME . "_copy",
		"title"   => __( 'Copyright', 'presstige' ),
		"desc"    => __( 'A textarea for a block of text in the footer. 
		Only some inline HTML 
		(&lt;a&gt;, &lt;b&gt;, &lt;em&gt;, &lt;strong&gt;, &lt;abbr&gt;, &lt;acronym&gt;, &lt;blockquote&gt;, &lt;cite&gt;, &lt;code&gt;, &lt;del&gt;, &lt;q&gt;, &lt;strike&gt;)  
		is allowed!', 'presstige' ),
		"type"    => "textarea",
		"std"     => "",
		"class"   => "inlinehtml"
	);	
	
	// Select Form Fields section	
	// $options[] = array(
	// 	"section" => "select_section",
	// 	"id"      => PRESSTIGE_SHORTNAME . "_select2_input",
	// 	"title"   => __( 'Select (type two)', 'presstige' ),
	// 	"desc"    => __( 'A select field with a label for the option and a corresponding value.', 'presstige' ),
	// 	"type"    => "select2",
	// 	"std"    => "",
	// 	"choices" => array( __('Option 1','presstige') . "|opt1", __('Option 2','presstige') . "|opt2", __('Option 3','presstige') . "|opt3", __('Option 4','presstige') . "|opt4")
	// );
	
	// Checkbox Form Fields section
	$options[] = array(
		"section" => "checkbox_section",
		"id"      => PRESSTIGE_SHORTNAME . "_maintenance",
		"title"   => __( 'Website in maintenance', 'presstige' ),
		"desc"    => __( 'Check this box if you want to hide your website.', 'presstige' ),
		"type"    => "checkbox",
		"std"     => 1 // 0 for off
	);
	
	// $options[] = array(
	// 	"section" => "checkbox_section",
	// 	"id"      => PRESSTIGE_SHORTNAME . "_multicheckbox_inputs",
	// 	"title"   => __( 'Multi-Checkbox', 'presstige' ),
	// 	"desc"    => __( 'Some Description', 'presstige' ),
	// 	"type"    => "multi-checkbox",
	// 	"std"     => '',
	// 	"choices" => array( __('Checkbox 1','presstige') . "|chckbx1", __('Checkbox 2','presstige') . "|chckbx2", __('Checkbox 3','presstige') . "|chckbx3", __('Checkbox 4','presstige') . "|chckbx4")	
	// );

	// File Form Fields section
	$options[] = array(
		"section" => "files_section",
		"id"      => PRESSTIGE_SHORTNAME . "_favicon",
		"title"   => __( 'Favicon', 'presstige' ),
		"desc"    => __( 'Upload your favicon', 'presstige' ),
		"type"    => "file"
	);
	
	return $options;	
}

/**
 * Contextual Help
 */
function presstige_options_page_contextual_help() {
	
	$text 	= "<h3>" . __('Presstige Settings - Contextual Help','presstige') . "</h3>";
	$text 	.= "<p>" . __('Contextual help goes here. You may want to use different html elements to format your text as you want.','presstige') . "</p>";
	
	// return text
	return $text;
} ?>