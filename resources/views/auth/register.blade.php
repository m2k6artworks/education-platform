@extends('layouts.app')

@section('content')
<div class="bg-light pt-3 pb-5 px-3 px-sm-0 col-12">
    <div class="container d-flex flex-wrap justify-content-center px-0">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="text-center mb-4">
                <a href="{{ route('home') }}" class="d-inline-block mb-3">
                    <img src="{{ asset('icons/logo-circle.svg') }}" alt="Kyulearn" height="60">
                </a>
                <h2 class="mb-2" style="font-weight: 600">Join Our Learning Community</h2>
                <p class="text-muted">Create your account and start your learning journey today.</p>
            </div>
            
            <div class="card border-0" style="border-radius: 15px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                <div class="card-body p-4 p-md-5">
                    <h4 class="text-center mb-4" style="font-weight: 600">Create Account</h4>
                    
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" name="name" id="name" class="form-control" 
                                   placeholder="Enter your full name" required value="{{ old('name') }}">
                            @error('name') 
                                <div class="text-danger mt-1" style="font-size: 0.875rem;">{{ $message }}</div>
                            @enderror
                        </div>
                        
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
                                   placeholder="Create a strong password" required>
                            @error('password') 
                                <div class="text-danger mt-1" style="font-size: 0.875rem;">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" 
                                   class="form-control" placeholder="Confirm your password" required>
                        </div>
                        
                        <div class="mb-4">
                            <label for="role" class="form-label">Account Type</label>
                            <select name="role" id="role" class="form-select" required>
                                <option value="">-- Choose Account Type --</option>
                                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>
                                    Student - Learn and take courses
                                </option>
                                <option value="creator" {{ old('role') == 'creator' ? 'selected' : '' }}>
                                    Instructor - Create and teach courses
                                </option>
                            </select>
                            @error('role') 
                                <div class="text-danger mt-1" style="font-size: 0.875rem;">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3 d-grid">
                            <button type="submit" class="btn btn-primary py-2" style="font-weight: 600;">
                                Create Account
                            </button>
                        </div>
                    </form>
                    
                    <div class="text-center mt-4">
                        <p class="mb-0">
                            Already have an account? 
                            <a href="{{ route('login') }}" class="text-primary fw-bold">Sign In</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection