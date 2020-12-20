@extends('layouts.admin')

@section('content')
    
@if (count($replies) > 0)

<h1 class="page-header">Replies</h1>

<table class="table pt-1">
    <thead>
        <tr>
        <th scope="col">ID</th>
        <th scope="col">Author</th>
        <th scope="col">Body</th>
        <th scope="col">Email</th>
        <th scope="col">Post</th>
        <th scope="col">Status</th>
        <th scope="col">Action</th>
        <th scope="col">Created</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($replies as $reply)
            <tr>
                <td>{{ $reply->id }}</td>
                <td>{{ $reply->author }}</td>
                <td>{{ $reply->body }}</td>
                <td>{{ $reply->email }}</td>
                {{-- <td><a href="{{ route('home.post', $reply->comment()->post_id) }}" target="_blank">{{ $reply->comment()->post->title }}</a></td> --}}
                <td>

                    @if ((int)$reply->is_active === 1)
                    {!! Form::open([
                        'route' => ['admin.comment.replies.update', $reply->id],
                        'method' => 'PUT',
                    ]) !!} 

                        {!! Form::hidden('is_active', 0) !!}

                        {!! Form::submit('Unapprove', ['class' => 'btn btn-success']) !!}

                    {!! Form::close() !!}
                    @else
                        {!! Form::open([
                            'route' => ['admin.comment.replies.update', $reply->id],
                            'method' => 'PUT',
                        ]) !!} 

                            {!! Form::hidden('is_active', 1) !!}

                            {!! Form::submit('Approve', ['class' => 'btn btn-primary']) !!}

                        {!! Form::close() !!}
                    @endif

                </td>
                <td>
                    {!! Form::open([
                        'route' => ['admin.comment.replies.destroy', $reply->id],
                        'method' => 'DELETE',
                    ]) !!} 

                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}

                    {!! Form::close() !!}
                </td>
                <td>{{ $reply->created_at->diffForHumans() }}</td>
            </tr>
        @endforeach
     
    </tbody>
</table>
@else
<h1>No Replies</h1>
@endif

@endsection