@extends('layouts.admin')

@section('content')
    <h1 class="page-header">Edit Category</h1>

    @include('partials.form-error')

    <div class="row">
        <div class="col-md-4">
            {{ Form::model($category, [
                'route' => ['admin.categories.update', $category->id],
                'method' => 'PUT',
            ]) }}
        
            <div class="form-group">
                {!! Form::label('name', 'Category') !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('slug', 'Slug') !!}
                {!! Form::text('slug', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-goup">
                {!! Form::submit('Update Category', ['class' => 'btn btn-primary']) !!}
            {{ Form::close() }}

            {!! Form::open([
                'route' => ['admin.categories.destroy', $category->id],
                'method' => 'DELETE',
                'style' => 'display:inline-block',
                'class' => 'pull-right'
            ]) !!}

                {!! Form::submit('Delete Category', ['class' => 'btn btn-danger']) !!}

            {!! 
                Form::close()
            !!}
            
            </div>
        
        </div>
    </div>


@endsection