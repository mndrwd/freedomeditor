<?php 
$db_passget_a[]="action";														// if you include this script into yours then you can pass these gets to this script for correct interface operation..
$db_passget_a[]="page";
$db_passget_a[]="db";
$db_passget_a[]="cc";
//$db_passget[]="";

# SAME BUT FOR RELOAD BUTTON
$db_passget_reload[]="db";
$db_passget_reload[]="cc";

$db_tool['delay']=3;															// delay between starting ftp upload and calling remote import script
$db_tool['tlimit']=120;														// script execution timelimit
$db_tool['os']=		"/";														// use "/" on unix/*bsd, use "\" on windows
$db_tool['extconfig']= "../config.inc.php";				// extern config file
$db_tool['bkpth']="../../.sqlexport";												/** local export-to folder path starting from the folder this file is in
warning:	use double backslashes on windows and a single trailing
example1	"foo\\sql\"
example2	"sql\" 
*/
$mysqlhosts[0]="localhost";
$mysqluser="root";
$mysqlpass="";
$mysqlpass="trinitron";

if (!$mysqlhosts or !$mysqlhosts[0]) {
	@include $db_tool['extconfig']; }
$db_tool['mysqlhost']=$mysqlhosts[0];
$db_tool['mysqluser']=$mysqluser;
$db_tool['mysqlpw']=$mysqlpass;
$db_tool['mysqldb']="";											// database
$db_tool['exiturl']="../";								
/** 	url one goes to if dbtool_import.php is directly called
			and the local export-to folder contains no sql files
*/

// Iframe Setup
$dbt_iframe['scrl']="yes";												// frame scrolling
$dbt_iframe['hght']=300;
$dbt_iframe['wdth']=600;
$dbt_iframe['fbd']="on";													// frameborder "on"/"off"

// Session Support
$db_tool['sesvar']="login";										// which $_SESSION array value to check for existence (one could set it to $yourarray['adminuserlevel'] )
$db_tool['sesvar_val']="1";										// value it needs to be

$db_tool['sess']="off";														// session support+authentication, "on"/"off"
///** // [mandatory if 'sess'="on"]
		// if you are not using this, the dbtool_auth.php could aswell be deleted
$db_tool['authpage']="../auth.inc.php";				// yours or build-in authentication script
$db_tool['bdin_auth']['md5']="on";								// md5 encryption "on"/"off"
$db_tool['bdin_auth']['utn']="users";							// users table name
$db_tool['bdin_auth']['ufn']="login";							// user field name
$db_tool['bdin_auth']['pfn']="pw";								// password field name

// */ // [/mandatory if 'sess'="on"]


$i=0;
// Remote FTP & import Support
/**
$ftpacct[$i]['addr']=		"lion-ts.redirectme.net";		// address
$ftpacct[$i]['user']=		"chucky";				// username
$ftpacct[$i]['pw']=		"ducky";				// pass
$ftpacct[$i]['wdmsql']=		"/sql";					// working directory
$ftpacct[$i]['rmimpsc']="http://lion-ts.redirectme.net:8080/~bosma-autos/lsdb_tool-v1/dbtool_imp.php";
// url to remote import script
//*/
$i++;

// Remote FTP & import Support
///**
$ftpacct[$i]['addr']=		"yourhost";		// address
$ftpacct[$i]['user']=		"user";							// username
$ftpacct[$i]['pw']=		"pw1234567";									// pass
$ftpacct[$i]['wdmsql']=			"/var/www/html/tmpdbmap";								// working directory
$ftpacct[$i]['rmimpsc']="http://www.".$ftpacct[$i]['addr']."/ffs/".$db_tool['scrdir']."/dbtool_imp.php";
// url to remote import script
//*/
$i++;




require_once($App_Root."/".$db_tool['scrdir']."/dbtool_preexec.php");
?>