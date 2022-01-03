@extends('layouts/guest.blade.php')

@section('title', 'Registro')

@section('content')
    
    <div class="container">
        <div class="row justify-content-center my-5">
            <div class="col-12 text-center my-5">
                <h1>New User</h1>
            </div>
    
            <div class="col-12 col-md-6">
                <div class="card shadow py-5 px-3">
                    <div class="card-body">
                        <form method="POST" action="{{ route('users/create') }}">
                            @method('POST')
                            <input type="text" class="form-control mb-3" name="name" placeholder="Name">
                            <input type="email" class="form-control mb-3" name="email" placeholder="Email">
                            <input type="password" class="form-control mb-3" name="password" placeholder="Password">
                            <input type="password" class="form-control mb-3" name="retypePassword" placeholder="Retype Password">
                            <button class="btn btn-primary w-100">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection