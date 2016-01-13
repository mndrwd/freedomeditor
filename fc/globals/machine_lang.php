<?php
               /*
	 * 	Developped by Bart Bosma
	 *	Released under GPL license
	 */

if (!function_exists("machine_lang")){function machine_lang($bbp, $_l_cssfilter, $dir=false){
	
	if (is_array($_l_cssfilter) && count($_l_cssfilter)>0){
   if ($dir==false){$arr1=array_keys($_l_cssfilter);$arr2=array_values($_l_cssfilter);
    }else{$arr1=array_values($_l_cssfilter);$arr2=array_keys($_l_cssfilter);}
   return str_replace($arr1, $arr2, $bbp);
} 
return $bbp;
}
  }

?>