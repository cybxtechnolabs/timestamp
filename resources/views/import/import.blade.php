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
                <h3 class="card-title">Import Excel</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-2 m-3">
                <!--begin::Form-->
                <form action="{{ route('upload') }}" method="post" enctype="multipart/form-data">
                     {{ csrf_field() }}
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Example file input</label>
                        <input type="file" class="form-control-file" id="file" name="file">
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
      @if($duplicateData)
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


