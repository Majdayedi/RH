<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Form;
use App\Models\Submission;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class GenerateAIReport extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'ai:report {form_id?} {--all}';

    /**
     * The description of the console command.
     */
    protected $description = 'Generate AI-powered reports using free offline models';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🤖 Starting AI Report Generation...');

        try {
            // Get form data
            $formData = $this->getFormData();
            
            if (empty($formData)) {
                $this->error('No form data found!');
                return 1;
            }

            // Export data to JSON
            $jsonPath = $this->exportToJson($formData);
            
            // Run Python AI analysis
            $reportPath = $this->runAIAnalysis($jsonPath);
            
            // Store report in Laravel storage
            $this->storeReport($reportPath);
            
            $this->info('✅ AI Report generated successfully!');
            $this->info("📄 Report saved to: storage/app/public/ai_reports/");
            
            return 0;
            
        } catch (\Exception $e) {
            $this->error('❌ Error generating AI report: ' . $e->getMessage());
            return 1;
        }
    }

    private function getFormData()
    {
        $formId = $this->argument('form_id');
        $all = $this->option('all');

        if ($all) {
            $forms = Form::with(['submissions.user'])->get();
        } elseif ($formId) {
            $forms = Form::with(['submissions.user'])->where('id', $formId)->get();
        } else {
            // Interactive selection
            $forms = Form::all();
            if ($forms->isEmpty()) {
                return [];
            }

            $choices = $forms->pluck('title', 'id')->toArray();
            $selectedId = $this->choice('Select a form to analyze:', $choices);
            $forms = Form::with(['submissions.user'])->where('id', $selectedId)->get();
        }

        // Transform to array format for AI processing
        $formData = [];
        
        foreach ($forms as $form) {
            foreach ($form->submissions as $submission) {
                $formData[] = [
                    'form_id' => $form->id,
                    'form_title' => $form->title,
                    'submission_id' => $submission->id,
                    'user_name' => $submission->user->first_name ?? 'Anonymous',
                    'user_email' => $submission->user->email ?? 'No email',
                    'submitted_at' => $submission->created_at->toISOString(),
                    'answers' => $submission->data['answers'] ?? [],
                    'raw_data' => $submission->data
                ];
            }
        }

        return $formData;
    }

    private function exportToJson($formData)
    {
        $filename = 'form_data_' . date('Y_m_d_H_i_s') . '.json';
        $path = storage_path('app/temp/' . $filename);
        
        // Ensure temp directory exists
        if (!file_exists(dirname($path))) {
            mkdir(dirname($path), 0755, true);
        }

        file_put_contents($path, json_encode($formData, JSON_PRETTY_PRINT));
        
        $this->info("📁 Data exported to: {$path}");
        return $path;
    }

    private function runAIAnalysis($jsonPath)
    {
        $this->info('🧠 Running AI analysis...');

        // Prefer virtualenv python if available
        $venvPython = base_path('ai-env') . DIRECTORY_SEPARATOR . 'Scripts' . DIRECTORY_SEPARATOR . 'python.exe';
        $python = file_exists($venvPython) ? $venvPython : 'python';

        // Use the project's ai_analysis.py script
        $pythonScript = base_path('ai_analysis.py');

        // Run Python script and capture JSON output
        $process = new Process([
            $python,
            $pythonScript,
            $jsonPath
        ]);

        $process->setTimeout(300); // 5 minutes timeout
        $process->run();

        if (!$process->isSuccessful()) {
            // Include stderr/exception details if available
            throw new ProcessFailedException($process);
        }

        $this->info('✅ AI analysis completed!');

        $output = $process->getOutput();
        $this->info('Raw Python output: ' . substr($output, 0, 400));

        $data = json_decode($output, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception('Invalid JSON returned from AI script');
        }

        if (empty($data['success']) || empty($data['html_report_path'])) {
            throw new \Exception('AI script failed or did not return report path: ' . ($output ?? '')); 
        }

        // Normalize path to absolute
        $reportPath = $data['html_report_path'];
        if (!file_exists($reportPath)) {
            // If relative, assume base_path
            $reportPath = base_path($reportPath);
        }

        if (!file_exists($reportPath)) {
            throw new \Exception('Generated report file not found: ' . $reportPath);
        }

        return $reportPath;
    }



    private function storeReport($reportPath)
    {
        if (!file_exists($reportPath)) {
            throw new \Exception('Report file not found: ' . $reportPath);
        }

        // Create reports directory
        $reportsDir = 'public/ai_reports';
        Storage::makeDirectory($reportsDir);

        // Copy report to storage
        $filename = 'ai_report_' . date('Y_m_d_H_i_s') . '.html';
        $storagePath = $reportsDir . '/' . $filename;
        
        Storage::put($storagePath, file_get_contents($reportPath));
        
        // Clean up temp files
        @unlink($reportPath);
        @unlink(base_path('run_ai_analysis.py'));
        
        $this->info("📄 Report stored at: storage/app/{$storagePath}");
    }
}
