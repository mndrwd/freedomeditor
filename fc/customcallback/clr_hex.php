<?php
		if (!isset($hex)){$hex='#ffffff';}
	if (isset($_POST['clr_hex']) && strlen($_POST['clr_hex'])>0){
	  if ($_POST['clr_hex']{0}!="#"){$hex="#";}else{$hex='';}$hex.=$_POST['clr_hex'];}
	
	$hex2=get_hex($GLOBALS['__the_cwd']."/".$GLOBALS['_cfg']['folders']['templates'].$GLOBALS['_cfg']['global']['default_template']."/img/");
if ($hex2!=FALSE){$hex=$hex2;}

return $hex;

?>