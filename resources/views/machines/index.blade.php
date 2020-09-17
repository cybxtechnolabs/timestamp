@extends('layouts.app')

@section('content')
<div class="content-wrapper" id="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
      <h1 class="m-0 text-dark">Machine List</h1>
      <a class="btn btn-primary" href="{{ route('machine.create') }}">Add Machine</a>
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
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Machines</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                @if(count($Machines) > 0)
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>No</th>
                        <th>Machine Name</th>
                        <th width="280px">Action</th>
                    </tr>
                    @foreach ($Machines as $Machine)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $Machine->machine_name }}</td>
                        <td>
                            <form action="{{ route('machine.destroy',$Machine->id) }}" method="POST">
            
                                <a class="btn btn-info" href="{{ route('machine.show',$Machine->id) }}">Show</a>
                
                                <a class="btn btn-primary" href="{{ route('machine.edit',$Machine->id) }}">Edit</a>
            
                                @csrf
                                @method('DELETE')
                
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>

                <div class="mt-3 text-center">
                    {!! $Machines->links() !!}
                </div>

                </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
      </div>
    </section>
  
    
    @else 
    <div class="row m-3">No Machine added yet!</div>

    @endif

</div>
@endsection