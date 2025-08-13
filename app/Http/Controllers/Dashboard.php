<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Validation\ValidationException;
use App\Models\Company;
use App\Models\Form;
use ColorThief\ColorThief;

class Dashboard extends Controller
{
    public function rh_dash(Request $request){
        $user = Auth::user();
        if ($user && $user->role === 'RH') {
            $userc= User::find($user->id)->where('company_id', $user->company_id)->get();
    $company = Company::find($user->company_id);
    $forms= Form::where('company_id',$user->company_id)->get();
    $logoPath = storage_path('app/public/' . $company->logo);
    $dominantColors = ColorThief::getPalette($logoPath, 3); // Extract two dominant colors

   // $gradientColor1 = "rgb({$dominantColors[0][0]}, {$dominantColors[0][1]}, {$dominantColors[0][2]})";
    $gradientColor1 = "rgb({$dominantColors[1][0]}, {$dominantColors[1][1]}, {$dominantColors[1][2]})";
    $gradientColor2 = "rgb({$dominantColors[2][0]}, {$dominantColors[2][1]}, {$dominantColors[2][2]})";
    $page =  $request->query('page', 'dashboard');

            return view('dashboard.dashboard',compact('company', 'gradientColor1', 'gradientColor2','forms','userc','page'));
        }
    }
    public function active(Request $request){
        $user=$request->query('user_id');
        $user = User::find($user);
            if($user->is_active){
                $user->is_active = false;
    
            }
            else{
                $user->is_active = true;
            }
            $user->save();
    
            return redirect()->route('dashboard',[
                'page' => 'dashboard',
            ]);
}
    }












































