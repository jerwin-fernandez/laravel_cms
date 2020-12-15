@extends('layouts.admin')

@section('content')
    
  <h1 class="page-header">Posts</h1>

  <table class="table pt-1">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Photo</th>
        <th scope="col">Title</th>
        <th scope="col">Category</th>
        <th scope="col">Author</th>
        <th scope="col">Created</th>
        <th scope="col">Updated</th>
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
          <td>{{ $post->updated_at->diffForHumans() }}</td>
        </tr>
        @endforeach
      
      @endif
    </tbody>
  </table>

@endsection