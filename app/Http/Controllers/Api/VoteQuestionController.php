<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Question;
use Auth;

class VoteQuestionController extends Controller
{
    public function __invoke(Request $request, Question $question)
    {
        $vote = (int) $request->vote;
        $votesCount = Auth::user()->voteQuestion($question, $vote);
        return response()->json([
            'message'    => 'Thanks for the feedback',
            'votesCount' => $votesCount
        ], 200);
    }
}
