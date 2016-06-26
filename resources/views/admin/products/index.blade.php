@extends('app')

@section('content')
<div class="container">
    <h3>Products</h3>
    <br>
    <a href="{{ route('admin.products.create') }}" class="btn btn-default">New Product</a>
    <br><br>

    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Product</th>
            <th>Price</th>
            <th>Category</th>
            <th>Action</th>
        </tr>
        </thead>

        <tbody>
        @foreach($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->category->name }}</td>
            <td>
                <a href="{{ route('admin.products.edit', ['id' => $product->id]) }}" class="btn btn-sm btn-default">Edit</a>
                <a href="{{ route('admin.products.destroy', ['id' => $product->id]) }}" class="btn btn-sm btn-danger">Delete</a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>

    {!! $products->render() !!}
</div>
@endsection