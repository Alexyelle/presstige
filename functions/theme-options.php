<?php
/* based on http://ottopress.com/2009/wordpress-settings-api-tutorial/ */
if ( is_admin() ){
	add_action( 'admin_menu', 'theme_options_add_page' );
}
/**
 * Load up the menu page
 */
function theme_options_add_page() {
	add_theme_page( 
		__( 'Theme Options', 'presstige' ), // Title for the page
		__( 'Theme Options', 'presstige' ), //  Page name in admin menu
		'edit_theme_options', //  Minimum role required to see the page
		'theme_options_page', // unique identifier
		'theme_options_do_page'  // name of function to display the page
	);
	
	add_action( 'admin_init', 'theme_options_settings' );	
}

/**
 * Create the options page
 */

function theme_options_do_page() { 
if (isset($_GET['settings-updated'])){
$is_updated= $_GET['settings-updated'];
if ($is_updated == 'true'){ ?>
	<div id="message" class="updated">
	<p><?php _e('Theme options were successfully updated','presstige') ?></p>
	</div>

<?php }
}
?>

<div class="wrap">

      <h2><?php _e( 'Theme Options', 'presstige' ) ?></h2>  
      
      <?php 
      /*** To debug, use this to print the theme options **/      
      // echo '<pre>';
      // $options = get_option( 'inpixel_theme_settings_options' );
      // print_r($options); 
      // echo '</pre>';      
      ?>
 
      <form method="post" enctype="multipart/form-data" action="options.php">
      		<?php settings_fields( 'inpixel_theme_settings_options' ); ?>
			<?php do_settings_sections('setting_section'); ?>			
			<p>	
			 <input name="inpixel_theme_settings_options[submit]" id="submit_options_form" type="submit" class="button-primary" value="<?php esc_attr_e(__('Save Changes','presstige')); ?>" /></p>	
      </form>
   </div>

<?php
	
}

/**
 * Init plugin options to white list our options
 */
function theme_options_settings(){
	/* Register the Theme settings. */
	register_setting( 
		'inpixel_theme_settings_options',  //$option_group , A settings group name. Must exist prior to the register_setting call. This must match what's called in settings_fields()
		'inpixel_theme_settings_options', // $option_name The name of an option to sanitize and save.
		'theme_options_validate' // $sanitize_callback  A callback function that sanitizes the option's value.
		);

	/** Add a section, you can as many as you like **/
	add_settings_section(
		'theme_option_main', //  section name unique ID
		__( ' ', 'presstige' ), // Title or name of the section (to be output on the page), you can leave nbsp here if not wished to display
		'theme_option_section_text',  // callback to display the content of the section itself
		'setting_section' // The page name. This needs to match the text we gave to the do_settings_sections function call 
		);

	/* Register each option **/	
	add_settings_field(
	 	'file_option', 
	 	__( 'Favicon', 'presstige' ), 
	 	'func_file_option', 
	 	'setting_section',  
	 	'theme_option_main' 
	 	); 
	add_settings_field(
	 	'textfield_option',  //$id a unique id for the field 
	 	__( 'Text field<br />(Useful for twitter, facebook etc..)', 'presstige' ), // the title for the field
	 	'func_textfield_option',  // the function callback, to display the input box
	 	'setting_section',  // the page name that this is attached to (same as the do_settings_sections function call).
	 	'theme_option_main' // the id of the settings section that this goes into (same as the first argument to add_settings_section).
	 	); 
	  add_settings_field(
	 	'maintenance', 
	 	__( 'Website in maintenance', 'presstige' ), 
	 	'func_radio_option', 
	 	'setting_section',  
	 	'theme_option_main' 
	 	); 
	  add_settings_field(
	 	'analytics', 
	 	__( 'Google analytics', 'presstige' ), 
	 	'func_textarea_option', 
	 	'setting_section',  
	 	'theme_option_main' 
	 	); 
		add_settings_field(
	 	'copy', 
	 	__( 'Copyright', 'presstige' ), 
	 	'func_copyright_option', 
	 	'setting_section',  
	 	'theme_option_main' 
	 	);

}

/** the theme section output**/
function theme_option_section_text(){
	//echo '<p>'.__( ' Echo some texte section description here !', 'presstige' ).'</p>';
}

/** Output for all the settings fields added **/
function func_textfield_option(){
/* Get the option value from the database. */
	$options = get_option( 'inpixel_theme_settings_options' );
	$textfield_option = $options['textfield_option'];	
	/* Echo the field. */ ?>
	<input type="text" id="textfield_option" name="inpixel_theme_settings_options[textfield_option]" value="<?php echo esc_attr($textfield_option); ?>" />

<?php }

function func_numeric_option(){
/* Get the option value from the database. */
	$options = get_option( 'inpixel_theme_settings_options' );
	$numeric_option = $options['numeric_option'];
	/* Echo the field. */ ?>
	<input type="text" id="numeric_option" name="inpixel_theme_settings_options[numeric_option]" value="<?php echo esc_attr($numeric_option); ?>" />
<?php }

