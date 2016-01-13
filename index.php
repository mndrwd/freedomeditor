<?php
# DEVELOPPED BY BART BOSMA OUDEHORNE 7-2008
# WWW.BARTBOSMA.EU

#PREPARE, define & load:
$scrext=".php";
$__the_cwd=getcwd();

#echo "<pre>";print_r(get_cfg_var("magic_quotes_gpc"));die();

$workpathios[]=$__the_cwd."/fc/";
$workpathios[]=$__the_cwd."/fc/parser/";
$workpathios[]=$__the_cwd."/fc/inputhandler/";
$workpathios[]=$__the_cwd."/fc/gui/";
$corepaths=$workpathios;
#global includes

include ("compat/php6".$scrext);



#echo "<pre>";print_r($_POST);die();
#echo $_POST['editelecont'];die();
# Css parser for config and language files
#chdir ("fc/parser");
#$___workpath="fc/parser/";
$___workpath=$workpathios[0];

#start funct/class loader
include $___workpath."dependencys.fc".$scrext;


#start core html object manager functions with funct loader
$___workpath.="client/";
include $___workpath."init".$scrext;


#start  css parser with funct loader( for loading (config) files written in css code, to php array)
$mainparser="css";
$___workpath=$workpathios[1].$mainparser."/";
include $___workpath."init".$scrext;
#chdir($__the_cwd);


#Remaining core client Vars & functions & processing(needs above css parser)
#$___workpath="fc/";
$___workpath=$workpathios[0];
ob_start();
include $___workpath."global".$scrext;

//WEIRD BUG HERE
//
#########UNTESTED SESSION SUPPORT
$db_tool=$_cfg['sessions'];
if ($db_tool['sess']=="on" && !isset($_SESSION)) {
@session_start(); }

