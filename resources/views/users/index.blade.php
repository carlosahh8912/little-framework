@extends('layouts/app.blade.php')

@section('title', 'Usuarios')

@section('content')
    
    <div class="raw">
        <div class="col-12">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Register</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>
                                <a href="{{ route('users', $user->id) }}" class="btn btn-link" >View</a>
                                <a href="{{ route('users/edit/', $user->id) }}" class="btn btn-link" >Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            No users found
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>


@endsection
    