@extends('adminlte::page')

@section('content_header')
  <h1>Listing</h1>
@endsection

@section('content')

  @if(session()->has('error'))
    <div class="alert alert-error alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check"></i> Error!</h4>
      {{ session()->get('error') }}
    </div>
  @endif

  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
            <form method="POST" action="{{ url($url) }}">
            @csrf
              <div class="box-body">
                <div class="form-group {{ ($errors->has('list_name')? 'has-error':'') }}">
                  <label for="inputListName">List name</label>
                  <input type="text" name="list_name" class="form-control" id="inputListName" placeholder="Enter list name" value="{{ old('list_name', $listing->list_name) }}">
                  @if ($errors->has('list_name'))
                    <span class="help-block">{{ $errors->first('list_name') }}</span>
                  @endif
                </div>
                <div class="form-group {{ ($errors->has('address')? 'has-error':'') }}">
                  <label for="inputAddress">Address</label>
                  <input type="text" name="address" class="form-control" id="inputAddress" placeholder="Enter address" value="{{ old('address', $listing->address) }}">
                  @if ($errors->has('address'))
                    <span class="help-block">{{ $errors->first('address') }}</span>
                  @endif
                </div>

                <div class="form-group {{ ($errors->has('latitude')? 'has-error':'') }}">
                  <label for="inputLatitude">Latitude</label>
                  <input type="text" name="latitude" class="form-control" id="inputLatitude" placeholder="Enter latitude" value="{{ old('latitude', $listing->latitude) }}">
                  @if ($errors->has('latitude'))
                    <span class="help-block">{{ $errors->first('latitude') }}</span>
                  @endif
                </div>

                <div class="form-group {{ ($errors->has('longitude')? 'has-error':'') }}">
                  <label for="inputLongitude">Longitude</label>
                  <input type="text" name="longitude" class="form-control" id="inputLongitude" placeholder="Enter longitude" value="{{ old('longitude', $listing->longitude) }}">
                  @if ($errors->has('longitude'))
                    <span class="help-block">{{ $errors->first('longitude') }}</span>
                  @endif
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </form>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>

@endsection

@section('css')
  
@endsection