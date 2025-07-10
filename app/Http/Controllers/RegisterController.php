<?php 
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Company;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisterController extends Controller
{
    public function create()
    {
        $companies = Company::all();
        return view('register', compact('companies')); // Changed to auth.register (standard Laravel location)
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'matricule' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'first_name' => ['required', 'string', 'max:255'],
            'department' => ['required', 'string', 'max:255'],
            'role'=> ['required', 'string', 'in:employee,manager,RH,admin'], // Added role validation
            
        ]);

        $user = User::create([
            'matricule' => $validated['matricule'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'first_name' => $validated['first_name'],
            'department' => $validated['department'],
            'company_id' => 'ab1',
            'role' => $validated['role'], // Default role
            'is_active' => true,   // Default active status
        ]);
        event(new Registered($user));

        Auth::login($user); // Automatically log in the user after registration

        return redirect()->route('login') // Redirect to dashboard after successful registration
               ->with('success', 'Registration successful! Welcome to the system.');
    }
    
}