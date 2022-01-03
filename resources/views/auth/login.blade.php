@extends('layouts/guest.blade.php')

@section('title', 'Login')
    
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 p-5 my-5 text-center">
            <h1>Little Framework</h1>
        </div>

        <div class="col-12 col-md-6">
            <div class="card shadow py-5 px-3">
                <div class="card-title text-center">
                    <h3 class="text-info pb-3">LogIn</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login/auth') }}">
                        <input class="form-control mb-3" type="email" name="email" id="" placeholder="Email">

                        <input class="form-control mb-3" type="password" name="password" id="" placeholder="Password">

                        <button class="btn btn-primary w-100">Log In</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    
@endsection