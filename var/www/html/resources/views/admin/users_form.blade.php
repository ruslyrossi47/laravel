@extends('adminlte::page')

@section('content_header')
  <h1>User</h1>
@endsection

@section('content')
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
                <div class="form-group {{ ($errors->has('name')? 'has-error':'') }}">
                  <label for="inputName">Name</label>
                  <input type="text" name="name" class="form-control" id="inputName" placeholder="Enter your name" value="{{ old('name', $user->name) }}">
                  @if ($errors->has('name'))
                    <span class="help-block">{{ $errors->first('name') }}</span>
                  @endif
                </div>
                <div class="form-group {{ ($errors->has('email')? 'has-error':'') }}">
                  <label for="inputEmail">Email address</label>
                  <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Enter email" value="{{ old('email', $user->email) }}">
                  @if ($errors->has('email'))
                    <span class="help-block">{{ $errors->first('email') }}</span>
                  @endif
                </div>
                <div class="form-group {{ ($errors->has('password')? 'has-error':'') }}">
                  <label for="inputPassword">Password</label>
                  <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password" value="{{ old('password') }}">
                  @if ($errors->has('password'))
                    <span class="help-block">{{ $errors->first('password') }}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label>Select</label>
                  <select class="form-control" name="type">
                    <option value="a" {{ (old('type', $user->type) == 'a'? 'selected':'') }}>Admin</option>
                    <option value="u" {{ (old('type', $user->type) == 'u'? 'selected':'') }}>User</option>
                  </select>
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