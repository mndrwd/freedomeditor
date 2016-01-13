<?php
/*

# WARNING:!:!:!::!:!
# DO NOT LEAVE THIS FILE LINGERING DIRECTLY ACCESSABLE VIA HTTP ON A PUBLIC/COMMERCIAL SERVER AS ITS FUNCTIONALITY IS POTENTIONALLY DEVASTATING WHEN USERINPUT CONTAINS CERTAIN UNWANTED STUFF
YOUR PRECIOUS DATA CAN BE DESTROYED ALMOST ANONYMOUSLY

	 * 	Developped by Bart Bosma 7-2008
	 *	Released under GPL license

	 */



	if (!function_exists("writefile")){
		include "../../fc/global/writefile.php";}

if (!$strraw && $_POST['editelecont'] && !isset($skip_css_specific)){
	$strraw[0]=$_POST['editelecont'];
	$skip_css_specific=true;
	}
	

if ($_cfg['global']['readonly']=="off"){ #changed nov 11 2008
	chdir ("../../fc/");
	if (is_dir(html_entity_decode($_GET['fd']))){
	@chdir(html_entity_decode($_GET['fd']));
	}
 if (isset($_cfg['global']['en_wr'])){
   @chmod($filename, $_cfg['global']['en_wr']);}



 if ($_cfg['global']['send_string']=="on" || $skip_css_specific==true){ 
#we're not writing back css arrays
	$klikit=$strraw[0];}


if (function_exists("writefile2")){
	writefile2($klikit, $filename, $_l_cssfilter, $_cfg['global'],
	$custom_array
	);

	}else{ 
writefile($klikit, $filename, $_l_cssfilter, $_cfg['global'],
$__the_cwd."/".$_cfg['folders']['parser'].$_cfg['global']['default_parser']."/write/".$current_ext.$scrext
); #write stuff back to file
}

 if (isset($_cfg['global']['dis_wr'])){
   @chmod($filename, $_cfg['global']['dis_wr']);}
chdir($__the_cwd);  
 }
#end filewrite



?>