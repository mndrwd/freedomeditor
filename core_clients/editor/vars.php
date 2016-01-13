<?php
# by Bart Bosma Oudehorne 2008
#*	Released under GPL license
#include("browsers".$scrext);


#create $filename from GET_fn
if (isset($_GET) && isset($_GET['fn'])&&strlen($_GET['fn'])>0){
  $filename=$_GET['fn'];
	}
#end

$noext=0;

#echo html_entity_decode($_GET['fd']);die();

#GET CURRENTLY OPENED FILE EXTENSION AND LINK DETECTED EXTLINK PROPERLY
	 
$current_ext=$_cfg['global']['default_gui'];


if (isset($_GET) && isset($_GET['fn']) && strlen($_GET['fn'])>0){

  if (strstr(html_entity_decode($_GET['fn']), ".")){ #changed nov 17 2008
$tempo=explode('.',html_entity_decode($_GET['fn']));
    $current_ext= end($tempo);
		if ($_cfg['global']['casesensitive_extension_handler']!="on"){
			$current_exti=strtolower($current_ext);}else{$current_exti=$current_ext;}
			if (isset($_cfg['ext_links'][$current_exti])){
	$current_extlink=$_cfg['ext_links'][$current_exti];
	$noext=0;
	}elseif (strlen($_cfg['global']['universal_unlinked_ext_files'])>0){
		$current_extlink=$_cfg['global']['universal_unlinked_ext_files'];
		$noext=1;
}
  

}else{ #checkfldr
$current_extlink=$_cfg['global']['universal_unlinked_ext_files'];
    $noext=1;
  }
#else
#use defaults
#

# choose a working folder
#echo $oldir."/".html_entity_decode($_GET['fd']);
if (isset ($_GET['fd']) && strlen(html_entity_decode($_GET['fd']))>0 && is_dir($oldir."/".html_entity_decode($_GET['fd']))){
	if ($_GET['fd']!="."){
$_cfg['global']['default_request_folder']=html_entity_decode($_GET['fd']);
}else{
	$_cfg['global']['default_request_folder']='';}
	}
	
	if ($noext!=1){
		if ($_cfg['global']['detect_mime']!="none"){
$mime=get_mime_wrap($oldir."/".$_cfg['global']['default_request_folder']."/".html_entity_decode($_GET['fn']));
	}
if ($_cfg['global']['detect_mime']=="partial"){
	if (isset ($_cfg['extlink_mime'][$current_ext]) &&stristr($mime, $_cfg['extlink_mime'][$current_ext])){
		
		if ($noext==1 && stristr($mime, 'text')){
			
				$current_extlink='txt';}

	}else{$invalidmime=1;$_GET['ele']="{lang:invalid_mime/l}: ".$mime;$_GET['fn']='';}
}
		elseif ($_cfg['global']['detect_mime']=="exact"){
			if (isset($_cfg['exlink_mime'][$current_ext]) && $mime==$_cfg['extlink_mime'][$current_ext]){
		}else{$invalidmime=1;$_GET['ele']="{lang:invalid_mime/l}: ".$mime;$_GET['fn']='';}
}
$mime='';
}
		
		
#load overwriting current_extension_config now that we finally got the most likely correct extlink
if (file_exists($__the_cwd."/core_clients/".$_cfg['global']['current_client']."/cfgs/".$current_extlink.".css")){
$arr=parse_css(file_get_contents($__the_cwd."/core_clients/".$_cfg['global']['current_client']."/cfgs/".$current_extlink.".css"), true);
if (isset ($arr) && is_array($arr)){
foreach ($arr['1'] as $a => $b){
  $tmp_cfg[$a]=piecele($arr['1'], $a);}
 }
$_cfg=mergecss($_cfg, $tmp_cfg); 
} 



# final EXTLINK check:
# LETS LINE UP SOME MIMER-ABLE THINGS
if (isset($noext) && $noext==1 && $_cfg['global']['autodetect_ext']=="on"){
$__d0 = dir($oldir."/".$_cfg['global']['default_request_folder']."/");
while (false !== ($entry = $__d0->read())) {

	if (strstr($entry, html_entity_decode($_GET['fn']))){

if ($_cfg['global']['detect_mime']!="none"){
$mime=get_mime_wrap($oldir."/".$_cfg['global']['default_request_folder'])."/".html_entity_decode($_GET['fn']);

	}
if ($_cfg['global']['detect_mime']=="partial"){

	if (isset ($_cfg['extlink_mime'][$current_ext]) &&stristr($mime, $_cfg['extlink_mime'][$current_ext])){
		$matches[]=$entry;}else{$matches[]="{lang:invalid_mime/l}: ".$mime;}
}
		elseif ($_cfg['global']['detect_mime']=="exact"){
			if (isset($_cfg['exlink_mime'][$current_ext]) && $mime==$_cfg['extlink_mime'][$current_ext]){
			$matches[]=$entry;
		}else{$matches[]="{lang:invalid_mime/l}: ".$mime;}
		}else{
		$matches[]=$entry;
		}
	}}
$__d0->close();
if (isset($matches) && count($matches)==1 ){
	 if (strstr(substr($matches[0], -5), ".")){
    $current_ext= end(explode('.',$matches[0]));
		if ($_cfg['global']['casesensitive_extension_handler']!="on"){
			$current_exti=strtolower($current_ext);}else{$current_exti=$current_ext;}
			if (isset($_cfg['ext_links'][$current_exti])){
				
				#A EXTLINK CHANGE!!!! OH BOY!
	$current_extlink=$_cfg['ext_links'][$current_exti];
	}elseif ($_cfg['global']['universal_unlinked_ext_files']!="none"){$current_extlink=$_cfg['global']['universal_unlinked_ext_files'];
}}
}else{$noext=1;}}

if (isset($noext) && $noext==1 && isset($_cfg['ext_links']['no_ext'])){
	# NO WAY! ITS ANOTHER EXTLINK CHANGE!
	$current_extlink=$_cfg['ext_links']['no_ext'];
	$current_ext=$_cfg['global']['universal_unlinked_ext_files'];
	}
}
if (!isset($current_extlink) || isset($current_extlink) && !strlen($current_extlink)>0){
	# U WONT BELIEVE IT! EXTLINK CHANGES AT HORIZON!!!
	$current_extlink="no_ext";
	}

