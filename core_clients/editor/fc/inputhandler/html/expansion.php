<?php
# BY BART BOSMA OUDEHORNE 7-2008
# WWW.BARTBOSMA.EU

#false=php funct true=php class
#$depend["parseHtml"]=false; 
if ($_cfg['global']['preserve_styletag']!="on" && isset($_GET['get_css_from_html'])){
	
	@ob_end_clean();@ob_end_clean();@ob_end_clean();@ob_end_clean();
$depend["edit_content"]=false;
$prematurend=1;
}
$depend["loophtmlobj"]=false;
startfunct($depend);
$depend=array();

?>
