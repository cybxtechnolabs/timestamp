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
                @if(count($Machines) > 0)
                  <div class="form-group col-xs-3 mt-1">
                    <select class="custom-select" id="machineselection" name="machineselection">
                      <option value="" >Select Machine</option>
                      @foreach($Machines as $k => $Machine)
                        <option value="{{$Machine->id}}" {{($selectedmachine == $Machine->machine_name) ? "selected":"" }} >{{$Machine->machine_name}}</option>
                      @endforeach
                    </select>
                  </div>
                @else
                  <div class="form-group col-xs-3 mt-1">Request your admin to add Machine! You will need to select machine before import.</div>
                @endif
              </div>

              <div class="card-body p-2 ml-3 mt-0 mb-3" id="excelImportForm">
                
                <!--begin::Form-->
                <form id="uploadExcelForm" action="{{ route('upload') }}" method="post" enctype="multipart/form-data">
                     {{ csrf_field() }}
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Upload your Excel file</label>
                        <input type="file" class="form-control-file" id="file" name="file">
                    </div>
                    <div class="row ml-1">
                        <input type="submit" value="Submit" class="btn btn-success float-right">
                    </div>
                </form>

              </div>

              <div class="card-body p-2 ml-3 mt-0 mb-3" id="csvImportForm">
                <h3>Make sure to select all the images mentioned in csv file</h3>
                <form id="uploadCSVForm" action="{{ route('uploadcsv') }}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Upload your CSV file</label>
                        <input type="file" class="form-control-file" id="csvfile" name="file">
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlFile2">Upload your SnapPic folder</label>
                        <input type="file" class="form-control-file" id="snapfile" name="snapfile[]" multiple directory="" webkitdirectory="" mozdirectory="">
                    </div>

                    <div class="row ml-1">
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


    $('#uploadCSVForm').submit(function (e) {
      e.preventDefault;
      if( document.getElementById("csvfile").files.length == 0 ){
            alert("No csv selected");
            return false;
      }
      if( document.getElementById("snapfile").files.length == 0 ){
            alert("No snapfile selected");
            return false;
      }
    });

    $('#uploadExcelForm').submit(function (e) {
      e.preventDefault;
      if( document.getElementById("file").files.length == 0 ){
            alert("No excel selected");
            return false;
      }
    });


    var machineselected = $( "#machineselection option:selected" ).text();
    if(machineselected == 'XF-TM-200') {
        $('#csvImportForm').show();
        $('#excelImportForm').hide();
    } 
    if(machineselected == 'OET-213H-NB_192.168.1.100') {
        $('#csvImportForm').show();
        $('#excelImportForm').hide();
    } 
    if(machineselected == 'XF-TM-100') {
      $('#excelImportForm').show();
      $('#csvImportForm').hide();
    }

    $("#machineselection").on("change", function(){
      var machineselected = $( "#machineselection option:selected" ).text();
      //console.log(machineselected);
      if(machineselected == 'Select Machine') {
        $('#csvImportForm').hide();
        $('#excelImportForm').hide();
      } 
      if(machineselected == 'XF-TM-200') {
        $('#csvImportForm').show();
        $('#excelImportForm').hide();
      } 
      if(machineselected == 'OET-213H-NB_192.168.1.100') {
        $('#csvImportForm').show();
        $('#excelImportForm').hide();
      } 
      if(machineselected == 'XF-TM-100') {
        $('#excelImportForm').show();
        $('#csvImportForm').hide();
      }
      
    });

</script>
@endpush

