@extends('layouts.admin')

@section('content')
    
  <h1 class="page-header">Create Post</h1>


  @include('partials.form-error')

  <div class="row">

    <div class="col-md-12">
      {!! Form::open([
        'route' => 'admin.posts.store',
        'files' => true,
      ]) !!}
  
      <div class="form-group">
        {!! Form::label('title', 'Title:') !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
      </div>
  
      <div class="form-group">
        {!! Form::label('category_id', 'Category') !!}
        {!! Form::select('category_id', ['' => 'Choose Category', 1 => 'PHP', 2 => 'Laravel'], 0, ['class' => 'form-control']) !!}
      </div>
  
      <div class="form-group">
        {!! Form::label('photo_id', 'Featured Image') !!}
        {!! Form::file('photo_id', ['class' => 'form-control']) !!}
      </div>
  
      <div class="form-group">
        {!! Form::label('body', 'Content:') !!}
        {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
      </div>
  
      <div class="form-group">
        {!! Form::submit('Create Post', ['class' => 'btn btn-primary']) !!}
      </div>
  
      {!! Form::close() !!}
    </div>

  </div>
@endsection