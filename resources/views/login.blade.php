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
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    
    .logo-container, .company-logo-container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 2rem;
    }
    
    .logo {
        width: 80px;
        height: 80px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        background: linear-gradient(135deg, #6f42c1, #5a4fcf);
        color: white;
    }
    
    .company-logo {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }
    
    .login-title {
        color: #6c757d;
        font-size: 1.5rem;
        text-align: center;
    }
    
    .form-floating {
        width: 100%;
        margin-bottom: 1rem;
    }
    
    .form-floating input {
        border: 1px solid #ced4da;
        border-radius: 4px;
        width: 100%;
        padding: 1rem;
        transition: all 0.3s;
    }
    
    .form-floating input:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
    
    .form-check {
        margin: 1.5rem 0;
        display: flex;
        align-items: center;
    }
    
    .btn-signin {
        background-color: {{ $gradientColor1 ?? '#6f42c1' }};
        border: none;
        border-radius: 4px;
        width: 100%;
        padding: 0.75rem;
        font-size: 1rem;
        font-weight: 500;
        color: white;
        transition: background-color 0.3s;
    }
    
    .btn-signin:hover {
        background-color: {{ $gradientColor2 ?? '#5a4fcf' }};
    }
    
    .text-link {
        color: #007bff;
        text-decoration: none;
        transition: color 0.2s;
    }
    
    .text-link:hover {
        text-decoration: underline;
    }
    
    .invalid-feedback {
        color: #dc3545;
        font-size: 0.875rem;
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

@section('background')
background: linear-gradient(135deg, {{ $gradientColor1 }}, {{ $gradientColor2 }});
@endsection

@section('content')
<div class="login-container">
    @if(isset($company))
        <div class="company-logo-container">
            <img src="{{ asset('storage/'.$company->logo) }}" alt="{{ $company->name }} logo" class="company-logo">
        </div>
    @endif

    <h1 class="login-title">Welcome to {{ $company->legal_name }}</h1>
    
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    
    <form method="POST" action="{{ route('login') }}" class="w-100">
        @csrf
        <div class="form-floating">
            <input type="text"
                   class="form-control @error('matricule') is-invalid @enderror" 
                   name="Matricule"  
                   placeholder="Enter your matricule" 
                   required aria-labelledby="matriculeLabel">
            <label id="matriculeLabel" for="Matricule">Matricule</label>
            @error('matricule')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-floating">
            <input type="password" 
                   class="form-control @error('password') is-invalid @enderror" 
                   id="password" 
                   name="password" 
                   placeholder="Enter your password" 
                   required aria-labelledby="passwordLabel">
            <label id="passwordLabel" for="password">Password</label>
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        
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
        
        <button type="submit" class="btn btn-primary btn-signin">
            Sign in
        </button>
    </form>
    
    @if (Route::has('password.request'))
        <div class="text-center mt-3">
            <a href="{{ route('password.request') }}" class="text-link">
                Forgot your password?
            </a>
        </div>
    @endif
    
    @if (Route::has('register'))
        <div class="text-center mt-2">
            <span class="text-muted">Don't have an account? </span>
            <a href="{{ route('register', ['company' => $company->id]) }}" class="text-link">
                Sign up here
            </a>
        </div>
    @endif
    
    <div class="copyright">
        © 2017-2018
    </div>
</div>
@endsection