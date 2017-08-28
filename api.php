<?php
if(!defined('ROOT')) exit('No direct script access allowed');

if(!function_exists("getContent")) {
  function getContent($slugID) {
    $data=_db()->_selectQ(_dbTable("contents"),"id,slug,title,category,tags,vers,blocked,published,published_on,published_by,created_by,created_on,edited_by,edited_on,text_published as txt")
							->_where(["slug"=>$slugID])->_GET();
    if(isset($data[0])) return $data[0];
    else return false;
  }
  
  function getContentHTML($slugID) {
    $data=_db()->_selectQ(_dbTable("contents"),"text_published as txt")
							->_where(["slug"=>$slugID])->_GET();
    
    if(isset($data[0])) return $data[0]['txt'];
    else return "";
  }
  function getContentDraft($slugID) {
    $data=_db()->_selectQ(_dbTable("contents"),"text_draft as txt")
							->_where(["slug"=>$slugID])->_GET();
    if(isset($data[0])) return $data[0]['txt'];
    else return "";
  }
}
?>