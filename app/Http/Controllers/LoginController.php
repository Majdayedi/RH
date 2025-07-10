<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie; // Added import for Cookie
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }
    public function login(Request $request)
    {
        Log::debug('Login attempt started', ['ip' => $request->ip(), 'input' => $request->all()]);

        // 1. Validate input
        $credentials = $request->validate([
            'Matricule' => 'required|string',
            'password' => 'required|string',
        ]);

        // 2. Check if user exists
        $user = User::where('Matricule', $credentials['Matricule'])->first();
        
        if (!$user) {
            Log::warning('User not found', ['matricule' => $credentials['Matricule']]);
            return $this->sendFailedLoginResponse($request);
        }

        // 3. Verify password
        if (!Hash::check($credentials['password'], $user->password)) {
            Log::warning('Invalid password', [
                'matricule' => $credentials['Matricule'],
                'input_pass' => $credentials['password'],
                'db_pass' => $user->password
            ]);
            return $this->sendFailedLoginResponse($request);
        }

        // 4. Attempt authentication
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            Log::info('Login successful', ['user_id' => Auth::id()]);
            $request->session()->regenerate();
            return redirect()->intended(route('home'));
        }

        // 5. Fallback error
        Log::error('Authentication failed for unknown reason');
        return $this->sendFailedLoginResponse($request);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'Matricule' => [trans('auth.failed')],
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate(); // clear session
        $request->session()->regenerateToken(); // regenerate CSRF token
    
        return redirect('/login'); // or wherever you want
    }

}