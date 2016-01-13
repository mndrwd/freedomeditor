<?php
# DEVELOPPED BY BART BOSMA OUDEHORNE 7-2008
# WWW.BARTBOSMA.EU

#load core config
$arr=parse_css(file_get_contents("config.css"), true);
if (is_array($arr)){
foreach ($arr['1'] as $a => $b){
  $_cfg[$a]=piecele($arr['1'], $a);}
 }else{die("config invalid.");}
# end config load

#CHECK userinput FOR NONDEFAULT CORECLIENT
if (isset($_GET[$_cfg['global']['select_client_by_urlvar']])){
$_cfg['global']['current_client']=$_GET[$_cfg['global']['select_client_by_urlvar']];}

#load core client config
if (file_exists($__the_cwd."/core_clients/".$_cfg['global']['current_client']."/config.css")){
$arr=parse_css(file_get_contents($__the_cwd."/core_clients/".$_cfg['global']['current_client']."/config.css"), true);
if (is_array($arr)){
foreach ($arr['1'] as $a => $b){
  $_cfg2[$a]=piecele($arr['1'], $a);}
#merge $_cfg (css)
$_cfg=mergecss($_cfg, $_cfg2);
#echo "<pre>";print_r($_cfg);die();  
 }else{die("config invalid.");}
} 
# end config load


#include any overlapping external overwriting settings somewhere here :s
#$_cfg['folders']['templates']='';


$_cfg['global']['ckitime']=time()+60*60*24*7*4*12; # browser can swallow the cookies after one year rotting without running this script

$tmplext=$_cfg['global']['tmplext'];
if (!isset($_cfg['global']['default_lang'])){$_cfg['global']['default_lang']="en";}

#####################
# AUTODETECT WORKING LANGUAGE & SAVE IN VARS
#DYNAMIC INPUT FEEDVARS where 1 overrides 2 etc
/*<?php substr(0,2 $
#1: $_SERVER['HTTP_ACCEPT_LANGUAGE'] #language client browser is set to
#2: $_POST['langi']; #alters cookie
#3: $_COOKIE[$_cfg['global']['lang_cookie'] #browser cookie
#4: $_cfg['global']['default_lang'] #if no cookie available
?>*/
# STATIC/CONFIGURATION INPUT FEEDVARS
/* 1: $_cfg['folders']['language'] #location with translation sets containing css files
 2: $_cfg['global']['lang_cookie']
*/
#OUTPUT
/*
$__tssf
*/
#####################

if (!isset($__tssf)){$__tssf='';}
if (!isset($_cfg['folders']['language'])){$_cfg['folders']['language']="lang";}
 if (!isset($_cfg['global']['lang_cookie'])){$_cfg['global']['lang_cookie']='lang';}


if (isset($_POST['langi'])){$__tssf=substr($_POST['langi'], 0, 2);
#echo $__tssf;die();
  $_COOKIE[$_cfg['global']['lang_cookie']]=$__tssf;}elseif (isset($_cfg) && isset($_cfg['global']['lang_cookie']) && isset($_COOKIE[$_cfg['global']['lang_cookie']])&& $_COOKIE[$_cfg['global']['lang_cookie']]!=false){
$__tssf=substr($_COOKIE[$_cfg['global']['lang_cookie']], 0, 2);}

if (!file_exists($_cfg['folders']['language']."/".$__tssf."/".$__tssf.".css")){
  if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])){$__tssf=substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);}
 if (!file_exists($_cfg['folders']['language']."/".$__tssf."/".$__tssf.".css")){
$__tssf=$_cfg['global']['default_lang'];
}}
# END AUTODETECT LANGUAGE

#save language cookie
if (!isset($_SESSION)){ session_start();}
setcookie ($_cfg['global']['lang_cookie'], $__tssf,$_cfg['global']['ckitime']);

#####################
#AUTODETECT MORE PATHS IN VARS
#INPUT
/*
array $_cfg, $_SERVER
*/
#OUTPUT
/*
$_urli_   #htmlentities(url_to_current_invoked_phpfile);
$WIMPY_BASE['path']['www'] # url_to_current_invoked_phpfile
$____urlx # url_to_current_invoked_phpfile?$_SERVER['query_string']

$_cfg['global']['ddir'] # location where valid template seemed to have been found
$_cfg['global']['lang_file'] # location of language set css file
*/

if (!isset($WIMPY_BASE['path']['physical'])){$WIMPY_BASE['path']['physical']=getcwd();}
if (isset($_cfg['folders']['templates'])){$_cfg['folders']['ddir']=$WIMPY_BASE['path']['physical']."/".$_cfg['folders']['templates'];if (isset($WIMPY_BASE['path']['physical'])){$_cfg['global']['lang_file']=$WIMPY_BASE['path']['physical']."/".$_cfg['folders']['language'].$__tssf."/".$__tssf.".css";}
 }else{$_cfg['global']['ddir']=getcwd()."/";$_cfg['folders']['templates']=getcwd()."/tmpl";
if (strlen($__tssf)<1){$__tssf=$_cfg['global']['default_lang'];}} $_cfg['global']['lang_file']=$__the_cwd."/lang/".$__tssf."/".$__tssf.".css";

#save even more pathstuff to variables
$____urlxs="";
	$____urlx= 'http';
if(isset ($_SERVER['HTTPS'])){$____urlxs= 's';}
	$____urlx.=$____urlxs.'://'.$_SERVER['HTTP_HOST']."";
	if (isset ($_SERVER['SCRIPT_NAME'])){
	$____urlx.=dirname($_SERVER['SCRIPT_NAME']);
	}
	$WIMPY_BASE['path']['www']=$____urlx;
	$_urli_=htmlentities($____urlx);
	# default {www}_
	if (isset($_SERVER['QUERY_STRING'])){
	$____urlx.="?".$_SERVER['QUERY_STRING'];
	}
#####################



	

	# load LANGUAGE VARS
$langcss=parse_css(file_get_contents($__the_cwd."/".$_cfg['folders']['language']."/".$__tssf."/".$__tssf.".css"), true);
#echo "<pre>";print_r($langcss);die();
$__lang=piecele($langcss["1"], $_cfg['global']['default_gui_lang']);

$__lang["current_template"]=$_cfg["global"]["default_template"];
$__lang["ele"]="&ele=";
$__lang["tmpl_folder"]=$_cfg["folders"]["templates"];

# added for backwards compatibility with older freedomeditor (<0.2.5) html code, mayb be changed into a extension or something in the future
$langcss["1"][$_cfg['global']['default_gui_lang']].="current_template:".$_cfg["global"]["default_template"].";
ele:&ele=;
tmpl_folder:".$_cfg["folders"]["templates"].";";



#LOAD CORE CLIENT VARS
$oldir=getcwd();
if (is_dir($__the_cwd."/core_clients/".$_cfg['global']['current_client']."/")){
	chdir ($__the_cwd."/core_clients/".$_cfg['global']['current_client']."/");
if (file_exists("vars".$scrext)){
include "vars".$scrext;}
chdir ($___workpath."/");
}


#$path['inputhandler']=getcwd()."/fc/inputhandler/";
#echo "<pre>";print_r($_cfg);die();hgdfgfd

#EXTENSION VARS
#$ele_content_cnt=0;
if (!isset($quick_ele_counter)){
$quick_ele_counter=0;}
?>
