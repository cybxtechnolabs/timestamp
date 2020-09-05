@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
      <h1 class="m-0 text-dark">Report</h1>
        <div class="row mb-2">
          <div class="col-sm-12">
            @if(session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif

            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
              <form action="{{route('report.generate')}}" method="post" class="">    
                {{ csrf_field() }}
                    <div class="" >
                        <div class="row">
                            <div class="form-group col-xs-4 p-1">
                                <!-- <input type='text' class="form-control" id='datepicker' placeholder='Select Date' style='width: 100px;' > -->
                                <input class="date form-control"  type="text" name="start_date" placeholder='Select Date'>
                            </div> 
                            <div class="form-group col-xs-4 p-1">
                                <!-- <input type='text' class="form-control" id='datepicker2' placeholder='Select Date' style='width: 100px;' > -->
                                <input class="date form-control"  type="text"  name="end_date" placeholder='Select Date'>
                            </div>
                            <!-- <div id="date-picker-example" class="md-form md-outline input-with-post-icon datepicker">
                              <input placeholder="Select date" type="text" id="example" class="form-control">
                              <label for="example">Try me...</label>
                              <i class="fas fa-calendar input-prefix" tabindex=0></i>
                            </div> -->

                            
                            <!-- <label for="from">From</label>
<input type="text" id="from" name="from">
<label for="to">to</label>
<input type="text" id="to" name="to"> -->
                            <div class="form-group col-xs-4 p-1">
                                <button type="submit" class="btn btn-primary">Generate Report</button>
                            </div>
                        </div>
                    </div>
                </form>    
              </div>
  @if($data)


              <table class="table">
  <thead class="thead-dark" id="myTable">
    <tr>
      <!-- <th scope="col">#</th> -->
      <th scope="col">Date</th>
      <th scope="col">Name</th>
      <th scope="col">Check In</th>
      <th scope="col">Check Out</th>
      <!-- <th scope="col">Staff/Visitor</th>
      <th scope="col">Body temperature</th>
      <th scope="col">Pass status</th>
      <th scope="col">Device name</th>
      <th scope="col">Access direction</th>
      <th scope="col">ETC details</th> -->
      <th scope="col">Duration</th>
      <th scope="col">Day Hrs</th>
    </tr>
  </thead>
  <tbody>
  @if(count($data) > 0)
  <?php

    $MaxHrs = date('h:i:s', strtotime($maxhrs.':00:00'));// "12:00:00"; strtotime($maxhrs.':00:00')
//print_r($MaxHrs);

  ?>
    @foreach($data as $d => $datewiseData)

      @foreach ($datewiseData  as  $k => $userwiseData)
        @foreach (array_chunk($userwiseData, 2)  as  $timeKey => $timewise)
        <pre><?php 
         // print_r($timeKey)
         //get this users first entry of the day
         $firstEntryOftheDay = $userwiseData[0];

          if(!isset($timewise[1])) {
            
            //first entry of the day
            $firstEntryOftheDayTime = date('h:i:s', strtotime($firstEntryOftheDay));

            //this duration first record
            $thiszeroTime = $timewise[0];
            
            //max hrs //$MaxHrs
            $secsDuration = strtotime($MaxHrs)-strtotime("00:00:00");
            $DefaultLastTime = date("H:i:s",strtotime($thiszeroTime)+$secsDuration);
            $timewise[1] =  $DefaultLastTime;

           // $userwiseData[] = $DefaultLastTime;
            
            
          }


          $durationExtract = (strtotime(date("H:i:s", strtotime($timewise[1])))-strtotime(date("H:i:s", strtotime($timewise[0]))))/60;
         // var_dump($durationExtract);
          $hours = floor($durationExtract / 60);
          $minutes = ($durationExtract % 60);

          $duration = date("H:i:s", strtotime($hours.':'.$minutes.':00')) ;// number_format((float)$durationExtract, 2, '.', '');
          
          //calculate total hrs of the day
          //get the first entry of the day 
          $firstEntryOftheDayTime = date('h:i:s', strtotime($firstEntryOftheDay));

          //get the last entry of the day
          ///$firstEntryOftheDayTime = date('h:i:s', strtotime($firstEntryOftheDay));
          //$lastdataIn_userwiseData = end($userwiseData);

          $lastdataIn_userwiseData = date('h:i:s', strtotime(end($userwiseData)));
          $lastTimeKey = key($userwiseData);
         // echo $lastTimeKey. '<br>'; 
         // print_r($lastdataIn_userwiseData);

          if($lastdataIn_userwiseData == $firstEntryOftheDayTime) {
            //this is having only single time
            $totalHrsOfDay = $duration;
           } else if($lastTimeKey%2 != 0) { //if last entry is odd
             // echo '<br><pre>'.$lastTimeKey; 
              // print_r($lastdataIn_userwiseData);
              // print_r($userwiseData);
              // print_r($DefaultLastTime);
              $secsDay = strtotime($MaxHrs)-strtotime("00:00:00");
              $DefaultLastTimeDay = date("H:i:s",strtotime($firstEntryOftheDayTime)+$secsDay); //lastentryof the day
             // $totalHrsOfDay = $DefaultLastTimeDay;

              //print_r($DefaultLastTimeDay);
              //print_r($firstEntryOftheDayTime);
             // $durationExtract = (strtotime(date("H:i:s", strtotime($DefaultLastTimeDay)))-strtotime(date("H:i:s", strtotime($firstEntryOftheDayTime))))/60;
             $DefaultLastTimeDay = (strtotime($DefaultLastTimeDay) - strtotime($firstEntryOftheDayTime))/60;
             //print_r($DefaultLastTimeDay);
              $Dayhours = floor($DefaultLastTimeDay / 60);
              $Dayminutes = ($DefaultLastTimeDay % 60);

             $totalHrsOfDay = date("H:i:s", strtotime($Dayhours.':'.$Dayminutes.':00')) ;

          } else {
            //calculate the total hrs of the day
            $DaydurationExtract = (strtotime($lastdataIn_userwiseData) - strtotime($firstEntryOftheDayTime))/60;
          // var_dump($durationExtract);
            $Dayhours = floor($DaydurationExtract / 60);
            $Dayminutes = ($DaydurationExtract % 60);

            $totalHrsOfDay = date("H:i:s", strtotime($Dayhours.':'.$Dayminutes.':00')) ;

            //$totalHrsOfDay = '';
          }
          //add the time 
          
          
          ?></pre>

        <tr>
          <!-- <th scope="row">1</th> -->
          <td>{{$d}}</td>
          <td>{{$k}}</td>
          <td>{{$timewise[0]}}</td>
          <td>{{$timewise[1]}}</td>
          <!-- <td>@mdo</td>
          <td>Pass status</td>
          <td>Device name</td>
          <td>Access direction</td>
          <td>Creation date</td>
          <td>ETC details</td> -->
          <td>{{$duration}} Hrs</td>
          <td>{{$totalHrsOfDay}}</td>
          <td></td>
        </tr>


         @endforeach
      @endforeach
      
    @endforeach
  @endif   


  
  </tbody>
</table>
@endif

            </div>
          </div>
        </div>
      </div>
    </section>
  </div>


  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
@endsection
@push('after-script')
<script>
$('.date').datepicker({  

format: 'mm-dd-yyyy'

});  
// /$('.datepicker').datepicker();


  // $( function() {
  //   var dateFormat = "mm/dd/yy",
  //     from = $( "#from" )
  //       .datepicker({
  //         defaultDate: "+1w",
  //         changeMonth: true,
  //         numberOfMonths: 3
  //       })
  //       .on( "change", function() {
  //         to.datepicker( "option", "minDate", getDate( this ) );
  //       }),
  //     to = $( "#to" ).datepicker({
  //       defaultDate: "+1w",
  //       changeMonth: true,
  //       numberOfMonths: 3
  //     })
  //     .on( "change", function() {
  //       from.datepicker( "option", "maxDate", getDate( this ) );
  //     });
 
  //   function getDate( element ) {
  //     var date;
  //     try {
  //       date = $.datepicker.parseDate( dateFormat, element.value );
  //     } catch( error ) {
  //       date = null;
  //     }
 
  //     return date;
  //   }
  // } );
  </script>
@endpush