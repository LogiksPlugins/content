<?php
if(!defined('ROOT')) exit('No direct script access allowed');

include_once __DIR__."/api.php";

$defaultParams=["lang"=>"en","slug"=>""];
if(isset($_ENV['MODULECONFIG'])) {
  if(isset($_ENV['MODULECONFIG']['content'])) {
    $params=array_merge($defaultParams,$_ENV['MODULECONFIG']['content']);
    
    echo getContentHTML($params['slug'],$params['lang']);
  }
} elseif(isset($_ENV['content'])) {
  $params=array_merge($defaultParams,$_ENV['content']);
  
  echo getContentHTML($params['slug'],$params['lang']);
}
?>