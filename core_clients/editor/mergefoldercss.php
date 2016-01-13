<?php
$scrext=".php";
$__the_cwd=getcwd();
chdir ("../../");

#start core html object manager functions with funct loader
$___workpath=getcwd()."/fc/client/";
include $___workpath."init".$scrext;

#start  css parser with funct loader( for loading (config) files written in css code, to php array)
$___workpath=getcwd()."/fc/parser/css/";
include $___workpath."init".$scrext;

include "fc/globals/writefile.php";
include "fc/globals/createsuffix.php";
include "fc/globals/filesystemcode.php";

$fd=html_entity_decode($_GET['fd']);
if ($fd{strlen($fd)}!="/"){
  $fd.="/";}
if (!is_dir($fd)){
  if (is_dir("fc/".$fd)){
    chdir ("fc/");
  }else{
    chdir("../");}}
chdir($fd);

$dh=opendir("./");
    while (false !== ($filename = readdir($dh))){
      if ($filename!=".." && $filename!="." 
	 && is_file($filename)  && $filename!="" 
	 && stristr($filename,  filesystemcode($_GET['filename'], "b", "c"))!== FALSE
	  ){
		  
		$arr[]=$filename;  
		
		
		}}
				    closedir($dh);
					
					
					
if (is_array($arr) && count($arr)>0){

if (count($arr)>1) {
	$arr=natsort($arr);}
	foreach ($arr as $lal){
	$arrx[]=parse_css(file_get_contents($lal), true);
	}
	$dullcounter=0;
if (is_array($arrx) && count($arrx)>0){
	foreach ($arrx as $lal) {
		if ($dullcounter==0){
			$array1=$lal;}
			else{
				$array2=$lal;
				$array1=mergecss($array1, $array2);}
		$dullcounter++;}}

$current_ext="css";
$getname=createsuffix("merged_", $current_ext);
writefile($array1, $getname, piecele($langcss["1"], $current_ext), $_cfg['global'], $__the_cwd."/fc/parser/css/write/css.php");
echo "wrote ".getcwd()."/".$getname;
}else{ echo "no input (looking in ".getcwd().")";}
?>
