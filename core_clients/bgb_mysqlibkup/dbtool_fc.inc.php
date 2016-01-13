<?php 
function passto_next_form($submit) {
 if (!empty($submit)) {
foreach ($submit AS $field => $value) { 
echo "<input type='hidden' name='".$field."' value=\"".$value."\">";
 } 
}
}

if (!function_exists("go_to_url")) {
 function go_to_url($url) {
    if (headers_sent())  {
    echo "<script language=\"JavaScript\">window.location=\"".$url."\"</script>";
   }else{ header('location: '.$url); }   }}


function iframe($fn)
						{
							global $dbt_iframe;
						?>
						<hr><div align="center">
						<iframe name=<?php echo $fn;?> SRC="<?php echo $fn;?>"
            scrolling="<?php echo $dbt_iframe['scrl'];?>"
            height="<?php echo $dbt_iframe['hght'];?>"
            width="<?php echo $dbt_iframe['wdth'];?>"
            FRAMEBORDER="<?php echo $dbt_iframe['fbd'];?>"
            ></iframe></p>
          </div>
          
          <?php
}


function sql_addslashes($a_string = '', $is_like = FALSE)
{
	/*
		Better sql_addslashes for SQL queries.
		Taken from phpMyAdmin.
	*/
    if ($is_like) {
        $a_string = str_replace('\\', '\\\\\\\\', $a_string);
    } else {
        $a_string = str_replace('\\', '\\\\', $a_string);
    }
    $a_string = str_replace('\'', '\\\'', $a_string);

    return $a_string;
}
	
	
	?>