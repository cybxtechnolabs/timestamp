@extends('layouts.app')

@section('content')
<div class="content-wrapper" id="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
      <h1 class="m-0 text-dark">Show Machine</h1>
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
                <h3 class="card-title">Machine Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-3 m-3">
                  <div>Name: <strong>{{ $machine->machine_name }}</strong></div>
                  <div>Created: <strong>{{ $machine->created_at }}</strong></div>
                  <div>Updated: <strong>{{ $machine->updated_at }}</strong></div>
                </div>
               </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
      </div>
    </section>
    
    </div>
@endsection