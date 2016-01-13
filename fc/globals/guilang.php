<?php
               /*
	 * 	Developped by Bart Bosma
	 *	Released under GPL license
	 */

 if (!function_exists("guilang")){function guilang($inp, $replm){
#     print_r($replm);die();
     return repl_between($inp, $replm, "LANG", "IANG", false, "sm");  
   }}


?>