<?php
namespace App\Imports;
use App\Bulk;
use App\BulkDuplicate;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Auth;

class BulkImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
       //print_r($row); dd();
        $user = Auth::user();
        
        if($row[1] != '' && $row[1] != 'Name' ) {
        //check if this entry already uploaded
        //check if same creation_date, creation_time, name already exist
        //if yes then skip and try adding in duplicate entries


            $recordExist = Bulk::where('name','=',$row[1])
                        ->where('creation_date','=', $row[7])
                        ->where('creation_time','=', $row[8])
                        ->get();

            if(count($recordExist) == 0){
                return new Bulk([
                    'imported_by' => $user->id,
                    'snap_photo'        => $row[0],
                    'name'    => $row[1],
                    'staff'    => $row[2],
                    'body_temperature'    => str_replace("℉","", $row[3]),
                    'pass_status'    => $row[4],
                    'device_name'    => $row[5],
                    'access_direction'    => $row[6],
                    'creation_date'    => $row[7],
                    'creation_time'    => $row[8],
                    'id_card'    => $row[9],
                    'ic_card'    => $row[10],
                ]);
            } else {
                //get all duplicate records entry to display back on the page with error message
                //add this entry in bulk_duplicate (import duplicate)
                //duplicate should not add more duplicates
                $recordExist = BulkDuplicate::where('name','=',$row[1])
                        ->where('creation_date','=', $row[7])
                        ->where('creation_time','=', $row[8])
                        ->get();
                if(count($recordExist) == 0){
                    return new BulkDuplicate([
                        'imported_by' => $user->id,
                        'snap_photo'        => 'image', //$row[0],
                        'name'    => $row[1],
                        'staff'    => $row[2],
                        'body_temperature'    => str_replace("℉","", $row[3]),
                        'pass_status'    => $row[4],
                        'device_name'    => $row[5],
                        'access_direction'    => $row[6],
                        'creation_date'    => $row[7],
                        'creation_time'    => $row[8],
                        'id_card'    => $row[9],
                        'ic_card'    => $row[10],
                        //'excel_row'    => $row[10],
                    ]);
                }


            }

        }
        
    }
}
