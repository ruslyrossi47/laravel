@extends('adminlte::page')

@section('content_header')
  <h1>Listing</h1>
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
            <div class="col-lg-10"><h3 class="box-title">Listing</h3></div>
            <div class="col-lg-2"><a href="{{ url('admin/listing/create') }}" class="btn btn-block btn-primary">Add new</a></div>
          </div>
          
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tbody><tr>
              <th>ID</th>
              <th>List Name</th>
              <th>Address</th>
              <th>Latitude</th>
              <th>Longitude</th>
              <th>Submit By</th>
              <th>Date added</th>
              <th>Last update</th>
              <th width="100">Action</th>
            </tr>
            @foreach ($listing as $key => $value)
            <tr>
              <td>{{ $value->id }}</td>
              <td>{{ $value->list_name }}</td>
              <td>{{ $value->address }}</td>
              <td>{{ $value->latitude }}</td>
              <td>{{ $value->longitude }}</td>
              <td>{{ $value->getSubmitBy() }}</td>
              <td>{{ $value->created_at }}</td>
              <td>{{ $value->updated_at }}</td>
              <td><a href="{{ url('admin/listing/update/' . $value->id) }}">Edit</a> | <a href="{{ url('admin/listing/delete/' . $value->id) }}" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a></td>
            </tr>
            @endforeach
            </tbody>
          </table>
        </div>

        <div class="box-footer clearfix">
          <div class="pull-right">{{ $listing->links() }}</div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>

@endsection

@section('css')
  
@endsection