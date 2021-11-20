<?php
/* WP Codex for adding an options page: https://codex.wordpress.org/Creating_Options_Pages */

/* Enqueue files required for react 
*  see: https://create-react-app.dev/docs/production-build/
*/
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
			
?>
<div class="wrap">
<h1>Your Plugin Name</h1>

<form method="post" action="options.php">
    <?php settings_fields( 'DLG-settings-group' ); ?>
    <?php do_settings_sections( 'DLG-settings-group' ); ?>
	
	<? //Root div added to load React application ?>
	<div id="root"></div>

</form>
</div>
<?php } ?>