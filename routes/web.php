<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SubmissionController;
use App\Models\Company;
use App\Models\Form;
use Illuminate\Http\Request;

// Language switching route (accessible to all)
Route::get('/language/{language}', [LanguageController::class, 'switch'])->name('language.switch');

// Public routes (accessible without authentication)
Route::middleware('guest')->group(function () {
    // Welcome page (public landing page)
    Route::get('test', function () {
        return view('test');
    })->name('test');
    
    // Login routes
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
  Route::post('loginAdmin',function (Request $request){

    $matricule = $request->input('Matricule');
    $password = $request->input('password');
    if ($matricule === 'admin' && $password === 'admin') {
        return redirect()->route('companies.companydash');
    }
    return back()->withErrors(['error' => 'Invalid credentials']);
})->name('loginAdmin');
    
    // Registration routes
    Route::get('register', [RegisterController::class, 'create'])->name('register');
    Route::post('register', [RegisterController::class, 'store']);


    // company/////////////////
    Route::get('companies', [CompanyController::class, 'index'])->name('companies.index');
    Route::get('companies/create', [CompanyController::class, 'create'])->name('companies.create');
    Route::post('companies', [CompanyController::class, 'store'])->name('companies.store');
        Route::get('companydelete', [CompanyController::class, 'destroy'])->name('company.delete');
    Route::get('searchCompany', [CompanyController::class, 'search'])->name('searchCompany');
    Route::get('admin',function (){
        return view('login', [
            'company' => null,
            'gradientColor1' => '#6f42c1',
            'gradientColor2' => '#c04fcfff'
        ]);
    })->name('admin');
        Route::get('companydash', [CompanyController::class, 'showdash'])->name('companies.companydash');

Route::get('activate',function(Request $request ){
        $company_id = $request->query('id');

        $company = Company::find($company_id);
        if($company->is_active){
            $company->is_active = false;
        }
        else{
            $company->is_active = true;
        }
        $company->save();

        return redirect()->route('companies.companydash');
    })->name('company.activate');


});

// Authenticated routes (require login)
Route::middleware('auth')->group(function () {
    Route::get('home', [HomeController::class, 'redirectToHome'])->name('home');
    
    Route::get('dashboard', [Dashboard::class, 'rh_dash'])->name('dashboard');
    Route::get('form', [FormController::class, 'create'])->name('form');
    Route::post('/save-form-json', [FormController::class, 'store'])->name('form.saveHtml');
   // routes/web.php
// In routes/web.php (backend)
Route::post('/show-string',  [FormController::class, 'store'])->name('form.saveHtml');
Route::get('formulaire',  [FormController::class, 'index'])->name('form.formulaire');

    Route::get('forms', [FormController::class, 'listForms'])->name('forms.index');
    Route::get('forms/list', [FormController::class, 'listForms'])->name('forms.show');
    Route::post('logout', [LogoutController::class, 'logout'])->name('logout');
    Route::post('/test', [FormController::class,'submit'])->name('testfetch');
    Route::post('/test-simple', function(Request $request) {
        return response()->json([
            'message' => 'Test successful',
            'data' => $request->all()
        ]);
    });
    Route::post('formDEL',[FormController::class,'delete'])->name('form.delete');
    Route::post('activation', [Dashboard::class, 'active'])->name('user.active');



    Route::post('form',function(Request $request ){
        $form_id = $request->query('form_id');

        $form = Form::find($request->form_id);
        if($form->is_active){
            $form->is_active = false;

        }
        else{
            $form->is_active = true;
        }
        $form->save();

        return redirect()->route('dashboard',[
            'page' => 'forms',
        ]);
    })->name('form.publish');
    Route::get('statistics', [QuestionController::class, 'index'])->name('statistics');
});