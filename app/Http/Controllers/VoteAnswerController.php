<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Answer;

class VoteAnswerController extends Controller
{
    public function __contruct()
    {
        $this->middleware('auth');
    }

    public function __invoke(Request $request, Answer $answer)
    {
        $vote = (int) $request->vote;
        Auth::user()->voteAnswer($answer, $vote);
        return back();
    }
}
