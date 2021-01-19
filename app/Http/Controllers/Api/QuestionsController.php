<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Question;
use Illuminate\Http\Request;
use App\Http\Resources\QuestionResource;
use App\Http\Requests\AskQuestionRequest;
use Illuminate\Support\Facades\Gate;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::with("user")->latest()->paginate(10);
        return QuestionResource::collection($questions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AskQuestionRequest $request)
    {
        $question = $request->user()->questions()->create($request->only('title', 'body'));
        return \response()->json([
            'message' => "Your question has been submitted",
            'question' => new QuestionResource($question)
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        return \response()->json([
            'title' => $question->title,
            'body' => $question->body
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        if(Gate::denies('update-question', $question)){
            // \abort(403, "Acess denied");
            return \response()->json([
                'message' => "Access denied"
            ], 403);
        }
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);
        $question->update($request->only('title', 'body'));
        return response()->json([
            'message' => "Your question has been updated.",
            'title' => $question->title,
            'body' => $question->body
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        if(Gate::denies('delete-question', $question)){
            // \abort(403, "Acess denied");
            return \response()->json([
                'message' => "Access denied"
            ], 403);
        }
        $question->delete();
        return response()->json([
            'message' => "Your question has been deleted."
        ], 200);
    }
}
