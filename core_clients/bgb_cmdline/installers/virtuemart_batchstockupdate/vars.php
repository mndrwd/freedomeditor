<?php
ob_start();
?>
<h1>
installation of the virtuemart category batch stock updater (known as vm-cbsu).</h1>
Current working folder: <?php echo realpath(html_entity_decode($_GET['fd'])); ?>
<p />

<?php if (!strstr(realpath(html_entity_decode($_GET['fd'])), "administrator/components/com_virtuemart/html")){
echo "Cannot proceed. You must navigate to the \"administrator/components/com_virtuemart/html/\" folder at the Freedomeditor > Structure menu.";
}else{
	
	if (!isset($_SERVER['WINDIR'])){
	?>
Note: folder must be writable for your webserver. <p />
<?php }else{
	?>
LANGreplwindowstipIANG<p />
<?php } ?>
Manual installation:<br />
product.product_list.php needs include of stockupdater.php below "new listFactory ( $pageNav );" line.

<form method="post">
<?php
if (!isset($_SERVER['WINDIR'])){
	?>
	Optional sudo username
<input type="text" name="sudouser" title="Optional sudo username" />
<?php
}else{
	?>
	<input type="hidden" name="sudouser" />
<?php	}?>
<input type="submit" value="Proceed attempt of automatic installation" />
</form>
(After installation check the products > product list in virtuemart administration menu)
<?php
if (isset($_POST['sudouser'])){

$cwd=$__the_cwd."/core_clients/bgb_cmdline/installers/virtuemart_batchstockupdate/";

copy($cwd."product.product_list.stockupdater.php", html_entity_decode($_GET['fd'])."/product.product_list.stockupdater.php");



// insert include
$_POST['filter']="product.product_list.php";
$_POST['find']="pageNav );";
$_POST['replace']="pageNav );include 'components\/com_virtuemart\/html\/product.product_list.stockupdater.php';";
chdir("../../sedfdrepl/");
include "vars.php";

}}


?>