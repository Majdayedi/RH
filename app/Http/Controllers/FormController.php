<?php

namespace App\Http\Controllers;

use App\Models\form;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use Illuminate\Validation\ValidationException;
use App\Models\Company;
use App\Models\Submission;
use ColorThief\ColorThief;
use Illuminate\Container\Attributes\Auth as AttributesAuth;

use function Termwind\render;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index(request $request)
    {
        $user = Auth::user();
        $id = $request->query('form');

        // Debug: Log what parameters we're receiving
        \Log::info('Formulaire access attempt', [
            'form_id' => $id,
            'all_params' => $request->all(),
            'query_params' => $request->query()
        ]);

        // Check if form ID is provided
        if (!$id) {
            \Log::warning('No form ID provided to formulaire route');
            return redirect()->route('dashboard', ['page' => 'forms'])
                ->with('error', 'No form ID provided. Please select a form to view.');
        }

        $form = Form::find($id);

        // Check if form exists
        if (!$form) {
            \Log::warning('Form not found', ['form_id' => $id]);
            return redirect()->route('dashboard', ['page' => 'forms'])
                ->with('error', 'Form not found.');
        }

        $form->schema = json_decode($form->schema, true);
        $company_id=$user->company_id;
        $company = Company::find($company_id);
        $forms= Form::where('company_id', $company_id)->get();
       
        
        if (!$company) {
            return redirect()->route('home')->with('error', 'Company not found');
        }
    
        $logoPath = storage_path('app/public/' . $company->logo);
       
        $dominantColors = ColorThief::getPalette($logoPath, 3);
        
        $gradientColor1 = "rgb({$dominantColors[1][0]}, {$dominantColors[1][1]}, {$dominantColors[1][2]})";
        $gradientColor2 = "rgb({$dominantColors[2][0]}, {$dominantColors[2][1]}, {$dominantColors[2][2]})";
    
        return view('form.formulaire',compact('form','id','gradientColor1','gradientColor2'));
    }

    /**
     * Display all forms for the authenticated user's company
     */
    public function listForms(Request $request)
    {
        $user = Auth::user();
        $company_id = $user->company_id;
        $company = Company::find($company_id);
        
        if (!$company) {
            return redirect()->route('home')->with('error', 'Company not found');
        }

        // Get all forms for this company
        $forms = Form::where('company_id', $company_id)
                    ->orderBy('created_at', 'desc')
                    ->get();
        
        $logoPath = storage_path('app/public/' . $company->logo);
        $dominantColors = ColorThief::getPalette($logoPath, 3);
        
        $gradientColor1 = "rgb({$dominantColors[1][0]}, {$dominantColors[1][1]}, {$dominantColors[1][2]})";
        $gradientColor2 = "rgb({$dominantColors[2][0]}, {$dominantColors[2][1]}, {$dominantColors[2][2]})";
    
        return view('forms.index', compact('forms', 'company', 'gradientColor1', 'gradientColor2'));
    }


    public function create(Request $request)
    {
        $user = Auth::user();
        if ($user && in_array($user->role, ['hr_staff', 'hr_admin'])) {
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

    public function submit(Request $request)
    {
        try {
            // Log incoming request for debugging
           
            
            $validated = $request->validate([
                'form_id' => 'required|string',
                'data' => 'required|array',
                'form_type' => 'nullable|string',
                'total_pages' => 'nullable|integer'
            ]);

            $submissionData = [
                'answers' => $validated['data'],
                'form_type' => $validated['form_type'] ?? 'single-page',
                'total_pages' => $validated['total_pages'] ?? 1,
                'submitted_at' => now()->toISOString(),
                'user_agent' => $request->userAgent()
            ];

            // Convert the JSON data to a formatted string
            $jsonString = json_encode($submissionData, JSON_PRETTY_PRINT);
            $submission = Submission::create([
                'form_id' => $validated['form_id'],
                'user_id' => Auth::id(),
                'data' => json_decode($jsonString, true),
                'status' => 'PENDING',
                'reviewed_by' => null,
            ]);
            
            // Return the JSON string as response
            return redirect()->route('home')
                ->with('success', 'Form submitted successfully');
                
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation failed', ['errors' => $e->errors()]);
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            \Log::error('Form submission error', ['message' => $e->getMessage()]);
            return response()->json(['error' => 'Internal server error'], 500);
        }
    }

    public function store(Request $request)

{
    $receivedString = $request->getContent();


// Decode JSON into an associative array
$formStructure = json_decode($receivedString, true);

// Extract the first page title
$title = $formStructure['pages'][0]['questions'][0]['label'];

echo $title; // Output: Page 1
   $form = Form::create([
        'company_id' => Auth::user()->company_id,
        'title' => $title ?? 'form',
        'description' => $formStructure['pages'][0]['questions'][0]['description'] ?? '',
        'schema' => $receivedString,
        'created_by' => Auth::user()->id,
        'is_active' => false,
        
    ]);

    $company = Company::find(Auth::user()->company_id);
    $logoPath = storage_path('app/public/' . $company->logo);
    $dominantColors = ColorThief::getPalette($logoPath, 3); // Extract two dominant colors

   // $gradientColor1 = "rgb({$dominantColors[0][0]}, {$dominantColors[0][1]}, {$dominantColors[0][2]})";
    $gradientColor1 = "rgb({$dominantColors[1][0]}, {$dominantColors[1][1]}, {$dominantColors[1][2]})";
    $gradientColor2 = "rgb({$dominantColors[2][0]}, {$dominantColors[2][1]}, {$dominantColors[2][2]})";

            return view('dashboard.dashboard',compact('company', 'gradientColor1', 'gradientColor2'));
        }

    
    
    /**
     * Display the specified resource.
     */
    public function publishform(Request $request)
    {
        $form_id = $request->query('form_id');

        dd($form_id);
        $form = Form::find($request->form_id);
        $form->is_active = true;
        $form->save();

        return redirect()->route('dashboard');
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
    public function delete(Request $request)
    {
        $form_id = $request->query('form_id');
        $form = Form::find($form_id);
        $form->delete();

        return redirect()->route('dashboard',[
            'page' => 'forms',
        ]);
    }
}
