<?php

namespace App\Http\Controllers;

use App\Models\company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
{
    $query = Company::where('is_active', true);

    if ($request->filled('query')) {
        $query->where('legal_name', 'LIKE', '%' . $request->input('query') . '%');
    }

    $companies = $query->get();

    // If AJAX request, return JSON only
    if ($request->ajax()) {
        return response()->json($companies);
    }

    return view('companies.index', compact('companies'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Code to show the company registration form
        return view('companies.companyform'); // Assuming you have a view for creating companies
    }


public function store(Request $request)
    {
        // Validate all fields
        $validated = $request->validate([
            'legal_name' => 'required|string|max:255',
            'trade_name' => 'nullable|string|max:255',
            'registration_number' => 'required|string|max:100',
            'tax_id' => 'required|string|max:100',
            'incorporation_date' => 'required|date',
            'legal_structure' => 'required|string|max:50',
            'jurisdiction' => 'nullable|string|max:100',
            'industry' => 'required|string|max:100',
            'is_active' => 'sometimes|boolean',
            'headquarters_address' => 'required|string',
            'country' => 'required|string|size:2',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255|unique:companies',
            'website' => 'nullable|url|max:255',
            'certificate_of_incorporation' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'tax_registration_certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'logo' => 'nullable|image|max:2048',
        ]);
    
        // Handle file uploads
        $jurisdiction = $request->input('jurisdiction', 'Default Jurisdiction Here');
        // Example: 'Tunisia' or 'Your Default Jurisdiction'
    
        // Handle file uploads
        $data = $request->except([
            'certificate_of_incorporation', 
            'tax_registration_certificate',
            'logo'
        ]);
    
        // Add the jurisdiction to the data
        $data['jurisdiction'] = $jurisdiction;
        // Process each file upload
        foreach (['logo', 'certificate_of_incorporation', 'tax_registration_certificate'] as $fileField) {
            if ($request->hasFile($fileField)) {
                $path = $request->file($fileField)->store("company/{$fileField}s", 'public');
                $data[$fileField] = $path;
            }
        }
    
        // Set default value for is_active if not provided
        $data['is_active'] = $request->has('is_active') ? 1 : 0;
    
        // Create the company
        $company = Company::create($data);

        // Auto-create HR admin user for the company
        $matricule = 'HR-' . substr($company->id, 0,3);
        $plainPassword = $data['legal_name'].'123';

        $user = User::create([
            'company_id' => $company->id,  // ✅ Fixed: Use the created company's ID
            'matricule' => $matricule,
            'first_name' => $data['legal_name'],
            'email' => $data['email'],
            'password' => Hash::make($plainPassword),
            'department' => 'Human Resources',  // ✅ Fixed: Set default department
            'role' => 'hr_admin',
            'is_active' => true,
        ]);

        // Log the user creation for debugging
        Log::info('Auto-created HR admin user', [
            'company_id' => $company->id,
            'user_id' => $user->id,
            'matricule' => $matricule,
            'email' => $data['email']
        ]);

        return redirect()->route('companies.index')
            ->with('success', 'Company created successfully!')
            ->with('user_credentials', [
                'matricule' => $matricule,
                'email' => $data['email'],
                'password' => $plainPassword,
                'company_name' => $data['legal_name']
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function showdash(company $company)
    {
          $companies = company::all();
         return view('dashboard.companydash', compact('companies'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $company_id = $request->query('id');
        $company = Company::find($company_id);
        $company->delete();

        return redirect()->route('companies.companydash');
    }
    

}