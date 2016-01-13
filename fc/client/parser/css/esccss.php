<?php

               /*
	 * 	Developped by Bart Bosma
	 *	Released under GPL license
	 */

if (!function_exists("esccss")){function esccss($css){
    $css=str_replace(array("\;", "\{", "\}",'<br />'), array("_dotcm_", "_brace_", "_bbrace_", "_nwln_"), $css);return($css);}}

?>