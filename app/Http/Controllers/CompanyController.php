<?php

namespace App\Http\Controllers;

use App\Models\company;
use Illuminate\Http\Request;

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
        $validated = $request->validate([
            'legal_name' => ['required', 'string', 'max:255'],
            'trade_name' => ['nullable', 'string', 'max:255'],
            'registration_number' => ['required', 'string', 'unique:companies,registration_number'],
            'tax_id' => ['required', 'string', 'unique:companies,tax_id'],
            'incorporation_date' => ['required', 'date'],
            'legal_structure' => ['required', 'string', 'max:255'],
            'jurisdiction' => ['required', 'string', 'max:255'],
            'industry' => ['required', 'string', 'max:255'],
            'headquarters_address' => ['required', 'string'],
            'country' => ['required', 'string', 'size:2'], // Assuming ISO 3166-1 alpha-2 country code
            'phone' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:255'],
            'website' => ['nullable', 'url'],
            'certificate_of_incorporation' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png'],
            'tax_registration_certificate' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png'],
            'logo' => ['nullable', 'file', 'mimes:jpg,jpeg,png,gif']
            
        ]);

        $company = company::create([
            'legal_name' => $validated['legal_name'],
            'trade_name' => $validated['trade_name'],
            'registration_number' => $validated['registration_number'],
            'tax_id' => $validated['tax_id'],
            'incorporation_date' => $validated['incorporation_date'],
            'legal_structure' => $validated['legal_structure'],
            'jurisdiction' => $validated['jurisdiction'],
            'industry' => $validated['industry'],
            'is_active' => true, // Default active status
            'headquarters_address' => $validated['headquarters_address'],
            'country' => $validated['country'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'website' => $validated['website'] ?? null,
            'certificate_of_incorporation' => $validated['certificate_of_incorporation'] ?? null,
            'tax_registration_certificate' => $validated['tax_registration_certificate'] ?? null,
            'logo' => $validated['logo'] ?? null,
        ]);


        return redirect()->route('login') // Redirect to dashboard after successful registration
               ->with('success', 'Registration successful! Welcome to the system.');
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