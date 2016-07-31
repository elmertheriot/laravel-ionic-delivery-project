@extends('app')

@section('content')
<div class="container">
    <h3>Clients</h3>
    <br>
    <a href="{{ route('admin.clients.create') }}" class="btn btn-default">New Client</a>
    <br><br>

    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
        </thead>

        <tbody>
        @foreach($clients as $client)
        <tr>
            <td>{{ $client->id }}</td>
            <td>{{ $client->user->name }}</td>
            <td>
                <a href="{{ route('admin.clients.edit', ['id' => $client->id]) }}" class="btn btn-sm btn-default">
                    Edit
                </a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>

    {!! $clients->render() !!}
</div>
@endsection