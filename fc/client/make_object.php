<?php

     /*
	 * 	Developped by Bart Bosma
	 *	Released under GPL license
$strr = 


	 */

if (!function_exists("make_object")){
  function make_object($strr, $aa="main", $langarr=false, $cont=false, $inglue="", $outglue="", $temp2=false){

    global $arr1timers;

    if (!is_array($arr1timers)){
      $arr1timers=array();}

#  echo "TESTETE";die();
  global $_cfg, $exacts, $lang;  
$skipthiscacheload=false;  
if ($cont!=false){global ${$cont};}  
  $thiscfg=&$_cfg;
  if (!isset($strr)){$strr='';}
if ($cont!=false){  
$passcont=$cont;
if (isset (${$passcont}[$aa]) && strlen(${$passcont}[$aa])>0){
$skipthiscacheload=true;
}
}else{$passcont=false;}
  if (!isset ($thiscfg[$aa]['min-userlevel'])) {
	$thiscfg[$aa]['min-userlevel']=0;}
  if (isset ($thiscfg[$aa]['min-userlevel']) && $_SESSION[$_SESSION['rdmstring']]>=$thiscfg[$aa]['min-userlevel'] || is_array($exacts)&& in_array($_SESSION[$_SESSION['rdmstring']], $exacts)){
   #echo "# access granted";die();

#echo "<pre>";print_r(${$passcont});
#die(); 

# find cached
#echo "<pre>";print_r($thiscfg);die();
    if (!isset($thiscfg[$aa]['cachelife'])){
      $timeofmylife=0;}elseif (!is_numeric($thiscfg[$aa]['cachelife'])){$timeofmylife=60;}else{
      $timeofmylife=$thiscfg[$aa]['cachelife'];}
	#echo "<pre>";	print_r($thiscfg);  echo "<hr />";
	
    if (isset($thiscfg[$aa]['str'])&& $strr!=""){
		#echo $thiscfg[$aa]['str']."<br />";
		#echo $thiscfg[$aa]['str']." -- $aa <br />";
		##echo $thiscfg[$aa]['str']." ";
 $cache=gethe("cache", md5($thiscfg[$aa]['str'].$lang
# . serialize($_GET)
), $timeofmylife);
    }else{$cache=false;}
#	if ($GLOBALS['dbg']==true){ echo $thiscfg[$aa]['str'].$lang.$aa." -->";}
      if ($cache==false  || $cache==true && $skipthiscacheload==false){
	if ($strr!=""){$cache=$strr;}else{
		if (isset($thiscfg[$aa]['tmpl_inp'])){
	  $cache=gethe("tmpl", $thiscfg[$aa]['tmpl_inp'], $timeofmylife);}else{$cache='';}}
#	echo getcwd()."/".$thiscfg[$aa]['tmpl_inp'];
	if (function_exists("guilang")&&is_array($langarr)){
	  $cache=guilang($cache, $langarr, "{lang:", "/l}");
	}

#      echo "WTF";die();
#echo $aa."<br /><pre>";print_r($thiscfg[$aa]);die();
#print_r(${$passcont});die();

#if ($cont!=false && isset(${$passcont}[$aa])){echo "WTWF";die();}
#echo ${$passcont}[$aa];die();


	if (isset($thiscfg[$aa]) && isset($thiscfg[$aa]['cnt_inp']) && strlen($thiscfg[$aa]['cnt_inp'])>0){$conttemp=gethe("cont", $thiscfg[$aa]['cnt_inp'].$lang.$aa, $timeofmylife);$temp=&$conttemp;}
	
	elseif($cont!=false && isset(${$passcont}[$aa]))
	{
		$conttemp=${$passcont}[$aa];$temp=$conttemp;
#	echo ${$passcont}[$aa];#conttemp;
#die();
	}
	
#      echo "WTF";die();

 
#	echo $conttemp;die();  
	if (isset ($thiscfg[$aa]['str']) && strstr($cache, $inglue.$thiscfg[$aa]['str'].$outglue) && isset($conttemp)){
      $temp=str_replace($inglue.$thiscfg[$aa]['str'].$outglue, $conttemp, $cache);
	}
	else{
	  #echo $cache."TWETWE";die();
		$temp=$cache;
	}
	
	      #echo $thiscfg[$aa]['str']." <p />".$thiscfg[$aa]['cachable'];#die();
      #echo "WTF";die();

# MARKER
if (isset ($thiscfg[$aa]) && isset($thiscfg[$aa]['cachable']) && $thiscfg[$aa]['cachable']!="off" && isset($conttemp)){
	
	
      if (!isset($thiscfg[$aa]['cachelife']) || !is_numeric($thiscfg[$aa]['cachelife'])){$timeofmylife=60;}else{
	$timeofmylife=$thiscfg[$aa]['cachelife'];}
	
	
	
	#echo $conttemp;
      writecache($conttemp, md5($thiscfg[$aa]['str'].$lang
	#  .serialize($_GET)
), $timeofmylife);
	if ($GLOBALS['dbg']==true){
	echo $conttemp." writing ..<br />";
	}
      }
	
	}else{$temp=$cache;
	$conttemp=$temp;
#	echo $temp;
#die();
	}  
	
	
	#$conttemp=str_replace($inglue.$thiscfg[$aa]['str'].$outglue, "", $conttemp);

#      echo "WTF";die();

}else{#access denied 
$temp="";$do=2;}
#echo $temp."TLATA";die();
if (isset($do) && $do<2 || !isset($do)){  
  $do=0;}

 if (isset ($do) && $do==0){  
    if ($temp2==false){
      $temp2=$cache;}

#echo "<pre>";    print_r(${$passcont});    echo "</pre><hr />";
 
  foreach ($thiscfg as $name =>$abcd){
   # echo $name . "<pre>".print_r($abcd)."</pre><hr />";	
#	if ($GLOBALS['dbg']==true){  
#	echo strlen($temp2)." --". isset($abcd['str'])." -- ".strlen($abcd['str'])." -- ".$aa." -- ".$abcd['str']." -- ".strstr($temp2, $inglue.$abcd['str'].$outglue)."<br />";
#	}




#    echo ${$passcont}[$abcd['str']]." - ". $abcd['str']."<hr />";

    if (
strlen($temp2)>0 && 
isset($abcd['str']) 
&& strlen($abcd['str'])>0 
&& $aa!=$abcd['str']
&& strstr($temp2, $inglue.$abcd['str'].$outglue)
&& isset(${$passcont}[$abcd['str']])
){
      $do=3;

	#echo $aa." - ".$abcd['str']."<p />".$conttemp."<hr />";  
	$temp2=str_replace ($inglue.$abcd['str'].$outglue, "", $temp2);
#echo $abcd['str']."H".$langarr."E".$passcont."H";
#	echo #${$passcont}[
#$abcd['str']
#]."<hr />"
#;
#	print_r(${$passcont});
#	die();
	$arr[$inglue.$abcd['str'].$outglue]=make_object(${$passcont}[$abcd['str']], $abcd['str'], $langarr, $passcont, $inglue, $outglue, $temp2);
#	echo "<hr /><pre>";
#	print_r($arr[$inglue.$abcd['str'].$outglue]);  
	unset ($thiscfg[$name][$abcd['str']]);  
    }
  }
#  echo"<pre>";
#123".$aa."321";
#print_r($arr);echo"<hr />";
  if (isset ($arr) && is_array($arr)){
#    echo "LALALA";die();
 # print_r(array_keys($arr));
#die();
 
   $return=str_replace(array_keys($arr), array_values($arr), $strr);
}else{

    $return=$temp;}

 }
if (!isset($return)){$return=$temp;}

 #echo $return."<hr />";
#die();
return $return;
}
 }
?>
