@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
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
                <h3 class="card-title">Users</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Registered at</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(count($users))
                      @foreach($users as $user)
                        <tr>
                          <td>{{ $user->id }}</td>
                          <td>{{ $user->name }}</td>
                          <td>{{ $user->email }}</td>
                          <td>{{ $user->created_at }}</td>
                          <td>   
                          @if(($user->is_active) > 0) 
                              Registered User
                          @else   
                              <a class="btn btn-info btn-sm" href="{{ url('admin/users/approve/'.$user->id) }}">
                                  <i class="fas fa-pencil-alt">
                                  </i>
                                  Approve User
                              </a>
                          @endif
                          </td>
                        </tr>
                      @endforeach
                    @else
                      <tr>
                          <td colspan="6" align="center">No data found.</td>
                      </tr>
                    @endif
                  </tbody>
                </table>

                <div class="mt-3 text-center">
                    {!!  $users->render() !!}
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


