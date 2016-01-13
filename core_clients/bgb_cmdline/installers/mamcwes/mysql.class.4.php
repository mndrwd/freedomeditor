<?php

# by B.G. Bosma
# BSD LICENSE (view LICENSE.txt for details)

# mysqli NOTES
#  the mysqli class only works on php5
#  assigning "pconnect" uses $mysqli->real_connect

# next 2lines  for my extern php script, basically to determine wether php must die when spitting possible mysql errors
if (!isset($_cfg['pages']) || isset ($_cfg['pages']) && !is_array($_cfg['pages'])){ #my script its optional "backup" config-array containing requestable pages data
  $mysqlerrordie=1;}else{$mysqlerrordie=0;}
# thanks to lad @ http://www.php.net/manual/en/function.phpversion.php#58145
# for providing a fast solution
# Compares versions of software
# versions must use the format ' x.y.z... '
# where (x, y, z) are numbers in [0-9]
if (!function_exists("check_version")){
function check_version($currentversion, $requiredversion)
{
   list($majorC, $minorC, $editC) = split('[/.-]', $currentversion);
   list($majorR, $minorR, $editR) = split('[/.-]', $requiredversion);
  
   if ($majorC > $majorR) return true;
   if ($majorC < $majorR) return false;
   // same major - check ninor
   if ($minorC > $minorR) return true;
   if ($minorC < $minorR) return false;
   // and same minor
   if ($editC  >= $editR)  return true;
   return false;
}}

$___php5=check_version(phpversion(), "5.0.0");
# OLD MYSQL CLIENT LIBRARY
if (function_exists('mysql_get_client_info') && !function_exists('mysqli_get_info') || function_exists("mysqli_get_info") &&  function_exists("mysql_get_client_info")) {
#    if ( file_exists("mysql.class.5.php")){
#      rename ("mysql.class.5.php", "disabled/mysql.class.5.php");}
if (!class_exists("MySQL")){
    class MySQL {

        var $querys;
        var $ask;
        var $fetch_array;
        var $fetch_object;
        var $fetch_assoc;
        var $row_count;
	var $link;
        var $query;
	var $conid;
	var $con;
	var $confdatafile;

# next vars determine the global names of the items in your connect-config array
	var $gl_conf_ulvl; # $_SESSION[$gl_conf_userlevel] used to select a conxid
	var $gl_conf_host; #mysqlsubarray host itemname
	var $gl_conf_user; #mysqlsubarray user itemname
	var $gl_conf_pass;
	var $gl_conf_db;
	var $gl_conf_typecon; #mysqlsubarray typecon itemname

        function __error($kind) {
            
            $message .= "There has been a MySQL error for: <b>".$kind.".</b><br>";
            $message .= "The error is: <b>".$this->dberrorr().".</b>";

            return $message;
        }

        function MySQL(){
	   # LOAD STUFF SETTINGS
	  $this->confdatafile="cfg/mysqlcfgdata.inc.php";
	  if (@include ($this->confdatafile)){
	foreach ($this->con as $condatcnt => $condat){
		if ($_SESSION[$this->gl_conf_ulvl] >= $condatcnt){
		  $cid=$condatcnt;}}
	if (!isset($this->con[$cid][$this->gl_conf_port]) or $this->con[$cid][$this->gl_conf_port]==""){$this->con[$cid][$this->gl_conf_port]=3306;}

            if($this->con[$cid][$this->gl_conf_typecon] != "p") {
	      $this->link=@mysql_connect($this->con[$cid][$this->gl_conf_host].":".$this->con[$cid][$this->gl_conf_port], $this->con[$cid][$this->gl_conf_user], $this->con[$cid][$this->gl_conf_pass]);

	      $mofoo=@mysql_select_db($this->con[$cid][$this->gl_conf_db]); 
 if (!$mofoo && $GLOBALS['mysqlerrordie']!=0){die($this->__error("Could not select Database, please check if the database exists"));}
            }
            else
            {
	      $this->link=@mysql_pconnect($this->con[$cid][$this->gl_conf_host].":".$this->con[$cid][$this->gl_conf_port], $this->con[$cid][$this->gl_conf_user], $this->con[$cid][$this->gl_conf_pass]);
	      $mofoo=@mysql_select_db($this->con[$cid][$this->gl_conf_db]);
	    }
 if (!$this->link && $GLOBALS['mysqlerrordie']!=0){die($this->__error("Making connection with the database"));}
 elseif (!$mofoo && $GLOBALS['mysqlerrordie']!=0){die($this->__error("Could not select Database, please check if the database exists"));}
 $this->con=Array();$this->conid=$cid;$this->confdatafile="";
	    return $this->link;
	       }return false;}

        function query ($command) {

            $this->querys++;
            
            $query = @mysql_query($command, $this->link);
	    if (!$query && $GLOBALS['mysqlerrordie']!=0){die($this->__error("Could not execute the query"));}

            return $query;
        }

    function db_object2($command) {
            $this->ask++;
            $this->fetch_object++;
            
            while ($list = @mysql_fetch_object($command)){

$newar[]=$list;}
            return $newar;
        }

    function db_array($command, $type=1) {
            	
            $this->ask++;
            $this->fetch_array++;
            
	    if ($type==1){$ext=MYSQL_NUM;}elseif($type==2){$ext=MYSQL_ASSOC;}elseif($type==3){$ext=MYSQL_BOTH;}
            $list = @mysql_fetch_array($command, $type);

            return $list;
        }
        
    function db_array2($command, $type=1) {
            $this->ask++;
            $this->fetch_array++;
	    if ($type==1){$ext=MYSQL_NUM;}elseif($type==2){$ext=MYSQL_ASSOC;}elseif($type==3){$ext=MYSQL_BOTH;}
            while ($list = @mysql_fetch_array($command, $type)){
$newar[]=$list;}
            return $newar;
        }

        function db_object($command) {
            
            $this->ask++;
            $this->fetch_object++;
            
            $list = @mysql_fetch_object($command);
        
            return $list;
        }

        function db_assoc($command) {

            $this->ask++;
            $this->fetch_assoc++;
            
            $list = @mysql_fetch_assoc($command);

            return $list;
        }

        function count_rows($command) {

            $this->ask++;
            $this->row_count++;

            $count = @mysql_num_rows($command);

            return $count;
        }

        function count_querys() {

            switch($this->querys):

                default:
                    return(print($this->querys." querys"));
                break;

                case 1:
                    return(print($this->querys." query"));
                break;
            
            endswitch;
        }

	function dberrorr() {
	  if (is_object($this->link)){
	    $msg=$this->link->error;
	    return $msg;}}


	function escstr($str) {
	  $stupidstr= @mysql_real_escape_string($str, $this->link);
	  return $stupidstr;}

        function close() {
            
            return @mysql_close($this->link);
        }

    }}

#}else{
# -===============================================-
#           NEW MYSQLI CLIENT LIBRARY
# -===============================================-
#    if ( file_exists("disabled/mysql.class.5.php")){
#      rename ("disabled/mysql.class.5.php", "mysql.class.5.php");
#    }
}


       
       
    ?>