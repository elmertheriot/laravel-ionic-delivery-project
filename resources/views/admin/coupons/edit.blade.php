@extends('app')

@section('content')
<div class="container">
    <h3>Edit Category: {{ $category->name }}</h3>

    @include('errors._check')

    {!! Form::model($category, ['route' => ['admin.categories.update', $category->id]]) !!}
    
    @include('admin.categories._form')
    
    <br>
    <div class="form-group">
        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}
</div>
@endsection