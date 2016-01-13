<?php

#THIS FILE IS (CURRENTLY) NOT USED IN FREEDOMEDITOR AND ONLY EXIST FOR TEST/DEBUG/EXAMPLE PURPOSE
$scrext=".php";

$___workpath=getcwd()."/";
include "init".$scrext;
#$___workpath.="parser/css/";

#include $___workpath."init".$scrext;
  #EXAMPLE USAGE:

#load config
$arr=parse_css(file_get_contents("testsite.css"), true);
print_r($arr);die();
if (is_array($arr)){
foreach ($arr['1'] as $a => $b){
  $_cfg[$a]=piecele($arr['1'], $a);}
 }else{die("config invalid.");}
# end config load

if (!isset($_SESSION)){session_start();$_SESSION['rdmstring']='ulvl';}
$_SESSION[$_SESSION['rdmstring']]=0;
$lang='en';
$aa=initcfg($_cfg);
if (isset($_cfg[$aa]['exact_userlevels'])){
$exacts=explode("-", $_cfg[$aa]['exact_userlevels']);
 }else{$exacts=false;}
$strr=make_object("", $aa);


	  echo $strr;
?>