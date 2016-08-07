@extends('app')

@section('content')
    
    <div class="container">
        <h2>Order #{{ $order->id }} - $ {{ $order->total }}</h2>
        <h3>Client: {{ $order->client->user->name }}</h3>
        <h4>Date: {{ $order->created_at }}</h4>

        <p>
            <b>Delivery on:</b><br>
            {{ $order->client->address }} - {{ $order->client->city }} / {{ $order->client->state }}
        </p>
        <br>

        {!! Form::model($order, ['route' => ['admin.orders.update', $order->id]]) !!}

        <div class="form-group">
            {!! Form::label('Status', 'Status: ') !!}
            {!! Form::select('status', $listStatus, null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('Delivery Man', 'Delivery Man: ') !!}
            {!! Form::select('user_deliveryman_id', $deliveryman, null, ['class' => 'form-control']) !!}
        </div>

        <br>
        <div class="form-group">
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
    </div>

@endsection