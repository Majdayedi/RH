<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use App\Models\Company;
use ColorThief\ColorThief;


class LoginController extends Controller
{

    public function showLoginForm(Request $request)

   { $companyId = $request->query('company');
    $company = Company::find($companyId);

    $logoPath = storage_path('app/public/' . $company->logo);
    $dominantColors = ColorThief::getPalette($logoPath, 3); // Extract two dominant colors

   // $gradientColor1 = "rgb({$dominantColors[0][0]}, {$dominantColors[0][1]}, {$dominantColors[0][2]})";
    $gradientColor1 = "rgb({$dominantColors[1][0]}, {$dominantColors[1][1]}, {$dominantColors[1][2]})";
    $gradientColor2 = "rgb({$dominantColors[2][0]}, {$dominantColors[2][1]}, {$dominantColors[2][2]})";



    return view('login', compact('company', 'gradientColor1', 'gradientColor2'));
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
            if (strcasecmp(Auth::user()->role, 'RH') === 0)
 {
                $companyId= Auth::user()->company_id ;
                $company = Company::find($companyId);
                return redirect()->route('dashboard', [
                    'company' => $company->id]);
            }
            else{
            return redirect()->intended(route('home'));
        }
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
        // 1. Get user and company data BEFORE logout
        $user = Auth::user();
        $company = $user ? Company::find($user->company_id) : null;
        dd($company->id,$company->legal_name);

        // 2. Prepare gradient colors (with fallbacks)
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
    
        // 3. Perform actual logout
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        // 4. Redirect to login page
       if ($company) {

        dd($company->id,$company->legal_name);
             /*return redirect()->route('login', [
                'company' => $company->id,
                'gradientColor1' => $gradientColor1,
                'gradientColor2' => $gradientColor2
            ]);*/
        }
        
    }
   
}