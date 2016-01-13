<?php
               /*
	 * 	Developped by Bart Bosma
	 *	Released under GPL license
	 */
	 
if (!function_exists("getclixele")){
  function getclixele($klikit, $req=''){

	global $__lang;  
    $tmplext='';
    $string='';
$truncate_ele_name_at=100;
    if (isset($klikit) && is_array($klikit)&& isset($klikit[html_entity_decode($_GET['cat'])]) && is_array($klikit[html_entity_decode($_GET['cat'])])){
      $tplele=gethatmpl($klikit, "ele");
    #$urlt="&amp;fd=".$_GET['fd']."&amp;fn=".$_GET['fn'];
    if ($req!='' && $req!=html_entity_decode($_GET['cat'])){ $string.='';}else{
$haha=0;
      foreach($klikit[html_entity_decode($_GET['cat'])] as $aa => $bb){
		$thisextlink="";  
	if (strlen($aa)>0){
		$test[0]='{current_ext}';
		$test[1]='folder';
		if ($_GET['cat']==$__lang['files']){
			if (strstr($aa, ".")){ #changed nov 17 2008
				$test[0]="{current_ext}";
				$tempo=explode('.',$aa);
			if (strlen(end($tempo))>0){
			$test[1]= end($tempo);}
			#echo $test[1];
		#added v0.1.3	
		if (isset($GLOBALS['_cfg']) && isset($GLOBALS['_cfg']['ext_links']) && isset($GLOBALS['_cfg']['ext_links'][strtolower($test[1])])){
$thisextlink=strtolower($GLOBALS['_cfg']['ext_links'][strtolower($test[1])]);

#echo $thisextlink;
		}
			}}
		
			if (strlen($aa)>=$truncate_ele_name_at+1){
				$bb=substr($aa, 0, $truncate_ele_name_at)."..";}
				else{$bb=$aa;}
			if (!isset($_GET['structfltr']) || strlen($_GET['structfltr'])<1 || !isset($_GET['enablefilter']) || stristr(html_entity_decode($aa), html_entity_decode($_GET['structfltr']))){	
	
				$test[1]=strtolower($test[1]);
				
				// xtc_dose
				if (stristr(gethatmpl($klikit, "ext_".strtolower($test[1])), "{load:")){				
				
				$xtcdose=str_replace("{load:".findinside("{load:", ":load}", gethatmpl($klikit, "ext_".strtolower($test[1]))).":load}", gethatmpl($klikit, "ext".findinside("{load:", ":load}", gethatmpl($klikit, "ext_".strtolower($test[1])))),gethatmpl($klikit, "ext_".strtolower($test[1])));
				}else{
				$xtcdose=gethatmpl($klikit, "ext_".strtolower($test[1]));
				}			

				// xtspeed_dose
				if (stristr(gethatmpl($klikit, "extlink_".strtolower($thisextlink)), "{load:")){				
				$xtspeedoze=str_replace("{load:".findinside("{load:", ":load}", gethatmpl($klikit, "extlink_".strtolower($thisextlink))).":load}", gethatmpl($klikit, "ext".findinside("{load:", ":load}", gethatmpl($klikit, "extlink_".strtolower($thisextlink)))),gethatmpl($klikit, "extlink_".strtolower($thisextlink)));
				}else{
				$xtspeedoze=				gethatmpl($klikit, "extlink_".strtolower($thisextlink));
				}

				
			  $string.=str_replace(array("{rawele}", "{ele}", "{shortrawele}", "{cat}", "{xtc_dose}", "{xtspeed_dose}", $test[0], "{uniqnum}", "{thisextlink}"),
			  Array(htmlentities($aa), urlencode(htmlentities($aa)), htmlentities($bb), htmlentities($_GET['cat']), 

				
				str_replace("{ele}", urlencode(htmlentities($aa)), $xtcdose),
				
				str_replace("{ele}",urlencode(htmlentities($aa)) , $xtspeedoze ),
				 
				  $test[1], htmlentities($_GET['cat']).$haha, strtolower($thisextlink)), $tplele);}}
      $haha++;
}}	}
			#echo $string;
			#die();
			
			return $string;}}
	
	
	?>
