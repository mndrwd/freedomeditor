<?php
               /*
	 * 	Developped by Bart Bosma
	 *	Released under GPL license
	 */

$scrext=".php";

$getcwdeej=getcwd();
include $corepaths[0]."dependencys.fc".$scrext;
chdir ("../globals/");

	$depend["loadextcfg"]=false;
	startfunct($depend);
$depend=array();
chdir($getcwdeej);

?>