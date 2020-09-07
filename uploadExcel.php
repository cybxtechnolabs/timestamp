<?php

die('upload file called');

$xlsFile = 'Pass_record_information_3.xlsx';
require_once 'PHPExcel/Reader/Excel2007.php';
$objReader = new PHPExcel_Reader_Excel2007();
//$objReader->setReadDataOnly(true);
$data = $objReader->load($xlsFile);
$objWorksheet = $data->getActiveSheet();

foreach ($objWorksheet->getDrawingCollection() as $key=> $drawing) {
    
    //for XLSX format
    $string = $drawing->getCoordinates();
    //print_r($string); //die();
    $coordinate = PHPExcel_Cell::coordinateFromString($string);

    if ($drawing instanceof PHPExcel_Worksheet_Drawing){
    $filename = $drawing->getPath();
    echo '<pre>';print_r($filename);echo '</pre>';
    $drawing->getDescription();
    //echo '<pre>';print_r($drawing);echo '</pre>';
    copy($filename, 'uploads/' .'image_'.$key.'.jpg');
    //move_uploaded_file('image_'.$key.'.jpg', 'uploads/' . $drawing->getDescription());
    }
}