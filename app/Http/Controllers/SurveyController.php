<?php

namespace App\Http\Controllers;

use App\Questionnaire;
use App\Survey;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

/**
 * Class SurveyController
 *
 * @package App\Http\Controllers
 */
class SurveyController extends Controller
{
    /**
     * Show survey.
     *
     * @param Questionnaire $questionnaire
     *
     * @return Application|Factory|View
     */
    public function show(Questionnaire $questionnaire)
    {
        //lazy loading questions answers.
        $questionnaire->load('questions.answers');

        return view('survey.show', compact('questionnaire'));
    }

    /**
     * @param Questionnaire $questionnaire
     *
     * @return string
     */
    public function store(Questionnaire $questionnaire): string
    {
        $data = request()->validate([
            'responses.*.answer_id' => 'required',
            'responses.*.question_id' => 'required',
            'survey.name' => 'required',
            'survey.email' => 'required|email',
        ]);

        /** @var Survey $survey */
        $survey = $questionnaire->surveys()->create($data['survey']);

        $survey->responses()->createMany($data['responses']);

        return 'Thank you';
    }
}
