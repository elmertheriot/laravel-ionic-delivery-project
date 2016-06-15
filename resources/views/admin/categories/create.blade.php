@extends('app')

@section('content')
<div class="container">
    <h3>New Category</h3>

    {!! Form::open(['route' => 'admin.categories.store']) !!}
    
    <div class="from-group">
        {!! Form::label('Name', 'Name: ') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
    
    <br>
    <div class="from-group">
        {!! Form::submit('Create category', ['class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}
</div>
@endsection