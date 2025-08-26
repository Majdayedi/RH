<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Validation\ValidationException;
use App\Models\Company;
use App\Models\Form;
use App\Services\LocalAIService;
use ColorThief\ColorThief;

class Dashboard extends Controller
{
    public function rh_dash(Request $request){
        
        $user = Auth::user();
        if ($user && in_array($user->role, ['hr_staff', 'hr_admin','manager'])) {
            $userc= User::find($user->id)->where('company_id', $user->company_id)->get();
    $company = Company::find($user->company_id);
    $forms= Form::where('company_id',$user->company_id)->get();

    // Transform forms into a map/associative array
    $formsMap = $forms->mapWithKeys(function ($form) {
        $submissionCount = \App\Models\Submission::where('form_id', $form->id)->count();
        $totalUsers = \App\Models\User::where('company_id', $form->company_id)->count();
        $responseRate = $totalUsers > 0 ? round(($submissionCount / $totalUsers) * 100, 1) : 0;

        return [
            $form->id => [
                'id' => $form->id,
                'title' => $form->title,
                'description' => $form->description,
                'is_active' => $form->is_active,
                'created_at' => $form->created_at,
                'submission_count' => $submissionCount,
                'response_rate' => $responseRate,
                'status' => $form->is_active ? 'published' : 'draft',
                'submissions' => \App\Models\Submission::where('form_id', $form->id)->with('user')->get()->map(function($submission) {
                    return [
                        'id' => $submission->id,
                        'user_name' => $submission->user->first_name ?? 'Anonymous',
                        'user_email' => $submission->user->email ?? 'No email',
                        'created_at' => $submission->created_at->format('M d, Y H:i'),
                        'data' => $submission->data
                    ];
                })
            ]
        ];
    });
    $logoPath = storage_path('app/public/' . $company->logo);
    $dominantColors = ColorThief::getPalette($logoPath, 3); // Extract two dominant colors

   // $gradientColor1 = "rgb({$dominantColors[0][0]}, {$dominantColors[0][1]}, {$dominantColors[0][2]})";
    $gradientColor1 = "rgb({$dominantColors[1][0]}, {$dominantColors[1][1]}, {$dominantColors[1][2]})";
    $gradientColor2 = "rgb({$dominantColors[2][0]}, {$dominantColors[2][1]}, {$dominantColors[2][2]})";
    $page =  $request->query('page', 'dashboard');

    // Generate AI analysis for specific form if requested
    $aiReport = null;
    if ($request->query('generate_ai') === 'true' && $request->query('form_id')) {
        $formId = $request->query('form_id');
        $form = \App\Models\Form::find($formId);

        if ($form) {
            $aiService = new LocalAIService();

            // Use your questionAnswerMap structure directly
            $questionAnswerMap = $this->getQuestionAnswerMap($formId);

            // Run AI analysis
            $analysis = $aiService->analyzeData($questionAnswerMap);
            $aiReport = $aiService->generateHTMLReport($analysis, $form->title);
        }
    }

            return view('dashboard.dashboard',compact('company', 'gradientColor1', 'gradientColor2','forms','formsMap','userc','page','aiReport'));
        }
    }

    /**
     * Get questionAnswerMap structure exactly as you specified
     */
    private function getQuestionAnswerMap($formId)
    {
        $form = \App\Models\Form::find($formId);
        $submissions = \App\Models\Submission::where('form_id', $formId)->get();

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
                $submissionData = is_array($submission->data) ? $submission->data : json_decode($submission->data, true);

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

        return $questionAnswerMap;
    }

    public function active(Request $request){
        $user=$request->query('user_id');
        $user = User::find($user);
            if($user->is_active){
                $user->is_active = false;
    
            }
            else{
                $user->is_active = true;
            }
            $user->save();
    
            return redirect()->route('dashboard',[
                'page' => 'dashboard',
            ]);
}
    }












































