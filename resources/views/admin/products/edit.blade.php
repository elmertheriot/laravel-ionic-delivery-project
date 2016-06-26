@extends('app')

@section('content')
<div class="container">
    <h3>Edit Product: {{ $product->name }}</h3>

    @include('errors._check')

    {!! Form::model($product, ['route' => ['admin.products.update', $product->id]]) !!}
    
    @include('admin.products._form')
    
    <br>
    <div class="form-group">
        {!! Form::submit('Save product', ['class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}
</div>
@endsection