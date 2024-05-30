@extends('layouts.app')
@extends('layouts.navbar')
@section('title', 'Login')

@section('content')
    <div class="container-fluid">
        <div class="row d-flex justify-content-center align-items-center min-vh-100">
            <div class="col-lg-4">
                <div class="card shadow">
                    <div class="card-header">
                        <h2 class="fw-bold text-secondary">Login</h2>
                    </div>
                    <div class="card-body p-5">
                        <form action="{{ route('user.login') }}" method="post">
                            @csrf
                            @method('post')
                            <div class="mb-3">
                                <input type="email" name="email" id="email" class="form-control rounded-0 @error('email') is-invalid @enderror"
                                    placeholder="E-mail">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <input type="password" name="password" id="password" class="form-control rounded-0 @error('password') is-invalid @enderror"
                                    placeholder="Password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 d-grid">
                                <input type="submit" value="Login" class="btn btn-secondary rounded-0">
                            </div>
                            <div class="text-center text-secondary">
                                <div>Don't have an account? <a href="/register_designer" class="text-decoration-none">Register Here</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
