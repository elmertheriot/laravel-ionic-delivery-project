@extends('app')

@section('content')
<div class="container">
    <h3>New Coupon</h3>

    @include('errors._check')

    {!! Form::open(['route' => 'admin.coupons.store']) !!}
    
    @include('admin.coupons._form')
    
    <div class="form-group">
        {!! Form::submit('Create coupon', ['class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}
</div>
@endsection