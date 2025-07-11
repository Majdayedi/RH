<?php

namespace App\Http\Controllers;

use App\Models\company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Code to list all companies
        $companies = company::all();
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
            'email' => 'required|email|max:255',
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
    
        return redirect()->route('companies.index')
            ->with('success', 'Company created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(company $company)
    {
        //
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
    public function destroy(company $company)
    {
        //
    }

}