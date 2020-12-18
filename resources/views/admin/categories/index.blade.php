@extends('layouts.admin')

@section('content')
    <h1 class="page-header">Categories</h1>

    @if (Session::has('created_category'))
      <div class="alert alert-success">
        {{ session('created_category') }}
      </div>
    @endif

    @if (Session::has('updated_category'))
      <div class="alert alert-info">
        {{ session('updated_category') }}
      </div>
    @endif

    @if (Session::has('deleted_category'))
      <div class="alert alert-danger">
        {{ session('deleted_category') }}
      </div>
    @endif

    

    <table class="table pt-1">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Category</th>
          <th scope="col">Slug</th>
          <th scope="col">Date Created</th>
        </tr>
      </thead>
      <tbody>
        @if ($categories)
  
          @foreach ($categories as $category)
          <tr>
            <td>{{ $category->id }}</td>
            <td><a href="{{ route('admin.categories.edit', $category->id) }}">{{ $category->name }}</a></td>
            <td>{{ $category->slug }}</td>
            <td>{{ $category->created_at->diffForHumans() }}</td>
          </tr>
          @endforeach
        
        @endif
      </tbody>
    </table>

@endsection