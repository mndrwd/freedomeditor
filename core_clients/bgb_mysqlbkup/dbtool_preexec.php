<?php 
if (!isset($n)) { $n=0; }
if (!function_exists("mysql_connect")){
	echo("PHP error: mysql_connect function missing (no mysql-client found).");}
$connection=@mysql_connect($db_tool['mysqlhost'], $db_tool['mysqluser'], $db_tool['mysqlpw']);
$dbi= mysql_list_dbs($connection);

while ($row = mysql_fetch_object($dbi)){
     $dblist[$n]=$row->Database;$n++;
}
if (isset($_GET['db'])){
	$db_tool['mysqldb']=$_GET['db'];
	@mysql_select_db($db_tool['mysqldb'], $connection);
	$tables = mysql_list_tables(mysql_escape_string($_GET['db']));
$n=0;
while ($table = mysql_fetch_row($tables)) {
	$tableyi[$n]=$table[0];$n++; }
	}
	
$db_tool['zzzz']="bB dirty mySQL db Tool";
$db_tool['version']="1";
$db_tool['maker']="bB";
$db_tool['url']="http://";
set_time_limit($db_tool['tlimit']);
?>