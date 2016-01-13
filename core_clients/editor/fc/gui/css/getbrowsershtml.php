<?php
               /*
	 * 	Developped by Bart Bosma
	 *	Released under GPL license
	 */
	$__wp=$___workpath;
$___workpath=$workpathios[0]."globals/";

$depend["gethatmpl"]=false;
startfunct($depend);
$depend=array();
$___workpath=$__wp;

if (!function_exists("getbrowsershtml")){
  function getbrowsershtml($klikit, $tmpll="cat_sel"){
    $string='';
      $cattpl=gethatmpl($klikit, $tmpll);
    if (is_array($klikit)){
      foreach ($klikit as $a =>$b){
	$string.=str_replace("{cat}", $a." : ".$b, $cattpl);
      }}
    return $string;
  }}

?>