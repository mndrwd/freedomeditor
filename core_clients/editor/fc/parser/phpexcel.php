<?php

if (isset($_GET['xcloutput']) && strlen($_GET['xcloutput'])>0){
/** Error reporting */
error_reporting(E_ALL);

/** PHPExcel */
require_once 'core_clients/editor/fc/parser/phpexcel/Classes/PHPExcel.php';

/** PHPExcel_IOFactory */
require_once 'core_clients/editor/fc/parser/phpexcel/Classes/PHPExcel/IOFactory.php';

$objPHPExcel = new PHPExcel();

$thisext=strtolower(end(explode('.',html_entity_decode($_GET['ele']))));

if ($thisext=="xls"){
$reader="Excel5";
}else{
$reader="Excel2007";}
$objReader = PHPExcel_IOFactory::createReader($reader);
$objPHPExcel = $objReader->load($_GET['fd'].'/'.$_GET['ele']);

chdir($_GET['fd']."/");



#################################
# select mode
switch (strtolower($_GET['xcloutput'])) {

    case 'xls':
// Export to Excel5 (.xls)
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

#store on server
if ($_GET['phpexcel_server']!=false){
echo date('H:i:s') . " Write to Excel5 format\n";
$objWriter->save($_GET['ele'].'.xls');}
        break;
  

  
		case 'xlsx':
// Export to Excel2007 (.xlsx)
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

#store on server
if ($_GET['phpexcel_server']!=false){
echo date('H:i:s') . " Write to Excel5 format\n";
$objWriter->save( $_GET['ele'].'.xlsx');}
        break;

 
    
		case 'htm':
// Export to HTML (.html)
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'HTML');

#store on server
if ($_GET['phpexcel_server']!=false){
echo date('H:i:s') . " Write to HTML format\n";
$objWriter->save($_GET['ele'].'.htm');}
        break;


		
		case 'pdf':
// Export to PDF (.pdf)
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'PDF');

#store on server
if ($_GET['phpexcel_server']!=false){
echo date('H:i:s') . " Write to PDF format\n";
$objWriter->save($_GET['ele'].'.pdf');}		
				break;


		
		case 'csv':
// Remove first two rows with field headers before exporting to CSV
#echo date('H:i:s') . " Removing first two rows\n";
$objWorksheet = $objPHPExcel->getActiveSheet();
$objWorksheet->removeRow(1, 2);
// Export to CSV (.csv)
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');

#store on server
if ($_GET['phpexcel_server']!=false){
echo date('H:i:s') . " Write to CSV format\n";
$objWriter->save($_GET['ele'].'.csv');}		
				break;


				
		case 'bomcsv':
// Remove first two rows with field headers before exporting to CSV
#echo date('H:i:s') . " Removing first two rows\n";
$objWorksheet = $objPHPExcel->getActiveSheet();
$objWorksheet->removeRow(1, 2);		
// Export to CSV with BOM (.csv)

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
$objWriter->setUseBOM(true);

#store on server
if ($_GET['phpexcel_server']!=false){
echo date('H:i:s') . " Write to CSV format (with BOM)\n";
$objWriter->save($_GET['ele'].'-bom.csv');}
				break;	
	
}


##########################


// #send to browser
if (!isset($_GET['phpexcel_server']) || isset($_GET['phpexcel_server']) && $_GET['phpexcel_server']!="s"){ 
#header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.str_replace(".".$thisext, ".".$_GET['xcloutput'], $_GET['ele']).'"');
header('Cache-Control: max-age=0');

$objWriter->save('php://output');
}
else{


// Echo memory peak usage
echo "<br />".date('H:i:s') . " Peak memory usage: " . (memory_get_peak_usage(true) / 1024 / 1024) . " MB<br />\r\n";

// Echo done
echo date('H:i:s') . " Done writing files.\r\n";

}
}

?>