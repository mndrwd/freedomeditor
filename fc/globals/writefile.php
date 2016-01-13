<?php
               /*
	 * 	Developped by Bart Bosma Oudehorne
   2007 / 2008 / 2009
	 *	Released under GPL license
	 */


# write css file when klikit=array or any file when string

#$fn= filename
if (!function_exists("writefile")){
  function writefile($klikit, $fn, $_l_cssfilter, $cfg, $parser=""){

	if (isset($GLOBALS['current_ext'])){
	global $current_ext;  }else{$current_ext="";}
     if (!isset($_l_cssfilter)){$_l_cssfilter=array();}
	
	# PERFORM PHP ARRAY TO CSS CONVERSION 
	# PERFORM MACHINE-LANGUAGE TRANSLATION
	# PERFORM WRITE FILE


 if (isset($klikit)){


#echo $parser;die();
	if (strlen($parser)>0 && file_exists($parser)){

	include $parser;}else{$strklikit="";}
   
 if (!is_array($klikit))   {
 
$strklikit=$klikit;
		if (!isset($_GET['get_css_from_html']) && isset($_REQUEST['ele']) && strlen($_REQUEST['ele'])>0){
$fn=filesystemcode($_REQUEST['ele'], "b", "c");}}

else{
$strklikit=prepare_write($klikit, $_l_cssfilter);
}
}else{$strklikit="";


}

# PERFORM RAW TEXT WRITEBACK METHOD AND MACHINELANGUAGE TRANSLATION
if (is_string($strklikit)&&strlen($strklikit)>0){if (isset($fn) && strlen($fn)>0){

   if (isset ($_POST['trlback']) &&  $_POST['trlback']=="on"    
&& $_l_cssfilter!=false && count($_l_cssfilter)>0 && function_exists("machine_lang")){   
 
     $strklikit=machine_lang($strklikit, $_l_cssfilter, $cfg,  true);
   }


return file_put_contents(html_entity_decode($fn), $strklikit);}}
  }}

?>
