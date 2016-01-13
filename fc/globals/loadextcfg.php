<?php
if (!function_exists("loadextcfg")){
function loadextcfg($item) {
	
if (file_exists($item)){
$arr=parse_css(file_get_contents($item), true);
if (isset ($arr) && is_array($arr)){
foreach ($arr['1'] as $a => $b){
  $_cfg[$a]=piecele($arr['1'], $a);}
 }else{die("config (".$item.") invalid.");}}
# end config load

if (isset($_cfg) && is_array($_cfg)){
	return $_cfg;
	}else{ die ("error loading ".$item);}
	
	}}
	
	?>