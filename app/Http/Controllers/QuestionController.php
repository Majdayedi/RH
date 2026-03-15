<?php

namespace App\Http\Controllers;

use App\Models\question;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */

public function index(Request $request)
{
    $form_id = $request->query('form_id');
    if (!$form_id) {
        return response('Missing form_id parameter', 400);
    }

    $form = \App\Models\Form::find($form_id);
    if (!$form) {
        return response('Form not found', 404);
    }

    $submissions = \App\Models\Submission::where('form_id', $form_id)->get();

    $questionAnswerMap = [];

    if ($submissions->count() > 0) {
        $schema = json_decode($form->schema, true);

        // Build question structure
        if (isset($schema['pages'][0]['questions'])) {
            foreach ($schema['pages'][0]['questions'] as $question) {
                $questionId = $question['id'];

                $questionAnswerMap[$questionId] = [
                    'question' => [
                        'label' => $question['label'],
                        'type' => $question['type'],
                        'options' => $question['options'] ?? null
                    ],
                    'answers' => []
                ];
            }
        }

        // Add answers from each submission
        foreach ($submissions as $submission) {
            $submissionData = is_array($submission->data) 
                ? $submission->data 
                : json_decode($submission->data, true);

            if (isset($submissionData['answers'])) {
                foreach ($submissionData['answers'] as $answer) {
                    $questionId = $answer['questionId'];

                    if (isset($questionAnswerMap[$questionId])) {
                        $questionAnswerMap[$questionId]['answers'][] = $answer['answer'];
                    }
                }
            }
        }
    }

    $tempFile = null;
    try {
        $pythonScript = base_path('ai_analysis.py');
        if (!file_exists($pythonScript)) {
            return response('Python script not found at: ' . $pythonScript, 500);
        }

        $storageDir = storage_path('app');
        if (!is_dir($storageDir)) {
            mkdir($storageDir, 0755, true);
        }

        $tempFile = tempnam($storageDir, 'survey_');
        if ($tempFile === false) {
            return response('Failed to create temporary file', 500);
        }

        $jsonResult = file_put_contents($tempFile, json_encode($questionAnswerMap, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        if ($jsonResult === false) {
            return response('Failed to write survey data for analysis', 500);
        }

        $venvPython = base_path('ai-env' . DIRECTORY_SEPARATOR . 'Scripts' . DIRECTORY_SEPARATOR . 'python.exe');
        $pythonCommand = file_exists($venvPython) ? $venvPython : 'python';

        $process = new Process([$pythonCommand, $pythonScript, $tempFile]);
        $process->setTimeout(300);
        $process->run();

        if (!$process->isSuccessful()) {
            return response('Python execution failed: ' . $process->getErrorOutput(), 500);
        }

        $output = $process->getOutput();
        if (empty($output)) {
            return response('No output returned from Python analysis script', 500);
        }
    } catch (\Throwable $e) {
        return response('Exception during Python execution: ' . $e->getMessage(), 500);
    } finally {
        if ($tempFile && file_exists($tempFile)) {
            @unlink($tempFile);
        }
    }

    $result = $this->decodePythonJsonOutput($output);

    if ($result === null) {
        return response('Invalid JSON from Python script: ' . json_last_error_msg(), 500);
    }

    // Check if Python script succeeded
    if (!isset($result['success']) || $result['success'] !== true) {
        return response('Python analysis failed: ' . ($result['error'] ?? 'Unknown error'), 500);
    }

    // SUCCESS: HTML report was generated - serve the HTML file
    $htmlFilePath = $result['html_report_path'];
    if (!file_exists($htmlFilePath)) {
        $htmlFilePath = base_path($htmlFilePath);
    }

    if (file_exists($htmlFilePath)) {
        // Read the HTML content
        $htmlContent = file_get_contents($htmlFilePath);

        // Clean up the HTML file after reading (optional)
        // unlink($htmlFilePath);

        // Return the HTML content directly
        return response($htmlContent)->header('Content-Type', 'text/html');
    } else {
        return response('HTML report file not found at: ' . $htmlFilePath, 500);
    }
}

    /**
     * Decode Python output even if extra non-JSON text is present.
     */
    private function decodePythonJsonOutput(string $output): ?array
    {
        $cleanOutput = trim($output);
        $cleanOutput = preg_replace('/^\xEF\xBB\xBF/', '', $cleanOutput);

        $decoded = json_decode($cleanOutput, true);
        if (is_array($decoded)) {
            return $decoded;
        }

        $firstBrace = strpos($cleanOutput, '{');
        $lastBrace = strrpos($cleanOutput, '}');
        if ($firstBrace !== false && $lastBrace !== false && $lastBrace > $firstBrace) {
            $jsonChunk = substr($cleanOutput, $firstBrace, $lastBrace - $firstBrace + 1);
            $decodedChunk = json_decode($jsonChunk, true);
            if (is_array($decodedChunk)) {
                return $decodedChunk;
            }
        }

        return null;
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(question $question)
    {
        //
    }
}
