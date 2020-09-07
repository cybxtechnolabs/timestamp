@extends('layouts.app')

@section('content')
<div class="content-wrapper" id="content-wrapper">
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
                                <input class="date form-control"  type="text" name="start_date" placeholder='Start Date'  value="{{$dateSelected['start_date']}}">
                            </div> 
                            <div class="form-group col-xs-4 p-1">
                                <!-- <input type='text' class="form-control" id='datepicker2' placeholder='Select Date' style='width: 100px;' > -->
                                <input class="date form-control"  type="text"  name="end_date" placeholder='End Date' value="{{$dateSelected['end_date']}}">
                            </div>

                            <div class="form-group col-xs-4 p-1">
                                <button type="submit" class="btn btn-primary">Generate Report</button>
                                @if(count($data) > 0)
                                  <input type="button" value="Print Report" class="btn btn-info"  onclick="printDiv()">  
                                @endif
                            </div>
                            
                            
                        </div>
                    </div>
                </form>    
              </div>
                    

              @if(count($data) > 0)
              
               
                <div class="container" id="reportpdf">
                <div class="row mb-3">
                  <div class="col">
                    Records showing for dates:
                   {{date("M/d/Y", strtotime($dateSelected['start_date'])) }} to 
                   {{date("M/d/Y", strtotime($dateSelected['end_date']))}}
                  </div>
                 
                </div>
                   
                    @foreach($data as $u => $userData)
                      <div class="">
                      
                          <div class="">
                            <table class="table" border="1px">
                              <thead class="thead-dark" id="myTable">
                                <tr><th colspan="6">{{$u}}</th></tr>
                                <tr>
                                  
                                  <th scope="col">Date</th>
                                  <th scope="col">Check In</th>
                                  <th scope="col">Check Out</th>
                                  <th scope="col">Temp In</th>
                                  <th scope="col">Temp Out</th>
                                  <th scope="col">Duration</th>
                                  <!-- <th scope="col">Day Hrs</th> -->
                                </tr>
                              </thead>
                              <tbody>
                                  @foreach ($userData  as  $d => $dates)
                                  
                                      @if($d !== 'totalhrs')
                                        @foreach ($dates  as  $key => $inout)
                                        <tr>
                                            @if($key !== 'dayhrs')
                                            <td>{{$d}}</td>
                                              @foreach ($inout  as  $i => $check)
                                                @if($i == 'in')
                                                <td>{{$check}}</td>
                                                @else
                                                <td>{{$check}}</td>
                                                @endif
                                              @endforeach
                                            @endif
                                          </tr>
                                          @endforeach
                                        
                                      @else
                                      @endif
                                    
                                    @endforeach
                              </tbody>
                              <tfoot>
                                <tr >
                                <td colspan=6>Total Hrs: {{$userData[$d]}}</td>
                                </tr>
                              </tfoot>
                              </table>
                          
                          </div>
                      </div>
                    @endforeach
                </div>

                @else
                <div class="alert alert-danger jsutify-center ">No Data Found</div>
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
  </script>
  <script> 
        function printDiv() { 
            var divContents = document.getElementById("reportpdf").innerHTML; 
            var a = window.open('', '', 'height=500, width=500'); 
            a.document.write('<html>'); 
            a.document.write('<body > Report <br>'); 
            a.document.write(divContents); 
            a.document.write('</body></html>'); 
            a.document.close(); 
            a.print(); 
        } 
    </script> 
@endpush