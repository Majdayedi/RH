<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Validation\ValidationException;
use App\Models\Company;
use ColorThief\ColorThief;

class Dashboard extends Controller
{
    public function rh_dash(Request $request){
        $user = Auth::user();
        if ($user && $user->role === 'RH') {
            $companyId = $request->query('company');
    $company = Company::find($companyId);
    $logoPath = storage_path('app/public/' . $company->logo);
    $dominantColors = ColorThief::getPalette($logoPath, 3); // Extract two dominant colors

   // $gradientColor1 = "rgb({$dominantColors[0][0]}, {$dominantColors[0][1]}, {$dominantColors[0][2]})";
    $gradientColor1 = "rgb({$dominantColors[1][0]}, {$dominantColors[1][1]}, {$dominantColors[1][2]})";
    $gradientColor2 = "rgb({$dominantColors[2][0]}, {$dominantColors[2][1]}, {$dominantColors[2][2]})";

            return view('dashboard.dashboard',compact('company', 'gradientColor1', 'gradientColor2'));
        }
    }}
