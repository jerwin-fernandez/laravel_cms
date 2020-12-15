@extends('layouts.admin')

@section('content')
    <h1 class="page-header">Media</h1>

    @if (Session::has('deleted_media'))
      <div class="alert alert-danger">
        {{ session('deleted_media') }}
      </div>
    @endif

    <table class="table pt-1">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Photo</th>
            <th scope="col">Delete</th>
            <th scope="col">Created</th>
          </tr>
        </thead>
        <tbody>
          @if ($photos)
    
            @foreach ($photos as $photo)
            <tr>
              <td>{{ $photo->id }}</td>
              <td>
                <img src="{{ $photo->file ? $photo->file : 'https://via.placeholder.com/50' }}" alt="{{ $photo->file ? $photo->file : 'Image placeholder'  }}" class="img-thumbnail" width="100px">
              </td>
              <td>
                {!! Form::open([
                  'method' => 'DELETE',
                  'route' => ['admin.media.destroy', $photo]
                ]) !!}
                  {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                {!! Form::close() !!}
              </td>
              <td>{{ $photo->updated_at->diffForHumans() }}</td>
            </tr>
            @endforeach
          
          @endif
        </tbody>
      </table>
@endsection