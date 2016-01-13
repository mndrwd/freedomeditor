<?php
               /*
	 * 	Developped by Bart Bosma
	 *	Released under GPL license
	 */
	#OVERWRITES $READONLY -- LEFT FOR DEBUG PURPOSES 
$readonly=false; # try comment this out it might work haven't tested yet
if (isset($_POST['editelecont'])){
	
	$readonly=false;}



if (!function_exists("parse_init")){function parse_init($aa2=false){
	
    global $donememo, $_cfg, $fd, 
		//$ckinm, 
		$current_ext, $readonly, $skip_css_specific;
$skip_css_specific=false;
if ($aa2!=false && is_array($aa2)){
	$skip_css_specific=true; if(isset($_POST['editelecont'])){ $readonly=false;}}
#prepare file query

if (isset($_GET) && isset($_GET['fn'])&&strlen($_GET['fn'])>0){
	if (strlen($current_ext)>0){
		if ($current_ext!="" && $current_ext!="no_ext"){
		$temp_1=".".$current_ext;}else{$temp_1="";}
		}
		
  $_GET['fn']=str_replace(Array("..", "/", ".".$current_ext), "", $_GET['fn']).$temp_1;
 } 
$temp_1='';

if (!isset($donememo)){$donememo='';}
if (!isset($_cfg['global']['memorize'])){$_cfg['global']['memorize']='';}
$_cfg['max']=$_cfg['global']['memorize']*$_cfg['global']['memorize'];
if(isset($_GET['mode'])&& is_numeric($_GET['mode'])){
     $_SESSION['res_space']= addslashes( $_GET['mode']);}
if (!isset($_SESSION['res_space'])){
  $_SESSION['res_space']=1;}

if (!isset($_GET) || !isset($_GET['fd']) || $_GET['fd']==''){$_GET['fd']='nonexistent';}else{ # $_GET['fd']= str_replace('..', '', addslashes($_GET['fd']));
}
if (!isset($_cfg['ddir'])){$_cfg['ddir']='';}
if (isset($_GET) && isset($_GET['fd'])&&strlen($_GET['fd'])>0 && is_dir($_cfg['ddir'].html_entity_decode($_GET['fd']).'/')){
    chdir($_cfg['ddir'].html_entity_decode($_GET['fd']).'/');
 }elseif (is_dir($_cfg['ddir']."css") &&isset($_GET) && $_GET['fd']==''){chdir("css");$fd='css';if (strlen($_GET['fd'])==0){$_GET['fd']='';}}

elseif (isset($_GET) && isset($_GET['fd']) && $_GET['fd']=='nonexistent'){if (is_dir('css')){$fd='css';chdir('css');}$_GET['fd']='';}
if (!isset($fd)){$fd='';}
if (is_array($aa2) || isset($_GET) && isset($_GET['fn']) && file_exists(html_entity_decode($_GET['fn']))){
	if (!is_array($aa2)){
	$filecont=file_get_contents(html_entity_decode($_GET['fn']));
	}
if (is_array($aa2) || isset($filecont) && strlen($filecont)>0){
	if (!is_array($aa2)){
$klikit=parse_css($filecont, $aa2);# make 3d array of existing data

}else{
$klikit=$aa2;}

#change it with other userinput:

 if (isset($_GET['rmcat'])){
#remove category/comment:
   $klikit[html_entity_decode($_GET['rmcat'])]=''; 
   unset ($klikit[html_entity_decode($_GET['rmcat'])]);
 }
# rm element
 elseif (isset($_GET['rmele'])){
   $klikit[html_entity_decode($_GET['cat'])][html_entity_decode($_GET['rmele'])]='';
   unset($klikit[html_entity_decode($_GET['cat'])][html_entity_decode($_GET['rmele'])]);
 }
 elseif (isset($_POST)&& is_array($_POST)){

     if (isset($_POST['attach'])){
       $ohwmg=explode(":", $_POST['brw']);
       $ohwmg=trim($ohwmg[0]);
        $_POST['ele']=trim($_POST['ele']);
       $_POST['ele'].=$ohwmg;unset($ohwmg);
     }
     if (isset($_POST['ele']) && strlen($_POST['ele'])>0 && html_entity_decode($_GET['ele'])!=$_POST['ele'] or isset($_POST['attach'])){
#remove old (get) ele and set get to new posted
       if (!isset($_POST['attach'])){
   $klikit[html_entity_decode($_GET['cat'])][html_entity_decode($_GET['ele'])]='';
   unset($klikit[html_entity_decode($_GET['cat'])][html_entity_decode($_GET['ele'])]);
}     $_GET['ele']=urlencode(htmlentities($_POST['ele']));
$readonly=false;   
     }
  
# edit elem contents
if ($skip_css_specific==true){
	if (isset($_POST['editelecont'])){
$spaceoutdude=$_POST['editelecont'];
}
#return $spaceoutdude;
}else{
   if(isset($_POST['editelecont'])){
  $spaceoutdude=str_replace(Array("  "," "), "{spaceoutdude}", trim($_POST['editelecont']));
 if (isset($_SESSION['res_space']) && $_SESSION['res_space']==1){
       $spaceoutdude=preg_replace('[\n]', ';', $spaceoutdude);
 }else{ 
}
 $spaceoutdude=preg_replace('[\s]', '', $spaceoutdude);
$spaceoutdude=trim(str_replace(";;", ";", $spaceoutdude));
     if (isset($_SESSION['res_space']) && $_SESSION['res_space']==0){

       if(is_substr($_GET['fd'], "edit_area") || is_substr(html_entity_decode($_GET['fd']), $GLOBALS['_cfg']['folders']['language'])){
$rep=" ";}else{$rep="";}}else{$rep=" ";}
   $spaceoutdude=str_replace("{spaceoutdude}", $rep, $spaceoutdude);
   
       
}}
if (isset($spaceoutdude)){
     $klikit[html_entity_decode($_GET['cat'])][$_POST['ele']]= html_entity_decode($spaceoutdude);
	#echo $klikit[html_entity_decode($_GET['cat'])][$_POST['ele']];
	unset($spaceoutdude); 
}

# add categ
 if (isset($_POST['addcat'])&& strlen($_POST['addcat'])>0){
     $klikit[$_POST['addcat']]='';
     $_GET['cat']=urlencode(htmlentities($_POST['addcat']));
   }

# add elem
   elseif (isset($_POST['addele']) && isset($_POST['addele']) && strlen($_POST['addele'])>0){
     $klikit[$_POST['cat']][$_POST['addele']]='';
     if (isset($_POST['addele']) && strlen($_POST['addele'])>0){
       $_GET['cat']=urlencode(htmlentities($_POST['cat']));
       $_GET['ele']=urlencode(htmlentities($_POST['addele']));
     }
   }
   if(isset($_POST['clr_hex'])&& isset($_POST['addcolor']) && $_POST['addcolor']=="addcolor"){
	   
//    if (strlen($_COOKIE[$ckinm])>0){$_COOKIE[$ckinm]=$_POST['clr_hex'].",".$_COOKIE[$ckinm];}else{$_COOKIE[$ckinm]=$_POST['clr_hex'];}
//setcookie ($ckinm, $_COOKIE[$ckinm],$_cfg['global']['ckitime']);
   }
 }
 }
 }
if (!isset($klikit)){$klikit=array();}

 return  $klikit;
  }}
?>