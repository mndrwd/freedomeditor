<?php
               /*
	 * 	Developped by Bart Bosma
	 *	Released under GPL license
	 */
if (!function_exists("dir_ls")){function dir_ls($klikit, $arr=false){
	#echo getcwd();die();
	#echo $klikit;die();
    if (is_dir(str_replace("//", '/', $klikit."/"))){
		$dh=opendir(str_replace("//", '/', $klikit."/"));
    while (false !== ($filename = readdir($dh))){
	
      if ($filename!=".." && $filename!="." && $filename!=''){
    if (is_dir($klikit.str_replace("%2F/", "/", "/".$filename))){
      $files['fd'][] = str_replace("/", '', $filename);}else{
		

#			if (only
	if ($arr!=false &&is_array($arr)){
	      foreach ($arr as $a =>$b){
		  $tempo2=str_replace("/", '', $filename);
$needl0='.';
$arrhey=explode($needl0,$tempo2);
		  $tempo=".".end($arrhey);
			if (!strstr($filename, ".") || $a=="no_ext"){
if ($GLOBALS['_cfg']['global']['universal_unlinked_ext_files']!="none"){
				$files['fn']["no_ext"][]=str_replace("/", '', $filename);
				}  }
					
					
					
		elseif ($GLOBALS['_cfg']['global']['casesensitive_extension_handler']=="on"){
		

		if (strstr($tempo, ".".$a)){ # changed nov 17 2008
		  $files['fn'][$b][]=str_replace("/", '', $filename);}
		}else{
		if (stristr($tempo, ".".$a)){ #changed nov 17 2008
		  $files['fn'][$b][]=str_replace("/", '', $filename);}
		
		}}

}else{

	if (strstr($filename, ".")){
$files['fn'][end(explode('.', $filename))][]=str_replace("/", '', $filename);}	
else{

	$files['fn']['no_ext']=str_replace("/", '', $filename);
	}
}	
	}
}}closedir($dh);
#echo "<pre>";print_r($files);
}else{return "na";}
if (!isset($files['fn']) && !isset($files['fd'])){  return "nf";}
    if (!isset($files)){$files=false;}
    return $files;}}

?>
