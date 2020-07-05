<?php
if(!defined('ROOT')) exit('No direct script access allowed');

if(!function_exists("getContent")) {
  function getContent($slugID,$lang="en") {
		$slugID=explode(".",$slugID);
		if(count($slugID)>0) {
			$category=$slugID[0];
			$slugID=$slugID[1];
		} else {
			$slugID=$slugID[0];
			$category="";
		}
		
		if($lang=="en" || strlen($lang)<=0) {
			$sql=_db()->_selectQ(_dbTable("contents"),"id,slug,title,category,tags,vers,lang,blocked,published,published_on,published_by,created_by,created_on,edited_by,edited_on,text_published as txt")
							->_where(["category"=>$category])
							->_whereOR("slug",[$slugID,"{$slugID}_{$lang}"]);
		} else {
			$sql=_db()->_selectQ(_dbTable("contents"),"id,slug,title,category,tags,vers,lang,blocked,published,published_on,published_by,created_by,created_on,edited_by,edited_on,text_published as txt")
							->_where(["category"=>$category])
							->_whereOR("slug",["{$slugID}_{$lang}"]);
		}
		
		$data=$sql->_GET();
		
    if(isset($data[0])) return $data[0];
    else return false;
  }
  
  function getContentHTML($slugID,$lang="en") {
		$slugID=explode(".",$slugID);
		if(count($slugID)>1) {
			$category=$slugID[0];
			$slugID=$slugID[1];
		} else {
			$slugID=$slugID[0];
			$category="";
		}
		if($lang=="en" || strlen($lang)<=0) {
			$sql=_db()->_selectQ(_dbTable("contents"),"text_published as txt")
							->_where(["category"=>$category])
							->_whereOR("slug",[$slugID,"{$slugID}_{$lang}"]);
		} else {
			$sql=_db()->_selectQ(_dbTable("contents"),"text_published as txt")
							->_where(["category"=>$category])
							->_whereOR("slug",["{$slugID}_{$lang}"]);
		}
		
    $data=$sql->_GET();
    
    if(isset($data[0])) {
    	$textContent = $data[0]['txt'];

    	$textContent=str_replace("\\r\\n","\n",$textContent);
		$textContent=str_replace("\\n","\n",$textContent);
		$textContent=str_replace("&amp%3B","&amp;",$textContent);
		$textContent=str_replace("%3B","",$textContent);
		
		//$textContent=stripslashes($textContent);

    	return $textContent;
    }
    else return "";
  }
  function getContentDraft($slugID,$lang="en") {
		$slugID=explode(".",$slugID);
		if(count($slugID)>0) {
			$category=$slugID[0];
			$slugID=$slugID[1];
		} else {
			$slugID=$slugID[0];
			$category="";
		}
		if($lang=="en" || strlen($lang)<=0) {
			$sql=_db()->_selectQ(_dbTable("contents"),"text_draft as txt")
							->_where(["category"=>$category])
							->_whereOR("slug",[$slugID,"{$slugID}_{$lang}"]);
		} else {
			$sql=_db()->_selectQ(_dbTable("contents"),"text_draft as txt")
							->_where(["category"=>$category])
							->_whereOR("slug",["{$slugID}_{$lang}"]);
		}
		
		$data=$sql->_GET();
		
    if(isset($data[0])) {
    	$textContent = $data[0]['txt'];

    	$textContent=str_replace("\\r\\n","\n",$textContent);
		$textContent=str_replace("\\n","\n",$textContent);
		$textContent=str_replace("&amp%3B","&amp;",$textContent);
		$textContent=str_replace("%3B","",$textContent);
		
		//$textContent=stripslashes($textContent);

    	return $textContent;
    }
    else return "";
  }
}
?>