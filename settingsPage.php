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

add_action( 'admin_enqueue_scripts', 'enqueue_admin' );	
function enqueue_admin( $hook ) {
	
	$reactFileParser=new DLG_ReactFileParser();
	$files=$reactFileParser->filesToLoad;
	$pageHook="toplevel_page_DovetailLocalGovernment/settingsPage";

	if ( $pageHook == $hook ) {
		
		for($x=0; $x<count($files["css"]); $x++){
			wp_enqueue_style( "DLG-".($x+1), $files["css"][$x], array(), 1.0 );
		}	
		
		wp_enqueue_script( 'DLG-Runtime',$files["js"]["runtime"], array(), '1.0', false );
		wp_enqueue_script( 'DLG-Main',$files["js"]["main"], array("DLG-Runtime"), '1.0' , true);
		for($x=0; $x<count($files["js"]["vendor"]); $x++){
			wp_enqueue_script( "DLG-Vendor-".($x+1), $files["js"]["vendor"][$x], array("DLG-Runtime","DLG-Main"), 1.0, true );
		}	
	}
	
}


function DLG_settings_page() {
			
?>
<div class="wrap">
<h1>Your Plugin Name</h1>

<form method="post" action="options.php">
    <?php settings_fields( 'DLG-settings-group' ); ?>
    <?php do_settings_sections( 'DLG-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">New Option Name</th>
        <td><input type="text" id="new_option_name" name="new_option_name" value="<?php echo esc_attr( get_option('new_option_name') ); ?>" /></td>
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
	
	<div id="root"></div>

</form>
</div>
<?php } ?>