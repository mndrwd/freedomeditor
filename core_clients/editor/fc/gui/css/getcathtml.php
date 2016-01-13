<?php
               /*
	 * 	Developped by Bart Bosma
	 *	Released under GPL license
	 */
	
	$depend["getclixele"]=false;
startfunct($depend);
$depend=array();

$__wp=$___workpath;
$___workpath=$workpathios[0]."globals/";

$depend["gethatmpl"]=false;

startfunct($depend);
$depend=array();
$___workpath=$__wp;
if (!function_exists("getcathtml")){
  function getcathtml($klikit, $tmpll="cat"){
    global $tmplext;
    $string='';
    if (is_array($klikit)){
      $cattpl=gethatmpl($klikit, $tmpll);
    $urlt="&amp;fd=".str_replace("\\", "/",htmlentities($_GET['fd']))."&amp;fn=".htmlentities($_GET['fn']);
$haha=0;
   foreach ($klikit as $aa => $bb){
     $aap=urlencode(htmlentities($aa));  
	$aa=htmlentities($aa); 
     if ($aa==$_GET['cat']){ $req=getclixele($klikit, $_GET['cat']);}else{$req='';}
     $string.=str_replace(Array("{urlstr}", "{rawcat}", "{cat}", "{elements}", "{uniqnum}"), Array($urlt, $aa, $aap, $req, $haha), $cattpl);
$haha++;   
}}return $string;}}

?>
