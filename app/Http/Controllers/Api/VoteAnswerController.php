<?php

namespace App\Http\Controllers\Api;
use App\Answer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VoteAnswerController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Answer $answer)
    {
        $vote = (int) request()->vote;

        $votesCount = auth()->user()->voteAnswer($answer, $vote);

        return response()->json([
            'message' => 'Thanks for the feedback',
            'votesCount' => $votesCount
        ], 200);
    }
}
