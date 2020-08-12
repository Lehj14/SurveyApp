<?php

namespace App\Http\Controllers;

use App\Question;
use App\Questionnaire;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use function request;

/**
 * Class QuestionController
 *
 * @package App\Http\Controllers
 */
class QuestionController extends Controller
{
    /**
     * Create Question.
     *
     * @param Questionnaire $questionnaire
     *
     * @return Application|Factory|View
     */
    public function create(Questionnaire $questionnaire)
    {
        return view('question.create', compact('questionnaire'));
    }

    /**
     * Store questions and and answers.
     *
     * @param Questionnaire $questionnaire
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Questionnaire $questionnaire)
    {
        /**
         * NOTE:. notation to get array
         * to represent the entire wildcard of an array
         */
        $data = request()->validate([
            'question.question' => 'required',
            'answers.*.answer' => 'required'
        ]);

        /** @var Question $question */
        $question = $questionnaire->questions()->create($data['question']);

        //creating more than one at the same time.
        $question->answers()->createMany($data['answers']);

        return redirect('/questionnaires/' . $questionnaire->id);
    }

    /**
     * Delete Questions and answers.
     *
     * @param Questionnaire $questionnaire
     * @param Question $question
     *
     * @return Application|RedirectResponse|Redirector
     *
     * @throws Exception
     */
    public function destroy(Questionnaire $questionnaire, Question $question)
    {
        //delete all answers
        $question->answers()->delete();
        //delete questions
        $question->delete();

        return redirect($questionnaire->path());
    }
}
