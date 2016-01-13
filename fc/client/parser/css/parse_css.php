<?php

               /*
	 * 	Developped by Bart Bosma
	 *	Released under GPL license
	 */



if (!function_exists("parse_css")){
  function parse_css($filecont, $custom=false){
    global $_l_cssfilter;
$cssoperators[]="/*cat=";
$cssoperators[]="_*/";
$cssoperators[]=";";
$cssoperators[]="{";
$cssoperators[]="}";
 #$filecont=preg_replace('(\t)', "", $filecont);
 $filecont=trim(nl2br(str_replace(Array("\t", ";*/", "/*cat=", "_*/", "{", "}"), Array('', "*/;", "\n\r /*cat=", "_*/ \n\r", "\n\r { \n\r", "\n\r } \n\r"), $filecont)))	;
 $filecontar=split("<br />", $filecont);
 if (isset($filecontar) && is_array($filecontar)){
 foreach($filecontar as $bb){
  if (strlen($bb)>= 3 || in_array($bb, $cssoperators)){
   $newcssar[]=$bb;
  }}
}
#echo "<pre>";
#print_r($newcssar);

 $status='';
 if (isset($newcssar) && is_array($newcssar)){
 foreach ($newcssar as $aa => $bb){
   if (!isset($nummerik)){$nummerik=0;}
   if (strlen($bb)>0){
   $bbo=$bb;
   foreach ($cssoperators as $csoperator){
  if (stristr($bb, $csoperator)){
   #    if ($csoperator=="/*"){ $status=5;}
    if ($csoperator=='_*/' || $csoperator=='/*cat='){ $status=1;}
   elseif ($csoperator==";") { $status=3;}
   elseif ($csoperator=="{") { $status=2;}
   elseif ($csoperator=="}") { $status=4;}
   
break;}
  
  
}
   $do='';
   if ($status==1 || $status==2){
     if ($status==1){
       $do=$bb;}else{$do=$newcssar[$aa-1];}
     $parselink=str_replace($cssoperators, "", $do);
	 if ($status==1){
   $parselink=preg_replace('[\s]', '', $parselink);}
	 $do=str_replace(array("\n", "\r"), '', $parselink);
  
   $do=str_replace(Array("<br />", "<br>"), "", nl2br($do));
    }
   if ($status==1){
     
     $status=2;      if (strlen($do)>0){$klikit[$do]='';$cat=$do;$do='';}

   }
   elseif ($status==2){
     if (!isset($cat)){$nummerik++;$cat=$nummerik;}
     $ele=$do;$do='';if (strlen(preg_replace('[\s]', '', $ele))>0){#$klikit[$cat][$ele]='';
}$status=3;
}
   elseif ($status==3){
     if (!isset($cat)){$nummerik++;$cat=$nummerik;}
     if (strlen(preg_replace('[\s]', '', $bb))>0 && isset($ele) && strlen($ele)>0){
       if (!isset($ele) ||!isset($cat) ||!isset($klikit[$cat][$ele])){$klikit[$cat][$ele]='';}
   $spaceoutdude=str_replace(Array("  "," "), "{spaceoutdude}", trim($bb));;
 if (isset($_SESSION['res_space']) && $_SESSION['res_space']==1){
       $spaceoutdude=preg_replace('[\n]', ';', $spaceoutdude);
 }else{ }
$spaceoutdude=preg_replace('[\s]', '', $spaceoutdude);
$spaceoutdude=trim(str_replace(";;", ";", $spaceoutdude));
     if (isset($_SESSION['res_space']) && $_SESSION['res_space']==0){
        if ($custom==true || is_substr($_GET['fd'], "edit_area") || is_substr(html_entity_decode($_GET['fd']), $GLOBALS['_cfg']['folders']['language'])!=false){
$rep=" ";
}else{$rep="";}}else{$rep=" ";}
   $spaceoutdude=str_replace("{spaceoutdude}", $rep, $spaceoutdude);
     }else{$spaceoutdude=$bb;}
     $spaceoutdude=unesccss($spaceoutdude);
     $spaceoutdude=trim($spaceoutdude);

     if (isset($ele) && isset($cat) && isset($klikit[$cat][$ele])){
       $klikit[$cat][$ele].= $spaceoutdude;}}
   
   elseif ($status==4){
#     if (isset($newcssar[$aa+1])){
     #  $ele=$newcssar[$aa+1];}else{$ele='';}
     if (isset ($newcssar[$aa+1]) && strstr($newcssar[$aa+1], "/*cat=")){
       $status=1;}else{$status=2;}}
   
   
   }}}
#echo "TEST";die();
 if (!isset($klikit) || count($klikit)< 1){$klikit='';}
 return($klikit);}}
?>