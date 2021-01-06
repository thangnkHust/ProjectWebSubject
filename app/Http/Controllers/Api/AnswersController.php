<?php

namespace App\Http\Controllers\Api;

use App\Answer;
use App\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Gate;

class AnswersController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question, Request $request)
    {
        $request->validate([
            'body' => 'required'
        ]);
        $question->answers()->create(['body' => $request->body, 'user_id' => Auth::id()]);
        return back()->with('success', 'You are submittted answer');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question, Answer $answer)
    {
        if(Gate::denies('update-answer', $answer)){
            \abort(403, "Access denied");
        }
        return view('answers.edit', \compact('answer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question, Answer $answer)
    {
        if(Gate::denies('update-answer', $answer)){
            \abort(403, "Access denied");
        }

        $answer->update($request->validate([
            'body' => 'required',
        ]));

        return \redirect()->route('questions.show', $answer->question->slug)->with('success', 'Your answer has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question, Answer $answer)
    {
        if(Gate::denies('delete-answer', $question)){
            \abort(403, "Acess denied");
        }
        $answer->delete();
        return \back()->with("success", "Your answer has been deleted");
    }
}
