<?php

function dlg_getExtension($file){
	$array = explode('.', $file);
	return $extension = end($array);
}	

function dlg_retrieve_files_from_directory($dir,$ext){
	
	$base_path="../wp-content/plugins/DovetailLocalGovernment/admin/build/static/";
	$reactFiles=scandir($base_path.$dir);
	
	$toLoad=array();
	foreach($reactFiles as $f){
		if(dlg_getExtension($f)==$ext){
				array_push($toLoad, $f);
		}	
	}	

	return($toLoad);

}	

function dlg_sort_JS($js_files){
	
	$js=array( "vendor"=>array());
	foreach($js_files as $j){
		if(strpos($j,"runtime-main")!==false){
			$js["runtime"]=$j;
		} else if(strpos($j,"main")!==false){
			$js["main"]=$j;
		} else {
			array_push($js["vendor"],$j);
		}
	}	
	return $js;
}	

function dlg_enqueue_admin( $hook ) {
	
	//echo $hook;
    if ( 'toplevel_page_DovetailLocalGovernment/settingsPage' == $hook ) {
		wp_enqueue_script( 'my_custom_script', plugin_dir_url( __FILE__ ) . 'myscript.js', array(), '1.0' );
	 
    }
    
}
add_action( 'admin_enqueue_scripts', 'dlg_enqueue_admin' );

function dlg_get_react_files(){
	
	$filesToLoad=array();
	$filesToLoad["css"]=dlg_retrieve_files_from_directory("css","css");
	
	$js_files=dlg_retrieve_files_from_directory("js", "js");
	$filesToLoad["js"]=dlg_sort_JS($js_files);

}	

?>