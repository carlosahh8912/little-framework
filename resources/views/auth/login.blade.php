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
                    <a class="btn btn-link" href="{{ route("") }}">< Return Back</a>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('auth') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="form-label">Email</label>
                            <input class="form-control  @error('email') is-invalid @enderror" type="email" name="email" id="" placeholder="Email" >
                            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                            
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">Password</label>
                            <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" id="" placeholder="Password" >
                            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <button class="btn btn-primary w-100">Log In</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    
@endsection