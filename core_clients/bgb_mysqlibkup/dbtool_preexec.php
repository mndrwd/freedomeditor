<?php 
if (!isset($n)) { $n=0; }
if (!function_exists("mysqli_connect")){
	echo("PHP error: mysqli_connect function missing (no mysqli-client found).");}
$connection=@mysqli_connect($db_tool['mysqlhost'], $db_tool['mysqluser'], $db_tool['mysqlpw']);
echo mysqli_error($connection);

$dbi= mysqli_query($connection, "show databases");
echo mysqli_error($connection);
#$dbi= mysql_list_dbs($connection);
while ($row = mysqli_fetch_object($dbi)){
     $dblist[$n]=$row->Database;$n++;
}
echo mysqli_error($connection);
if (isset($_GET['db'])){
	$db_tool['mysqldb']=$_GET['db'];
	mysqli_select_db($connection, 
	#mysql_real_escape_string($connection, $db_tool['mysqldb'])
$db_tool['mysqldb']
);
	echo mysqli_error($connection)." ";
	$tablet= mysqli_query($connection, "show tables from `".str_replace("-", "-", mysqli_real_escape_string($connection, $db_tool['mysqldb'])."`" )); 
	echo "<b>Selected Database:</b> ".$db_tool['mysqldb']."<br />";
	echo mysqli_error($connection)." ";
$n=0;
while ($table = mysqli_fetch_array($tablet)) {
$tableyi[$n]=$table[0];$n++; }
echo mysqli_error($connection)." ";
	}
	
$db_tool['zzzz']="bB dirty mySQL db Tool";
$db_tool['version']="1";
$db_tool['maker']="B.G. Bosma";
$db_tool['url']="http://www.bartbosma.eu";
set_time_limit($db_tool['tlimit']);
?>