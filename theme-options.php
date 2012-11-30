<?php

add_action( 'admin_init', 'theme_options_init' );
add_action( 'admin_menu', 'theme_options_add_page' );

/**
 * Init plugin options to white list our options
 */
function theme_options_init(){
	register_setting( 'presstige_options_set', 'presstige_options', 'presstige_options_validate' );
}

/**
 * Load up the menu page
 */
function theme_options_add_page() {
	add_theme_page( __( 'Options', 'presstige' ), __( 'Options', 'presstige' ), 'edit_theme_options', 'theme_options', 'theme_options_do_page' );
}

/**
 * Create the options page
 */
function theme_options_do_page() {
	global $select_options, $radio_options;

	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;
	?>
	<div class="wrap">
		<?php screen_icon(); echo "<h2>" . get_current_theme() . __( ' options', 'presstige' ) . "</h2>"; ?>

		<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
		<div class="updated fade"><p><strong><?php _e( 'Options saved', 'presstige' ); ?></strong></p></div>
		<?php endif; ?>

      echo '<pre>';
      print_r($presstige_options); 
      echo '</pre>';
		<form method="post" enctype="multipart/form-data" action="options.php">
			<?php settings_fields( 'presstige_options_set' ); ?>
			<?php $options = get_option( 'presstige_options' ); ?>

			<table class="form-table">
			
				<!-- Favicon -->
				<tr valign="top"><th scope="row"><?php _e( 'Favicon', 'presstige' ); ?></th>
					<td>
						<input id="favicon" name="favicon" type="file" />
						<label class="description" for="favicon"><img height='16' src='<?php echo $options['favicon'] ?>' /> (.ico de préférence)</label>
					</td>
				</tr>
				
				<!-- Google Analytics -->
				<tr valign="top"><th scope="row"><?php _e( 'Google analytics code', 'presstige' ); ?></th>
					<td>
						<textarea id="presstige_options[analytics]" class="large-text" cols="50" rows="10" name="presstige_options[analytics]"><?php echo esc_textarea($options['analytics']); ?></textarea>
					</td>
				</tr>
				
				<!-- Maintenance -->
				<tr valign="top"><th scope="row"><?php _e( 'Website in maintenance', 'presstige' ); ?></th>
					<td>
						<input type='checkbox' id="presstige_options[maintenance]" name="presstige_options[maintenance]" <?php if ($options['maintenance']) echo "checked='checked'"; ?> />
					</td>
				</tr>
				<!-- Copyright -->
				<tr valign="top">
					<th scope="row"><?php _e('Copyright text', 'presstige'); ?></th>
					<td>
						<textarea id="presstige_options[copyright_text]" class="large-text" cols="50" rows="10" name="presstige_options[copyright_text]"><?php echo esc_textarea($options['copyright_text']); ?></textarea>
						<label class="description" for="presstige_options[copyright_text]">
							<?php _e('You can use HTML tags here', 'presstige'); ?>
						</label>
					</td>
				</tr>

			   <!-- Twitter -->
				<tr valign="top">
					<th scope="row"><?php _e('Twitter account', 'presstige'); ?></th>
					<td><input type="text" id="presstige_options[twitter_account]"  size="32" name="presstige_options[twitter_account]" value="<?php echo esc_html($options['twitter_account']); ?>" />
						<label class="description" for="presstige_options[twitter_account]">
							<?php _e('Please type here the name of your twitter account, without the @. If not provided, the footer Twitter icon will not be displayed.', 'presstige'); ?>
						</label></td>
				</tr>
			
				<!-- Facebook -->
				<tr valign="top">
					<th scope="row"><?php _e('Facebook account', 'presstige'); ?></th>
					<td><input type="text" id="presstige_options[facebook_account]"  class="large-text" name="presstige_options[facebook_account]" value="<?php echo esc_html($options['facebook_account']); ?>" />
						<label class="description" for="presstige_options[facebook_account]">
							<?php _e('Please type here the URL of your Facebook profile/page. If not provided, the footer Facebook icon will not be displayed.', 'presstige'); ?>
						</label></td>
				</tr>
			</table>

			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e( 'Save settings', 'presstige' ); ?>" />
			</p>
		</form>
	</div>
	<?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function presstige_options_validate($input){

	// analytics
	if (!isset( $input['analytics']))
		$input['analytics'] = '';

	// favicon
    if ($_FILES['favicon']['size'] > 0) {
        $overrides = array('test_form' => false); 
        $file = wp_handle_upload($_FILES['favicon'], $overrides);
        $input['favicon'] = $file['url'];
    }
	else{
		$options = get_option('presstige_options');
		$input['favicon'] = $options['favicon'];
	}
	
	// maintenance
	if (isset( $input['maintenance']))
		$input['maintenance'] = 1;
	else
		$input['maintenance'] = 0;

	return $input;
}

// adapted from http://planetozh.com/blog/2009/05/handling-plugins-options-in-wordpress-28-with-register_setting/