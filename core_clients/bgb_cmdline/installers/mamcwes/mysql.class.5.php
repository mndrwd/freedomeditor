<?php

# by B.G. Bosma
# BSD LICENSE (view LICENSE.txt for details)

# mysqli NOTES
#  the mysqli class only works on php5
#  assigning "pconnect" uses $mysqli->real_connect

# next 2lines  for my extern php script, basically to determine wether php must die when spitting possible mysql errors
if (!isset($_cfg['pages']) || isset ($_cfg['pages']) && !is_array($_cfg['pages'])){ #my script its optional "backup" config-array containing requestable pages data
  $mysqlerrordie=1;}else{$mysqlerrordie=0;}
# thanks to homey @ http://www.php.net/manual/en/function.phpversion.php#58145
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


# -===============================================-
#           NEW MYSQLI CLIENT LIBRARY
# -===============================================-

 if (function_exists('mysqli_get_client_info')) {
   if ( file_exists("mysql.class.4.php")){
       rename ("mysql.class.4.php", "disabled/mysql.class.4.php");}
if (!class_exists("MySQL") && $___php5==true){
  class MySQL {

        protected $querys;
	protected $ask;
	protected $fetch_array;
	protected $fetch_object;
	protected $fetch_assoc;
	protected $row_count;
	public $conid;
	protected $con;
	private $confdatafile;
	public $str;
	public $query;
        protected $link;

	private $gl_conf_ulvl;
        public $gl_conf_host; #mysqlsubarray host itemname
	public $gl_conf_user; #mysqlsubarray user itemname
	public $gl_conf_pass;
	public $gl_conf_db;
	public $gl_conf_port;
	public $gl_conf_typecon; #mysqlsubarray typecon itemname
	private $gl_conf_options; #mysql options subarray

        function __error($kind) {
            
            $message .= "There has been a MySQLi error for: <b>".$kind.".</b><br>";
            $message .= "The error is: <b>".$this->dberrorr().".</b>";

            return $message;
	    }
// destructor (delete object)
	function __destruct() {
		$this->close();
	}
	
	
        function __construct(){
	   # LOAD STUFF SETTINGS
	  $confdatafile="cfg/mysqlcfgdata.inc.php";
	 #echo "<pre>";	  print_r($GLOBALS);die();
	  if ( @include ($confdatafile)){
	foreach ($this->con as $condatcnt => $condat){
		if ($_SESSION[$this->gl_conf_ulvl] >= $condatcnt){
		  $cid=$condatcnt;}}
	if (!isset($this->con[$cid][$this->gl_conf_port]) or $this->con[$cid][$this->gl_conf_port]==""){$this->con[$cid][$this->gl_conf_port]=3306;}

            if($this->con[$cid][$this->gl_conf_typecon] != "p") {
	    
	    
	      $this->link=new mysqli ($this->con[$cid][$this->gl_conf_host], $this->con[$cid][$this->gl_conf_user], $this->con[$cid][$this->gl_conf_pass], $this->con[$cid][$this->gl_conf_db], $this->con[$cid][$this->gl_conf_port]);
	      #echo ($this->con[$cid][$this->gl_conf_host]." ".$this->con[$cid][$this->gl_conf_user]." ".$this->con[$cid][$this->gl_conf_pass]." ". $this->con[$cid][$this->gl_conf_db], $this->con[$cid][$this->gl_conf_port]);
#if(mysqli_connect_errno()) {
  #echo "CONNERROR";die();}else{ echo $this->escstr("NOCONEROR");die();}
	      #echo "<pre>";	      print_r($this);die();
            }
            else
            {

	      $this->link=mysqli_init();
	      if (is_array($this->con[$cid][$this->gl_conf_options])){
	      foreach ($this->con[$cid][$this->gl_conf_options] as $a1 => $a2){
		$this->link->options($a1, $a2);}}
	      $this->link->real_connect($this->con[$cid][$this->gl_conf_host], $this->con[$cid][$this->gl_conf_user], $this->con[$cid][$this->gl_conf_pass], $this->con[$cid][$this->gl_conf_db], $this->con[$cid][$this->gl_conf_port]);
	    }
	    $this->conid=$cid;
	    $this->con=Array();$this->confdatafile="";
 if (mysqli_connect_errno() && $GLOBALS['mysqlerrordie']!=0) {

   die($this->__error("Making connection with the database"));}
            
	    return $this->link; 
	  }return false;}
    
	function query($command) {

	  if (is_object($this->link)){
            $this->querys++;
            
            $query =$this->link->query($command);
	    if (!$query && $GLOBALS['mysqlerrordie']!=0) {die($this->__error("Could not execute the query"));}

 return $query; }return false;
        }

	      function db_object2($cmd) {
		if (is_object($cmd)){
            $this->ask++;
            $this->fetch_object++;
            
            while ($list = $cmd->fetch_object()){

$newar[]=$list;}
            return $newar;}return false;
        }

	      function db_array($cmd, $type=1) {
            	
		if (is_object($cmd)){
            $this->ask++;
            $this->fetch_array++;
            
	    if ($type==1){$ext=MYSQLI_NUM;}elseif($type==2){$ext=MYSQLI_ASSOC;}elseif($type==3){$ext=MYSQLI_BOTH;}
            $list = $cmd->fetch_array($type);

            return $list;
		}return false;
        }
        
	      function db_array2($cmd, $type=1) {
		if (is_object($cmd)){
            $this->ask++;
            $this->fetch_array++;
            
	    if ($type==1){$ext=MYSQLI_NUM;}elseif($type==2){$ext=MYSQLI_ASSOC;}elseif($type==3){$ext=MYSQLI_BOTH;}
            while ($list = $cmd->fetch_array($ext)){
$newar[]=$list;}
            return $newar;
		}return false;
        }

        function db_object($cmd) {
	  if (is_object($cmd)){
            
            $this->ask++;
            $this->fetch_object++;
            
            $list = $cmd->fetch_object();
        
            return $list;}return false;
        }

        function db_assoc($cmd) {
	  if (is_object($cmd)){
            $this->ask++;
            $this->fetch_assoc++;
            
            $list = $cmd->fetch_assoc();
	  
            return $list;
	  }return false;
        }

        function count_rows($cmd) {

	  if (is_object($cmd)){
            $this->ask++;
            $this->row_count++;

            $count = $cmd->num_rows;

            return $count;}
	  return false;
        }

        function count_querys() {

            switch($this->querys):
               default:return(print($this->querys." querys"));break;
                case 1:return(print($this->querys." query"));break;
            endswitch;
        }
	
	function dberrorr() {
	  if (is_object($this->link)){
	    $msg=$this->link->error;
	    return $msg;}}

	function escstr($str) {
#	  print_r($this->link);
#        echo $str;
	  if (is_object($this->link)){
	    
$test=$this->link->real_escape_string($str);
#        echo $test;
 return $test;}return false;}

        function close() {
	  if (is_object($this->link)){            
 $this->link->close();
 $this->link = null;
 return;}return false;}
    }

 }}else{
  if ( file_exists("disabled/mysql.class.4.php")){
    rename ("disabled/mysql.class.4.php", "mysql.class.4.php");}


 }
    ?>