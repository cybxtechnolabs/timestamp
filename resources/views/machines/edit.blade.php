@extends('layouts.app')

@section('content')
<div class="content-wrapper" id="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
      <h1 class="m-0 text-dark">Edit Machine</h1>
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
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Name</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-3 m-3">
                <form action="{{ route('machine.update',$machine->id) }}" method="POST">
                    @csrf
                    @method('PUT')
              
                    <div class="row ">
                        <div class="col-xs-4 col-sm-4 col-md-4 m-3">
                            <div class="form-group">
                                <input type="text" name="machine_name" value="{{ $machine->machine_name }}" class="form-control" placeholder="Name">
                            </div>
                        </div>
                      
                        <div class="col-xs-4 col-sm-4 col-md-4 m-3">
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
                </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
      </div>
    </section>
    
    </div>
@endsection