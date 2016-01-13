<!DOCTYPE HTML PUBLIC \\\"-//W3C//DTD HTML 4.01 Transitional//EN\\\">
<html>
  <head>
    <title>Freebsd BpvoTSS, the bsdadminscripts pkg_validate output to custom shell script writer </title>
</head>
<body>
This page is all about... BpvoTSS!!.
<h3>What's that?</h3>
A little <a href="http://www.freebsd.org/">Freebsd</a> (PC Operating system) ports management helper tool.
<h3>For who is it?</h3>
Administrators who do not (only) update with <a href="http://www.freebsd.org/">Freebsd</a> packages but (also) compile ports..

<h3>What does it do?</h3>
This <a href="http://www.php.net/">PHP</a> script uses output from the command pkg_validate, found in <a href="http://www.google.com/search?q=bsdadminscripts">bsdadminscripts</a>, to write a shell script containing all the commands to reinstall  ports marked as damaged (caused by system software updates, old dependencys, etc.).

<h3>When is it used?</h3> I ran it after updating my freebsd 6.2 to freebsd7.0. When i ran pkg_validate, i noticed i had to somehow rebuild 70 random ports, and didn't wanted to recompile all 700 installed ports with portupgrade -af<br />
Also it is believed that people used the name long ago when rubber was the newest technology, and people tried to impress others in pre-historic languages explaining how a flat tire sounded.

<h3>How does it work?</h3>
<b>1.</b> Take proper steps to allow write access for the "core_clients/bgb_cmdline/backend/freebsd/bpvotss" folder.
<p />
<b>2.</b> <a target="_blank" href="../../../../../?fd=../core_clients/bgb_cmdline/backend/freebsd/bpvotss/&ele=bpvotss.php">Edit</a> gen_output.sh generator script<p />
<form type="submit" method="get" action="../../../../../">
<?php
     $urlcmd="pkg_add -r bsdadminscripts";
       
	#echo $urlcmd;die();   
	?>
	<input type="hidden" name="cc" value="phpterm" />
	<input type="hidden" id="cmdd" name="command" value="<?php echo ($urlcmd);?>" />
	<input type="hidden" name="fd" value="<?php echo $_GET['fd']; ?>" />
	<b>3.</b> <input type="submit" value="Attempt installation of bsdadminscripts package if available." title="pkg_add -r bsdadminscripts" />
	</form><p />
	<form type="submit" method="get" action="../../../../../">
<?php
     $urlcmd="rm gen_input";
       
	#echo $urlcmd;die();   
	?>
	<input type="hidden" name="cc" value="phpterm" />
	<input type="hidden" id="cmdd" name="command" value="<?php echo ($urlcmd);?>" />
	<input type="hidden" name="fd" value="<?php echo $_GET['fd']; ?>" />
	<b>4.</b> <input type="submit" value="remove any previously generated input file." title="rm gen_input" />
	</form><p />
	
		<form type="submit" method="get" action="../../../../../">
<?php
     $urlcmd="/usr/local/bin/php bpvotss.php gen_output.sh gen_input";
       
	#echo $urlcmd;die();   
	?>
	<input type="hidden" name="cc" value="phpterm" />
	<input type="hidden" id="cmdd" name="command" value="<?php echo ($urlcmd);?>" />
	<input type="hidden" name="fd" value="<?php echo $_GET['fd']; ?>" />
	<b>5.</b> <input type="submit" value="Generate bpvotss output file" title="/usr/local/bin/php bpvotss.php gen_output.sh gen_input" />
	</form><p />
	
			<form type="submit" method="get" action="../../../../../">

<b>6.</b> <a href="gen_output.sh">View</a> / <a target="_blank" href="../../../../../?fd=../core_clients/bgb_cmdline/backend/freebsd/backend/bpvotss/&ele=gen_output.sh">edit</a> gen_output.sh (Doublecheck if your editing is saved before proceeding with next step)<p />
<form type="submit" method="get" action="../../../../../">
<?php
     $urlcmd="./gen_output.sh >templog";
       
	#echo $urlcmd;die();   
	?>
	<input type="hidden" name="cc" value="phpterm" />
	<input type="hidden" id="cmdd" name="command" value="<?php echo ($urlcmd);?>" />
	<input type="hidden" name="fd" value="<?php echo $_GET['fd']; ?>" />
	<b>7.</b> <input type="submit" value="Run gen_output.sh (LOG FILE WILL BE CLEARED BEFORE RUNNING)" title="./gen_output.sh >templog" />
	*NOTE: EXPECT THIS TO NOT WORK IN PHPTERM*. It is advised to just run gen_output.sh in a native terminal instead of via this.
<p />
<b>8.</b> <a href="templog">View</a> / <a target="_blank" href="../../../../../?fd=../core_clients/bgb_cmdline/backend/freebsd/bpvotss/&ele=templog">Edit</a> gen_output.sh log file.<p />

<h3>Future plans:</h3>
Might add support for pkg_libchk.
<h3>Contact author</h3>
Contact Bart Bosma
<a href="http://freedomeditor.com">Here..</a>
<p />

Copyright (c) 2008-2009, B.G. Bosma
All rights reserved.
</body></html>
