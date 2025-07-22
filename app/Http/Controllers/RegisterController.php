<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use ColorThief\ColorThief;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    public function create(Request $request)
    {
        // Get company ID from query parameter
        $companyId = $request->query('company');
        
        // Find the company or fail
        $company = Company::findOrFail($companyId);
    
        // Extract logo colors with fallback
        try {
            $logoPath = storage_path('app/public/' . $company->logo);
            $dominantColors = ColorThief::getPalette($logoPath, 3);
            $gradientColor1 = "rgb({$dominantColors[1][0]}, {$dominantColors[1][1]}, {$dominantColors[1][2]})";
            $gradientColor2 = "rgb({$dominantColors[2][0]}, {$dominantColors[2][1]}, {$dominantColors[2][2]})";
        } catch (\Exception $e) {
            $gradientColor1 = "#6f42c1";
            $gradientColor2 = "#5a4fcf";
        }
    
        return view('register', compact('company', 'gradientColor1', 'gradientColor2'));
    }

    public function store(Request $request)
    {
        $companyId = $request->query('company');
        $company = Company::find($companyId);
        $gradientColor1 = "#6f42c1";
        $gradientColor2 = "#5a4fcf";
        
        if ($company && $company->logo) {
            try {
                $logoPath = storage_path('app/public/' . $company->logo);
                if (file_exists($logoPath)) {
                    $dominantColors = ColorThief::getPalette($logoPath, 3);
                    $gradientColor1 = sprintf("rgb(%d, %d, %d)", ...$dominantColors[1]);
                    $gradientColor2 = sprintf("rgb(%d, %d, %d)", ...$dominantColors[2]);
                }
            } catch (\Exception $e) {
                // Use default colors if extraction fails
            }
        }   
        // Validate all inputs including company_id
        $validated = $request->validate([
            'company_id' => ['required', 'exists:companies,id'],
            'matricule' => ['required', 'string', 'max:255', 'unique:users'],
            'first_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'department' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'in:employee,manager,RH,admin'],
        ]);

        // Create the user
        $user = User::create([
            'company_id' => $validated['company_id'],
            'matricule' => $validated['matricule'],
            'first_name' => $validated['first_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'department' => $validated['department'],
            'role' => $validated['role'],
            'is_active' => true,
        ]);

        // Trigger registration event
        event(new Registered($user));

        // Log the user in

        // Redirect with success message
        return redirect()->route('login', [
            'company' => $company->id,
            'gradientColor1' => $gradientColor1,
            'gradientColor2' => $gradientColor2
        ]);
    }
}