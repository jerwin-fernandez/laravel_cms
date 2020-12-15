@extends('layouts.admin')

@section('content')
    <h1 class="page-header">Create Categories</h1>

    @include('partials.form-error')

    <div class="row">
        <div class="col-md-4">
            {{ Form::open([
                'route' => 'admin.categories.store'
            ]) }}
        
            <div class="form-group">
                {!! Form::label('name', 'Category') !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-goup">
                {!! Form::submit('Create Category', ['class' => 'btn btn-primary']) !!}
            </div>
        
            {{ Form::close() }}
        </div>
    </div>
@endsection