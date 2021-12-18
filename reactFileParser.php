<?php
/* Retrieve files stored in build folder */

class DLG_ReactFileParser {
	
	public $filesToLoad=array();
	
	function __construct() {
		$this->filesToLoad["css"]=$this->retrieve_files_from_directory("css","css");
		
		$js_files=$this->retrieve_files_from_directory("js", "js");
		$this->filesToLoad["js"]=$this->sort_JS($js_files);
			
		//add_action( 'admin_enqueue_scripts', 'enqueue_admin' );	
	}

	function getExtension($file){
		$array = explode('.', $file);
		return $extension = end($array);
	}	

	function retrieve_files_from_directory($dir,$ext){
		
		$wpContentDirectory=basename( plugin_dir_path(  dirname( __FILE__ , 2 ) ) );

		$base_path=WP_CONTENT_DIR."/plugins/wp-admin-ajax-master/admin/build/static/";
		$LoadBase=site_url()."/".$wpContentDirectory."/plugins/wp-admin-ajax-master/admin/build/static/".$dir."/";
		$reactFiles=scandir($base_path.$dir);
		
		$toLoad=array();
		foreach($reactFiles as $f){
			if($this->getExtension($f)==$ext){
				$filePath=$LoadBase.$f;
				array_push($toLoad, $filePath);
			}	
		}	

		return($toLoad);

	}	

	function sort_JS($js_files){
		
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

}

?>