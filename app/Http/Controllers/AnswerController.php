<?php

namespace App\Http\Controllers;

use App\Enums\SurveyStatus;
use App\Helpers\UrlHelper;
use App\Http\Requests\StoreAnswerRequest;
use App\Http\Requests\UpdateAnswerRequest;
use App\Models\Answer;
use App\Models\Survey;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $surveys = Survey::all()->pluck('id');
        // map bcrypt all ids
        $surveys = $surveys->map(function ($item) {
            return UrlHelper::urlSafeHashMake($item);
        });

        // check if id is in surveys
        if (! $surveys->contains($request->id)) {
            abort(404);
        }

        // get id
        $id = UrlHelper::urlSafeHashDecode($request->id);

        // check if survey is active
        if (Survey::findOrFail($id)->status != SurveyStatus::Published->value) {
            abort(404);
        }

        // get survey
        $survey = Survey::findOrFail($id);

        return view('answers.create', compact('survey'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAnswerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAnswerRequest $request)
    {
        $answer = Answer::create($request->validated());
        // insert ip
        $answer->ip()->create(['ip' => $request->ip()]);

        return view('thanks');
        // return redirect()->route('answers.show', $answer->id);
    }

    /**
     * Display the specified resource.
     *s
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer)
    {
        if (! auth()->check()) {
            abort(404);
        }

        return view('answers.show', compact('answer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Answer $answer)
    {
        abort(404);
        // return view('answers.edit', compact('answer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAnswerRequest  $request
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAnswerRequest $request, Answer $answer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {
        //
    }
}
