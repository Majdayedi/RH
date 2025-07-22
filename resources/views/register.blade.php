@extends('layouts.auth')

@section('title', 'Register')
@push('styles')
<style>
    /* Reuse all login page styles */
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
        text-align: center;
    }
    
    .form-floating {
        margin-bottom: 1rem;
        position: relative;
    }
    
    .form-floating input,
    .form-floating select {
        border: 1px solid #ced4da;
        border-radius: 4px;
        height: calc(3.5rem + 2px);
        padding: 1rem 0.75rem;
    }
    
    .form-floating label {
        position: absolute;
        top: 0;
        left: 0;
        padding: 1rem 0.75rem;
        pointer-events: none;
        transform-origin: 0 0;
        transition: all 0.2s ease-out;
    }
    
    .form-floating input:focus,
    .form-floating select:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
    
    .form-floating input:not(:placeholder-shown) ~ label,
    .form-floating input:focus ~ label,
    .form-floating select:not([value=""]) ~ label,
    .form-floating select:focus ~ label {
        transform: scale(0.85) translateY(-0.5rem) translateX(0.15rem);
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
        transition: all 0.3s ease;
    }
    
    .btn-signin:hover {
        background-color: {{ $gradientColor2 ?? '#5a4fcf' }};
    }
    
    .text-link {
        color: #007bff;
        text-decoration: none;
    }
    
    .text-link:hover {
        text-decoration: underline;
    }
    
    .invalid-feedback {
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }
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
        background-color:  {{ $gradientColor1 }} ;
        border: none;
        border-radius: 4px;
        width: 100%;
        padding: 0.75rem;
        font-size: 1rem;
        font-weight: 500;
    }
    
    .btn-signin:hover {
        background-color: {{ $gradientColor2 }};
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
    .company-logo{
        width: 200;
        height: 200;
        object-fit: cover;
        border-radius: 0%;
        margin-bottom: 1rem;
        align-items: center;
        justify-content: center;
        max-width: 100%;
    max-height: 100%;
    object-fit: contain; /* Ensures the image fits within the container */
    margin-bottom: 1rem;
    padding-bottom: 2rem;
    padding-top: 2rem;

    }
    .company-logo-container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 1rem;
    }
</style>
@endpush

@section('background')
background: linear-gradient(135deg, {{ $gradientColor1 ?? '#6f42c1' }}, {{ $gradientColor2 ?? '#5a4fcf' }});
@endsection

@section('content')
<<div class="login-container">
    @if(isset($company))
        <div class="company-logo-container">
            <img src="{{ asset('storage/'.$company->logo) }}" alt="{{ $company->legal_name }} logo" class="company-logo">
        </div>
    @endif


    
    <h1 class="login-title">Create Account</h1>
    
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form method="POST" action="{{ route('register', ['company' => $company->id]) }}">
    @csrf
    <input type="hidden" name="company_id" value="{{ $company->id }}">
        
        <!-- Matricule -->
        <div class="form-floating">
            <input id="matricule" type="text" 
                   class="form-control @error('matricule') is-invalid @enderror" 
                   name="matricule" value="{{ old('matricule') }}" 
                   placeholder="Employee ID" required autofocus>
            <label for="matricule">Employee ID</label>
            @error('matricule')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <!-- First Name -->
        <div class="form-floating">
            <input id="first_name" type="text" 
                   class="form-control @error('first_name') is-invalid @enderror" 
                   name="first_name" value="{{ old('first_name') }}" 
                   placeholder="First Name" required>
            <label for="first_name">First Name</label>
            @error('first_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <!-- Department -->
        <div class="form-floating">
            <input id="department" type="text" 
                   class="form-control @error('department') is-invalid @enderror" 
                   name="department" value="{{ old('department') }}" 
                   placeholder="Department" required>
            <label for="department">Department</label>
            @error('department')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <!-- Role -->
        <div class="form-floating">
            <select id="role" name="role" 
                    class="form-control @error('role') is-invalid @enderror" required>
                <option value="">Select Role</option>
                <option value="employee" {{ old('role') == 'employee' ? 'selected' : '' }}>Employee</option>
                <option value="manager" {{ old('role') == 'manager' ? 'selected' : '' }}>Manager</option>
                <option value="RH" {{ old('role') == 'RH' ? 'selected' : '' }}>RH</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
            <label for="role">Role</label>
            @error('role')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <!-- Email -->
        <div class="form-floating">
            <input id="email" type="email" 
                   class="form-control @error('email') is-invalid @enderror" 
                   name="email" value="{{ old('email') }}" 
                   placeholder="Email" required>
            <label for="email">Email</label>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <!-- Password -->
        <div class="form-floating">
            <input id="password" type="password" 
                   class="form-control @error('password') is-invalid @enderror" 
                   name="password" placeholder="Password" required>
            <label for="password">Password</label>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <!-- Confirm Password -->
        <div class="form-floating">
            <input id="password_confirmation" type="password" 
                   class="form-control" 
                   name="password_confirmation" 
                   placeholder="Confirm Password" required>
            <label for="password_confirmation">Confirm Password</label>
        </div>
        
        <!-- Company -->
        
        
        <button type="submit" class="btn btn-signin mt-3">
            Register
        </button>
        
        <div class="text-center mt-3">
            <span>Already have an account? </span>
            <a href="{{ route('login',['company'=>$company->id]) }}" class="text-link">Sign in</a>
        </div>
    </form>
</div>
@endsection