@extends('app')

@section('content')
<div class="container">
    <h3>New Category</h3>

    @include('errors._check')

    {!! Form::open(['route' => 'admin.categories.store']) !!}
    
    @include('admin.categories._form')
    
    <div class="form-group">
        {!! Form::submit('Create category', ['class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}
</div>
@endsection