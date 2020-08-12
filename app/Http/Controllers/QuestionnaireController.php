<?php

namespace App\Http\Controllers;

use App\Questionnaire;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use function request;

/**
 * Class QuestionnaireController
 *
 * @package App\Http\Controllers
 */
class QuestionnaireController extends Controller
{
    /**
     * QuestionnaireController constructor.
     *
     * NOTE: to make it protected for auth you can add middleware auth in the construct.
     */
    public function __construct()
    {
        //prevent anyone to access this controller. send you back to login.
        $this->middleware('auth');
    }

    /**
     * Create questionnaire.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('questionnaire.create');
    }

    /**
     * Store questionnaire.
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function store()
    {
        $data = request()->validate([
            'title' => 'required',
            'purpose' => 'required',
        ]);

        //first approach on linking table with foreign key
        //auth() to get the authenticated user.
        //$data['user_id'] = auth()->user()->id;
        //$questionnaire = Questionnaire::create($data);

        //2nd approach
        //go to user and create a function there to link tables.
        //then go to Questionnaire and create a function that return user.
        $questionnaire = auth()->user()->questionnaires()->create($data);

        return redirect('questionnaires/' . $questionnaire->id);
    }

    /**
     * Show questionnaires.
     *
     * @param Questionnaire $questionnaire
     *
     * @return Application|Factory|View
     */
    public function show(Questionnaire $questionnaire)
    {
        //lazy loading relationship on the Questionnaire
        $questionnaire->load('questions.answers.responses');

        return view('questionnaire.show', compact('questionnaire'));
    }
}
