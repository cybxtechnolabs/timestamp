@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
      <h1 class="m-0 text-dark">Import</h1><br>
        <div class="row mb-2">
          <div class="col-sm-12">
            @if(session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
               
                
            @endif
            @if(session()->has('msg'))
            <div class="alert alert-danger">
            {{ session()->get('msg') }}
                    <?php if(isset($msg)) print_r($msg); ?>
                </div>
            @endif

            
            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
                
            @endif
            @if($success)
            <div class="alert alert-success">
                    {{ $success }}
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
                <h3 class="card-title">Import Excel</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-2 m-3" >
                
              

              
                
                <!--begin::Form-->
                <form id="uploadForm" action="{{ route('upload') }}" method="post" enctype="multipart/form-data">
                     {{ csrf_field() }}
                     
                    <!-- Machine selection -->
                     <div class="card-body p-2 m-3 " >
                        @if(count($Machines) > 0)
                          <div class="form-group ">
                            <select class="custom-select" id="machineselection" name="machineselection">
                              <option value="" >Select Machine</option>
                              @foreach($Machines as $k => $Machine)
                                <option value="{{$Machine->machine_name}}" {{($selectedmachine == $Machine->machine_name) ? "selected":"" }} >{{$Machine->machine_name}}</option>
                              @endforeach
                            </select>
                          </div>
                        @else
                          <div class="form-group ">Request your admin to add Machine! You will need to select machine before import.</div>
                        @endif
                      </div>

                    <!-- Machine100 + 105 file selection excelImportForm-->
                    <div class="form-group ml-3" id="excelImportForm">
                        <label for="exampleFormControlFile1">Upload your Excel file</label>
                        <input type="file" class="form-control-file" id="file" name="fileexcel">
                    </div>

                    <!-- Machine200 file selection csvImportForm-->

                    <div id="csvImportForm" class="ml-3">
                      <div class="form-group">
                          <label for="exampleFormControlFile1">Upload your CSV file</label>
                          <input type="file" class="form-control-file" id="csvfile" name="filecsv">
                      </div>

                      <div class="form-group">
                          <label for="exampleFormControlFile2">Upload your SnapPic folder</label>
                          <input type="file" class="form-control-file" id="snapfile" name="snapfile[]" multiple directory="" webkitdirectory="" mozdirectory="">
                      </div>
                    </div>

                    <div class="row ml-3 submit" id="submit">
                        <input type="submit" value="Submit" class="btn btn-success float-right">
                    </div>
                </form>
              </div>
              
              <!-- /.card-body -->
            </div>
          </div>
        </div>
      </div>

      @if(isset($duplicateData) && count($duplicateData) > 0 )
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card m-2 p-2">
            
           
            <h3>Duplicate Entries Found as below:</h3>
            <table class="table">
              <tbody>
              @foreach($duplicateData as $duplicateEntry)
              <tr>
              <td>{{$duplicateEntry->name}}</td>
              <td>{{$duplicateEntry->staff}}</td>
              <td>{{$duplicateEntry->body_temperature}}</td>
              <td>{{$duplicateEntry->pass_status}}</td>
              <td>{{$duplicateEntry->creation_date}}</td>
              <td>{{$duplicateEntry->creation_time}}</td>
              </tr>
              

              @endforeach
              </tbody>
           
            

            </div>
          </div>
        </div>
        @endif
    </section>


  </div>
@endsection

@push('after-script')
<script>
  $('#excelImportForm').hide();
  $('#csvImportForm').hide();
  $('#submit').hide();


    //when redirect happens handle hide show
    var machineselected = $( "#machineselection option:selected" ).text();
    if(machineselected == 'XF-TM-200') {
        $('#csvImportForm').show();
        $('#excelImportForm').hide();
        $('#submit').show();
    } 
    if(machineselected == 'XF-TM-100' || machineselected == 'XF-TM-105') {
      $('#excelImportForm').show();
      $('#csvImportForm').hide();
      $('#submit').show();
    }

    //before form submission check if files are selected
    $('#uploadForm').submit(function (e) {
      e.preventDefault;
      var machineselected = $( "#machineselection option:selected" ).text();
      if(machineselected == 'XF-TM-200') {
        if( document.getElementById("csvfile").files.length == 0 ){
              alert("No csv selected");
              return false;
        }
        if( document.getElementById("snapfile").files.length == 0 ){
              alert("No snapfile selected");
              return false;
        }
      }

      if(machineselected == 'XF-TM-100' || machineselected == 'XF-TM-105') {
        if( document.getElementById("file").files.length == 0 ){
              alert("No excel selected");
              return false;
        }
      }


    });

    $("#machineselection").on("change", function(){
      var machineselected = $( "#machineselection option:selected" ).text();
      //console.log(machineselected);
      if(machineselected == 'Select Machine') {
        $('#csvImportForm').hide();
        $('#excelImportForm').hide();
        $('#submit').show();
      } 
      if(machineselected == 'XF-TM-200') {
        $('#csvImportForm').show();
        $('#excelImportForm').hide();
        $('#submit').show();
      } 
      if(machineselected == 'XF-TM-100' || machineselected == 'XF-TM-105') {
        $('#excelImportForm').show();
        $('#csvImportForm').hide();
        $('#submit').show();
      }
      
    });

</script>
@endpush

