@extends('layouts.admin')

@section('content')
  <h1 class="page-header">Users</h1>

  @if (Session::has('deleted_user'))
    <div class="alert alert-danger">
      {{ session('deleted_user') }}
    </div>
  @endif

  @if (Session::has('created_user'))
    <div class="alert alert-success">
      {{ session('created_user') }}
    </div>
  @endif

  @if (Session::has('updated_user'))
    <div class="alert alert-info">
      {{ session('updated_user') }}
    </div>
  @endif

  <table class="table pt-1">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Photo</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Role</th>
        <th scope="col">Status</th> 
        <th scope="col">Created</th>
        <th scope="col">Updated</th>
      </tr>
    </thead>
    <tbody>
      @if ($users)

        @foreach ($users as $user)
        <tr>
          <td>{{ $user->id }}</td>
          <td>
            <img src="{{ $user->photo ? $user->photo->file : 'https://via.placeholder.com/50' }}" alt="{{ $user->photo ? $user->photo->file : 'Image placeholder'  }}" width="50px" height="50px">
          </td>
          <td><a href="{{ route('admin.users.edit', $user->id) }}">{{ $user->name }}</a></td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->role->name }}</td>
          <td>
            @if ($user->is_active == 1)
              <span class="alert alert-sm alert-success">Active</span>
            @else
              <span class="alert alert-sm alert-danger">Inactive</span>
            @endif
          </td>
          <td>{{ $user->created_at->diffForHumans() }}</td>
          <td>{{ $user->updated_at->diffForHumans() }}</td>
        </tr>
        @endforeach
      
      @endif
    </tbody>
  </table>
@endsection
