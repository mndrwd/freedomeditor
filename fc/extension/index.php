<?php
/*
#extensions introduced in freedomeditor 0.2.4
#Written by B.G. Bosma, Oudehorne, Netherlands
#GPL Licensed

last modification : freedomeditor 0.2.6

#required functions:
mergecss
repl_between
loadextcfg
piecele
gethatmpl
stro_replace
*/

if (!function_exists("extension")){
function extension($source, $scrext, $_cfg, $langcss, $js=false, $donethatoncearray=array()) {
	$returnjs='';
$cfg_gl=$_cfg;
$resultingarray345=repl_between($source, "", $_cfg['extension']['string_open'], $_cfg['extension']['string_close'], false, "sm",true);  
$amnt=count($resultingarray345[2]);
$noloop=false;

if (is_array($resultingarray345) && is_array($resultingarray345[2])){
foreach ($resultingarray345[2] as $boelieboelie){
	if (strlen($boelieboelie)>0){

if (file_exists("cfg/custom/".$boelieboelie.".css")){

	$_cfgt=loadextcfg("cfg/custom/".$boelieboelie.".css");
	
	if (isset($_cfgt)){
		$_cfg=mergecss($_cfg, $_cfgt);}}

		
$tmpl="";
$emptytmpl=true;
$next=false;

if (isset ($_cfg['extension_req_val']) && is_array($_cfg['extension_req_val']) && count($_cfg['extension_req_val'])>0){
	foreach ($_cfg['extension_req_val'] as $var => $val){
		if (strlen($var)>0){
		if (!isset($_REQUEST[$var])){ $next=true;}else{
			if ($_cfg['extension']['ext_req_val']=="matchvar"){
			
				if ($_cfg['extension']['ext_req_val_Casesens']!="on"){
					
			
					if ($_REQUEST[strtolower($var)]!=strtolower($val)){		
		
					$next=true;}
					}elseif ($_REQUEST[$var]!=$val){			$next=true;
					}
					}
					}
				}}
				}
	
if ($js!=false){
	$next=false;}


if ($next==false && $_cfg['extension']['launch']=="enabled"){

if (strtolower($_cfg["extension"]["core_client"])!="any"){
$coreclients=explode(",", $_cfg["extension"]["core_client"]);		
if (
isset ($_cfg['global']['select_client_by_urlvar']) &&
isset ($_GET[$_cfg['global']['select_client_by_urlvar']]) &&
isset($coreclients[$_GET[$_cfg['global']['select_client_by_urlvar']]]) ||
!isset($_cfg['global']['select_client_by_urlvar']) &&
!isset($_GET[$_cfg['global']['select_client_by_urlvar']]) &&
!isset($coreclients[$_GET[$_cfg['global']['select_client_by_urlvar']]]) &&
isset($_cfg['global']['current_client']) &&
isset($coreclients[$_cfg['global']['current_client']])

){

		$emptytmpl=false;

		
}}elseif (strtolower($_cfg["extension"]["core_client"])=="any"){
	
	$emptytmpl=false;
	}


if ($_cfg['extension']['languageload']=="enabled"){
$__tssf=$GLOBALS['__tssf'];
if (file_exists($_cfg['folders']['language']."/".$__tssf."/custom/".$boelieboelie."/".$__tssf.".css")){
$lang_t=loadextcfg($_cfg['folders']['language']."/".$__tssf."/custom/".$boelieboelie."/".$__tssf.".css");
}}
if (isset ($lang_t) && is_array($lang_t) && $_cfg['extension']['globallanguageload']=="enabled"){

	if (is_array($langcss)){
		$langcss=mergecss($langcss, $lang_t);}
		}else{
if ($_cfg['extension']['globallanguageload']=="enabled"){
	}else{
			$langcss=parse_css($lang_t);}}
			
if (is_array($langcss["1"])){
$__lang=piecele($langcss["1"], $_cfg['global']['default_gui_lang']);}

#print_r($__lang);


if ($emptytmpl==false && $_cfg['extension']['tmplload']=="enabled"){
$tmpl=gethatmpl(0, $boelieboelie);
}


if ($_cfg['extension']['phplaunch']=="enabled" && file_exists("fc/customcallback/".$boelieboelie.$scrext)){
ob_start();

$tmpl= include "fc/customcallback/".$boelieboelie.$scrext;

if (strlen($tmpl)==0 || $emptytmpl==false){

	if ($_cfg['extension']['phplaunch_output']=="enabled"){
	
	if (strlen($tmpl)<1){
$tmpl=ob_get_contents();}}else{ob_clean();}
}}

if ($_cfg['extension']['srch_ext']!="disabled" && strlen($tmpl)>0 &&isset($srch_ext) && is_array($srch_ext) && count($srch_ext)>0){
	$tmpl=str_replace(array_keys(${$_cfg['extension']['srch_ext']}), array_values(${$_cfg['extension']['srch_ext']}), $tmpl);
	}
	
	#if (strlen($tmpl)>0){
	if ($_cfg['extension']['languagereplace']=="enabled"){
	if (!in_array($boelieboelie, $donethatoncearray)){
	
	$return[$_cfg['extension']['level']][$_cfg['extension']['string_open'].$boelieboelie.$_cfg['extension']['string_close']]=guilang($tmpl, $__lang);
	#$source=str_replace("{ext:".$boelieboelie.":ension}", guilang($tmpl, $__lang), $source);
	}
	}else{
	if (!in_array($boelieboelie,$donethatoncearray)){
	
	$return[$_cfg['extension']['level']][$_cfg['extension']['string_open'].$boelieboelie.$_cfg['extension']['string_close']]=$tmpl;	
	#$source=str_replace("{ext:".$boelieboelie.":ension}", $tmpl, $source);
		}
		}
		
#		}
#		echo "<pre>";
#		print_r($source);
	if (isset($_cfg['always_block_ext_scan_inside'][$boelieboelie])){
	$donethatoncearray[]=$boelieboelie;
	}	
		

/*
loop result for generating output cmd
  {
load "cfg/custom/named*.css"; if found
load "lang/custom/named*.css"; if found
load tmpl/named*.html if found;
load tmpl/js/named*.js if found;
ob_start();
load "fc/customcallback/named*.php"; < 
repl {DEFAULTTAG} in html result if any, with ob_end_Clean() or what comes from return function;  result
result repl guilang
$rep[$cfgdepth]["named*"]=result
}
#gen output cmd exe
*/
$_cfg=$cfg_gl;
}}}}else{$noloop=true;}
 # end prepare loop




#start output gen loop
if (isset($return) && is_array($return) && count($return)>0){
	if ($js!=false){
	
	$extensionjs="";}
	//$source2=$source;
	
foreach ($return as $ret) {

	$source=str_replace(array_keys($ret), array_values($ret), $source);
	
	foreach ($ret as $re => $turn){
	if ($js=='print'){


if (file_exists($GLOBALS['__the_cwd']."/".$_cfg['folders']['templates']."js/".str_replace(array($_cfg['extension']['string_open'], $_cfg['extension']['string_close']), "", $re).".js")){
			$extensionjs.="//".$_cfg['folders']['templates']."js/".str_replace(array($_cfg['extension']['string_open'], $_cfg['extension']['string_close']), "", $re).".js\n";		
		$extensionjs.=file_get_contents($GLOBALS['__the_cwd']."/".$_cfg['folders']['templates']."js/".str_replace(array($_cfg['extension']['string_open'], $_cfg['extension']['string_close']), "", $re).".js");
		$extensionjs.="\n\n//------------------------------//\n\n\n\n";
		}}
		}
	
	}
			############## moved to this place @ 0.2.6
			
if ($_cfg['extension']['loop_srch_ext']!="disabled" && $js==false){

	$source=extension($source, $scrext, $_cfg, $langcss, $js, $donethatoncearray);
}	
	##############
	

	
	if ($js=="print"){	@ob_end_clean();@ob_end_clean();@ob_end_clean();@ob_end_clean();
		if (strlen($extensionjs)==0){
		die( "Unable to determine javascript source files, no ".$_cfg['extension']['string_open']."*".$_cfg['extension']['string_close']." tags found for the current coreclient or no corresponding js files.");}	
		$returnjs.=($extensionjs);}
	}elseif ($js!=false){
		die( "Unable to determine javascript source files, no ".$_cfg['extension']['string_open']."*".$_cfg['extension']['string_close']." tags found for the current coreclient or no corresponding js files.");}
		if ($js!=false){
			return $returnjs;}else{
return $source;}
}}
?>
