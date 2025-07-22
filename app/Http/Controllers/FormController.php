<?php

namespace App\Http\Controllers;

use App\Models\form;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Validation\ValidationException;
use App\Models\Company;
use ColorThief\ColorThief;
class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }


    public function create(Request $request)
    {
        $user = Auth::user();
        if ($user && $user->role === 'RH') {
            $companyId = $request->query('company');
    $company = Company::find($companyId);
    $logoPath = storage_path('app/public/' . $company->logo);
    $dominantColors = ColorThief::getPalette($logoPath, 3); // Extract two dominant colors

   // $gradientColor1 = "rgb({$dominantColors[0][0]}, {$dominantColors[0][1]}, {$dominantColors[0][2]})";
    $gradientColor1 = "rgb({$dominantColors[1][0]}, {$dominantColors[1][1]}, {$dominantColors[1][2]})";
    $gradientColor2 = "rgb({$dominantColors[2][0]}, {$dominantColors[2][1]}, {$dominantColors[2][2]})";

            return view('form.form-creator',compact('company', 'gradientColor1', 'gradientColor2'));
        }
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'survey_json' => 'required|string'
        ]);

        $survey = new Form();
        $survey->json = $request->survey_json;
        $survey->save();
dd($survey);
        return response()->json(['message' => 'Survey stored', 'survey_id' => $survey->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(form $form)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(form $form)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, form $form)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(form $form)
    {
        //
    }
}
