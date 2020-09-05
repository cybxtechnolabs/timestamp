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
        //TODO - make sure to avoid duplicate data
        
        if($request->hasFile('file')){
            //check if file format is correct
            $ext = $request->file('file')->getClientOriginalExtension();
            $valid_extensions = array('csv', 'xlsx', 'xls');
            if (!in_array($ext, $valid_extensions)) {
                return back()->with('error', 'Invalid file format');
            }

            $path = $request->file('file')->getRealPath();

            $data = Excel::import(new BulkImport, request()->file('file'));

             return back()->with('success', 'Uploaded files, it will check for duplicate entries. Please ensure in your report!');

        } else {
            return back()->with('error', 'Select file');
        }

    }


}
