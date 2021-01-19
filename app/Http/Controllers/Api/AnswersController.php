<?php

namespace App\Http\Controllers\Api;

use App\Answer;
use App\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\AnswerResource;

class AnswersController extends Controller
{
    public function index(Question $question)
    {
        $answers = $question->answers()->with('user')->get();
        return AnswerResource::collection($answers);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question, Request $request)
    {
        $answer = $question->answers()->create($request->validate([
            'body' => 'required'
        ]) + ['user_id' => Auth::id()]);
        return response()->json([
            'message' => 'You are submittted answer',
            'answer' => new AnswerResource($answer->load('user'))
        ], 200);
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

        return \response()->json([
            'message' => 'Your answer has been updated',
            'body' => $answer->body
        ]);
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
            \abort(403, "Access denied");
        }
        $answer->delete();
        return \response()->json([
            'message' => "Your answer has been deleted",
        ]);
    }
}
