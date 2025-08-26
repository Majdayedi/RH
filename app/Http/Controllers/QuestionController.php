<?php

namespace App\Http\Controllers;

use App\Models\question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */

public function index(request $request)
{
    $form_id = $request->query('form_id') ;
    $form = \App\Models\Form::find($form_id);
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

    try {
        // Check if Python script exists
        $pythonScript = base_path('ai_analysis.py');
        if (!file_exists($pythonScript)) {
            return response()->json([
                'error' => 'Python script not found',
                'expected_path' => $pythonScript,
                'current_directory' => getcwd()
            ], 500);
        }

        // Save data to temporary JSON file for Python script
        $tempFile = storage_path('app/temp_survey_data.json');

        // Ensure storage directory exists
        $storageDir = dirname($tempFile);
        if (!is_dir($storageDir)) {
            mkdir($storageDir, 0755, true);
        }

        $jsonResult = file_put_contents($tempFile, json_encode($questionAnswerMap, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

        if ($jsonResult === false) {
            return response()->json([
                'error' => 'Failed to write temporary data file',
                'temp_file' => $tempFile,
                'permissions' => is_writable($storageDir) ? 'writable' : 'not writable'
            ], 500);
        }

        // Test Python availability
        $pythonTest = shell_exec('python --version 2>&1');
        if (empty($pythonTest)) {
            // Try python3
            $pythonTest = shell_exec('python3 --version 2>&1');
            $pythonCommand = empty($pythonTest) ? 'python' : 'python3';
        } else {
            $pythonCommand = 'python';
        }

        // Execute Python script with proper error handling
        $command = $pythonCommand . ' "' . $pythonScript . '" "' . $tempFile . '" 2>&1';
        $output = shell_exec($command);

        // Clean up temp file
        if (file_exists($tempFile)) {
            unlink($tempFile);
        }

        // Check if we got any output
        if (empty($output)) {
            return response()->json([
                'error' => 'No output from Python script',
                'command' => $command,
                'python_version' => $pythonTest,
                'script_exists' => file_exists($pythonScript),
                'script_readable' => is_readable($pythonScript)
            ], 500);
        }

    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Exception during Python execution',
            'exception_message' => $e->getMessage(),
            'exception_file' => $e->getFile(),
            'exception_line' => $e->getLine()
        ], 500);
    }

    if ($output === null) {
        return response()->json([
            'error' => 'Failed to execute Python analysis script',
            'debug' => [
                'command' => $command,
                'possible_causes' => [
                    'Python3 not installed',
                    'ai_analyzer.py file not found',
                    'Script execution permissions',
                    'Missing dependencies'
                ]
            ]
        ], 500);
    }

    // Decode the result from Python
    $result = json_decode($output, true);
    
    if ($result === null) {
        return response()->json([
            'error' => 'Invalid response from Python script',
            'raw_output' => $output,
            'json_error' => json_last_error_msg()
        ], 500);
    }

    // Check if Python script succeeded
    if (!isset($result['success']) || $result['success'] !== true) {
        return response()->json([
            'error' => 'Python analysis failed',
            'details' => $result['error'] ?? 'Unknown error',
            'python_output' => $result
        ], 500);
    }

    // SUCCESS: HTML report was generated - serve the HTML file
    $htmlFilePath = $result['html_report_path'];

    if (file_exists($htmlFilePath)) {
        // Read the HTML content
        $htmlContent = file_get_contents($htmlFilePath);

        // Clean up the HTML file after reading (optional)
        // unlink($htmlFilePath);

        // Return the HTML content directly
        return response($htmlContent)->header('Content-Type', 'text/html');
    } else {
        return response()->json([
            'error' => 'HTML report file not found',
            'expected_path' => $htmlFilePath
        ], 500);
    }
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
