<!DOCTYPE HTML PUBLIC \\\"-//W3C//DTD HTML 4.01 Transitional//EN\\\">
<html>
  <head>
    <title>Freebsd Package reinstaller by Bart Bosma </title>
</head>
<body>
<h3>What is this?</h3>
A <a href="http://www.freebsd.org/">Freebsd</a> (PC Operating system) 
Third party software binary packages reinstaller.

<h3>What does it do?</h3>
This <a href="http://www.php.net/">PHP</a> script uses output from the command "ls /var/db/pkg", to write a shell script containing all the commands to reinstall most (if not all) currently installed packages or ports, from <b>packages</b> (current repository).

<h3>When is it used?</h3> When updating to a new freebsd release with the freebsd-update command.

<h3>How does it work?</h3>
<b>1.</b> Take proper steps to allow write access for the "core_clients/bgb_cmdline/backend/freebsd/package_reinst" folder.
<p />
<b>2.</b> <a target="_blank" href="../../../../../?fd=../core_clients/bgb_cmdline/backend/freebsd/package_reinst/&ele=package_reinst.php">Edit</a> outputscript.sh generator script<p />
<form type="submit" method="get" action="../../../../../">
<?php
     $urlcmd="/usr/local/bin/php package_reinst.php outputscript.sh";
       
	#echo $urlcmd;die();   
	?>
	<input type="hidden" name="cc" value="phpterm" />
	<input type="hidden" id="cmdd" name="command" value="<?php echo ($urlcmd);?>" />
	<input type="hidden" name="fd" value="<?php echo $_GET['fd']; ?>" />
	<b>3.</b> <input type="submit" value="Create outputscript.sh" title="/usr/local/bin/php package_reinst.php outputscript.sh" />
	</form><p />
<b>4.</b> <a href="outputscript.sh">View</a> / <a target="_blank" href="../../../../../?fd=../core_clients/bgb_cmdline/backend/freebsd/package_reinst/&ele=outputscript.sh">edit</a> outputscript.sh (Doublecheck if your editing is saved before proceeding with step 8)<p />
<form type="submit" method="get" action="../../../../../">
<?php
     $urlcmd="pkg_add -r freebsd-update";
       
	#echo $urlcmd;die();   
	?>
	<input type="hidden" name="cc" value="phpterm" />
	<input type="hidden" id="cmdd" name="command" value="<?php echo ($urlcmd);?>" />
	<input type="hidden" name="fd" value="<?php echo $_GET['fd']; ?>" />
	<b>5.</b> <input type="submit" value="Attempt installation of freebsd-update package if available." title="pkg_add -r freebsd-update" />
	</form><p />


<form type="submit" method="get" action="../../../../../">
<?php
     $urlcmd="man freebsd-update";
       
	#echo $urlcmd;die();   
	?>
	<input type="hidden" name="cc" value="phpterm" />
	<input type="hidden" id="cmdd" name="command" value="<?php echo ($urlcmd);?>" />
	<input type="hidden" name="fd" value="<?php echo $_GET['fd']; ?>" />
	<b>6.</b> <input type="submit" value="View freebsd-update command manual" title="man freebsd-update" />
	*NOTE: this needs the freebsd-update package/port installed in earlier freebsd versions, as it is not supplied with freebsd itself*.
	</form><p />
	<b>7.</b> At this point, manually execute the whole freebsd-update process from a native terminal. It cannot be done from phpterm, as phpterm only supports commands which return to shell prompt.<p />
<form type="submit" method="get" action="../../../../../">
<?php
     $urlcmd="./outputscript.sh >templog";
       
	#echo $urlcmd;die();   
	?>
	<input type="hidden" name="cc" value="phpterm" />
	<input type="hidden" id="cmdd" name="command" value="<?php echo ($urlcmd);?>" />
	<input type="hidden" name="fd" value="<?php echo $_GET['fd']; ?>" />
	<b>8.</b> <input type="submit" value="Run outputscript.sh" title="./outputscript.sh >templog" />
	*NOTE: EXPECT THIS TO NOT WORK IN PHPTERM*. It is advised to just run outputscript.sh in a native terminal instead of via this.
	Also note that php most likely will be reinstalled from package, which means no apache module is available anymore after running this.
	This can be fixed by recompiling php. Also note that due to the way this program works, (it just strips the version number of installed packages) programs like "apache22" will be removed and "apache" will be added. (which happen to be the  old apache 1.3) Therefore it is always advised to pipe outputscript.sh it's console output into a log file as this button by default does. To prevent this from occuring, edit the generated script with the edit button at step 4, add some manual commands to install latest packages for software you require. Put those commands above the existing pkg_add -r commands, but below the first line (pkg_delete).
	</form><p />
<b>9.</b> <a href="templog">View</a> / <a target="_blank" href="../../../../../?fd=../core_clients/bgb_cmdline/backend/freebsd/package_reinst/&ele=templog">Edit</a> outputscript.sh log file.<p />	
<b>10.</b> Update ports tree:<br />
cvsup<p />
<form type="submit" method="get" action="../../../../../">
<?php
     $urlcmd="pkg_delete php*";
       
	#echo $urlcmd;die();   
	?>
	<input type="hidden" name="cc" value="phpterm" />
	<input type="hidden" id="cmdd" name="command" value="<?php echo ($urlcmd);?>" />
	<input type="hidden" name="fd" value="<?php echo $_GET['fd']; ?>" />
	<b>11.</b> <input type="submit" value="Remove php" title="pkg_delete php\*" />
</form>
<p />
<h3><b>12.</b> Recompiling ports (like php):</h3>
<u>rm -r /usr/ports/*/*/work/*</u><br />
<i>cd /usr/ports/lang/php5<br />
make config</i><br />
<u>cd /usr/ports/lang/php5-extensions</u><br />
<i>make config</i><br />
<u>make install clean<br />
apachectl restart</u><br />
<i>Only required if php was never compiled before.</i><br />




<h3>Contact author</h3>
Contact Bart Bosma
<a href="http://freedomeditor.com">Here..</a>
<p />


Copyright (c) 2009, B.G. Bosma
All rights reserved.
</body></html>
