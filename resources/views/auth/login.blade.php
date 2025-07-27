@extends('layouts.app')

@section('content')
<div class="bg-light pt-3 pb-5 px-3 px-sm-0 col-12">
    <div class="container d-flex flex-wrap justify-content-center px-0">
        <div class="col-12 col-md-8 col-lg-6 col-xl-4">
            <div class="text-center mb-4">
                <a href="{{ route('home') }}" class="d-inline-block mb-3">
                    <img src="{{ asset('icons/logo-circle.svg') }}" alt="Kyulearn" height="60">
                </a>
                <h2 class="mb-2" style="font-weight: 600">Welcome Back!</h2>
                <p class="text-muted">Sign in to access your courses and continue learning.</p>
            </div>
            
            <div class="card border-0" style="border-radius: 15px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                <div class="card-body p-4 p-md-5">
                    <h4 class="text-center mb-4" style="font-weight: 600">Sign In</h4>
                    
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control" 
                                   placeholder="Enter your email" required value="{{ old('email') }}">
                            @error('email') 
                                <div class="text-danger mt-1" style="font-size: 0.875rem;">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control" 
                                   placeholder="Enter your password" required>
                            @error('password') 
                                <div class="text-danger mt-1" style="font-size: 0.875rem;">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" name="remember" id="remember" class="form-check-input">
                                <label class="form-check-label" for="remember">Remember me</label>
                            </div>
                        </div>
                        
                        <div class="mb-3 d-grid">
                            <button type="submit" class="btn btn-primary py-2" style="font-weight: 600;">
                                Sign In
                            </button>
                        </div>
                    </form>
                    
                    <div class="text-center mt-4">
                        <p class="mb-2">
                            <a href="#" class="text-muted" style="text-decoration: none;">
                                <i class="fas fa-lock me-1"></i>Forgot your password?
                            </a>
                        </p>
                        <p class="mb-0">
                            Don't have an account? 
                            <a href="{{ route('register') }}" class="text-primary fw-bold">Sign Up</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection