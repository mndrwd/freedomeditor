<?php
               /*
	 * 	Developped by Bart Bosma
	 *	Released under GPL license
	 */

if (!function_exists("getlanghtml")){
  function getlanghtml($klikit, $tmpl='language'){
    $newstr='';

  $langtpl=gethatmpl($klikit, $tmpl);
  if (is_array($klikit)&&is_array($klikit['1'])){
    foreach($klikit['1'] as $a =>$b){
      $newstr.=str_replace($klikit[0], $b, $langtpl);}
  }else{$newstr=$langtpl;}
  return $newstr;
  }}


?>