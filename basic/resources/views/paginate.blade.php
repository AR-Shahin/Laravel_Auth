@extends('layout.app')

@section('app_content')
<div class="row justify-content-center">
    <div class="col-6">
        <table class="table table-bordered">
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
            </tr>
            @endforeach

        </table>
        {{ $users->links('vendor.pagination.ab') }}
    </div>
</div>
@stop
