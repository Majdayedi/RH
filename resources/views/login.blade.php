@extends('layouts.auth')

@section('title', 'Sign in')

@push('styles')
<style>
    body {
        background-color: #f8f9fa;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .login-container {
        background: white;
        border-radius: 8px;
        padding: 2rem;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
    }
    
    .logo-container {
        text-align: center;
        margin-bottom: 2rem;
    }
    
    .logo {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #6f42c1, #5a4fcf);
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 1rem;
    }
    
    .login-title {
        color: #6c757d;
        font-size: 1.5rem;
        margin-bottom: 2rem;
    }
    
    .form-floating {
        margin-bottom: 1rem;
    }
    
    .form-floating input {
        border: 1px solid #ced4da;
        border-radius: 4px;
    }
    
    .form-floating input:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
    
    .form-check {
        margin: 1.5rem 0;
    }
    
    .btn-signin {
        background-color: #007bff;
        border: none;
        border-radius: 4px;
        width: 100%;
        padding: 0.75rem;
        font-size: 1rem;
        font-weight: 500;
    }
    
    .btn-signin:hover {
        background-color: #0056b3;
    }
    
    .copyright {
        text-align: center;
        color: #6c757d;
        font-size: 0.875rem;
        margin-top: 2rem;
    }
    
    .alert {
        margin-bottom: 1rem;
    }
</style>
@endpush

@section('content')
<div class="login-container">
    <div class="logo-container">
        <div class="logo">B</div>
        <h1 class="login-title">Please sign in</h1>
    </div>
    
    <!-- Error Messages -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <!-- Success Message -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <!-- Error Message -->
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    
    <form method="POST" action="{{ route('login') }}">
        @csrf
       
        <!-- matricule Field -->
        <div class="form-floating">
    <input type="text"
           class="form-control @error('matricule') is-invalid @enderror" 
           name="Matricule"  
           placeholder="donner votre matricule" 
           required>
    <label for="Matricule">Matricule</label>
    @error('matricule')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
        
        <!-- Password Field -->
        <div class="form-floating">
            <input type="password" 
                   class="form-control @error('password') is-invalid @enderror" 
                   id="password" 
                   name="password" 
                   placeholder="Password" 
                   required>
            <label for="password">Password</label>
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        
        <!-- Remember Me -->
        <div class="form-check">
            <input class="form-check-input" 
                   type="checkbox" 
                   name="remember" 
                   id="remember" 
                   {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">
                Remember me
            </label>
        </div>
        
        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary btn-signin">
            Sign in
        </button>
    </form>
    
    <!-- Optional: Add forgot password link -->
    @if (Route::has('password.request'))
        <div class="text-center mt-3">
            <a href="{{ route('password.request') }}" class="text-decoration-none">
                Forgot your password?
            </a>
        </div>
    @endif
    
    <!-- Optional: Add register link -->
    @if (Route::has('register'))
        <div class="text-center mt-2">
            <span class="text-muted">Don't have an account? </span>
            <a href="{{ route('register') }}" class="text-decoration-none">
                Sign up here
            </a>
        </div>
    @endif
    
    <!-- Footer -->
    <div class="copyright">
        © 2017-2018
    </div>
</div>
@endsection