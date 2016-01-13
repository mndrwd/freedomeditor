<?php
function scanajax($inp, $urlvar, $inhtmlcomments=false){

  if (isset($_GET[$urlvar])){
  
  /*
    $ret= repl_between($inp, false, 
		regexpmeta_safe(
		$urlvar."{".$_GET[$urlvar]."}"
		)
		, 
		regexpmeta_safe(
		"{".$_GET[$urlvar]."}".$urlvar
		)
		, true
		, "sm"
		);
		*/
		$ret=findinside($urlvar."{".$_GET[$urlvar]."}", "{".$_GET[$urlvar]."}".$urlvar, $inp,$inhtmlcomments);
    #print_r($ret);
    #echo "ALOTOFBS";
		return $ret;
    
}else{
return("ajax request failure (error from fc/globals/scanajax.php)");}

}

?>