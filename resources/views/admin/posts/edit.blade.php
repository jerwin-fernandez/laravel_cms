@extends('layouts.admin')

@section('content')
    
  <h1 class="page-header">Edit Post</h1>

  @include('partials.form-error')

  <div class="row">
    <div class="col-md-12">
      {!! Form::model($post, [
        'route' => ['admin.posts.update', $post],
        'files' => true,
        'method' => 'PUT'
      ]) !!}

      <div class="col-md-4">
        <div class="form-group">

          @if ($post->photo)
              
            <img src="{{ $post->photo->file }}" alt="{{ $post->photo->file }}" class="img-responsive"> <br>
  
          @endif
  
          {!! Form::label('photo_id', 'Featured Image') !!}
          {!! Form::file('photo_id', ['class' => 'form-control']) !!}
        </div>
      </div>

      <div class="col-md-8">
        <div class="form-group">
          {!! Form::label('title', 'Title:') !!}
          {!! Form::text('title', null, ['class' => 'form-control']) !!}
        </div>
    
        <div class="form-group">
          {!! Form::label('category_id', 'Category') !!}
          {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
        </div>
    
        <div class="form-group">
          {!! Form::label('body', 'Content:') !!}
          {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
        </div>
    
        <div class="form-group">
          {!! Form::submit('Update Post', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}

        {!! Form::open([
          'route' => ['admin.posts.destroy', $post->id],
          'method' => 'DELETE',
          'style' => 'display:inline-block;',
          'class' => 'pull-right'
        ]) !!}

          {!! Form::submit('Delete Post', ['class' => 'btn btn-danger']) !!}

        {!! Form::close() !!}
        </div>
      </div>
  
    </div>
  </div>
@endsection