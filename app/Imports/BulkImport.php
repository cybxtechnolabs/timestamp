<?php
namespace App\Imports;
use App\Bulk;
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
      // print_r($row);
        $user = Auth::user();
        
        if($row[1] != '' && $row[1] != 'Name' ) {

            return new Bulk([
                'imported_by' => $user->id,
                'snap_photo'        => 'image', //$row[0],
                'name'    => $row[1],
                'staff'    => $row[2],
                'body_temperature'    => $row[3],
                'pass_status'    => $row[4],
                'device_name'    => $row[5],
                'access_direction'    => $row[6],
                'creation_date'    => $row[7],
                'creation_time'    => $row[8],
                'id_card'    => $row[9],
                'ic_card'    => $row[10],
            ]);
        }
        
    }
}
