<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
//use Maatwebsite\Excel\Concerns\ToModel;
use App\Exports\BulkExport;
use App\Imports\BulkImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Bulk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ImportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('import.import');
    }


    public function uploadexcel(Request $request)
    {
        //validation
        // $request->validate([
        //     'file' => 'required|mimes:xls,xlsx'
        // ]);
        //TODO - make sure to avoid duplicate data
        
        if($request->hasFile('file')){
            // $validator = Validator::make(
            //     [
            //         'file'      => $request->file,
            //         'extension' => strtolower($request->file->getClientOriginalExtension()),
            //     ],
            //     [
            //         'file'          => 'required',
            //         'extension'      => 'required|in:xlsx,xls',
            //     ]
            //   );
            //check if file format is correct
            $ext = $request->file('file')->getClientOriginalExtension();
            $valid_extensions = array('csv', 'xlsx', 'xls');
            if (!in_array($ext, $valid_extensions)) {
                return back()->with('error', 'Invalid file format');
            }

            $path = $request->file('file')->getRealPath();
            
            //$data = Excel::load($path)->get();
            $data = Excel::import(new BulkImport, request()->file('file'));

            // if($data->count() >0) {
            //     foreach ($data->toArray() as $key => $value) {
            //         foreach ($value as $row) {

            //         }
            //     }
            // }
            //get current data of current user from import table and do filter require and then store in biometric table
        //     $current_id = Auth::user()->id;
        //     $current_date = date('Y-m-d');
        //     $uploaded_data = Bulk::where('imported_by',$current_id)
        //                             ->where('created_at', $current_date)
        //                             ->where('created_at', $current_date)
        //                             ->get();

            
            
        //    dd('working...');
             return back()->with('success', 'File Imported Successfully!');

        } else {
            return back()->with('error', 'Select file');
        }

    }


}
