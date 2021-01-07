<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
use Illuminate\Support\Facades\Gate;

class AcceptAnswerController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Answer $answer)
    {   
        if(Gate::denies('accept', $answer)){
            \abort(403, "Access denied");
        }
        $answer->question->acceptBestAnswer($answer);
        return back();
    }
}
