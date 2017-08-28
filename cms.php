<?php
if(!defined('ROOT')) exit('No direct script access allowed');

if(Database::checkConnection()<=1) {
	print_error("Sorry, DB Connection required for Content Module");
	return;
}

$dbTable=_db()->get_table("contents");
$dbTableList=_db()->get_tableList();

if(in_array($dbTable,$dbTableList)) {
	loadModule("pages");

	function pageSidebar() {
		// <form role='search'>
		//     <div class='form-group'>
		//       <input type='text' class='form-control' placeholder='Search'>
		//     </div>
		// </form>
		return "<div id='componentTree' class='componentTree list-group list-group-root well'></div>";
	}
	function pageContentArea() {
		return "<div id='componentSpace' class='componentSpace'><h2 align=center>Please load a content.</h2></div>
	<script>
	FORSITE='{$_REQUEST["forsite"]}';
	</script>
		";
	}
	
	$webPath=dirname(getWebPath(__FILE__))."/";
	
	echo '<link rel="stylesheet" href="'.$webPath.'simplemde/simplemde.min.css" />';
	echo '<script src="'.$webPath.'simplemde/simplemde.min.js"></script>';
	
	echo _css("content");
	echo _js("content");
	
	printPageComponent(false,[
			"toolbar"=>[
				"loadEditorComponent"=>["title"=>"Editor","align"=>"right"],
				"loadInfoComponent"=>["title"=>"About","align"=>"right"],
				"loadPreviewComponent"=>["title"=>"Preview","align"=>"right"],

				// ["title"=>"Search Site","type"=>"search","align"=>"left"]
				"listContent"=>["icon"=>"<i class='fa fa-refresh'></i>"],
				"createContent"=>["icon"=>"<i class='fa fa-plus'></i>","tips"=>"Create New"],
				//"openExternal"=>["icon"=>"<i class='fa fa-external-link'></i>","class"=>"onsidebarSelect"],
				//"preview"=>["icon"=>"<i class='fa fa-eye'></i>","class"=>"onsidebarSelect onOnlyOneSelect","tips"=>"Preview Content"],
				['type'=>"bar"],
				//"rename"=>["icon"=>"<i class='fa fa-terminal'></i>","class"=>"onsidebarSelect onOnlyOneSelect","tips"=>"Rename Content"],
				"deleteContent"=>["icon"=>"<i class='fa fa-trash'></i>","class"=>"onsidebarSelect"],
			],
			"sidebar"=>"pageSidebar",
			"contentArea"=>"pageContentArea"
		]);
} else {
	print_error("Sorry, the plugin is not properly installed.</h1><h5 class='errorMsg'>Please visit Plugin Manager for further details.");
}
?>