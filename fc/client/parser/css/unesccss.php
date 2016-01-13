<?php
               /*
	 * 	Developped by Bart Bosma
	 *	Released under GPL license
	 */


if (!function_exists("unesccss")){function unesccss($css){
    $css=str_replace(array("_dotcm_", "_brace_", "_bbrace_", "_nwln_"), array("\;", "\{", "\}",'<br />'), $css);return($css);}}

?>