<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Form;
use ColorThief\ColorThief;
use Doctrine\ORM\Mapping\Id;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use function Illuminate\Log\log;

class HomeController extends Controller
{
    public function redirectToHome(Request $request)
    {
        // Get the authenticated user with their company
        $company_id = Auth::user()->company_id;
        
        // Check if user has a company
        if (!$company_id) {
            return redirect()->route('home')->with('error', 'No company assigned to this user');
        }
    
        // Fix: Remove the incorrect where() clause
        $company = Company::find($company_id);
        $forms= Form::where('company_id', $company_id)->get();
       
        
        if (!$company) {
            return redirect()->route('home')->with('error', 'Company not found');
        }
    
        $logoPath = storage_path('app/public/' . $company->logo);
       
        $dominantColors = ColorThief::getPalette($logoPath, 3);
        
        $gradientColor1 = "rgb({$dominantColors[1][0]}, {$dominantColors[1][1]}, {$dominantColors[1][2]})";
        $gradientColor2 = "rgb({$dominantColors[2][0]}, {$dominantColors[2][1]}, {$dominantColors[2][2]})";
    
        return view('welcome', compact('company', 'gradientColor1', 'gradientColor2','forms'));
    }
}