function func_radio_option() {
	 /* Get the option value from the database. */
	$options = get_option( 'inpixel_theme_settings_options' );
	$maintenance = $options['maintenance'];	
	/* Echo the field. */ ?>
	<label for="maintenance_true" > <?php _e( 'Yes', 'presstige' ); ?></label>
	<input type="radio" <?php if ($maintenance == "true") echo'checked="checked"' ; ?> id="maintenance_true" name="inpixel_theme_settings_options[maintenance]" value="true" /> 
	<label for="maintenance_false" > <?php _e( 'No', 'presstige' ); ?></label>
	<input type="radio" id="maintenance_false" <?php if ($maintenance == "false") echo'checked="checked"' ; ?> name="inpixel_theme_settings_options[maintenance]" value="false" /> 
	<?php
}

function func_textarea_option(){
/* Get the option value from the database. */
	$options = get_option( 'inpixel_theme_settings_options' );
	$analytics = $options['analytics'];	
	/* Echo the field. */ ?>
	<textarea id="analytics" cols="100" rows="10" name="inpixel_theme_settings_options[analytics]"><?php echo esc_textarea($analytics); ?></textarea>	
<?php }


function func_copyright_option(){
/* Get the option value from the database. */
	$options = get_option( 'inpixel_theme_settings_options' );
	$copy = $options['copy'];	
	/* Echo the field. */ ?>
	<textarea id="copy" cols="100" rows="5" name="inpixel_theme_settings_options[copy]"><?php echo esc_textarea($copy); ?></textarea><br />			
	<label class="description" for="copy">
		<?php _e('You can use HTML tags here.', 'presstige'); ?>
	</label>			
<?php }


function func_checkbox_option(){
/* Get the option value from the database. */
	$options = get_option( 'inpixel_theme_settings_options' );
	$checkbox_option = $options['checkbox_option'];	
	/* Echo the field. */ ?>
	<label class="description" for="checkbox_one"><?php _e( 'Sample checkbox', 'presstige' ); ?></label>
	<input id="checkbox_one" name="inpixel_theme_settings_options[checkbox_option]" type="checkbox" value="1" <?php if ($checkbox_option == "1") echo'checked="checked"' ; ?> />
<?php }

function func_file_option(){
		/* Favicon */
		$options = get_option( 'inpixel_theme_settings_options' );
		$file_option = $options['file_option'];		
		?>
		<input id="favicon" name="favicon" type="file" />
		<label for="favicon"><img height='16' src='<?php echo $options['favicon']; ?>' /> <?php _e( '(preferably .ico)', 'presstige' ); ?></label>
		 <?php if ( '' != $options['favicon'] ): ?> 
            <input id="delete_favicon_button" name="inpixel_theme_settings_options[delete_favicon]" type="submit" class="button-primary" value="<?php _e( 'Delete Favicon', 'presstige' ); ?>" />  
        <?php endif; ?>
<?php }

function delete_image( $image_url ) {  
        global $wpdb;  
        // We need to get the image's meta ID.  
        $query = "SELECT ID FROM wp_posts where guid = '" . esc_url($image_url) . "' AND post_type = 'attachment'";  
        $results = $wpdb->get_results($query);  
        // And delete it  
        foreach ( $results as $row ) {  
            wp_delete_attachment( $row->ID );  
        }  
    }  

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */

function theme_options_validate( $input ) {

$options = get_option( 'inpixel_theme_settings_options' );
$submit = ! empty($input['submit']) ? true : false;  
$delete_favicon =! empty($input['delete_favicon']) ? true : false; 

// favicon
if ($_FILES['favicon']['size'] > 0) {
    $overrides = array('test_form' => false); 
    $file = wp_handle_upload($_FILES['favicon'], $overrides);
    $input['favicon'] = $file['url'];
	$options['favicon'] = $input['favicon'];
}

/** clean text field, no HTML allowed or it won't update settings */
$options['textfield_option'] = wp_filter_nohtml_kses($input['textfield_option'] );
if ( $delete_favicon ) { 
	$options['favicon'] = $input['favicon']; 
    delete_image( $options['favicon'] );  
    $options['favicon'] = '';  
} 

/** validate only numbers 
$options['numeric_option'] = wp_filter_nohtml_kses( intval( $input['numeric_option'] ) );*/

/** validation radio buttons **/
$options['maintenance'] = $input['maintenance'];

// Our radio option must actually be in our array of radio options
if ( ! isset( $input['maintenance'] ) )
	$input['maintenance'] = null;
if ( ! array_key_exists( $input['maintenance'], $maintenance) )
	$input['maintenance'] = null;

/** validate textareas **/
// $options['analytics'] = wp_filter_nohtml_kses($input['analytics'] );
$options['analytics'] = $input['analytics'];
$options['copy'] = $input['copy'];

/** validate checkboxes 
$options['checkbox_option'] = $input['checkbox_option'];
if ( ! isset( $input['checkbox_option'] ) )
	$input['checkbox_option'] = null;
if ( ! array_key_exists( $input['checkbox_option'], $checkbox_option) )
	$input['checkbox_option'] = null;**/

return $options;
}