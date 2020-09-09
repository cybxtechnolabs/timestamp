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

        return view('import.import')->with('duplicateData', $duplicateData)->with('success', '');
    }


    public function uploadexcel(Request $request)
    {
        //TODO - make sure to avoid duplicate data
        $user = Auth::user();
        if($request->hasFile('file')){
            //check if file format is correct
            $ext = $request->file('file')->getClientOriginalExtension();
            $valid_extensions = array('xlsx', 'xls');
            if (!in_array($ext, $valid_extensions)) {
                return back()->with('error', 'Invalid file format .xls or .xlsx allowed');
            }

            $path = $request->file('file')->getRealPath();

            $file = $request['file'];


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
                
                list($type, $filename) = explode(';', $filename);
                list(, $filename)      = explode(',', $filename);
                $filename = base64_decode($filename);

                $Bulk = new Bulk;

                //check if record already exist in our record 
                //check if existing records for this importer only
                $recordExist = Bulk::where('name','=',$value[1])
                        ->where('creation_date','=', $value[7])
                        ->where('imported_by','=', $user->id)
                        ->where('creation_time','=', $value[8])
                        ->get();

               if(count($recordExist) == 0){

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
               } else {
                    $BulkDuplicate =  new BulkDuplicate;

                    $recordExistDuplicate = BulkDuplicate::where('name','=',$value[1])
                    ->where('creation_date','=', $value[7])
                    ->where('creation_time','=', $value[8])
                    ->get();
                    
                    if(count($recordExistDuplicate) == 0){
                        
                        $BulkDuplicate->imported_by = $user->id;
                        $BulkDuplicate->snap_photo = 'image';
                        $BulkDuplicate->name = $value[1];
                        $BulkDuplicate->staff = $value[2];
                        $BulkDuplicate->body_temperature = $value[3];
                        $BulkDuplicate->pass_status = $value[4];
                        $BulkDuplicate->device_name = $value[5];
                        $BulkDuplicate->access_direction = $value[6];
                        $BulkDuplicate->creation_date = $value[7];
                        $BulkDuplicate->creation_time = $value[8];
                        $BulkDuplicate->id_card = $value[9];
                        $BulkDuplicate->ic_card = $value[10];

                        $BulkDuplicate->save();

                }
               }
            }
            
            $duplicateData = BulkDuplicate::all();

            
        
            return view('import.import')->with('duplicateData', $duplicateData)->with('success', 'Uploaded file successfully. If there exists any duplicate entry it will be shown below');

        } else {
            return back()->with('error', 'Select file');
        }

    }


}
