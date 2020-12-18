@extends('layouts.blog-post')

@section('content')

  <!-- Blog Post -->

  <!-- Title -->
  <h1>{{ $post->title }}</h1>

  <!-- Author -->
  <p class="lead">
      by <a href="#">{{ $post->user->name }}</a>
  </p>

  <hr>

  <!-- Date/Time -->
  <p><span class="glyphicon glyphicon-time"></span> Posted on  {{ $post->created_at->toFormattedDateString() }} {{ $post->created_at->diffForHumans() }}</p>

  <hr>

  <!-- Preview Image -->
  @if ($post->photo)
    <img class="img-responsive" src="{{ $post->photo->file }}" alt="{{ $post->photo->file }}">
  @endif

  <hr>

  <!-- Post Content -->
  <p class="lead">{{ $post->body }}</p>

  <hr>

  @if (Session::has('comment_message'))
      <div class="alert alert-success">
        {{ session('comment_message') }}
      </div>
  @endif

  <!-- Blog Comments -->

  <!-- Comments Form -->
  <div class="well">
    <h4>Leave a Comment:</h4>
    {{ Form::open([
      'route' => 'admin.comments.store',
      'method' => 'POST'
    ]) }}

      {!! Form::hidden('post_id', $post->id) !!}

      <div class="form-group">
        {{ Form::textarea('body', null, ['class' => 'form-control', 'rows' => 5]) }}
      </div>

      <div class="form-group">
        {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
      </div>

    {{ Form::close() }}
  </div>

  <hr>
  
  <!-- Posted Comments -->

  <!-- Comment -->
  <div class="media">
      <a class="pull-left" href="#">
          <img class="media-object" src="http://placehold.it/64x64" alt="">
      </a>
      <div class="media-body">
          <h4 class="media-heading">Start Bootstrap
              <small>August 25, 2014 at 9:30 PM</small>
          </h4>
          Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
      </div>
  </div>

  <!-- Comment -->
  <div class="media">
      <a class="pull-left" href="#">
          <img class="media-object" src="http://placehold.it/64x64" alt="">
      </a>
      <div class="media-body">
          <h4 class="media-heading">Start Bootstrap
              <small>August 25, 2014 at 9:30 PM</small>
          </h4>
          Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
          <!-- Nested Comment -->
          <div class="media">
              <a class="pull-left" href="#">
                  <img class="media-object" src="http://placehold.it/64x64" alt="">
              </a>
              <div class="media-body">
                  <h4 class="media-heading">Nested Start Bootstrap
                      <small>August 25, 2014 at 9:30 PM</small>
                  </h4>
                  Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
              </div>
          </div>
          <!-- End Nested Comment -->
      </div>
  </div>


    
@endsection