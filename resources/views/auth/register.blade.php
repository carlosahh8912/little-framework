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
                        <form method="POST" action="{{ route('auth/create') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="" class="form-label">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Name" value="{{ old('name') }}" required>
                                @error('name') <small class="text-danger">{{ $message }}</small> @enderror   
                            </div>

                            <div class="form-group mb-3">
                                <label for="" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" required>
                                @error('email') <small class="text-danger">{{ $message }}</small> @enderror  
                            </div>

                            <div class="form-group mb-3">
                                <label for="" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required>
                                @error('password') <small class="text-danger">{{ $message }}</small> @enderror  
                            </div>

                            <div class="form-group mb-3">
                                <label for="" class="form-label">Retype Password</label>
                                <input type="password" class="form-control @error('retypePassword') is-invalid @enderror" name="retypePassword" placeholder="Retype Password" required>
                                @error('retypePassword') <small class="text-danger">{{ $message }}</small> @enderror    
                            </div>
                            
                            <button class="btn btn-primary w-100">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection