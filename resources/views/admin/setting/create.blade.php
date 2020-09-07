@extends('layouts.app')

@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
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
                <h3 class="card-title">Create Setting</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
 

              <form action="{{ route('settingupdate',['id'=> 0]) }}" method="post" class="border rounded p-5">    
              {{ csrf_field() }}
                  <div class="form-group">
                      <label for="multiple_record_time">Multiple Record Time</label>
                      <input type="text" class="form-control" id="multiple_record_time"  name="multiple_record_time" value="">
                  </div>

                  <label class="form-check-label" for="skip_mask">
                        <strong> Skip Mask </strong> 
                  </label>
                  <div class="form-check">
                      <input class="form-check-input" type="radio" name="skip_mask" id="skip_mask1" value="1" >
                      <label class="form-check-label" for="exampleRadios1">
                          On
                      </label>
                      </div>
                  <div class="form-check">
                      <input class="form-check-input" type="radio" name="skip_mask" id="skip_mask2" value="0" >
                      <label class="form-check-label" for="exampleRadios2">
                          Off
                      </label>
                  </div>
                  <div class="form-group">
                      <label for="threshold_temperature">Threshold Temperature (℉)</label>
                      <input type="text" class="form-control" id="threshold_temperature"  name="threshold_temperature" value="">
                  </div>
                  <div class="form-group">
                      <label for="threshold_temperature">Max Hours Per Day</label>
                      <input type="text" class="form-control" id="max_hours_per_day"  name="max_hours_per_day" value="">
                  </div>

                  <label class="form-check-label" for="skip_unknown">
                        <strong> Skip Unknown </strong> 
                  </label>
                  <div class="form-check">
                      <input class="form-check-input" type="radio" name="skip_unknown" id="skip_unknown1" value="1" >
                      <label class="form-check-label" for="exampleRadios1">
                          On
                      </label>
                      </div>
                  <div class="form-check">
                      <input class="form-check-input" type="radio" name="skip_unknown" id="skip_unknown2" value="0" >
                      <label class="form-check-label" for="exampleRadios2">
                          Off
                      </label>
                  </div>
                  
                  
                  <button type="submit" class="btn btn-primary mt-2">Submit</button>
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