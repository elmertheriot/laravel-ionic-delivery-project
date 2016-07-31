@extends('app')

@section('content')
<div class="container">
    <h3>New Client</h3>

    @include('errors._check')

    {!! Form::open(['route' => 'admin.clients.store']) !!}
    
    @include('admin.clients._form')
    
    <div class="form-group">
        {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}
</div>
@endsection