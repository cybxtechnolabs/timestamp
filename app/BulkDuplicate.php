<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class BulkDuplicate extends Model
{
    protected $table = 'import_duplicate';

    protected $fillable = [
        'imported_by','snap_photo', 'name', 'staff', 'body_temperature', 'pass_status', 'device_name',
        'access_direction','creation_date', 'creation_time', 'id_card', 'ic_card', 'personner_id'
    ];

       //protected $table = 'bulk';
    // protected $fillable = [
    //     'name', 'employee'
    // ];
}