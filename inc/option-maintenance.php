<?php
/**
 * Page maintenance
 */
function load_page_wait() { 
	$options = get_option( 'maintenance_option' );
	$maintenance = $options['maintenance_field'];
	if ( $maintenance == "enable"){
		$isLoginPage = strpos($_SERVER['REQUEST_URI'], "wp-login.php") !== false;
		$adminPage = strpos($_SERVER['REQUEST_URI'], "wp-admin") !== false;
		if($maintenance && !is_user_logged_in() && !$isLoginPage && !$adminPage) {
			include('page-maintenance.php');
			exit();	
		}
	}
}
add_action('init','load_page_wait');

/**
 * @internal never define functions inside callbacks.
 * these functions could be run multiple times; this would result in a fatal error.
 * https://developer.wordpress.org/plugins/settings/custom-settings-page/
 */
 
/**
 * custom option and settings
 */
function maintenance_settings_init() {
 // register a new setting for "maintenance" page
 register_setting( 'maintenance', 'maintenance_option' );
 
 // register a new section in the "maintenance" page
 add_settings_section(
 'maintenance_section_developers',
 __( ''),
 'maintenance_section_developers_cb',
 'maintenance'
 );
 
 // register a new field in the "maintenance_section_developers" section, inside the "maintenance" page
 add_settings_field(
 'maintenance_field', // as of WP 4.6 this value is used only internally
 // use $args' label_for to populate the id inside the callback
 __( 'Mode'),
 'maintenance_field_cb',
 'maintenance',
 'maintenance_section_developers',
 [
 'label_for' => 'maintenance_field'
 ]
 );
}
 
/**
 * register our maintenance_settings_init to the admin_init action hook
 */
add_action( 'admin_init', 'maintenance_settings_init' );
 
/**
 * custom option and settings:
 * callback functions
 */

// developers section cb
 
// section callbacks can accept an $args parameter, which is an array.
// $args have the following keys defined: title, id, callback.
// the values are defined at the add_settings_section() function.
function maintenance_section_developers_cb( $args ) {
 ?>
 <p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Vous pouvez mettre le site en maintenance.' ); ?></p>
 <?php
}
 
// pill field cb
 
// field callbacks can accept an $args parameter, which is an array.
// $args is defined at the add_settings_field() function.
// wordpress has magic interaction with the following keys: label_for, class.
// the "label_for" key value is used for the "for" attribute of the <label>.
// the "class" key value is used for the "class" attribute of the <tr> containing the field.
// you can add custom key value pairs to be used inside your callbacks.
function maintenance_field_cb( $args ) {
 // get the value of the setting we've registered with register_setting()
 $options = get_option( 'maintenance_option' );
 // output the field
 ?>
 <select id="<?php echo esc_attr( $args['label_for'] ); ?>" 
 data-custom="<?php echo esc_attr( $args['wporg_custom_data'] ); ?>"
 name="maintenance_option[<?php echo esc_attr( $args['label_for'] ); ?>]"
 >
 <option value="disable" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'disable', false ) ) : ( '' ); ?>>
 <?php esc_html_e( 'désactivé'); ?>
 </option>
 <option value="enable" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'enable', false ) ) : ( '' ); ?>>
 <?php esc_html_e( 'activé' ); ?>
 </option>
 </select>
 <?php
}
 
/**
 * top level menu
 */
function maintenance_options_page() {
 // add top level menu page
 add_menu_page(
 'Option maintenance',
 'Maintenance',
 'manage_options',
 'maintenance',
 'maintenance_options_page_html'
 );
}
 
/**
 * register our maintenance_options_page to the admin_menu action hook
 */
add_action( 'admin_menu', 'maintenance_options_page' );
 
/**
 * top level menu:
 * callback functions
 */
function maintenance_options_page_html() {
 // check user capabilities
 if ( ! current_user_can( 'manage_options' ) ) {
 return;
 }
 
 // add error/update messages
 
 // check if the user have submitted the settings
 // wordpress will add the "settings-updated" $_GET parameter to the url
 if ( isset( $_GET['settings-updated'] ) ) {
 // add settings saved message with the class of "updated"
 add_settings_error( 'maintenance_messages', 'maintenance_message', __( 'Option sauvegardée' ), 'updated' );
 }
 
 // show error/update messages
 settings_errors( 'maintenance_messages' );
 ?>
 <div class="wrap">
 <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
 <form action="options.php" method="post">
 <?php
 // output security fields for the registered setting "wporg"
 settings_fields( 'maintenance' );
 // output setting sections and their fields
 // (sections are registered for "wporg", each field is registered to a specific section)
 do_settings_sections( 'maintenance' );
 // output save settings button
 submit_button( 'Sauvegarder' );
 ?>
 </form>
 </div>
 <?php
}