@extends('app')

@section('content')
<div class="container">
    <h3>Orders</h3>
    <br><br>

    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Action</th>
        </tr>
        </thead>

        <tbody>
        @foreach($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>
                <a href="#" class="btn btn-sm btn-default">
                    Edit
                </a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>

    {!! $orders->render() !!}
</div>
@endsection