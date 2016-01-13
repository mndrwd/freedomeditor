<?php
               /*
	 * 	Developped by Bart Bosma
	 *	Released under GPL license
	 */

if (!function_exists ("linkfldrarr")){ #create folder contents array compatible with css guiparser
  function linkfldrarr($klikit, $extlink, $fd='', $retcwd=false){
	global $__lang;  
	$klikit=array(); 
	$klikit[$__lang['folders']]=array();
#echo html_entity_decode($_GET['fd']);die();
	#echo getcwd()." ".str_replace("//", "/", html_entity_decode($_GET['fd']))."<hr />";
	#if (isset($_GET['fd']) &&strlen($_GET['fd'])>0 && is_Dir(str_replace("//", "/", html_entity_decode($_GET['fd'])))){
#	echo $_GET['fd'];die();
	if ($fd==''){
     
	  $fd=str_replace("//", "/", str_replace("%2F", "/", html_entity_decode(html_entity_decode($_GET['fd']))));}
       
		#}
	if ($retcwd==true){
	  chdir($fd);
	  return getcwd();}
if (isset($_GET['newfoldername'])){
$newname=filesystemcode($_GET['newfoldername'],'b', 'c'); 
$chdir=getcwd();
chdir($fd);
mkdir($newname, 755);
chdir($chdir);
unset($chdir);
}

elseif (isset($_GET['newfilename'])){
$newname=filesystemcode($_GET['newfilename'],'b', 'c'); 
$chdir=getcwd();
chdir($fd);
file_put_contents($newname, "");
chdir($chdir);
unset($chdir);
}
elseif (isset($_GET['newname'])){
$chdir=getcwd();
chdir($fd);
rename (rawurldecode($_GET['fn']), filesystemcode(rawurldecode($_GET['newname']), 'b', 'c'));
chdir($chdir);
}
elseif(isset($_GET['cutcopy'])){
$chdir=getcwd();
chdir($fd);
if ($_GET['cutcopy']=='cut'){
rename (str_replace( "+", " ",$_GET['pastefromlocation']), filesystemcode(str_replace("+", " ",$_GET['ccitemname']), 'b', 'c'));
}
elseif ($_GET['cutcopy']=='copy'){
rcopy (str_replace( "+", " ",$_GET['pastefromlocation']), filesystemcode(str_replace("+", " ",$_GET['ccitemname']), 'b', 'c'));
}

chdir($chdir);

}
    #if ($fd=='' || $fd==$GLOBALS['_cfg']['global']['default_request_folder']){
	#}else{}
	#if ($fd=='.'){$fd=$GLOBALS['_cfg']['global']['default_request_folder'];}
#Prepare folder display selection with current userinput
#echo "<pre>";print_r($__lang);die();
    $filecont='/*cat='.$__lang['files'].'_*/';
#    $_GET['cat']=$__lang['files'];
	if (!isset($fd) ||$fd==''){$fd=$GLOBALS['_cfg']['global']['default_request_folder'];}
	if (!isset($fd) ||$fd==''){$fd='.';} #load defaults ;/

#	echo $fd;die();
#	echo $extlink;die();
	$dircont=dir_ls($fd."/", $extlink);
#echo "<pre>";print_r($dircont);
	if (is_array($dircont)){
	foreach ($extlink as $d =>$test){

#echo "<pre>";print_r($dircont);die();
      if (isset ($dircont['fn'][$d]) &&is_array($dircont['fn'][$d])){
    foreach ($dircont['fn'][$d] as $b){

		if (!isset($klikit[$__lang['files']][$b])){
      if (isset($_GET) && isset($_GET['ele']) && $b==html_entity_decode($_GET['ele'])){
	$klikit[$__lang['files']][$b]=
	#htmlentities(
	file_get_contents(str_replace("//", "/",html_entity_decode(
	$fd
	))."/".$b
	#, ENT_QUOTES)
	);
	 $klikit[$__lang['files']][$b]=mb_convert_encoding($klikit[$__lang['files']][$b], 'UTF-8',
          mb_detect_encoding($klikit[$__lang['files']][$b], 'UTF-8, ISO-8859-1', true)); 
#echo 	
#strlen(
#$klikit[$__lang['files']][$b]
#)
#."<br />";

    
      }else{
	

#	if ($d=="no_ext" && $GLOBALS['_cfg']['global']['universal_unlinked_ext_files']!="none" || $d!="no_ext"){  

if (!isset($klikit[$__lang['files']][$b])){

		$klikit[$__lang['files']][$b]='';
}
#	}
	  }
    }
	}
}
	}
	
	if (isset($dircont['fd']) && is_array($dircont['fd'])){
	$klikit[$__lang['folders']]=array_flip($dircont['fd']);
	}
	}elseif (isset($_GET['cat']) &&$dircont=="nf"){$klikit[html_entity_decode($_GET['cat'])]['LANGempty_folderIANG']="";$_GET['ele']='';}elseif(isset($_GET['cat']) && $dircont=="na"){$klikit[html_entity_decode($_GET['cat'])]['LANGaccess_deniedIANG']="";$_GET['ele']='';}
    $klikity['fd']=$fd;$klikity['klikit']=$klikit;

#   print_r($klikity);die();
#die();
    return $klikity;

}}
#echo html_entity_decode($_GET['fd']);die();


?>

