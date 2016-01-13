<html>
<body>
Current working dir: <?php echo realpath(html_entity_decode($_GET['fd'])); ?>
<br />
<h2>Install third party software extensions</h2>
<ul><li><a href="core_clients/bgb_cmdline/installers/aateau/">
Freedomeditor >Structure view > archive extraction functionality (Bash script "aateau.sh" also suitable for rox-filer)</a></li>
<li><a href="core_clients/bgb_cmdline/installers/mamcwes/">
Mamcwes, mysql + mysqli php4+php5 class with extended security</a></li>
</ul>

<h3>Joomla!</h3>
<ul><li><a href="./?cc=bgb_cmdline/installers/virtuemart_batchstockupdate/&fd=<?php echo $_GET['fd'];?>">
Joomla Virtuemart category batch stock updater</a></li>
<li><a href="./?cc=bgb_cmdline/installers/createjoomlapassword/&fd=<?php echo $_GET['fd'];?>">
Create joomla 1.5 password entry for in mysql table jos_users</a></li></ul>
<h3>Freebsd</h3>
<ul>
<li>
<a href="core_clients/bgb_cmdline/backend/freebsd/package_reinst/?fd=../core_clients/bgb_cmdline/backend/freebsd/package_reinst">Reinstall currently installed ports and packages from current package repository (used when updating for example Freebsd 7.0-RELEASE to 7.1-RELEASE, mainly on systems with few or no compiled ports)</a></ li>
<li><a href="core_clients/bgb_cmdline/backend/freebsd/bpvotss/?fd=../core_clients/bgb_cmdline/backend/freebsd/bpvotss">Reinstall currently installed broken ports and broken packages, from ports.</a></li></ul>

</body>
</html>