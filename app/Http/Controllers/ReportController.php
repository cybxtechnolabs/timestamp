<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use App\Admin\Setting;
use App\Setting;
use DB;
use App\Bulk;
use DateTime;
use PDF;


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
        $data = [];
        $dateSelected = [
            'start_date' => '',
            'end_date' => date("m/d/Y"),
        ];

        return view('report.index')->with('user_id', $user_id)->with('setting', $Setting)->with('data', $data)->with('dateSelected', $dateSelected);
    }
    
    public function generateReportpdf($start_date, $end_date) {

        //get current user id
        $user_id = Auth::user()->id;

        //get filters start date and end date
        // $start = '2020-08-20'; 
        // $end = '2020-09-04';
        $start = $start_date;
        $end = $end_date;

        //get settings available
        $Setting = Setting::find(1);

        //TODO - check daywise filter, weekly filter or monthly filter
       // $data  = getReportData();

        //get all records filter with settings(skip mask/temperature imported by current user)
        $reports = Bulk::where('imported_by', $user_id)
                        ->where([['creation_date','>=', $start], ['creation_date','<=', $end]])
                        ->where([['body_temperature','<=', (int)$Setting->threshold_temperature]])
                        ->where([['name','!=', 'Stranger']])
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
       // echo '<pre>';
        if (count($reportsData) > 0) {
            foreach ($reportsData as $report) {
                //$r_data[$report->creation_date] = 
                $r_data[$report->name][$report->creation_date] = [];

            //    if($r_data[$report->name][$report->creation_date] != '') {
            //         $thisuser_creation[$report->name][] = $report->creation_time;
            //         $r_data[$report->name][$report->creation_date] = $thisuser_creation[$report->name];
            //    }
           // if($report->name == 'Chris Sabina') {
                $thisuser_creation[$report->name][$report->creation_date][] = $report->creation_time;
                $r_data[$report->name][$report->creation_date] = $thisuser_creation[$report->name][$report->creation_date];
                
            //    if(count($r_data[$report->name][$report->creation_date]) > -1) {
            //      //  if()
            //     $thisuser_creation[$report->name][$report->creation_date][] = $report->creation_time;
            //     print_r($thisuser_creation[$report->name]);
                
            //    // if(!array_key_exists($report->creation_date, $thisuser_creation[$report->name])) {
            //         $r_data[$report->name][$report->creation_date] = $thisuser_creation[$report->name];
            //    // }
                
            //     } 

        //} //temp 

            }
            

        }//echo '</pre>';
        //dd($r_data);
        $cr = [];
        foreach ($r_data as $d => $datewiseData) {
            foreach ($datewiseData as  $k => $userwiseData) {
                $x = null;
                $sum = strtotime('00:00:00');
                $sum2 = 0;
                foreach($userwiseData as $key => $t){
                
                    $date = new DateTime($t);
                    
                    if($x){
                        $interval = $date->diff($date2);
                        
                        
                        $sum1=strtotime($interval->h.':'.$interval->i.':'.$interval->s)-$sum;
                        
                        $sum2 = $sum2+$sum1;
                        
                      //  echo "<br />";
                        if($interval->i <= (int)$Setting->multiple_record_time && $interval->h == 0){
                        //    echo $interval->i." minutes -$key";
                            unset($userwiseData[$key]);
                            //$userwiseData2 = array_values($userwiseData);
                            //array_splice($userwiseData,1,0);
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
             //  $datewiseData[$k]['total'] = date("H:i:s",$sum3);
            }
            $r_data[$d] = $datewiseData;
            //echo '<pre>'; print_r($datewiseData); 
        }

      //  dd($r_data);

       // dd('working..');
        //get max hrs per day
        $maxhrs = $Setting->max_hours_per_day;
        $MaxHrs = date('h:i:s', strtotime($maxhrs.':00:00'));// "12:00:00"; strtotime($maxhrs.':00:00')

        $reportData = [];
        foreach ($r_data as $d => $datewiseData) {
            $totalhrs = strtotime('00:00:00');
            $durationExtracttotalhrs = 0;
            foreach ($datewiseData  as  $u => $userwiseData)  {
                $userwiseData = array_values($userwiseData); //restruct the usertime
                $firstEntryOftheDay = $userwiseData[0]; //6:28:56 
                $firstEntryOftheDayTime = date('h:i:s', strtotime($firstEntryOftheDay)); //06:28:56 type: date
               // echo '<hr><pre>u='; print_r($d); echo '</pre>';
               // echo '<pre>d='; print_r($u); echo '</pre>';
                $dayhrs = strtotime('00:00:00');
                foreach (array_chunk($userwiseData, 2)  as  $timeKey => $timeValue) {
                    $checkinCurrent = $timeValue[0]; //checkin
                 //   echo '<hr><pre>user='; print_r($d); echo '</pre>';
                 //   echo '<pre>date='; print_r($u); echo '</pre>';
                 //   echo '<pre>timeValue='; print_r($timeValue); echo '</pre>';
                //    echo '<pre>datewiseData='; print_r($datewiseData); echo '</pre>';

                    if(!isset($timeValue[1])) { //means missed checkout of the day
                        //adding default max hrs to checkin time of the day
                        $secsDuration = strtotime($MaxHrs)-strtotime("00:00:00");
                        $DefaultLastTime = date("H:i:s",strtotime($firstEntryOftheDay)+$secsDuration); //default checkout time of the day
                        $checkOutCurrent = $DefaultLastTime; //checkout time to display

                      //  echo '<pre>checkOutCurrent='; print_r($checkOutCurrent); echo '</pre>';

                    } else {
                        $checkOutCurrent = $timeValue[1]; //checkout
                    }
                    //get duration between checkin and checkout
                    $durationExtract = (strtotime(date("H:i:s", strtotime($checkOutCurrent))) - strtotime(date("H:i:s", strtotime($checkinCurrent))))/60;
                    $Dayhours = floor($durationExtract / 60);
                    $Dayminutes = ($durationExtract % 60);
                    $duration = date("H:i:s", strtotime($Dayhours.':'.$Dayminutes.':00')) ;

                    $durationExtracttotalhrs += $durationExtract;

                    //get temp here to not disturb the existing array structure
                    $getTempIn = Bulk::select('body_temperature')->where('imported_by', $user_id)->where('name', $d)->where('creation_date', $u)->where('creation_time', $checkinCurrent)->first();
                    $getTempOut = Bulk::select('body_temperature')->where('imported_by', $user_id)->where('name', $d)->where('creation_date', $u)->where('creation_time', $checkOutCurrent)->first();
                    
                     // echo "<pre>$d -$u - $checkOutCurrent t- ";
                    //print_r ($getTempIn->body_temperature);
                    //  if(!$getTempOut) {
                    //     print_r($d);
                    //     print_r($u);
                    //     print_r($checkOutCurrent);
                    //     dd($getTempOut);
                    // }
                    $tempin = ($getTempIn) ? $getTempIn->body_temperature : '-';
                    $tempout = ($getTempOut) ? $getTempOut->body_temperature : '-';

                    $reportData[$d][$u][] = [
                            
                            'in'=>$checkinCurrent, 'out'=>$checkOutCurrent, 
                            'tempin' => $tempin, 'tempout' => $tempout, 'duration'=>$duration,
                    ];
                    $dayhrs = strtotime($duration) + $dayhrs;
                }

                $reportData[$d][$u]['dayhrs'] = date("H:i:s", $dayhrs);

                $totalhrs = $durationExtracttotalhrs; //$dayhrs + $totalhrs;
            }
            $Dayhourstotalhrs = floor($durationExtracttotalhrs / 60);
            $Dayminutestotalhrs = (string)$durationExtracttotalhrs % 60;

           // $Dayminutestotalhrs =  number_format((float)$Dayminutestotalhrs, 2, '.', '');
            $totalhrs = sprintf("%02d", $Dayhourstotalhrs).':'.sprintf("%02d", $Dayminutestotalhrs);
            $reportData[$d]['totalhrs'] = $totalhrs;
        }

        //dd($reportData);
        $dateSelected = [
            'start_date' => date("m/d/Y", strtotime($start_date)),
            'end_date' => date("m/d/Y", strtotime($end_date))
        ];
        $data = [
           'data' => $reportData,
           'MaxHrs' => $MaxHrs,
           'dateSelected' => $dateSelected,
        ];
        $pdf = PDF::loadView('report.indexpdf', $data);
        return $pdf->download('invoice.pdf');

        //return view('report.indexpdf')->with('data', $reportData)->with('MaxHrs', $MaxHrs)->with('dateSelected', $dateSelected); 
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
        $Setting = Setting::where('user_id', $user_id)->first();
        //if no setting found redirect to setting page with msg to add settings first
        //though we will add default setting whlie one registers
        if($Setting === null) {
            return redirect('setting')->with('message', 'Please add your settings before generating report !');
        }
        //TODO - check daywise filter, weekly filter or monthly filter
       // $data  = getReportData();


        //get all records filter with settings(skip mask/temperature imported by current user)
        $reports = Bulk::where('imported_by', $user_id)
                        ->where([['creation_date','>=', $start], ['creation_date','<=', $end]])
                        ->where([['body_temperature','<=', (int)$Setting->threshold_temperature]])
                        ->where([['name','!=', 'Stranger']])
                        ->orderBy('creation_date', 'desc')
                        ->orderBy('name', 'asc')
                        ->orderBy('creation_time');

        if ($Setting->skip_mask > 0) {
            $reports->where('pass_status', '!=', 'No mask');
        }
        if ($Setting->skip_unknown > 0) {
            $reports->where('name', '!=', 'Stranger');
        }

        $reportsData = $reports->get();

      //  dd($reportsData);
        $r_data = [];
        $thisuser_creation = [];
        $x = null;
        $sum = strtotime('00:00:00');
        $sum2 = 0;
       // echo '<pre>';
        if (count($reportsData) > 0) {
            foreach ($reportsData as $report) {
                //$r_data[$report->creation_date] = 
                $r_data[$report->name][$report->creation_date] = [];

            //    if($r_data[$report->name][$report->creation_date] != '') {
            //         $thisuser_creation[$report->name][] = $report->creation_time;
            //         $r_data[$report->name][$report->creation_date] = $thisuser_creation[$report->name];
            //    }
           // if($report->name == 'Chris Sabina') {
                $thisuser_creation[$report->name][$report->creation_date][] = $report->creation_time;
                $r_data[$report->name][$report->creation_date] = $thisuser_creation[$report->name][$report->creation_date];
                
            //    if(count($r_data[$report->name][$report->creation_date]) > -1) {
            //      //  if()
            //     $thisuser_creation[$report->name][$report->creation_date][] = $report->creation_time;
            //     print_r($thisuser_creation[$report->name]);
                
            //    // if(!array_key_exists($report->creation_date, $thisuser_creation[$report->name])) {
            //         $r_data[$report->name][$report->creation_date] = $thisuser_creation[$report->name];
            //    // }
                
            //     } 

        //} //temp 

            }
            

        }//echo '</pre>';
        //dd($r_data);
        $cr = [];
        foreach ($r_data as $d => $datewiseData) {
            foreach ($datewiseData as  $k => $userwiseData) {
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
                            //$userwiseData2 = array_values($userwiseData);
                            //array_splice($userwiseData,1,0);
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
             //  $datewiseData[$k]['total'] = date("H:i:s",$sum3);
            }
            $r_data[$d] = $datewiseData;
            //echo '<pre>'; print_r($datewiseData); 
        }

      //  dd($r_data);

       // dd('working..');
        //get max hrs per day
        $maxhrs = $Setting->max_hours_per_day;
        $MaxHrs = date('h:i:s', strtotime($maxhrs.':00:00'));// "12:00:00"; strtotime($maxhrs.':00:00')

        $reportData = [];
        foreach ($r_data as $d => $datewiseData) {
            $totalhrs = strtotime('00:00:00');
            $durationExtracttotalhrs = 0;
            foreach ($datewiseData  as  $u => $userwiseData)  {
                $userwiseData = array_values($userwiseData); //restruct the usertime
                $firstEntryOftheDay = $userwiseData[0]; //6:28:56 
                $firstEntryOftheDayTime = date('h:i:s', strtotime($firstEntryOftheDay)); //06:28:56 type: date
               // echo '<hr><pre>u='; print_r($d); echo '</pre>';
               // echo '<pre>d='; print_r($u); echo '</pre>';
                $dayhrs = strtotime('00:00:00');
                foreach (array_chunk($userwiseData, 2)  as  $timeKey => $timeValue) {
                    $checkinCurrent = $timeValue[0]; //checkin
                 //   echo '<hr><pre>user='; print_r($d); echo '</pre>';
                 //   echo '<pre>date='; print_r($u); echo '</pre>';
                 //   echo '<pre>timeValue='; print_r($timeValue); echo '</pre>';
                //    echo '<pre>datewiseData='; print_r($datewiseData); echo '</pre>';

                    if(!isset($timeValue[1])) { //means missed checkout of the day
                        //adding default max hrs to checkin time of the day
                        $secsDuration = strtotime($MaxHrs)-strtotime("00:00:00");
                        $DefaultLastTime = date("H:i:s",strtotime($firstEntryOftheDay)+$secsDuration); //default checkout time of the day
                        $checkOutCurrent = $DefaultLastTime; //checkout time to display

                      //  echo '<pre>checkOutCurrent='; print_r($checkOutCurrent); echo '</pre>';

                    } else {
                        $checkOutCurrent = $timeValue[1]; //checkout
                    }
                    //get duration between checkin and checkout
                    $durationExtract = (strtotime(date("H:i:s", strtotime($checkOutCurrent))) - strtotime(date("H:i:s", strtotime($checkinCurrent))))/60;
                    $Dayhours = floor($durationExtract / 60);
                    $Dayminutes = ($durationExtract % 60);
                    $duration = date("H:i:s", strtotime($Dayhours.':'.$Dayminutes.':00')) ;

                    $durationExtracttotalhrs += $durationExtract;

                    //get temp here to not disturb the existing array structure
                    $getTempIn = Bulk::select('body_temperature')->where('imported_by', $user_id)->where('name', $d)->where('creation_date', $u)->where('creation_time', $checkinCurrent)->first();
                    $getTempOut = Bulk::select('body_temperature')->where('imported_by', $user_id)->where('name', $d)->where('creation_date', $u)->where('creation_time', $checkOutCurrent)->first();
                    $image = Bulk::select('snap_photo')->where('imported_by', $user_id)->where('name', $d)->where('creation_date', $u)->where('creation_time', $checkinCurrent)->first();
                   //  echo "<pre>$d -$u - $checkOutCurrent t- ";
                    //print_r ($getTempIn->body_temperature);
                    //  if(!$getTempOut) {
                    //     print_r($d);
                    //     print_r($u);
                    //     print_r($checkOutCurrent);
                    //     dd($getTempOut);
                    // }
                    $tempin = ($getTempIn) ? $getTempIn->body_temperature : '-';
                    $tempout = ($getTempOut) ? $getTempOut->body_temperature : '-';
                    $image = ($image) ? $image->snap_photo : '-';
                    $reportData[$d][$u][] = [
                            'image' => $image,
                            'in'=>$checkinCurrent, 'out'=>$checkOutCurrent, 
                            'tempin' => $tempin, 'tempout' => $tempout, 
                            'duration'=>$duration,
                    ];
                    $dayhrs = strtotime($duration) + $dayhrs;
                }

                $reportData[$d][$u]['dayhrs'] = date("H:i:s", $dayhrs);

                $totalhrs = $durationExtracttotalhrs; //$dayhrs + $totalhrs;
            }
            $Dayhourstotalhrs = floor($durationExtracttotalhrs / 60);
            $Dayminutestotalhrs = (string)$durationExtracttotalhrs % 60;

           // $Dayminutestotalhrs =  number_format((float)$Dayminutestotalhrs, 2, '.', '');
            $totalhrs = sprintf("%02d", $Dayhourstotalhrs).':'.sprintf("%02d", $Dayminutestotalhrs);
            $reportData[$d]['totalhrs'] = $totalhrs;
        }

       // dd($reportData);
        $dateSelected = [
            'start_date' => date("m/d/Y", strtotime($request->start_date)),
            'end_date' => date("m/d/Y", strtotime($request->end_date))
        ];

        return view('report.index')->with('data', $reportData)->with('MaxHrs', $MaxHrs)->with('dateSelected', $dateSelected); 
    }
}
