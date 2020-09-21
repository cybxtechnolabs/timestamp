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
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader;
use Storage;
use App\Machine;
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
        //BulkDuplicate::truncate();
       // $duplicateData = [];

        //get machines list
        $Machines = Machine::all();

        return view('import.import')->with('Machines', $Machines)
                                    ->with('selectedmachine', '')
                                    ->with('success', '');
    }

    public function uploadanymachine(Request $request) {
        $user = Auth::user();
        $request->validate([
            'machineselection' => 'required',
        ]);
        //dd($request->machineselection);
        

        
            //check which machine is selected
            if($request->machineselection == 'XF-TM-100' || $request->machineselection == 'XF-TM-105') {
                $valid_extensions = array('xlsx', 'xls');
                $importfile = $request->hasFile('fileexcel');
                $importfilerequest = $request->file('fileexcel');
                $file = $request['fileexcel'];
            } elseif ($request->machineselection == 'XF-TM-200') {
                $valid_extensions = array('csv');
                $importfile = $request->hasFile('filecsv');
                $importfilerequest = $request->file('filecsv');
                $file = $request['filecsv'];
            } else {
                dd('new machine');
            }
           

            if($importfile) {
                $ext = $importfilerequest->getClientOriginalExtension();
                
                if (!in_array($ext, $valid_extensions)) {
                    return back()->with('error', 'Invalid file format .csv allowed');
                }

                //upload csv or excel file 
                $path = $importfilerequest->getRealPath();

                $name = $file->getClientOriginalName();
                if (!file_exists('upload/')) {
                    mkdir('upload/', 0777, true);
                }
                $path = public_path()."/upload/";
                $file->move($path, $name);

                if($request->machineselection == 'XF-TM-100') {
                    // $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(public_path()."/upload/".$name);
                    // $worksheet = $spreadsheet->getActiveSheet();
                    // $sheetData = $worksheet->toArray();
                    // array_shift($sheetData);

                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                    

                } elseif($request->machineselection == 'XF-TM-105') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                } elseif ($request->machineselection == 'XF-TM-200') {
                    //snappic management
                    if($request->hasFile('snapfile')){
                        $errorfile='';
                        $extension=array("jpeg","jpg","png","gif");

                        if (!file_exists('upload/snap/')) {
                            mkdir('upload/snap/', 0777, true);
                        }

                        
                        foreach($_FILES["snapfile"]["tmp_name"] as $key=>$tmp_name) {
                                $file_name=$_FILES["snapfile"]["name"][$key];
                                $file_tmp=$_FILES["snapfile"]["tmp_name"][$key];

                                if($file_name != 'Thumbs.db') {
                                    $ext=pathinfo($file_name,PATHINFO_EXTENSION);
                                    if(in_array($ext,$extension)) {
                                        if(!file_exists("upload/snap/".$file_name)) {
                                            move_uploaded_file($file_tmp=$_FILES["snapfile"]["tmp_name"][$key],"upload/snap/".$file_name);
                                        }
                                    } else {
                                        $errorfile.=$file_name;
                                        session()->flash('msg', $errorfile);
                                        session()->flash('error', 'Invalid image format selected. Please verify all selected images.');
                                        return back();
                                    }
                                }
                            }
                        } else {
                            return back()->with('error', 'Select all images in the SnapPic Folder.');
                        }
                    
                    //sheet management
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                   
                   // $spreadsheet = $reader->load(public_path()."/upload/".$name);
                   // $sheetData   = $spreadsheet->getActiveSheet()->toArray();
    
                } else {
                    dd('new machine');
                }
                $spreadsheet = $reader->load(public_path()."/upload/".$name);
                $sheetData   = $spreadsheet->getActiveSheet()->toArray();
                array_shift($sheetData);
                //delete previous duplicate records
                BulkDuplicate::truncate();


                foreach ($sheetData as $key => $value) {
                    if( isset($value[1]) ) { //XF-TM-100 do not require key check in excel format but XF-TM-200 needs
                        
                        //uploading snaphoto from excel file
                        if( $request->machineselection == 'XF-TM-100' || $request->machineselection == 'XF-TM-105'){

                            
                            $worksheet = $spreadsheet->getActiveSheet(); 
                            $drawing = $worksheet->getDrawingCollection()[$key];

                           // if ($drawing instanceof PHPExcel_Worksheet_MemoryDrawing) {
                               if($request->machineselection == 'XF-TM-105') {
                                    ob_start();
                                    call_user_func(
                                        $drawing->getRenderingFunction(),
                                        $drawing->getImageResource()
                                    );
                            
                                    $imageContents = ob_get_contents();
                                    ob_end_clean();
                                    $extension = 'jpg';
                               } else{
                                    $zipReader = fopen($drawing->getPath(), 'r');

                                    $imageContents = '';
                                    while (!feof($zipReader)) {
                                        $imageContents .= fread($zipReader, 1024);
                                    }
                                    fclose($zipReader);
                                    $extension = $drawing->getExtension();
                               }

                            
                            
                            $data = 'data:image/jpeg;base64,' . base64_encode($imageContents);

                            // Extract base64 file for standard data
                            $fileBin = file_get_contents($data);
                            $mimeType = mime_content_type($data);
                            if (!file_exists('upload/snap/')) {
                                mkdir('upload/snap/', 0777, true);
                            }

                            $file_name = 'upload/snap/'.time().'_'.$key.'_'.$value[1].'.jpeg';
                            file_put_contents($file_name, $fileBin);

                            //for db column
                            $snap_photo = $file_name;

                        }

                        //rearranging as per machine/type
                        $imported_by = $user->id;
                        if($request->machineselection == 'XF-TM-100'){
                            $name = $value[1];
                            $staff = $value[2];
                            $body_temperature = str_replace('℉', '', $value[3]);
                            $body_temperature = $body_temperature;
                            $pass_status = $value[4];
                            $device_name = $value[5];
                            $access_direction= $value[6];
                            $creation_date= $value[7];
                            $creation_time = $value[8];
                            $personner_id = $value[11];
                            $id_card = $value[10];
                            $ic_card = $value[9];

                        } else if($request->machineselection == 'XF-TM-105') {
                            $name = $value[1];
                            $staff = ucwords($value[2]);
                            //convert temp to ℉
                            $body_temperature = $value[3]*9/5+32;
                            $body_temperature = $body_temperature;

                            if($value[7] == 'Not wearing a mask') {
                                $pass_status = 'No Mask';
                            } else{//there are more condition to check further
                                $pass_status = $value[4];
                            } 
                            $device_name = $value[5];
                            $access_direction= $value[6];

                            $inorouttime = explode(' ',$value[8]);
                            $creation_date = $inorouttime[0];
                            $creation_time = $inorouttime[1];

                            $personner_id = $value[11];
                            $id_card = $value[10];
                            $ic_card = $value[9];

                        } elseif($request->machineselection == 'XF-TM-200') {
                            $imagename = explode('/',$value[8]); 
                            $snap_photo = (string)end($imagename);
                            $snap_photo = "upload/snap/".$snap_photo;
                            $name = $value[1];
                            $staff = ($value[3] == 'Unknown') ? 'Stranger': 'Employee';
                            $body_temperature = $value[6];
                            $pass_status = $value[5];
                            $device_name = $value[7];
                            $access_direction= '';

                            $inorouttime = explode(' ',$value[0]);
                            $creation_date = $inorouttime[0];
                            $creation_time = $inorouttime[1];

                            $personner_id = $value[2];
                            $id_card = $value[4];
                            $ic_card = '';

                        }


                        //check if record already exist in our record 
                        //check if existing records for this importer only
                        $Bulk = new Bulk;
                        $recordExist = Bulk::where('name',$name)
                                ->where('creation_date','=', $creation_date)
                                ->where('imported_by','=', $imported_by)
                                ->where('creation_time','=', $creation_time)
                                ->get();
                        

                        if(count($recordExist) == 0){

                           // var_dump($imported_by);
    
                            $Bulk->imported_by = $imported_by;
                            $Bulk->snap_photo = $snap_photo;
                            $Bulk->name = $name;
                            $Bulk->staff = $staff;
                            $Bulk->body_temperature = $body_temperature;
                            $Bulk->pass_status = $pass_status;
                            $Bulk->device_name = $device_name;
                            $Bulk->access_direction = $access_direction;
                            $Bulk->creation_date = $creation_date;
                            $Bulk->creation_time = $creation_time;
                            $Bulk->personner_id = $personner_id;
                            $Bulk->id_card = $id_card;
                            $Bulk->ic_card = $ic_card;
                            $Bulk->save();
                        } else { 
                            $BulkDuplicate =  new BulkDuplicate;
    
                            $recordExistDuplicate = BulkDuplicate::where('name','=',$name)
                            ->where('creation_date','=', $creation_date)
                            ->where('creation_time','=', $creation_time)
                            ->get();
    
    
                            if(count($recordExistDuplicate) == 0){
                            
                                $BulkDuplicate->imported_by = $imported_by;
                                $BulkDuplicate->snap_photo = 'image';
                                $BulkDuplicate->name = $name;
                                $BulkDuplicate->staff = $staff;
                                $BulkDuplicate->body_temperature = $body_temperature;
                                $BulkDuplicate->pass_status = $pass_status;
                                $BulkDuplicate->device_name = $device_name;
                                $BulkDuplicate->access_direction = $access_direction;
                                $BulkDuplicate->creation_date = $creation_date;
                                $BulkDuplicate->creation_time = $creation_time;
                                $BulkDuplicate->id_card = $id_card;
                                $BulkDuplicate->ic_card = $ic_card;
                                $BulkDuplicate->personner_id = $personner_id;
        
                                $BulkDuplicate->save();
        
                            }
    
                        }       
    
    
                        //dd($recordExist);
                    }
                    
                }
                $duplicateData = BulkDuplicate::all();
                $Machines = Machine::all();
                $selectedmachine = $request->machineselection;
                return view('import.import')->with('duplicateData', $duplicateData)->with('Machines', $Machines)
                                        ->with('selectedmachine', $selectedmachine)
                                        ->with('success', 'Uploaded file successfully. If there exists any duplicate entry it will be shown below');

    
            } else {
                return back()->with('error', 'Select file');
            }

        



        
    }

    public function uploadcsv(Request $request) {
        $user = Auth::user();
        if($request->hasFile('file')){
            //check if file format is correct
            $ext = $request->file('file')->getClientOriginalExtension();
            $valid_extensions = array('csv');
            if (!in_array($ext, $valid_extensions)) {
                return back()->with('error', 'Invalid file format .csv allowed');
            }

            //snappic management
            if($request->hasFile('snapfile')){
                $errorfile='';
                $extension=array("jpeg","jpg","png","gif");

                if (!file_exists('upload/snap/')) {
                    mkdir('upload/snap/', 0777, true);
                }

                
                foreach($_FILES["snapfile"]["tmp_name"] as $key=>$tmp_name) {
                    $file_name=$_FILES["snapfile"]["name"][$key];
                    $file_tmp=$_FILES["snapfile"]["tmp_name"][$key];

                    if($file_name != 'Thumbs.db') {
                        $ext=pathinfo($file_name,PATHINFO_EXTENSION);
                        if(in_array($ext,$extension)) {
                            if(!file_exists("upload/snap/".$file_name)) {
                                move_uploaded_file($file_tmp=$_FILES["snapfile"]["tmp_name"][$key],"upload/snap/".$file_name);
                            }
                        } else {
                            $errorfile.=$file_name;
                            session()->flash('msg', $errorfile);
                            session()->flash('error', 'Invalid image format selected. Please verify all selected images.');
                            return back();
                        }
                    }
                }
            } else {
                return back()->with('error', 'Select all images in the SnapPic Folder.');
            }

            //csv  management
            $path = $request->file('file')->getRealPath();
            $file = $request['file'];

            $name = $file->getClientOriginalName();
            $path = public_path()."/upload/";
            $file->move($path, $name);

            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            $spreadsheet = $reader->load(public_path()."/upload/".$name);
           // $spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();
            $sheetData   = $spreadsheet->getActiveSheet()->toArray();
            //validation to check if file have valid entries
            
            BulkDuplicate::truncate();
            foreach ($sheetData as $key => $value) {
                if($key != 0) {
                    //echo '<pre>';print_r($value);
                    $Bulk = new Bulk;

                    //check if record already exist in our record 
                    //check if existing records for this importer only
                    $inorouttime = explode(' ',$value[0]);

                    $creation_date = $inorouttime[0];
                    $creation_time = $inorouttime[1];
 
                    $recordExist = Bulk::whereIn('name',[$value[1], 'Stranger'])
                            ->where('creation_date','=', $creation_date)
                            ->where('imported_by','=', $user->id)
                            ->where('creation_time','=', $creation_time)
                            ->get();
                            
                    //saving images name
                    $imagename = explode('/',$value[8]); 
                    $imagename = (string)end($imagename);

                    
                    if(count($recordExist) == 0){

                        $Bulk->imported_by = $user->id;
                        $Bulk->snap_photo = "upload/snap/".$imagename;
                        $Bulk->name = ($value[3] == 'Unknown') ? 'Stranger':$value[1];
                        $Bulk->staff = ($value[3] == 'Unknown') ? 'Stranger': 'Employee';
                        $Bulk->body_temperature = $value[6].'℉';
                        $Bulk->pass_status = $value[5];
                        $Bulk->device_name = $value[7];
                        $Bulk->access_direction = '';
                        $Bulk->creation_date = $creation_date;
                        $Bulk->creation_time = $creation_time;
                        $Bulk->personner_id = $value[2];
                        $Bulk->id_card = $value[4];
                        $Bulk->ic_card = '';
                        $Bulk->save();
                    } else { 
                        $BulkDuplicate =  new BulkDuplicate;

                        $recordExistDuplicate = BulkDuplicate::where('name','=',$value[1])
                        ->where('creation_date','=', $creation_date)
                        ->where('creation_time','=', $creation_time)
                        ->get();


                        if(count($recordExistDuplicate) == 0){
                        
                            $BulkDuplicate->imported_by = $user->id;
                            $BulkDuplicate->snap_photo = 'image';
                            $BulkDuplicate->name = $value[1];
                            $BulkDuplicate->staff = ($value[3] == 'Unknown') ? 'Stranger': 'Employee';
                            $BulkDuplicate->body_temperature = $value[6].'℉';
                            $BulkDuplicate->pass_status = $value[5];
                            $BulkDuplicate->device_name = $value[7];
                            $BulkDuplicate->access_direction = '';
                            $BulkDuplicate->creation_date = $creation_date;
                            $BulkDuplicate->creation_time = $creation_time;
                            $BulkDuplicate->id_card = $value[4];
                            $BulkDuplicate->ic_card = '';
                            $BulkDuplicate->personner_id = $value[2];
    
                            $BulkDuplicate->save();
    
                        }

                    }       


                    //dd($recordExist);
                }
                
            }

            $duplicateData = BulkDuplicate::all();
  
            $Machines = Machine::all();

            //TODO - get machine name from form
            // return redirect()->route('import')->with('duplicateData', $duplicateData)->with('Machines', $Machines)
            //                     ->with('selectedmachine', 'XF-TM-200')
            //                     ->with('success', 'Uploaded file successfully. If there exists any duplicate entry it will be shown below');
             return view('import.import')->with('duplicateData', $duplicateData)->with('Machines', $Machines)
                                         ->with('selectedmachine', 'XF-TM-200')
                                         ->with('success', 'Uploaded file successfully. If there exists any duplicate entry it will be shown below');

        } else {
            return back()->with('error', 'Select file');
        }
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
            
            BulkDuplicate::truncate();
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

                
                // $filename = 'data:image/jpeg;base64,' . base64_encode($imageContents);
                
                // list($type, $filename) = explode(';', $filename);
                // list(, $filename)      = explode(',', $filename);
                // $filename = base64_decode($filename);
              //  file_put_contents($user->id.'_img.png', base64_encode($imageContents));

                $data = 'data:image/jpeg;base64,' . base64_encode($imageContents);

                // Extract base64 file for standard data
                $fileBin = file_get_contents($data);
                $mimeType = mime_content_type($data);

                if (!file_exists('upload/snap/')) {
                    mkdir('upload/snap/', 0777, true);
                }
                

                $file_name = 'upload/snap/'.time().'_'.$key.'_'.$value[1].'.jpeg';
                // Check allowed mime type
                //if ('image/png'==$mimeType) {
                file_put_contents($file_name, $fileBin);
                //}


                //rearranging data as per type
                
                $inorouttime = explode(' ',$value[8]);
                $creation_date = $inorouttime[0];
                $creation_time = $inorouttime[1];

                


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
                    $Bulk->snap_photo = $file_name;
                    $Bulk->name = $value[1];
                    $Bulk->staff = $value[2];
                    $Bulk->body_temperature = $value[3];
                    $Bulk->pass_status = ucwords($value[4]);
                    $Bulk->device_name = $value[5];
                    $Bulk->access_direction = $value[6];
                    $Bulk->creation_date = $value[7];
                    $Bulk->creation_time = $value[8];
                    $Bulk->id_card = $value[9];
                    $Bulk->ic_card = $value[10];
                    $Bulk->personner_id = $value[11];
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
            $Machines = Machine::all();
            
        
            return view('import.import')->with('duplicateData', $duplicateData)->with('Machines', $Machines)
                                        ->with('selectedmachine', 'XF-TM-100')
                                        ->with('success', 'Uploaded file successfully. If there exists any duplicate entry it will be shown below');

        } else {
            return back()->with('error', 'Select file');
        }

    }


}
