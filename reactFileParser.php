<?php

function dcf_getExtension($file){
	$array = explode('.', $file);
	return $extension = end($array);
}	

function dcf_retrieve_files_from_directory($dir,$ext){
	
	$base_path="../wp-content/plugins/DovetailLocalGovernment/admin/build/static/";
	$reactFiles=scandir($base_path.$dir);
	
	$toLoad=array();
	foreach($reactFiles as $f){
		if(dcf_getExtension($f)==$ext){
				array_push($toLoad, $f);
		}	
	}	

	return($toLoad);

}	

function dcf_sort_JS($js_files){
	
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

function dcf_get_react_files(){
	
	$filesToLoad=array();
	$filesToLoad["css"]=dcf_retrieve_files_from_directory("css","css");
	
	$js_files=dcf_retrieve_files_from_directory("js", "js");
	$filesToLoad["js"]=dcf_sort_JS($js_files);
	
	echo "<pre>";
	print_r($filesToLoad);
	echo "</pre>";

}	

?>