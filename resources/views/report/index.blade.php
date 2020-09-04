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
              <form action="" method="post" class="">    
                {{ csrf_field() }}
                    <div class="" >
                        <div class="row">
                            <div class="form-group col-xs-4 p-1">
                                <input type='text' class="form-control" id='datepicker' placeholder='Select Date' style='width: 100px;' >
                            </div> 
                            <div class="form-group col-xs-4 p-1">
                                <input type='text' class="form-control" id='datepicker2' placeholder='Select Date' style='width: 100px;' >
                            </div>
                            <div class="form-group col-xs-4 p-1">
                                <button type="submit" class="btn btn-primary">Generate Report</button>
                            </div>
                        </div>
                    </div>
                </form>    
              </div>
    
              <table class="table">
  <thead class="thead-dark" id="myTable">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Staff/Visitor</th>
      <th scope="col">Body temperature</th>
      <th scope="col">Pass status</th>
      <th scope="col">Device name</th>
      <th scope="col">Access direction</th>
      <th scope="col">Creation date</th>
      <th scope="col">ETC details</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
      <td>Pass status</td>
      <td>Device name</td>
      <td>Access direction</td>
      <td>Creation date</td>
      <td>ETC details</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
      <td>Pass status</td>
      <td>Device name</td>
      <td>Access direction</td>
      <td>Creation date</td>
      <td>ETC details</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
      <td>the Bird</td>
      <td>@twitter</td>
      <td>Pass status</td>
      <td>Device name</td>
      <td>Access direction</td>
      <td>Creation date</td>
      <td>ETC details</td>
    </tr>
  </tbody>
</table>


            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js">
<script type="text/javascript">
$(document).ready(function(){
 
  $('#datepicker').datepicker({
   format: "yy-mm-dd",
   startDate: '-1y -1m',
   endDate: '+2m +10d'
  });

  $('#datepicker2').datepicker({
   format: "yy-mm-dd",
   startDate: '-1m',
   endDate: '+10d'
  }); 
});
</script>
@endsection


