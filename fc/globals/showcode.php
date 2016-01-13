<?php
  /* freedomeditor.com
	 * 	Developed by Bart Bosma
	 *	Released under GPL license
	 */

if (!function_exists("showcode")){
function showcode($dir=getcwd()){
if ($handle = opendir($dir)) {
    echo "Directory handle: $handle\n";
    echo "Files:\n";

    /* Dit is de juiste manier om door een directory te wandelen. */
    while (false !== ($file = readdir($handle))) {
      echo '$depend["'.str_replace(".php", "", $file).'"]=false;<br />';
    }
	echo 'startfunct($depend);<br />$depend=array();<br />';
closedir($handle);
}
 }}

?>