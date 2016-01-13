<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
/**

@ Joomla Virtuemart batch stock updater for categories
Version 1 by B Bosma www.freedomeditor.com
GPL License version 3 applies
*/

if (isset($category_id) && $perm->check("admin")){
	
$amount= vmGet($_REQUEST, 'amount' );
	if (isset($amount) && $amount>0){
$q=	"
UPDATE #__{vm}_product, #__{vm}_product_category_xref 
SET `product_in_stock` = product_in_stock+".$amount." 
WHERE  #__{vm}_product_category_xref.category_id =".$category_id." 
AND
#__{vm}_product.product_id=#__{vm}_product_category_xref.product_id
";

 $db->query($q);


		echo "category batch stock update succesfull<br />";
		}
	?>
	<form name="stockupdate" method="post" onsubmit="stockupdate.action.value='<?php echo $_SERVER['PHP_SELF'] ?>?option=com_virtuemart&page=product.product_list&category_id='+document.getElementById('category_id').options[selectedIndex].value;'" 	 />
	<input type="text" name="amount" title="category stock amount"  />
	<input type="submit" />
	</form>
	
	
	
	<?php
	}
	?>