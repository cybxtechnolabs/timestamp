
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
             
              </div>
                    

              @if(count($data) > 0)
              
                
                <div class="container">
                <div class="row mb-3">
                  <table>
                  <tr><td>Records showing for dates:</td></tr>
                    <tr>
                    <td><strong>{{date("M/d/Y", strtotime($dateSelected['start_date'])) }}</strong> to 
                      <strong>{{date("M/d/Y", strtotime($dateSelected['end_date']))}}</strong>
                    </td>
                    </tr>
                    
                  </table>
                </div>

                    <!--Row with two equal columns-->
                    <!-- <div class="row">
                        <div class="col-md-2">Username</div>
                        <div class="col-md-2">Date</div>
                        <div class="col-md-2">Day Total hrs</div>
                        <div class="col-md-2">Overall</div>
                        <div class="col-md-2">Total Hrs</div>
                    </div> -->
                    @foreach($data as $u => $userData)
                      <div class="">
                          <div class=""><strong>{{$u}}:</strong>
                            <table class="table">
                              <thead class="thead-dark" id="myTable">
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
                                <td colspan=4>Total Hrs: {{$userData[$d]}}</td>
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



<!-- @push('after-script')
<script>
$('.date').datepicker({  

format: 'mm-dd-yyyy'

});  

  </script>
@endpush -->