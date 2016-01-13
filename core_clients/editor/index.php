<?php

#echo "# DEVELOPPED BY BART BOSMA OUDEHORNE 7-2008";
#echo "# WWW.BARTBOSMA.EU www.freedomeditor.com";

#CUSTOM ARRAY (EDITOR CORE CLIENT SPECIFIC)
#$replacemany["ext:fileext:ension"]=$_cfg['global']['default_gui'];
#$replacemany["ext:file:ension"]=urlencode(htmlentities($_GET['fn']));
#$replacemany["ext:rawfile:ension"]=htmlentities($_GET['fn']);
#$replacemany["ext:folder:ension"]= urlencode(htmlentities(realpath($_GET['fd'])));
#$replacemany["ext:urlstr:ension"]=$urlt;
#$replacemany["ext:www:ension"]=$_urli_;
#$replacemany["ext:current_ext:ension"]=$current_ext;

#echo htmlentities($strraw[0]);die();

#echo $current_ext;

if (isset ($_GET[$GLOBALS['_cfg']['global']['ajax_urlvar']])&& $_GET[$GLOBALS['_cfg']['global']['ajax_urlvar']]=="getrawcontents" 
||
 isset($_GET[$GLOBALS['_cfg']['global']['ajax_urlvar']]) && $_GET[$GLOBALS['_cfg']['global']['ajax_urlvar']]=="getrawcontentsdl"){
if ($_GET[$GLOBALS['_cfg']['global']['ajax_urlvar']]=="getrawcontentsdl")
{
header('Content-Disposition: attachment; filename="'.$_GET['ele'].'"');
}else{
header('Content-Disposition: inline; filename="'.$_GET['ele'].'"');
}
ob_clean();
$contents=file_get_contents($_GET['fd'].'/'.$_GET['ele']);
//header("Content-Type: " . "application/pdf");
///*
$file_info = new finfo(FILEINFO_MIME);	// object oriented approach!

$mime_type = $file_info->buffer($contents);
#print_r($mime_type);die();
header("Content-Type: " . $mime_type);
//*/
die($contents);
}

/*
# (x)html to pdf conversion support
elseif(isset ($_GET['html2fpdf']) && $_GET['html2fpdf']!=false){
ob_clean();
chdir($__the_cwd."/");
$html=file_get_contents($_GET['fd'].'/'.$_GET['ele']);
include("core_clients/editor/fc/parser/html2fpdf".$scrext);die();}
 */

# xsl(x) to xsl(x)/html/pdf/csv with phpexcel
# requires $_GET['xcloutput']
elseif(isset($_GET['xcloutput']) && $_GET['xcloutput']!=false){
ob_clean();
chdir($__the_cwd."/");
include ("core_clients/editor/fc/parser/phpexcel".$scrext);die();}

# sometimes extlinks array is needed in javascript so here we go:
elseif (isset($_GET[$_cfg['global']['ajax_urlvar']]) && $_GET[$_cfg['global']['ajax_urlvar']]=="jsonextlink"){
ob_clean();
header('Content-type: application/x-javascript; charset=utf8');
$i=0;
# Make JSON array with specific structure easy usable with jquery.json
foreach($_cfg['ext_links'] as $key=>$val){
$extlinkarray[$i]['ext']=$key;
$extlinkarray[$i]['extl']=$val;
$i++;
}
die('{
"items":
'.json_encode($extlinkarray).'
}');
}
# end json/ extlink array request



$replaceonce["{once:ele_content:cc}"]=#html_entity_decode
htmlentities
($strraw[0]);


# WRITE BACK FILE ##### WARNING CURRENTLY FLAGGED INSECURE ON SHARED/PUBLIC SERVER
#$klikit=ksort($klikit);

if ($_cfg['global']['current_client']=="editor"
&&$_cfg['global']['readonly']=="off" && isset($_POST['editelecont']) && strlen($_POST['editelecont'])>0){

chdir($__the_cwd."/core_clients/".$_cfg['global']['current_client']."/");
 if (file_exists("writeback_main_edited_data".$scrext)){

$strrawrap=$strraw[0];
#$strraw[0]=html_entity_decode($strraw[0]);

include "writeback_main_edited_data".$scrext;
 $strraw[0]=$strrawrap;unset($strrawrap);
}
}


#MAIN REQUIRED ARRAY NEEDS 2 B CUSTOMIZED FOR ANY / EVERY CORE CLIENT USING MAKE_OBJECT function
$cont_vars["langarr"]=false; # supply like $arr["find"]="replace";
$cont_vars["array"]="replacemany";
$cont_vars["array2"]="replaceonce";  # processed after many
$cont_vars["template"]=$strraw[1];
$cont_vars["open"]="{";
$cont_vars["close"]="}";
#$cont_vars['first']=${$cont_vars["array"]}[0];
$cont_vars['first']="fileext";

$dbg=false; #NOT SURE WHAT THIS DOES NYMORE


#echo "<pre>";print_r($__lang);die();

?>
