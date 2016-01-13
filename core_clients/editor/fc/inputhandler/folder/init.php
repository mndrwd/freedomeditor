<?php
# BY BART BOSMA OUDEHORNE 7-2008
# WWW.BARTBOSMA.EU
	 
#if (isset($_GET['ele'])){
#$filename=$_GET['ele'];
#}


  /*
if (isset($_GET['fd2'])&&strlen($_GET['fd2'])>0){
#	    echo $_GET['fd2'];die();
#  echo str_replace("fc", "", getcwd());echo "<hr />";
    $fd="../".str_replace(str_replace("fc", "", getcwd()), '', $_GET['fd2']);
#    echo $fd;die();
	    $_GET['fd']=$fd;
	    }*/

if ($_GET['fd']=='' || $_GET['fd']=="\\" || $_GET['fd']=="/"){$_GET['fd']="/.";} #added nov 9 2008
if (!isset($_GET['fd'])){$_GET['fd']="../";}

if ($_GET['fd']==".") {$_GET['fd']="./";}
if ($_GET['fd']=="..") {$_GET['fd']="../";}
if (substr($_GET['fd'],  -1, 1)!="/"){
	$_GET['fd'].="/";
	}
#added nov 9 2008
if (strstr($_GET['fd'], "\\")){
$_GET['fd']=str_replace("/", "\\", $_GET['fd']);
}
#/added nov 9 2008


if (isset($_GET) && isset($_GET['cat']) && html_entity_decode($_GET['cat'])==$__lang['folders']){
	$_GET['fn']='';
	}
	if (isset($_POST['editelecont'])){
		$readonly==false;}

#### VARS & arrays####
#$__lang['where_to']=rp($_GET['fd'])."/";
$__lang['ele']='';
if (isset($_GET['go']) && $_GET['go']==".." ){
	#if ($_GET['fd']!='' && $_GET['fd']!="."){
		#}
		#$__lang['where_to'].="/..";
		if ($_GET['fd']==''){
			$_GET['fd']="..";
			}else{
				if ($_GET['fd']!="/"){$_GET['fd'].="/";}
			$_GET['fd'].="../";
			}
}
#if ($_GET['go']=='..'){
#	$__lang['where_to'].='/..';}
 
#if (!isset($_GET['ele']) || !strlen($_GET['ele'])>0){
	#$temp_1=$_GET['fd'];
	#if ($_GET['go']=='..'){$_GET['fd'].="/../";}
	if (isset($_cfg['ext_links'])){
$_GET['fd']=str_replace("+", " ", $_GET['fd']);
$workz0rdir=getcwd();
$temps=linkfldrarr(0, $GLOBALS['_cfg']['ext_links']);}
$currentwd=linkfldrarr(0, '', '', true);
chdir($workz0rdir);


#echo $currentwd;
#if (isset($_GET['go']) && $_GET['go']=='..'){$_GET['fd']=$temp_1;}
if (isset($temps) && is_array($temps)){
	#$_GET['fd']=$temps['fd'];
#echo "<pre>";print_r($temps['klikit']);
if (is_array($temps['klikit'])){
foreach ($temps['klikit'] as $a =>$cat){
#foreach ($cat as $abracat=>$abracata) {
#$cata[$abracat]=html_entity_decode($abracata);
#}
$klikit[$a]=($cat);
}}
}
#print_r($klikit);die();
$temps=array();
if (isset ($_GET['cat']) && $_GET['cat']==$__lang['folders']){
	#if ($_GET['fn']{strlen($_GET['fn'])-1}=="/"){
#		$_GET['fn'].="/";
	#	}
	
	#	if ($_GET['fd']=='.'){$temp_1="./";}elseif($_GET['fd']=='/'){$temp_1="/";}else{$temp_1='';}
		#if ($_GET['fd']{0}=="/"){$temp_1='/';}elseif ($_GET['fd']{0}=="."){$temp_1='.';}else{$temp_1='';}

				
				#if ($_GET['go']=='..'){$temp_2="/../";}else{$temp_2='';}
				
				#echo $_GET['fn'];die();
if (strlen($__lang['ele'])>0){
				$__lang['ele'].='%2F';
}
				$urlt=str_replace("%2F%2F", "%2F", 
"&amp;fd=".urlencode(htmlentities(rp(str_replace("\\", "/", $_GET['fd']).$_GET['fn'])))); 
}else{$_GET['cat']=$__lang['files'];
$__lang['ele']="&amp;fn="; 
if (isset($_GET['fd']) && isset($_GET['fn'])){
$urlt=str_replace("%2F%2F", "%2F", "&amp;fd=".urlencode(htmlentities(rp($_GET['fd']))))."&ele=".urlencode(htmlentities($_GET['fn']));
 }
}
#$urlt="&amp;fd=".htmlentities(urlencode($temp_1.rp($_GET['fd'].$_GET['fn']))); 
#}


#$current_ext= end(explode('.', html_entity_decode($_GET['ele'])));
#### VARS ####
if (!isset($current_extlink)){$current_extlink="";}
	$___wph=$workpathios[2].$current_extlink."/";
$___workpath=$workpathios[2]."css/";
#echo $___workpath;die();
$depend["parse_init"]=false;
startfunct($depend);
$depend=array();

if (file_exists($___wph."expansion".$GLOBALS['scrext'])){
	
	chdir($___wph);
	$___workpath=$___wph;
	include ("expansion".$GLOBALS['scrext']);
	chdir ($__the_cwd);
	
}

?>