#SET ALL $_cfg[global][default_*]  VARS to THE VARS LINKED TO $_cfg[extlink_*]
if (isset($current_extlink) && strlen($current_extlink)>0){
foreach ($_cfg as $a => $b ){
	if (strstr($a, "extlink_")&&isset($_cfg[$a][$current_extlink])){
	$_cfg['global']['default_'.substr($a, 8)]=$_cfg[$a][$current_extlink];
	}}
	}
	
################
# END EXTLINK (final  vars creation in a uninteresting chaotic way)
#####################



# MEMORIZE COLOR COLLECTION COOKIE NAME
/*
if (isset($_POST['ckinm'])){ $ckinm=$_POST['ckinm'];}else{ if (isset($_COOKIE['ckinm'])){
    $ckinm=$_COOKIE['ckinm'];}if (!isset($ckinm)){if ($_cfg['global']['clrck_def']!==false || !isset($_GET) || isset($_GET['fn']) && strlen($_GET['fn'])< 1){$ckinm=$_cfg['global']['clrck_def'];}else{$ckinm=$_GET['fn']; }}}
setcookie("ckinm", $ckinm, $_cfg['global']['ckitime']);
if (!isset($_COOKIE[$ckinm])){$_COOKIE[$ckinm]='';}else{$_COOKIE[$ckinm].=",";$_COOKIE[$ckinm]=str_replace(',,', ',', $_COOKIE[$ckinm]);}
*/

# default {urlstr}
if (!isset($_GET['fd'])){ $_GET['fd']='';}
if (!isset($_GET['fn'])){ $_GET['fn']='';}

$urlt="&fd=".urlencode(htmlentities(str_replace(array("%2F/", "\\"), array('%2F', "/"), html_entity_decode($_GET['fd']))))."&fn=".urlencode(htmlentities($_GET['fn'])); 
# default {urlstr}
#echo html_entity_decode($_GET['fd']);

	
#load machinelanguage translation set from quirks css file

  if (isset ($_POST['trlback']) && $_POST['trlback']=="on" || isset($_COOKIE['translate_editfield']) && $_COOKIE['translate_editfield']=="on"){ 


$_l_cssfilter=piecele($langcss["1"], $_cfg['global']['default_lang']);
 }
if (!isset($_l_cssfilter)){$_l_cssfilter=array();} 



?>
