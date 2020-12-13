@extends('layouts.admin')

@section('content')
  <h1 class="page-header">Create User</h1>

  @include('partials.form-error')

  {!! Form::open([
    'route' => 'admin.users.store',
    'files' => 'true',
  ]) !!}

  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
      </div>
    
      <div class="form-group">
        {!! Form::label('email', 'Email:') !!}
        {!! Form::email('email', null, ['class' => 'form-control']) !!}
      </div>

      <div class="form-group">
        {!! Form::label('password', 'Password:') !!}
        {!! Form::password('password', ['class' => 'form-control']) !!}
      </div>
    
      <div class="form-group">
        {!! Form::label('role_id', 'Role:') !!}
        {!! Form::select('role_id', $roles, null, ['class' => 'form-control']) !!}
      </div>
    
      <div class="form-group">
        {!! Form::label('is_active', 'Status:') !!}
        {!! Form::select('is_active', [1 => 'Active', 2 => 'Inactive'], 1, ['class' => 'form-control']) !!}
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group">
        {!! Form::label('file', 'Photo:') !!}
        {!! Form::file('file', null, ['class' => 'form-control']) !!}
      </div>
    </div>

    <div class="col-md-12">
      <div class="form-group">
        {!! Form::submit('Create User', ['class' => 'btn btn-primary']) !!}
      </div>
    </div>

    
  </div>

  {!! Form::close() !!}

@endsection