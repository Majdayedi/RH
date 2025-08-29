<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
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

  // $gradientColor2 = "rgb({$dominantColors[0][0]}, {$dominantColors[0][1]}, {$dominantColors[0][2]})";
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
        $companyId = $request->query('company');
        $user = User::where('Matricule', $credentials['Matricule'])->where('company_id',$companyId )->first();
        
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
            if (in_array(Auth::user()->role, ['hr_staff', 'hr_admin']))
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
       
        
    }
    public function admin()
    {
        return view('login', [
            'company' => null,
            'gradientColor1' => '#6f42c1',
            'gradientColor2' => '#b14fcfff'
        ]);
    }
    public function showEdit()
    {
        return view('edit_profile');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        Log::info('Profile update started', [
            'user_id' => $user->id,
            'request_data' => $request->all()
        ]);

        // Validate the request - ONLY fields that exist in the form
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'matricule' => 'required|string|max:255|unique:users,matricule,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:employee,hr_staff,hr_admin,manager',
            'department' => 'required|string|max:255',
            'current_password' => 'nullable|string',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        try {
            // Check current password if trying to change password
            if ($request->filled('password')) {
                if (!$request->filled('current_password')) {
                    return back()->withErrors(['current_password' => __('messages.current_password_required', [], app()->getLocale())]);
                }

                if (!Hash::check($request->current_password, $user->password)) {
                    return back()->withErrors(['current_password' => __('messages.current_password_incorrect', [], app()->getLocale())]);
                }

                $validatedData['password'] = Hash::make($request->password);
            } else {
                // Remove password from update if not changing
                unset($validatedData['password']);
            }

            // Remove password confirmation and current password from update data
            unset($validatedData['password_confirmation']);
            unset($validatedData['current_password']);

            // Prepare update data - ONLY fields from the form
            $updateData = [
                'first_name' => $validatedData['first_name'],
                'matricule' => $validatedData['matricule'],
                'email' => $validatedData['email'],
                'role' => $validatedData['role'],
                'department' => $validatedData['department'],
                'updated_at' => now(),
            ];

            if (isset($validatedData['password'])) {
                $updateData['password'] = $validatedData['password'];
            }

            // Update using direct DB query (more reliable)
            $affected = DB::table('users')
                ->where('id', $user->id)
                ->update($updateData);

            Log::info('Profile update attempt', [
                'user_id' => $user->id,
                'affected_rows' => $affected,
                'update_data' => $updateData
            ]);

            if ($affected > 0) {
                Log::info('Profile updated successfully', ['user_id' => $user->id]);
            } else {
                Log::warning('No rows affected in profile update', ['user_id' => $user->id]);
            }
            

            return redirect()->route('home')->with('success', __('messages.profile_updated_successfully', [], app()->getLocale()));

        } catch (\Exception $e) {
            Log::error('Profile update failed', [
                'user_id' => $user->id,
                'error' => $e->getMessage()
            ]);

            return redirect()->route('home')->with('error', __('messages.profile_update_failed', [], app()->getLocale()));
        }
    }
   

}