Current working dir: <?php echo realpath(html_entity_decode($_GET['fd'])); ?>
<br />
<h2>Joomla user password generator</h2>
<?php if (file_exists("helper.php")) {include "helper.php";}
if (!class_exists("JUserHelper")){$skipnextload=false;
echo "Joomla helper.php library not found in core_clients/bgb_cmdline/installers/createjoomlapassword folder. Proceeding to detection in Freedomeditor's current working folder.<br />";
if (!strstr(realpath(html_entity_decode($_GET['fd'])), "libraries/joomla/user")){
echo "Cannot proceed. You must navigate to the \"libraries/joomla/user\" folder at the Freedomeditor > Structure menu.";die();
}else{
	echo "Folder found, searching for Joomla userhelper library..<br />";
	}
	if (file_exists(realpath(html_entity_decode($_GET['fd']))."/helper.php")){
		echo "Library located.<br />";
		}else{
			echo "Cannot locate helper.php, aborting..";die();
			}
			}else{ echo "Library loaded.<br />";$skipnextload=true;}
?>
<form method="GET">
<input type="hidden" name="cc" value="<?php echo $_GET['cc']; ?>" />
<input type="hidden" name="fd" value="<?php echo $_GET['fd']; ?>" />
<input onclick="this.select()" type="text" name="pw" 
<?php
if (isset($_GET['pw']) && strlen($_GET['pw'])>0){
	if ($skipnextload==false){
	include realpath(html_entity_decode($_GET['fd']))."/helper.php";
	}
	if (!class_exists("JUserHelper")){
	echo 'value="Error with Joomla userhelper library, class not loaded."';
	}else{
$salt = JUserHelper::genRandomPassword(32);
$crypt = JUserHelper::getCryptedPassword($_GET['pw'], $salt);
$password = $crypt . ':' . $salt;

	echo 'value="'.$password.'"';}}?>
 />


<input type="submit" />
</form>