<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use Auth;

class VoteQuestionController extends Controller
{
    public function __contruct()
    {
        $this->middleware('auth');
    }

    public function __invoke(Request $request, Question $question)
    {
        $vote = (int) $request->vote;
        Auth::user()->voteQuestion($question, $vote);
        return back();
    }
}
