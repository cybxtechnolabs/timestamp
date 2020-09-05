@extends('layouts.app')

@section('content')
@if($Setting)

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
                <h3 class="card-title">Edit Setting</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
 

    <form action="{{ route('admin.settingupdate',['id'=> $Setting->id]) }}" method="post" class="border rounded p-5">    
    {{ csrf_field() }}
        <div class="form-group">
            <label for="multiple_record_time">Multiple Record Time</label>
            <input type="text" class="form-control" id="multiple_record_time"  name="multiple_record_time" value="{{$Setting->multiple_record_time}}">
        </div>
        <!-- <div class="form-check">
            <input class="form-check-input" type="checkbox" value="{{$Setting->skip_mask}}" id="skip_mask" name="skip_mask[]" 
                {{($Setting->skip_mask == 1) ? 'checked':'' }} >
            <label class="form-check-label" for="defaultCheck1">
                Skip Mask
            </label>
        </div> -->
        <label class="form-check-label" for="skip_mask">
               <strong> Skip Mask </strong> 
        </label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="skip_mask" id="skip_mask1" value="1" {{($Setting->skip_mask == 1) ? 'checked':'' }}>
            <label class="form-check-label" for="exampleRadios1">
                On
            </label>
            </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="skip_mask" id="skip_mask2" value="0" {{($Setting->skip_mask == 1) ? '':'checked' }}>
            <label class="form-check-label" for="exampleRadios2">
                Off
            </label>
        </div>
        <div class="form-group">
            <label for="threshold_temperature">Threshold Temperature (℉)</label>
            <input type="text" class="form-control" id="threshold_temperature"  name="threshold_temperature" value="{{$Setting->threshold_temperature}}">
        </div>
        <div class="form-group">
            <label for="threshold_temperature">Max Hours Per Day</label>
            <input type="text" class="form-control" id="max_hours_per_day"  name="max_hours_per_day" value="{{$Setting->max_hours_per_day}}">
        </div>
        
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endif
@endsection