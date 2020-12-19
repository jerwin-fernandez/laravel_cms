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

  @if (Session::has('reply_message'))
      <div class="alert alert-success">
        {{ session('reply_message') }}
      </div>
  @endif

  <!-- Blog Comments -->

  @if (Auth::check())
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
  @else
    <p>You must be logged in to comment.</p>
  @endif


  <hr>
  
  <!-- Posted Comments -->  

  <!-- Comment -->
  @if (count($comments) > 0)
    @foreach ($comments as $comment)
      <div class="media">
        <a class="pull-left" href="#">
            <img class="media-object" src="{{ $comment->photo ? $comment->photo : 'http://placehold.it/64x64' }}" alt="" width="64" height="64">
        </a>
        <div class="media-body">
            <h4 class="media-heading">{{ $comment->author }}
                <small>{{ $comment->created_at->toFormattedDateString() }} at {{ $comment->created_at->format('g:i A') }}</small>
            </h4>
            {{ $comment->body }}
            
            
            @if (count($comment->replies) > 0)

              @foreach($comment->replies()->where('is_active', 1)->get() as $reply)

                <!-- Nested Comment -->
                <div class="media">
                  <a class="pull-left" href="#">
                      <img class="media-object" src="{{  $reply->photo ? $reply->photo : 'http://placehold.it/64x64' }}" alt="" width="64" height="64">
                  </a>
                  <div class="media-body">
                      <h4 class="media-heading"> {{ $reply->author }}
                        <small>{{ $reply->created_at->toFormattedDateString() }} at {{ $reply->created_at->format('g:i A') }}</small>
                      </h4>
                      {{ $reply->body }}
                  </div>

                  <div class="comment-reply-container">
                    <button class="toggle-reply btn btn-primary pull-right">Reply</button> <br>

                    <div class="comment-reply-form">
                      {{-- reply form --}}
                      {!! Form::open([
                        'action' => 'CommentReplyController@createReply',
                        'method' => 'POST'
                      ]) !!}

                      {!! Form::hidden('comment_id', $comment->id) !!}

                      <div class="form-group">
                        {!! Form::label('body', 'Reply:') !!}
                        {!! Form::textarea('body', null, ['class' => 'form-control', 'rows' => 5]) !!}
                      </div>

                      <div class="form-group">
                        {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
                      </div>

                      {!! Form::close() !!}
                      {{-- end reply form --}}
                    </div>
                    
                  </div>

                </div>
                <!-- End Nested Comment -->
                  
              @endforeach

            @endif
        </div>
    </div>
    @endforeach
  @endif

  @section('scripts')

  <script>

      $(".comment-reply-container .toggle-reply").click(function() {
        $(this).next().next().slideToggle();
      });

  </script>

      
  @endsection


@endsection