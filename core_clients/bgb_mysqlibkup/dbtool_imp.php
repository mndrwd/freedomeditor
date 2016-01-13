<?php 
$db_tool['scrdir']="core_clients/bgb_mysqlibkup";									// directory in which dbtool_imp.php exists. (use trailing slash)
	$ScriptPath = $_SERVER['SCRIPT_FILENAME'];
	
	/*
	** get root of Web site
	*/
	$ScriptPath = $_SERVER['SCRIPT_FILENAME'];
		eregi("([^/\\]*)$", $ScriptPath, $match);
	$ThisScript = $match[0];
	$vl=strlen($db_tool['scrdir']);
	$vla=substr($db_tool['scrdir'], 0, $vl);
	$App_Root = eregi_replace("[/\\]$ThisScript", "", $ScriptPath);
	if (substr($App_Root, -$vl)==$vla) {
		$App_Root=substr($App_Root, 0, -$vl);
			}
		
require_once ("dbtool_conf.inc.php");
require_once ("dbtool_fc.inc.php");

if ($db_tool['sess']=="on") {
session_start(); }

 if (!$_GET['sl1']) {
	go_to_url($db_tool['exiturl']);
	}else{

if ($_GET['sl1']=="all") {
	$_GET['sl1']=$db_tool['mysqldb'];}
	$slfile=$db_tool['bkpth'].$db_tool['os'].$db_tool['mysqldb'].$db_tool['os'].$_GET['sl1'].".sql";
	echo $slfile;
	if (file_exists($slfile)) {

			$TXT=fopen($slfile, "r");
			$sql = "";
			while(feof($TXT)==0) {
				$zeile=chop(fgets($TXT, 24000));
				$sql .= $zeile;
			}
			fclose($TXT);
		  $sqllp= (split(";", $sql));
			
				foreach ($sqllp as $qry) {
				$exeqr=mysqli_query($connection, $qry);				
				echo mysqli_error($connection);
				if ($exeqr) {
					echo "".$qry."<p>";unset ($qry); unset($sql_drop);
					}
				}
		
		}else{ 
		if ($_SESSION[$db_tool['sesvar']]==$db_tool['sesvar_val'] or $db_tool['sess']=="off") {
			echo "nothing to do.";}else{
go_to_url($db_tool['exiturl']);

}}

if (unlink($slfile)) {
echo "<hr>\"".$slfile."\" Deleted.";
}
}
echo "<hr><a target=\"_blank\" href=\"".$db_tool['url']."\">".$db_tool['zzzz']."</a> ";
echo $db_tool['version']." by ".$db_tool['maker'];
 ?>	