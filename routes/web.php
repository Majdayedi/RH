<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoutController;
use App\Models\Form;
use Illuminate\Http\Request;

// Public routes (accessible without authentication)
Route::middleware('guest')->group(function () {
    // Welcome page (public landing page)
    Route::get('test', function () {
        return view('test');
    })->name('test');
    
    // Login routes
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
  
    
    // Registration routes
    Route::get('register', [RegisterController::class, 'create'])->name('register');
    Route::post('register', [RegisterController::class, 'store']);
    Route::get('companies', [CompanyController::class, 'index'])->name('companies.index');
    Route::get('companies/create', [CompanyController::class, 'create'])->name('companies.create');
    Route::post('companies', [CompanyController::class, 'store'])->name('companies.store');
    
    
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
});