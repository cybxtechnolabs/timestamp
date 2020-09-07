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
        //$user_id = Auth::user()->id;
        if($request->hasFile('file')){
            //check if file format is correct
            $ext = $request->file('file')->getClientOriginalExtension();
            $valid_extensions = array('csv', 'xlsx', 'xls');
            if (!in_array($ext, $valid_extensions)) {
                return back()->with('error', 'Invalid file format');
            }

            $path = $request->file('file')->getRealPath();

            $data = Excel::import(new BulkImport, request()->file('file'));
            
            $duplicateData = BulkDuplicate::all();


        
            return view('import.import')->with('duplicateData', $duplicateData)
                    ->with('success', 'Uploaded files, it will check for duplicate entries. Please ensure in your report!');

        } else {
            return back()->with('error', 'Select file');
        }

    }


}
