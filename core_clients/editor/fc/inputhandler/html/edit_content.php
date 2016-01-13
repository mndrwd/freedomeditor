<?php

function edit_content($content){


@$doc =  DOMDocument:: loadHTML($content);
@$se = simplexml_import_dom($doc);

ob_start();
echo "<br />".getcwd()."<br />";

#fetch style tags from $se ((x?)html string)
# output:
# $searchos & $replaceos


$dullcounter=0;


$ret=loophtmlobj($se, "style", "id", "class");
#echo "<pre>";print($ret[$dullcounter]["style"][0]);die();

if (is_object($ret[$dullcounter]["style"])){

echo "Style attributes located, generating css stylesheet..<br />";
	# LOOP TROUGH NEW STYLE TAG(S)
foreach ($ret as  $bla => $blaa){
foreach ($blaa as $rd ){

# <tag id=""> ALREADY EXISTS FOR TAG WITH NEW STYLE ATTRIBUTE
if (isset($ret[$dullcounter]["style"]["id"])){
	$klikit["automoved"]["#".$ret[$dullcounter]["style"]["id"]]=$rd[0];
	$csclass="";
	$searchos[]="style=\"".$rd[0]."\"";
	}
# 	 <tag class=""> ALREADY EXISTS FOR TAG WITH NEW STYLE ATTRIBUTE
	elseif (isset($ret[$dullcounter]["style"]["class"])){

if ($GLOBALS['_cfg']['global']['increment_new_css_class_tags']=="off"){ 
#any new found style tag will be written back to the relevant class in the css file
	$klikit["automoved"][".".$ret[$dullcounter]["style"]["class"]]=$rd[0];
	$csclass="";
	$searchos[]="style=\"".$rd[0]."\"";
	}else{
		#any new found style tag will be written back to incremented class name and added to the main edited html file class="mult iple" tag
		
		
		}
	}else{
	# NO ID OR CLASS ATTRIBUTE FOUND, CREATE NEW
		$csclass="class=\"cl".$dullcounter."\"";
		$klikit["automoved"][".cl".$dullcounter]=$rd[0];
		$searchos[]="style=\"".$rd[0]."\"";
	}
	
$replaceos[]=$csclass;
	
$dullcounter++;	
}}
#END FRUITY LOOPCSS
# END FILLING SEARCH & REPLACE ARRAY

echo "Replacing html style attributes with id attributes...<br />";
$content=str_replace($searchos, $replaceos, $content);
$dullcounter=0;



if ($GLOBALS['_cfg']['global']['readonly']=="off"){
echo "readonly disabled, prearing to write files...<br />";
#write fetched inline style tags to extern css file
global $current_ext,$langcss,$_cfg,$__the_cwd,$_l_cssfilter;
$extracurry=$current_ext;
$current_ext="css";
#echo "<pre>";print_r($GLOBALS);die();
#echo $GLOBALS['__the_cwd']."/".$GLOBALS['_cfg']['global']['default_request_folder'];die();

#chdir ($GLOBALS['__the_cwd']."/".$GLOBALS['_cfg']['global']['default_request_folder']."/");
chdir($_GET['fd']);


 $getname=createsuffix(filesystemcode($_GET['fn'], "b", "c"), $current_ext);
 if (!isset($_l_cssfilter)){
 $_l_cssfilter='';}
 $klikit=prepare_write($klikit, $_l_cssfilter);

echo "Writing ".$getname."...<br />";
writefile($klikit, $getname, piecele($langcss["1"], $current_ext), $_cfg['global']);

$current_ext=$extracurry;
 $getname=createsuffix(filesystemcode(str_replace(".".$current_ext, "",$_GET['fn']), "b", "c"), $current_ext);
 if (!isset($_l_cssfilter)){
 $_l_cssfilter='';}
 

echo "Writing ".$getname."...<br />";
writefile($content, $getname, piecele($langcss["1"], $current_ext), $_cfg['global']);
chdir($__the_cwd);

echo "Modifying tinymce CSS stylesheet cookie...<br />";
if (!isset($_COOKIE['tinymcecooker'])){$_COOKIE['tinymcecooker']='';}
setcookie ($_COOKIE["tinymcecooker"], $_COOKIE[$_COOKIE['tinymcecooker']].", ".rawurldecode($_GET['fd']."/".$getname),$_cfg['global']['ckitime']);
}}else{
echo $GLOBALS['__lang']['no style attributes found']."</br >";
}


//return $content; 


if ($GLOBALS['prematurend']==1){die();}
}
?>
