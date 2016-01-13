<?php 
$current_extlink="no_ext";
$current_ext="no_ext";
$db_tool['scrdir']="core_clients/bgb_mysqlibkup";#"lsdb_tool-v1";									// directory in which dbtool.php exists. (use trailing slash) if ur not including this script into yours, use "."



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
require_once ($App_Root."/".$db_tool['scrdir']."/dbtool_conf.inc.php");
require_once ($App_Root."/".$db_tool['scrdir']."/dbtool_fc.inc.php");

if ($db_tool['sess']=="on") {
@session_start(); }
if($db_tool['sess']=="on" && !isset($_SESSION[$db_tool['sesvar']]) || $db_tool['sess']=="on" &&$_SESSION[$db_tool['sesvar']]!=$db_tool['sesvar_val']) {
#go_to_url($db_tool['authpage']);
}elseif ($db_tool['sess']!="on"  || (isset($_SESSION[$db_tool['sesvar']]) && $_SESSION[$db_tool['sesvar']]==$db_tool['sesvar_val'] )){

	#####################

$db_passget="";
$db_passget_r="";
foreach ($db_passget_a as $dbpeeg) {
	if ($_GET[$dbpeeg]) {
		$get2[$dbpeeg]=$_GET[$dbpeeg];
		$db_passget.=$dbpeeg."=".$_GET[$dbpeeg]."&";}}
		
		foreach ($db_passget_reload as $dbpeeg) {
	if ($_GET[$dbpeeg]) {
		$db_passget_r.=$dbpeeg."=".$_GET[$dbpeeg]."&";}}
		

	if (!$_GET['do']) {
	$_GET['do']="mysql"; }

	$fnamept = $App_Root.$db_tool['os'].$db_tool['scrdir'].$db_tool['os'].$db_tool['bkpth'].$db_tool['os'].$db_tool['mysqldb'].$db_tool['os'];		
	if ($_GET['sl1']=="all") {
		$filename=$db_tool['mysqldb'].".sql";

		}elseif ($_GET['sl1']!="all") {
			$filename=$_GET['sl1'].".sql";
		if ($_GET['ac']=="exp") {
		unset ($tableyi);
		$tableyi[0]=$_GET['sl1']; }
		}
$fname=$fnamept.$filename;
echo "<a href=\"".$_SERVER['PHP_SELF']."?".$db_passget_r."\">Reload</a><hr>";

if ($_GET['do']=='mysql' and !isset($_GET['db']) and $_GET['ac']=='') {				
echo "
 <form action=\"".$_SERVER['PHP_SELF']."\" method=\"GET\">
";
passto_next_form($get2);
echo "
<select size=\"1\" name=\"db\">
";

foreach ($dblist as $dbio) {
echo "<option value=\"".$dbio."\">".$dbio."</option>";
				}
				
	echo "
	</select>
	<input type=\"submit\" value=\"Go\"></form>
	";
}

elseif ($_GET['do']=='mysql' and $_GET['ac']=='') {				
$db_tool['mysqldb']=$_GET['db'];

echo "
 <form action=\"".$_SERVER['PHP_SELF']."\" method=\"GET\">
";
passto_next_form($get2);
echo "
<select size=\"1\" name=\"sl1\">
";

if (!$_GET['sl1']=="") {  
echo "<option value=\"".$_GET['sl1']."\">".$_GET['sl1']."</option>";
}

if ($_GET['sl1']!="all"){
echo "
<option value=\"all\">all</option>
";}

echo "
<option value=\"\">-----</option>
";
foreach ($tableyi as $table) {
echo "<option value=\"".$table."\">".$table."</option>";
				}
				
	echo "
	</select>
	<input type=\"submit\" value=\"Go\"></form>
	";
}

if ($_GET['ac']=="dellbk") {
		$bla=unlink($fname);
		if ($bla) {
			echo $fname." Deleted";}else{ echo "Deleting ".$fname." failed"; }
			echo "<p>";
		
		}


	
	
			if ($_GET['ac']=="exp") {

// Create the SQL statements

		
	foreach ($tableyi as $tabley) {
			$sql = "SHOW CREATE TABLE `".$db_tool['mysqldb']."`.`".$tabley."`";
			
			$result = @mysqli_query($sql);
			echo mysqli_error($connection);
				$row=mysqli_fetch_row($result);
				echo mysqli_error($connection);
				$sqltext="\n";
				$sqltext.= $row[1];
			  $sqltext.=";\n";
			  $sqlli.="\n\nDROP TABLE IF EXISTS `".$tabley."`;";
$sqltext=ereg_replace("ENGINE=MyISAM DEFAULT CHARSET=latin1", "TYPE=MyISAM", $sqltext);
$sqlli.=$sqltext;
		$sql = "DESCRIBE `".$db_tool['mysqldb']."`.`".$tabley."`";
				$describe_res = mysqli_query($sql);
				echo mysqli_error($connection);
				$fieldprops = array();
				$sqlli.=" Insert into `".$tabley."` (";
				while ($row = mysqli_fetch_assoc($describe_res)) {
				
if (!$hia) {
	$hia=0;}
	if ($hia!=0) {
		$sqlli.=", ";}
		$hia++;
		
				 $fieldprops[] = $row;
				 			 
				$sqlli.="`".$row['Field']."`";
	
				
 }unset ($hia);
echo mysqli_error($connection); 

$sqlli.=") VALUES \n";

	$sql = "select count(*) from `".$db_tool['mysqldb']."`.`$tabley`";
				$anzahl_res = mysqli_query($sql);
				if ($anzahl_res) {
					$row = mysqli_fetch_row($anzahl_res);
					$number = $row[0];
				}
				////////////////////////////////////////////////////
				if ($number > 0) {
					if ($seperator == "tab") $seperator = "\t";
					$sql = "SELECT * from `".$db_tool['mysqldb']."`.`$tabley`";
					$down_res = mysqli_query($sql);
					echo mysqli_error($connection);
					$fields = mysqli_num_fields($down_res);
					echo mysqli_error($connection);

					while ($row = mysqli_fetch_assoc($down_res)) {
				if (!$hia) {
	$hia=0;}
	if ($hia!=0) {
		$sqlli.=", \n";}
		$hia++;
					
					$sqlli.="(";
							for ($j=0; $j<count($fieldprops); $j++) {
								
								if (!$via) {
	$via=0;}
	if ($via!=0) {
		$sqlli.=", ";}
		$via++;
								
									$row[$fieldprops[$j]['Field']] = sql_addslashes($row[$fieldprops[$j]['Field']]);
									$fieldvalue = $row[$fieldprops[$j]['Field']];

$sqlli.="'".$fieldvalue."'";
					


}unset ($via);
$sqlli.=")";
}unset ($hia);
echo mysqli_error($connection);
$sqlli.="; ";
		
		}

$eccb.=$tabley." & ";
		}
		
 
 				if (isset($sqlli) AND $sqlli != "") {
				if ($TXT=@fopen($fname, "w")) {
						echo "<b>Writing data from tables ".$eccb." to ".$fname."</b> ...<br>";
						fputs($TXT,$sqlli);
						fclose($TXT);
		}}

				
				
					if ($_GET['upl']==1) {
					echo "<p>upload to ftp:<br>";
foreach ($ftpacct as $ftpacc) {
	$ftpuser=$ftpacc['user'];
	$ftppw=$ftpacc['pw'];
	$ftpaddr=$ftpacc['addr'];
	$ftpwdmsql=$ftpacc['wdmsql'];
	$ftprmimpsc=$ftpacc['rmimpsc'];
	$ftprmimp=$ftpacc['rmimport'];
	$ftpssl=$ftpacc['ssl'];
		echo "<hr>Connecting to <u>".$ftpaddr."</u>...<br>";
		$conn_id = ftp_connect($ftpaddr);
				if ($ftpssl==false || !function_exists("ftp_ssl_connect")){
		$conn_id = ftp_connect($ftpaddr);
		}else{
		$conn_id=ftp_ssl_connect($ftpaddr);
		}
		
		if ($conn_id) {
			echo "<b>Connection success!</b><p>";
		  echo "Logging in as <u>".$ftpuser."</u>...<br>";
		$login_result = ftp_login($conn_id, $ftpuser, $ftppw);
		
		if ($login_result) {
			echo "<b>Login success!</b><p>";
			echo "Changing working directory to <u>".$ftpwdmsql."</u>...<br>";
			
			if (@ftp_chdir($conn_id, $ftpwdmsql."/".$db_tool['mysqldb'])) {
				echo "<b>Change directory success!</b><p>";
			$tables = mysqli_list_tables($db_tool['mysqldb']);



if ($_GET['sl1']=="all") {
$_GET['sl1']=$db_tool['mysqldb']; }

				$upload_success = ftp_put($conn_id, $_GET['sl1'].".sql", $fname, FTP_BINARY);
					if ($upload_success) {
						echo "<b>uploaded as: <u>".$ftpaddr.$ftpwdmsql.$db_tool['os'].$db_tool['mysqldb'].$db_tool['os'].$_GET['sl1'].".sql</u></b><p>";

					}else{ echo "<b>upload failed</b><br>";}
				 	}else{ echo "<b>couldnt change to working directory on ftp server (perhaps its not there)</b><br>";}
				 	}else{ echo "<b>couldnt login to ftp (check your sqlman_conf.inc.php</b><br>";}
				 	}else{ echo "<b>couldnt connect to ftp $ftpaddr perhaps it doesnt exist</b><br>";}
				 		if (ftp_close($conn_id)) {
				 			echo "<b>Connection closed</b><p>"; }else{ echo "<b><u>couldnt close connection</u></b><p>"; }
							 	if ($_GET['rmimp']==1) {
							 		if ($ftprmimp!="off") {
							 		echo "opening \"".$ftprmimpsc."?".$db_passget."sl1=".$_GET['sl1']."\"in ".$db_tool['delay']." seconds<hr>";
				 		sleep($db_tool['delay']);
				 		iframe($ftprmimpsc."?".$db_passget."sl1=".$_GET['sl1']);
				 		echo "<hr>";
				 	}}//else{ echo "no ftp`s specified in sqlman_conf.inc.php<br>";}
				 	

				 		
				 	}
				 	}
					}

if ($_GET['rmimp']==2) {
	foreach ($ftpacct as $ftpacc) {
if ($ftpacc['rmimport']!="off") {
iframe($ftpacc['rmimpsc']."?sl1=".$_GET['sl1']);
echo "<hr>";
}
}
}
	if ($_GET['ac']=="imp") {
iframe($db_tool['scrdir']."/dbtool_imp.php?sl1=".$_GET['sl1']);
echo "<hr>";
}


if ($_GET['ac']=="opti") {
	if ($_GET['sl1']=="all") {
		foreach ($tableyi as $tabul) {
				$sql[] = "OPTIMIZE TABLE `".sql_addslashes($tabul)."`";
	}}
	elseif ($_GET['sl1']!="all") {
	$sql[] = "OPTIMIZE TABLE `".sql_addslashes($_GET['sl1'])."` ";
	}
	
	foreach ($sql as $slq) {
	$qryrsl=mysqli_query($slq);
	echo mysqli_error($connection);
	echo "\"".$slq."\" ";
	if ($qryrsl) {
	echo "successfully executed @ local db<p>";
		}}
}


if (!$_GET['sl1']=="") {
echo "<hr>";
echo "<b>LOCAL SERVER</b><br>";
if (file_exists($fname)) {
echo "| <a href=\"".$db_tool['scrdir']."/dl.php?fn1=".$db_tool['bkpth']."/".$db_tool['mysqldb']."&fn2=".$filename."\">Download sql file</a> ";
echo "| <a href=\"".$_SERVER['PHP_SELF']."?".$db_passget."sl1=".$_GET['sl1']."&ac=imp\">Import sql file</a> ";
echo "| <a href=\"".$_SERVER['PHP_SELF']."?".$db_passget."sl1=".$_GET['sl1']."&ac=dellbk\">Delete sql File</a> ";
}
echo "| <a href=\"".$_SERVER['PHP_SELF']."?".$db_passget."sl1=".$_GET['sl1']."&ac=opti\">Optimize table('s)</a> |<br>";
if ($_GET['ac']!="exp") {
echo "| <a href=\"".$_SERVER['PHP_SELF']."?".$db_passget."sl1=".$_GET['sl1']."&ac=exp\">Export to sql file </a> |";}
if ($ftpacct[1]['addr']=="" and $ftpacct[0]['addr']=="") { echo "";}else{
echo "<hr>| <a href=\"".$_SERVER['PHP_SELF']."?".$db_passget."sl1=".$_GET['sl1']."&ac=exp&upl=1\">Export to sql file & upload to FTP</a> |<br>";
echo "| <a href=\"".$_SERVER['PHP_SELF']."?".$db_passget."sl1=".$_GET['sl1']."&rmimp=2\">load remote import scripts</a> |<br>";
echo "| <a href=\"".$_SERVER['PHP_SELF']."?".$db_passget."sl1=".$_GET['sl1']."&ac=exp&upl=1&rmimp=1\">Export to sql file & upload to FTP & load remote import scripts</a> |<p>";
}}
if (!$_GET['ac']=="") {
		ignore_user_abort(TRUE);
		// If the directory for backups of this database doesn't exist create it
					if (!file_exists($App_Root.$db_tool['os'].$db_tool['scrdir'].$db_tool['os'].$db_tool['bkpth'] . $db_tool['os'] . $db_tool['mysqldb'])) {
						echo $App_Root.$db_tool['os'].$db_tool['scrdir'].$db_tool['os'].$db_tool['bkpth'] . $db_tool['os'] . $db_tool['mysqldb'];
						mkdir($App_Root.$db_tool['os'].$db_tool['scrdir'].$db_tool['os'].$db_tool['bkpth'] . $db_tool['os'] . $db_tool['mysqldb'], 0777);
					 chmod($App_Root.$db_tool['os'].$db_tool['scrdir'].$db_tool['os'].$db_tool['bkpth'] . $db_tool['os'] . $db_tool['mysqldb'], 0777);
		}
	}



	

echo "<hr><a href=\"".$_SERVER['PHP_SELF']."?".$db_passget_r."\">Reload</a>";

}

echo "<hr><a target=\"_blank\" href=\"".$db_tool['url']."\">".$db_tool['zzzz']."</a> ";
echo $db_tool['version']." by ".$db_tool['maker'];


?>