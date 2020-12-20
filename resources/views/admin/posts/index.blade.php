@extends('layouts.admin')

@section('content')
    
  <h1 class="page-header">Posts</h1>

  @if (Session::has('created_post'))
      <div class="alert alert-success">
        {{ session('created_post') }}
      </div>
  @endif

  @if (Session::has('updated_post'))
      <div class="alert alert-info">
        {{ session('updated_post') }}
      </div>
  @endif

  @if (Session::has('deleted_post'))
      <div class="alert alert-danger">
        {{ session('deleted_post') }}
      </div>
  @endif

  <table class="table pt-1">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Photo</th>
        <th scope="col">Title</th>
        <th scope="col">Category</th>
        <th scope="col">Author</th>
        <th scope="col">Created</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      @if ($posts)

        @foreach ($posts as $post)
        <tr>
          <td>{{ $post->id }}</td>
          <td>
            <img src="{{ $post->photo ? $post->photo->file : 'https://via.placeholder.com/50' }}" alt="{{ $post->photo ? $post->photo->file : 'Image placeholder'  }}" class="img-thumbnail" width="100px">
          </td>
          <td><a href="{{ route('admin.posts.edit', $post->id) }}">{{ $post->title }}</a></td>
          <td>{{ $post->category ? $post->category->name : 'Uncategorized' }}</td>
          <td>{{ $post->user->name }}</td>
          <td>{{ $post->created_at->diffForHumans() }}</td>
          <td>
            <a href="{{ route('home.post', $post->slug) }}" target="_blank">View Post</a> | 
            <a href="{{ route('admin.comments.show', $post->id) }}"  >View Comment</a>
          </td>
        </tr>
        @endforeach
      
      @endif
    </tbody>
  </table>

  <div class="row">
    <div class="col-sm-6 col-sm-offset-5">
      {{ $posts->render() }}
    </div>
  </div>

@endsection