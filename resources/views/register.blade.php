@extends('layouts.auth')

@section('content')
<div class="py-12">
    <div class="max-w-md mx-auto bg-white rounded-lg shadow-md overflow-hidden md:max-w-lg">
        <div class="p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Register</h2>
            
            <form method="POST" action="{{ route('register') }}">                @csrf

                <!-- Matricule -->
                <div class="mb-4">
                    <label for="matricule" class="block text-gray-700 text-sm font-bold mb-2">Employee ID</label>
                    <input id="matricule" type="text" class="form-input w-full @error('matricule') border-red-500 @enderror" 
                           name="matricule" value="{{ old('matricule') }}" required autofocus>
                    @error('matricule')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- First Name -->
                <div class="mb-4">
                    <label for="first_name" class="block text-gray-700 text-sm font-bold mb-2">First Name</label>
                    <input id="first_name" type="text" class="form-input w-full @error('first_name') border-red-500 @enderror" 
                           name="first_name" value="{{ old('first_name') }}" required>
                    @error('first_name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Department -->
                <div class="mb-4">
                    <label for="department" class="block text-gray-700 text-sm font-bold mb-2">Department</label>
                    <input id="department" type="text" class="form-input w-full @error('department') border-red-500 @enderror" 
                           name="department" value="{{ old('department') }}" required placeholder="Enter your department">
                    @error('department')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
<!-- Role -->
<div class="mb-4">
    <label for="role" class="block text-gray-700 text-sm font-bold mb-2">Role</label>
    <select id="role" name="role" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        <option value="employee">Employee</option>
        <option value="manager">Manager</option>
        <option value="RH">RH</option>
        <option value="admin">Admin</option>
    </select>
    @error('role')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                    <input id="email" type="email" class="form-input w-full @error('email') border-red-500 @enderror" 
                           name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                    <input id="password" type="password" class="form-input w-full @error('password') border-red-500 @enderror" 
                           name="password" required>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Confirm Password</label>
                    <input id="password_confirmation" type="password" class="form-input w-full" name="password_confirmation" required>
                </div>

                <!-- Company -->
                <div class="mb-6">
                    <label for="company_id" class="block text-gray-700 text-sm font-bold mb-2">Company</label>
                    <select id="company_id" name="company_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('company_id') border-red-500 @enderror" required>
                        <option value="">Select your company...</option>
                            <option value= "1">microsoft
                            </option>
                        
                    </select>
                    @error('company_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                

                <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Register
                </button>
                    <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-700 text-sm">
                        Already have an account?
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection