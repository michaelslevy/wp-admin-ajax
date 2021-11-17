<?php

// create custom plugin settings menu
add_action('admin_menu', 'DLG_create_menu');

function DLG_create_menu() {

	//create new top-level menu
	add_menu_page('Local Government Settings', 'Local Governement Settings', 'administrator', __FILE__, 'DLG_settings_page' , "dashicons-groups" );

	//call register settings function
	add_action( 'admin_init', 'register_DLG_settings' );
}


function register_DLG_settings() {
	//register our settings
	register_setting( 'DLG-settings-group', 'new_option_name' );
	register_setting( 'DLG-settings-group', 'some_other_option' );
	register_setting( 'DLG-settings-group', 'option_etc' );
}


function DLG_settings_page() {
		
	dcf_get_react_files();
	
?>
<div class="wrap">
<h1>Your Plugin Name</h1>

<form method="post" action="options.php">
    <?php settings_fields( 'DLG-settings-group' ); ?>
    <?php do_settings_sections( 'DLG-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">New Option Name</th>
        <td><input type="text" name="new_option_name" value="<?php echo esc_attr( get_option('new_option_name') ); ?>" /></td>
        </tr>
         
        <tr valign="top">
        <th scope="row">Some Other Option</th>
        <td><input type="text" name="some_other_option" value="<?php echo esc_attr( get_option('some_other_option') ); ?>" /></td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Options, Etc.</th>
        <td><input type="text" name="option_etc" value="<?php echo esc_attr( get_option('option_etc') ); ?>" /></td>
        </tr>
    </table>
    
    <?php submit_button(); ?>

</form>
</div>
<?php } ?>