<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use App\Admin\Setting;
use App\Setting;
use DB;
use App\Bulk;
use DateTime;


class ReportController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //pass the current user_id
        $user_id = Auth::user()->id;
        //get current settings
        $Setting = Setting::find(1);

        return view('report.index')->with('user_id', $user_id)->with('setting', $Setting)->with('data', '');
    }

    public function generateReport(Request $request) {

        //validate
        $request->validate([  
            'start_date'=>'required',
            'end_date'=>'required',
        ]);


        //get current user id
        $user_id = Auth::user()->id;

        //get filters start date and end date
        // $start = '2020-08-20'; 
        // $end = '2020-09-04';
        $start = date("Y-m-d", strtotime($request->start_date));
        $end = date("Y-m-d", strtotime($request->end_date));

        //get settings available
        $Setting = Setting::find(1);


        //get all records filter with settings(skip mask/temperature imported by current user)
        $reports = Bulk::where('imported_by', $user_id)
                        ->where([['creation_date','>=', $start], ['creation_date','<=', $end]])
                        ->where([['body_temperature','<=', (int)$Setting->threshold_temperature]])
                        ->orderBy('creation_date', 'desc')
                        ->orderBy('name', 'asc')
                        ->orderBy('creation_time');

        if ($Setting->skip_mask > 0) {
            $reports->where('pass_status', '!=', 'No mask');
        }

        $reportsData = $reports->get();

        //dd($reportsData);
        $r_data = [];
        $thisuser_creation = [];
        $x = null;
        $sum = strtotime('00:00:00');
        $sum2 = 0;

        if (count($reportsData) > 0) {
            foreach ($reportsData as $report) {
                //$r_data[$report->creation_date] = 
                $r_data[$report->creation_date][$report->name] = [];// $report->name;
                // $r_data[$report->creation_date][$report->name]['staff'] = $report->staff;
                // $r_data[$report->creation_date][$report->name]['body_temperature'] = $report->body_temperature;
                // $r_data[$report->creation_date][$report->name]['pass_status'] = $report->pass_status;
                // $r_data[$report->creation_date][$report->name]['device_name'] = $report->device_name;
                // $r_data[$report->creation_date][$report->name]['access_direction'] = $report->access_direction;
                // $r_data[$report->creation_date][$report->name]['creation_date'] = $report->creation_date;
                // $r_data[$report->creation_date][$report->name]['creation_time'] = $report->creation_time;
                // $r_data[$report->creation_date][$report->name]['id_card'] = $report->id_card;
                // $r_data[$report->creation_date][$report->name]['ic_card'] = $report->ic_card;
                // $r_data[$report->creation_date][$report->name]['personner_id'] = $report->personner_id;

              //  if(array_key_exists($report->name, $r_data[$report->creation_date])) {
                //    $r_data[$report->creation_date][$report->name][] = $report->creation_time;
                 //   echo '<pre>'; print_r($r_data[$report->creation_date][$report->name]); echo '</pre>';
               // }
               if($r_data[$report->creation_date][$report->name] != '') {
                   // if() {
                    // if(!isset($r_data[$report->creation_date][$report->name]['prev'])) {
                    //     $r_data[$report->creation_date][$report->name]['prev'][] =  $report->creation_time;
                    // }
                    
                    // if(!isset($r_data[$report->creation_date][$report->name]['prev'])) {
                    //     $thisuser_creation[$report->name]['prev'] = $report->creation_time;
                    //     $r_data[$report->creation_date][$report->name] = $thisuser_creation[$report->name];
                    //     //echo '<pre>'; print_r($r_data[$report->creation_date][$report->name]); echo '</pre>';
                    //    // $thisuser_creation[$report->name][] = 
                    // } 
                     //   $thisuser_creation[$report->name][] = $report->creation_date. ' ' .$report->creation_time;
                    $thisuser_creation[$report->name][] = $report->creation_time;
                   // $thisuser_creation[$report->name][]

                    $r_data[$report->creation_date][$report->name] = $thisuser_creation[$report->name];
                        

                       // $thisuser_creation[$report->name][] = $report->creation_time;
                   // }
                    
               }

            }
            

        }
        //dd($r_data);
        $cr = [];
        foreach ($r_data as $d => $datewiseData) {
           // echo '<pre>'; print_r($d); dd();
            foreach ($datewiseData as  $k => $userwiseData) {
              // echo '<pre>'; print_r($k); dd();

                
                $x = null;
                $sum = strtotime('00:00:00');
                $sum2 = 0;
                foreach($userwiseData as $key => $t){
                
                    $date = new DateTime($t);
                    
                    if($x){
                        $interval = $date->diff($date2);
                        
                       // echo "difference " . $interval->h . " hour, " . $interval->i." minutes, ".$interval->s." second";
                        
                        $sum1=strtotime($interval->h.':'.$interval->i.':'.$interval->s)-$sum;
                        
                        $sum2 = $sum2+$sum1;
                        
                      //  echo "<br />";
                        if($interval->i <= (int)$Setting->multiple_record_time && $interval->h == 0){
                        //    echo $interval->i." minutes -$key";
                            unset($userwiseData[$key]);
                        //    echo "<br />";
                        }
                        
                    }
                    $date2 = $date;

                    $x = 1;
                }
              //  echo '<pre>'; print_r($userwiseData); 
                //print_r($userwiseData);

                $sum3=$sum+$sum2;


               // echo date("H:i:s",$sum3);
               // echo '</pre>'; dd();
               $datewiseData[$k] =  $userwiseData;
               $datewiseData[$k]['total'] = date("H:i:s",$sum3);
            }
            $r_data[$d] = $datewiseData;
            //echo '<pre>'; print_r($datewiseData); 
        }

       // dd($r_data);

       // dd('working..');

        return view('report.index')->with('data', $r_data);
      //  dd($r_data);
        //set in and out time from data(max time to skip)
        //build proper array structure to display in table
        //return value

        
    }
}
