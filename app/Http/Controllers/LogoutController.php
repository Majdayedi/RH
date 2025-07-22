<?php
;

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie; // Added import for Cookie
use Illuminate\Validation\ValidationException;
use App\Models\Company;
use ColorThief\ColorThief;


class LogoutController extends Controller
{
    //
    public function logout(Request $request)
    {
        // 1. Get user and company data BEFORE logout
        $companyId = $request->query('company');
    $company = Company::find($companyId);

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

             return redirect()->route('login', [
                'company' => $company->id,
                'gradientColor1' => $gradientColor1,
                'gradientColor2' => $gradientColor2
            ]);
        }
        
    }
}
