@extends('adminlte::page')

@section('content_header')
  <h1>Users</h1>
@endsection

@section('content')

  @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check"></i> Success!</h4>
      {{ session()->get('success') }}
    </div>
  @endif

  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">

          <div class="row">
            <div class="col-lg-10"><h3 class="box-title">All users</h3></div>
            <div class="col-lg-2"><a href="{{ url('admin/user/create') }}" class="btn btn-block btn-primary">Add new</a></div>
          </div>
          
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tbody><tr>
              <th>User ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Level</th>
              <th>Action</th>
            </tr>
              @foreach ($user as $key => $value)
              <tr>
                <td>{{ $value->id }}</td>
                <td>{{ $value->name }}</td>
                <td>{{ $value->email }}</td>
                <td>{{ $value->getUserType() }}</td>
                <td><a href="{{ url('admin/user/update/' . $value->id) }}">Edit</a> | <a href="{{ url('admin/user/delete/' . $value->id) }}" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <div class="box-footer clearfix">
          <div class="pull-right">{{ $user->links() }}</div>
        </div>

        <!-- /.box-body -->
      </div>

      <!-- /.box -->
    </div>
  </div>

@endsection

@section('css')
  
@endsection