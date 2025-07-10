<?php

namespace App\Http\Controllers;

use App\Models\Answer; // Correctly import the Answer model
use Illuminate\Http\Request;

class AnswersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Code to list all answers
        $answers = Answer::all();
        return view('answers.index', compact('answers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Code to show a form for creating a new answer
        return view('answers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Code to store a new answer
        $validated = $request->validate([
            'content' => 'required|string|max:255',
        ]);

        Answer::create($validated);

        return redirect()->route('answers.index')->with('success', 'Answer created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Answer $answer)
    {
        // Code to display a specific answer
        return view('answers.show', compact('answer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Answer $answer)
    {
        // Code to show a form for editing an answer
        return view('answers.edit', compact('answer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Answer $answer)
    {
        // Code to update an answer
        $validated = $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $answer->update($validated);

        return redirect()->route('answers.index')->with('success', 'Answer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Answer $answer)
    {
        // Code to delete an answer
        $answer->delete();

        return redirect()->route('answers.index')->with('success', 'Answer deleted successfully.');
    }
}