if($db_tool['sess']=="on" && !isset($_SESSION[$db_tool['sesvar']]) || $db_tool['sess']=="on" &&$_SESSION[$db_tool['sesvar']]!=$db_tool['sesvar_val']) {
#go_to_url($db_tool['authpage']);
}elseif ($db_tool['sess']!="on"  || (isset($_SESSION[$db_tool['sesvar']]) && $_SESSION[$db_tool['sesvar']]==$db_tool['sesvar_val'] )){

	#####################




#########################
#########################
#include portable functions

  if(isset($_GET) && isset($_GET['inspenv']) && $_cfg['global']['allow_vardump_request']=="on"){
    $_cfg['global']['var_dump']="on";}

if ($_cfg['global']['var_dump']=="on"){
echo "{<br />check for, then init parser for relevant extlink (set in config.css)<br /><span style=\"color:navy\">";
}#vardump

#$___workpath="fc/parser/";
if ($_cfg['global']['default_parser']!="off" && $_cfg['global']['default_parser']!=$mainparser){
$workpathios[1]=$__the_cwd."/".$_cfg['folders']['parser'];
$___workpath=$workpathios[1].$_cfg['global']['default_parser']."/";
#echo $___workpath;die();
include ($___workpath."init".$scrext);
}

if ($_cfg['global']['var_dump']=="on"){
echo "</span><br />end parser init from ".$___workpath."<br />}<p />";

echo "{<br />check for, then init inputhandler for relevant extlink (set in config.css)<br /><span style=\"color:navy\">";
}#vardump

#$___workpath="fc/inputhandler/";
if ($_cfg['global']['default_input_handler']!="off"){
	$workpathios[2]=$__the_cwd."/".$_cfg['folders']['inputhandler'];
$___workpath=$workpathios[2].$_cfg['global']['default_input_handler']."/";
include ($___workpath."init".$scrext);
#print_r($klikit); #(Here $klikit is filled with html_entity_encoded editor content (0.2.6 debugging note)
#die("EWREWR");
}

if ($_cfg['global']['var_dump']=="on"){ 
echo "</span><br />end inputhandler init from ".$___workpath."<br />}<p />";

echo "{<br />check for, then init gui for relevant extlink (set in config.css)<br /><span style=\"color:navy\">";
}#vardump


#load gui  for relevant extlink (set in config.css)
#$___workpath="fc/gui/";
if ($_cfg['global']['default_gui']!="off"){
	$workpathios[3]=$__the_cwd."/".$_cfg['folders']['gui'];
$___workpath=$workpathios[3].$_cfg['global']['default_gui']."/";
include ($___workpath."init".$scrext);
}
if ($_cfg['global']['var_dump']=="on"){
	echo "</span><br />end gui init from ".$___workpath."<br />}<p />";
}#vardump

#execute portable functions xcept gui

#    END FUNCTIONS LOADING
#############################
#############################




if ($_cfg['global']['var_dump']=="on"){
echo "{<br />use portable functions most likely build in custom inputhandler and/or parser started from parse_init function<br /><span style=\"color:navy\">";
}#vardump

if (function_exists("parse_init")){
	if (isset($klikit)){
	
	#print_r($klikit);die("WWWW");
	$klikit=parse_init($klikit);$skip_css_specific=true;}else{$klikit=parse_init();}}

 #print_r($klikit);die("EWWWWW");
if ($_cfg['global']['var_dump']=="on"){ 
echo "</span><br />end parse_init call from ".$___workpath."<br />}<p />";

echo "{<br />Build GUI HTML with portable htmlshifter function
#builds html items (from \$klikit) in customized template position (ways).<br /><span style=\"color:navy\">";
}#vardump

# print_r($klikit);die("EWFWEFW");

 if (!isset($klikit)){$klikit='';}  
if (function_exists("htmlshifter")){ 

$strraw=htmlshifter($klikit);}else{
$strraw[0]=$klikit;}

# print_r($strraw);
# echo $strraw[0];
#die();

if ($_cfg['global']['var_dump']=="on"){ 
echo "</span ><br />end htmlshifter call, which by default fills \$strraw[0] content [1] template<br />}<p />";
}#vardump

 
#this is a seperated feature
if (isset($_cfg['global']['ent_decode'])){
	if ($_cfg['global']['ent_decode']=="after_htmlshifter" or $_cfg['global']['ent_decode']=="on"){
	$strraw[0]=html_entity_decode($strraw[0]);
	}}
#end


# print_r($strraw);die();
# echo $strraw[0];die();

#these are the object builder global core client var inits
#(all required for make_object function)
if (!isset($_SESSION)){if (function_exists("session_start")){session_start();}}
$_SESSION['rdmstring']='ulvl';
$_SESSION[$_SESSION['rdmstring']]=0;


if (is_dir($__the_cwd."/core_clients/".$_cfg['global']['current_client']."/cfgs/gui/".$_cfg['global']['default_gui']) && file_exists($__the_cwd."/core_clients/".$_cfg['global']['current_client']."/cfgs/gui/".$_cfg['global']['default_gui']."/gui.css")){
$getguicss=$__the_cwd."/core_clients/".$_cfg['global']['current_client']."cfgs/gui/".$_cfg['global']['default_gui']."/gui.css";
}else{	$getguicss=$__the_cwd."/core_clients/".$_cfg['global']['current_client']."/cfgs/gui/default/gui.css";}

if ($_cfg['global']['var_dump']=="on"){ 
echo "{<br />get gui configuration in \$getguicss for make_object function from ".$getguicss." and using the parser/css on file contents string<br /><span style=\"color:navy\">";
}#vardump

if (file_exists($getguicss)){
$arr=parse_css(file_get_contents($getguicss), true);
if (is_array($arr)){
foreach ($arr['1'] as $a => $b){
  $_cfg[$a]=piecele($arr['1'], $a);}
 }else{die("config invalid.");}}
# end config load

#select corresponding make object vars
$aa=initcfg($_cfg);
if (isset($_cfg[$aa]['exact_userlevels'])){
$exacts=explode("-", $_cfg[$aa]['exact_userlevels']);
 }else{$exacts=false;}
$__the_cwd2=getcwd();

if ($_cfg['global']['var_dump']=="on"){ 
echo "</span><br />end of getting gui config<br />}<p />";

echo "{<br />opening ".$__the_cwd."/core_clients/".$_cfg['global']['current_client']."/index.php if found<br /><span style=\"color:navy\">";
}#vardump
# print_r($strraw);die();
if (file_exists($__the_cwd."/core_clients/".$_cfg['global']['current_client']."/index.php")){
include $__the_cwd."/core_clients/".$_cfg['global']['current_client']."/index.php";}
if ($_cfg['global']['var_dump']=="on"){ 
echo "</span><br />end of core_client index.php loader<br />}<p />";

echo "########### finishing touch<br />
<span style=\"color:navy\">Check for anything we echoed previously.
Putting that in respectively either \$strraw[0] or \$strrm also depending on which you have left empty (or in \$strr if cfg_vardump=on).
Check for and if found, run \$strraw[0]=edit_content(\$strraw[0]);\$strraw[1]=edit_template(\$strraw[1]).<br />

Then make_object with settings from core_client index.php AND \$getguicss<br />
or if no make object (or vars from core_client index.php) available , fill \$strrm with \$strraw[0] if it's not filled yet<br />AND THEN, show that vardump (below)<br /></span>";
$strr=ob_get_contents();

}#vardump


#NO contents FROM HTMLSHIFTER, lets fill strraw[0]
elseif (!isset($strraw[0]) || strlen($strraw[0])<1){
  $strraw[0]=ob_get_contents();
if ($_cfg['global']['guilang']=="on"){
$strraw[0]=guilang($strraw[0], $__lang);
}
}


# oH well LETS TRY FILL $strrm then
elseif (!isset($strrm)){
	$strrm=ob_get_contents();
if ($_cfg['global']['guilang']=="on"){
	$strrm=guilang($strrm, $__lang);
	}}

@ob_end_clean();

//print_r($strraw);
 

ob_start();

#carefully selected global order of execution for each core client

#this is a seperated feature
if (isset($_cfg['global']['ent_decode'])){
	if ($_cfg['global']['ent_decode']=="before_make_object" or $_cfg['global']['ent_decode']=="on"){
	$strraw[0]=html_entity_decode($strraw[0]);}}
#end

if (function_exists("edit_content")){
	$strraw[0]=edit_content($strraw[0], $_cfg['global']['default_request_folder']);
	}
if (function_exists("edit_template")){
	$strraw[1]=edit_template($strraw[1],  $_cfg['global']['default_template']);}
	
if ($_cfg['global']['make_object_on_strrm']=="on" && isset($strrm)){
	$strraw[0]=$strrm;
	}
if (is_dir($__the_cwd."/cache/".$_cfg['global']['current_client']."/")){
chdir($__the_cwd."/cache/".$_cfg['global']['current_client']."/");}
if (function_exists("make_object") && isset($cont_vars) && is_array($cont_vars)){
	if ($_cfg['global']['var_dump']=="on"){
		$dbg=true;}

#this is a seperated feature
if (isset($_cfg['global']['ent_decode'])){
	if ($_cfg['global']['ent_decode']=="before_extension_load" or $_cfg['global']['ent_decode']=="on"){
	$strraw[0]=html_entity_decode($strraw[0]);}}	

#end
$strrm=make_object(
#$strraw[1], "fileext", false, "conti", "{", "}"
$cont_vars["template"], $cont_vars["first"], $cont_vars["langarr"], $cont_vars["array"], $cont_vars["open"], $cont_vars["close"]
);


# echo $strrm;
#die();
 }

#last desperate panic attempt to output at least something
 elseif (!isset($strrm)){$strrm=$strraw[0];}
#echo str_replace(array("{fileext}", "{file}", "{rawfile}", "{folder}", "{urlstr}", "{www}", "{current_ext}", "{ele}"), array($_cfg['global']['default_gui'], urlencode(htmlentities($_GET['fn'])), htmlentities($_GET['fn']), urlencode(htmlentities($_GET['fd'])), $urlt, $_urli_, $current_ext, htmlentities($strraw[0])), $strraw[1]);



#############################
# EXTENSION LOAD
chdir ($corepaths[0]."extension/");
include "init".$scrext;

chdir($__the_cwd."/");
include $corepaths[0]."extension/index".$scrext;

$__temp1='';
if (is_array($_cfg['always_load_extension']) && count($_cfg['always_load_extension'])>0){
foreach ($_cfg['always_load_extension'] as $_ok => $_oke) {
	if (strlen($_oke)>0){
		
	$__temp1.="{ext:".$_oke.":ension}";
}}}

if (isset($_GET['extjs'])){
die(extension($__temp1.$strrm, $scrext, $_cfg, $langcss, "print"));
	
}

if (!isset($strrm) || strlen($strrm)==0){

ob_start();


$strrm=extension($__temp1, $scrext, $_cfg, $langcss);

if (!isset($strrm) || strlen($strrm)==0){
$strrm=ob_get_contents();
}
ob_clean();
}else{
extension($__temp1, $scrext, $_cfg, $langcss);
	}


if (is_array($_cfg['always_load_extension_after_extscan']) && count($_cfg['always_load_extension_after_extscan'])>0){
foreach ($_cfg['always_load_extension_after_extscan'] as $_ok => $_oke) {
	if (strlen($_oke)>0){
	$strrm.="{ext:".$_oke.":ension}";
}}}
$strrm=extension($strrm, $scrext, $_cfg, $langcss);


# EXTENSION LOAD COMPLETED
############################




#    echo "test";die();
#    print_r(${$cont_vars['array2']});die();
 
 
 ##########################


##############
#part of core_client system: VERY IMPORTANT TO LOAD AFTER EXTENSIONS BEFORE AJAX
	if (isset ($cont_vars) && isset($cont_vars["array2"]) && isset(${$cont_vars["array2"]}) &&is_array(${$cont_vars["array2"]})){

    $strrm=str_replace(array_keys(${$cont_vars["array2"]}), array_values(${$cont_vars["array2"]}), $strrm);
}
############  ##   
  



 

  if (isset($_GET[strtolower($_cfg['global']['ajax_urlvar'])])){
    $strrm=scanajax($strrm, $_cfg['global']['ajax_urlvar'], true);
  }




 if ($_cfg['global']['var_dump']!="on"){

   echo($strrm);}else{
	
	$this_vardump=str_replace(array("/*", "*/"), '', print_r($GLOBALS, true));
	
  $this_vardump=highlight_string('<?PHP '.($this_vardump).' ?>', true);
  $cavalery=@ob_get_contents();
ob_end_clean();  
ob_start();
echo $strr."<p />".$cavalery."<pre><code>".($this_vardump)."</code></pre>";

}

} 
#move on boys n girls theres nothing interesting to see here
else{ #session authentication failed 
echo "yeah so i guess you are not allowed to view this page, whata bummer, isn't it? (Un?)fortunately for you, there's nothing ya can do about it.";
}


?>
