<?php
               /*
	 * 	Developped by Bart Bosma
	 *	Released under GPL license
	 */
	
	$__wp=$___workpath;
$___workpath=$workpathios[0]."globals/";

$depend["machine_lang"]=false;

startfunct($depend);
$depend=array();
$___workpath=$__wp;


if (!function_exists("ele_content")){
      function ele_content($klikit){
global $_l_cssfilter, $quick_ele_counter;
if (isset($quick_ele_counter)){
$quick_ele_counter++;
}else{
$quick_ele_counter=0;}
if ($quick_ele_counter==1){
	if (isset($_GET['ele'])){
	  $fromthis=html_entity_decode($_GET['ele']);
	  if (!isset($klikit[html_entity_decode($_GET['cat'])])){
	    $klikit[html_entity_decode($_GET['cat'])]='';}
	  if (!isset($klikit[html_entity_decode($_GET['cat'])][$fromthis])){
	    $klikit[html_entity_decode($_GET['cat'])][$fromthis]='';}
	  if (isset($_GET) && isset($_GET['fn']) && strlen($_GET['fn'])>0){
		if ($GLOBALS['skip_css_specific']==false){  
	    $arr[0]=array(";", ",", ":", ";\n;\n");
	    $arr[1]=array(";\n", ", ", ": ", ";\n");
		}else{$arr[0]='';$arr[1]='';}
	  }else{$arr[0]='';$arr[1]='';}

#		echo "<pre>";print_r($klikit);die();
if ($_l_cssfilter==false || count($_l_cssfilter)< 1 || 
!function_exists("machine_lang") || isset($_COOKIE['translate_editfield']) && $_COOKIE['translate_editfield']!="on"){   
  $return= htmlentities(str_replace($arr[0], $arr[1], $klikit[html_entity_decode($_GET['cat'])][$fromthis]));
	}else{
  $return= htmlentities(machine_lang(html_entity_decode(str_replace($arr[0], $arr[1], $klikit[html_entity_decode($_GET['cat'])][$fromthis])), $GLOBALS['_l_cssfilter']));
		}
		}
#	echo "<pre>";print_r($return);die();
	return $return;
    }return "";
}}
		
		?>