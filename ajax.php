<?php

/* Place Ajax Url in the Footer */
add_action( 'admin_enqueue_scripts', 'dlg_enqueue' );
function dlg_enqueue($hook) {
    if( 'index.php' != $hook ) {
	// Only applies to dashboard panel
	return;
    }
        
	wp_enqueue_script( 'ajax-script', plugins_url( '/js/my_query.js', __FILE__ ), array('jquery') );

	// in JavaScript, object properties are accessed as ajax_object.ajax_url
	wp_localize_script( 'ajax-script', 'ajax_object',
            array( 'ajax_url' => admin_url( 'admin-ajax.php' )) );
}

/* Ajax to load value */
add_action( 'wp_ajax_dlg_load_option', 'dlg_load_option' );
function dlg_load_option() {
	global $wpdb;
	echo get_option("new_option_name");
	wp_die();
}

/* Ajax to save value */
add_action( 'wp_ajax_DLG_save_option', 'DLG_save_option' );
function DLG_save_option() {
	global $wpdb;
	$new_option_name = sanitize_text_field( $_POST['new_option_name'] );
	update_option("new_option_name", $new_option_name);
	echo 1;
	wp_die();
}

?>