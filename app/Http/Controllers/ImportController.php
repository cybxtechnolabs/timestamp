<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
//use Maatwebsite\Excel\Concerns\ToModel;
use App\Exports\BulkExport;
use App\Imports\BulkImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Bulk;
use App\BulkDuplicate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Storage;
//require '../PHPExcel/PHPExcel/Reader/Excel2007.php';


class ImportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //delete any duplicate records if exist
        BulkDuplicate::truncate();
        $duplicateData = [];

        return view('import.import')->with('duplicateData', $duplicateData);
    }


    public function uploadexcel(Request $request)
    {
        //TODO - make sure to avoid duplicate data
        $user = Auth::user();
        if($request->hasFile('file')){
            //check if file format is correct
            $ext = $request->file('file')->getClientOriginalExtension();
            $valid_extensions = array('csv', 'xlsx', 'xls');
            if (!in_array($ext, $valid_extensions)) {
                return back()->with('error', 'Invalid file format');
            }

            $path = $request->file('file')->getRealPath();

            //$pathLocal = $request->file('file')->store('public/storage','report_'.time().'.xlsx');
            //$filePath = 'storage' . DIRECTORY_SEPARATOR . $request->file('file');
            //Storage::disk('public')->put($filePath, file_get_contents($request->file('file')));

          //  move_uploaded_file(  $request->file('file')->getRealPath(), 'public/storage/report_'.time().'.xlsx');
           // dd();
           $file = $request['file'];

           // public_path()
           $name = $file->getClientOriginalName();
                $path = public_path()."/upload/";
                $file->move($path, $name);

          

            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(public_path()."/upload/".$name);
            
            $worksheet = $spreadsheet->getActiveSheet();
            $worksheetArray = $worksheet->toArray();
            array_shift($worksheetArray);

            foreach ($worksheetArray as $key => $value) {

                $worksheet = $spreadsheet->getActiveSheet();
                $drawing = $worksheet->getDrawingCollection()[$key];
            
                $zipReader = fopen($drawing->getPath(), 'r');
                $imageContents = '';
                while (!feof($zipReader)) {
                    $imageContents .= fread($zipReader, 1024);
                }
                fclose($zipReader);
                $extension = $drawing->getExtension();

                
                $filename = 'data:image/jpeg;base64,' . base64_encode($imageContents);
               // print_r("<img   src=\"data:image/jpeg;base64,' . base64_encode($imageContents) . '\"/>");
                
                list($type, $filename) = explode(';', $filename);
                list(, $filename)      = explode(',', $filename);
                $filename = base64_decode($filename);
                //dd($filename);
             //   $pathLocal =  $request->file('file')->storeAs('public/storage','report_'.time().'.jpg');
                //file_put_contents('/tmp/image.png', $filename);

              //  move_uploaded_file('image_'.$key.'.jpg', public_path()."/upload/".$filename);

                //$file->move($saveImage, $filename);

            
                // echo '<tr align="center">';
                // echo '<td>' . $value[0] . '</td>';
                // echo '<td>' . $value[1] . '</td>';
                // echo '<td><img  height="150px" width="150px"   src="data:image/jpeg;base64,' . base64_encode($imageContents) . '"/></td>';
                // echo '</tr>';

                $Bulk = new Bulk;
                $Bulk->imported_by = $user->id;
                $Bulk->snap_photo = 'data:image/jpeg;base64,' . base64_encode($imageContents);
                $Bulk->name = $value[1];
                $Bulk->staff = $value[2];
                $Bulk->body_temperature = $value[3];
                $Bulk->pass_status = $value[4];
                $Bulk->device_name = $value[5];
                $Bulk->access_direction = $value[6];
                $Bulk->creation_date = $value[7];
                $Bulk->creation_time = $value[8];
                $Bulk->id_card = $value[9];
                $Bulk->ic_card = $value[10];


                $Bulk->save();

                // Bulk([
                //     'imported_by' => $user->id,
                //     'snap_photo'        => $row[0],
                //     'name'    => $row[1],
                //     'staff'    => $row[2],
                //     'body_temperature'    => str_replace("℉","", $row[3]),
                //     'pass_status'    => $row[4],
                //     'device_name'    => $row[5],
                //     'access_direction'    => $row[6],
                //     'creation_date'    => $row[7],
                //     'creation_time'    => $row[8],
                //     'id_card'    => $row[9],
                //     'ic_card'    => $row[10],
                // ])
            }
           
            // foreach ($objWorksheet->getDrawingCollection() as $key=> $drawing) {
   
            //     //for XLSX format
            //     $string = $drawing->getCoordinates();
            //     //print_r($string); //die();
            //     $coordinate = PHPExcel_Cell::coordinateFromString($string);
                
            //     if ($drawing instanceof PHPExcel_Worksheet_Drawing){
            //     $filename = $drawing->getPath();
            //     echo '<pre>';print_r($filename);echo '</pre>';
            //     $drawing->getDescription();
            //     //echo '<pre>';print_r($drawing);echo '</pre>';
            //     copy($filename, 'uploads/' .'image_'.$key.'.jpg');
            //     //move_uploaded_file('image_'.$key.'.jpg', 'uploads/' . $drawing->getDescription());
            //     }
            //     }
           // dd($path);
            

            //$data = Excel::import(new BulkImport, request()->file('file'));

          //  $xlsFile = $path ;


//  $objReader = new \PHPExcel_Reader_Excel2007();
//  //   dd($objReader->setReadDataOnly(true));
// // //$objReader->setReadDataOnly(true);
// $data = $objReader->load($xlsFile);
// $objWorksheet = $data->getActiveSheet();

// foreach ($objWorksheet->getDrawingCollection() as $key=> $drawing) {
   
// //for XLSX format
// $string = $drawing->move();
// //print_r($string); //die();
// $coordinate = PHPExcel_Cell::coordinateFromString($string);

// if ($drawing instanceof PHPExcel_Worksheet_Drawing){
// $filename = $drawing->getPath();
// echo '<pre>';print_r($filename);echo '</pre>';
// $drawing->getDescription();
// //echo '<pre>';print_r($drawing);echo '</pre>';
// copy($filename, 'uploads/' .'image_'.$key.'.jpg');
// //move_uploaded_file('image_'.$key.'.jpg', 'uploads/' . $drawing->getDescription());
// }
// }
            
            $duplicateData = []; //BulkDuplicate::all();


        
            return view('import.import')->with('duplicateData', $duplicateData)
                    ->with('success', 'Uploaded files, it will check for duplicate entries. Please ensure in your report!');

        } else {
            return back()->with('error', 'Select file');
        }

    }


}
