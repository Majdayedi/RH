<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    /**
     * Switch language
     */
    public function switch(Request $request, $language)
    {
        // Available languages
        $availableLanguages = ['en', 'fr', 'ar'];
        
        // Check if language is supported
        if (in_array($language, $availableLanguages)) {
            Session::put('locale', $language);
        }
        
        // Redirect back to previous page
        return redirect()->back();
    }
}
