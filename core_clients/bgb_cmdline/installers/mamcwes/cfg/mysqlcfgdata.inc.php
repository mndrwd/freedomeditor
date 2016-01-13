<?php
$another_unique_string_Zzz     ="random,veryveryrandom,but the same as ablove/beflow";
if ($another_unique_string_Zzz=="random,veryveryrandom,but the same as ablove/beflow")
{ unset ($another_unique_string_Zzz);


#think twice before putting a password here

# entrys are bound to cfg.inc.php
# =======================
# select here
$i=0;
$this->con[$i]['host']		=			"localhost";
$this->con[$i]['user']               =			"username";
$this->con[$i]['pass']		=			"password";
$this->con[$i]['db']			=			"database";
$this->con[$i]['typecon'] 	        =			"not_p";#connect
# p for www.php.net/mysql_pconnect
# or if mysqli, p for www.php.net/mysqli_real_connect
#$this->con[$i]['port']="3306";
#$this->con[$i]['options']["custom"]    =        "custom";
# these get only used when using php5 with mysqli and you assign "p"connect in typecon
# this is because the default mysql.class (i wrote ;) handles pconnects as www.php.net/mysqli_real_connect
$i++;

# ========================
# select untill here
# ========================
# paste here:


	  $this->gl_conf_ulvl=$_SESSION['rdmstring'];# $_SESSION[$gl_conf_userlevel] used to select a conxid
	  $this->gl_conf_host="host";
	  $this->gl_conf_user="user";
	  $this->gl_conf_pass="pass";
	  $this->gl_conf_db="db";
	  $this->gl_conf_port="port";
	  $this->gl_conf_typecon="typecon";
	  $this->gl_conf_options="options";


 }
?>