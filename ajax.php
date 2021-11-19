<?php
add_action( 'admin_enqueue_scripts', 'my_enqueue' );
function my_enqueue($hook) {
    if( 'index.php' != $hook ) {
	// Only applies to dashboard panel
	return;
    }
        
	wp_enqueue_script( 'ajax-script', plugins_url( '/js/my_query.js', __FILE__ ), array('jquery') );

	// in JavaScript, object properties are accessed as ajax_object.ajax_url, ajax_object.we_value
	wp_localize_script( 'ajax-script', 'ajax_object',
            array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'we_value' => 1234 ) );
}

add_action( 'wp_ajax_dlg_load_option', 'dlg_load_option' );
function dlg_load_option() {
	global $wpdb;
	echo get_option("new_option_name");
	wp_die();
}

add_action( 'wp_ajax_DLG_save_option', 'DLG_save_option' );
function DLG_save_option() {
	global $wpdb;
	$new_option_name = sanitize_file_name( $_POST['new_option_name'] );
	update_option("new_option_name", $new_option_name);
	echo "data saved: $new_option_name";
	wp_die();
}

add_action( 'admin_footer', 'my_action_javascript' ); // Write our JS below here

function my_action_javascript() { ?>
	<script type="text/javascript" >
	jQuery(document).ready(function($) {

		var data = {
			'action': 'dlg_load_option'
		};

		// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		jQuery.post(ajaxurl, data, function(response) {
			alert('Got this from the server: ' + response);
		});
		
		jQuery("#new_option_name").keyup(function(){
			var data = {
				'action': 'DLG_save_option',
				'new_option_name': jQuery("#new_option_name").val()
			};
			
			jQuery.post(ajaxurl, data, function(response) {
				alert('Got this from the server: ' + response);
			})
			
		});
		
		
	});
	</script> <?php
}
?>