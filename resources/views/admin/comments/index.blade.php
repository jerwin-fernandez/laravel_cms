@extends('layouts.admin')

@section('content')
    @if (count($comments) > 0)

        <h1 class="page-header">Comments</h1>

        <table class="table pt-1">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Author</th>
                <th scope="col">Body</th>
                <th scope="col">Email</th>
                <th scope="col">Post</th>
                <th scope="col">Status</th>
                <th scope="col">View Replie</th>
                <th scope="col">Action</th>
                <th scope="col">Created</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comments as $comment)
                    <tr>
                        <td>{{ $comment->id }}</td>
                        <td>{{ $comment->author }}</td>
                        <td>{{ $comment->body }}</td>
                        <td>{{ $comment->email }}</td>
                        <td><a href="{{ route('home.post', $comment->post_id) }}" target="_blank">{{ $comment->post->title }}</a></td>
                        <td>

                            @if ((int)$comment->is_active === 1)
                            {!! Form::open([
                                'route' => ['admin.comments.update', $comment->id],
                                'method' => 'PUT',
                            ]) !!} 

                                {!! Form::hidden('is_active', 0) !!}

                                {!! Form::submit('Unapprove', ['class' => 'btn btn-success']) !!}

                            {!! Form::close() !!}
                            @else
                                {!! Form::open([
                                    'route' => ['admin.comments.update', $comment->id],
                                    'method' => 'PUT',
                                ]) !!} 

                                    {!! Form::hidden('is_active', 1) !!}

                                    {!! Form::submit('Approve', ['class' => 'btn btn-primary']) !!}

                                {!! Form::close() !!}
                            @endif

                        </td>
                        <td><a href="{{ route('admin.comment.replies.show', $comment->id) }}" >View Replies</a></td>
                        <td>
                            {!! Form::open([
                                'route' => ['admin.comments.destroy', $comment->id],
                                'method' => 'DELETE',
                            ]) !!} 

                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}

                            {!! Form::close() !!}
                        </td>
                        <td>{{ $comment->created_at->diffForHumans() }}</td>
                    </tr>
                @endforeach
             
            </tbody>
        </table>
    @else
        <h1>No Comments</h1>
    @endif
@endsection