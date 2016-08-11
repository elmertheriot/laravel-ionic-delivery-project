@extends('app')

@section('content')
<div class="container">
    <h3>Coupons</h3>
    <br>
    <a href="{{ route('admin.coupons.create') }}" class="btn btn-default">New Coupon</a>
    <br><br>

    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Code</th>
            <th>Value</th>
            <th>Action</th>
        </tr>
        </thead>

        <tbody>
        @foreach($coupons as $coupon)
        <tr>
            <td>{{ $coupon->id }}</td>
            <td>{{ $coupon->code }}</td>
            <td>{{ $coupon->value }}</td>
            <td>
                -
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>

    {!! $coupons->render() !!}
</div>
@endsection