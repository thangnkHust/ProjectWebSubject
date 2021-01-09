<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Answer;

class AcceptAnswerController extends Controller
{
    public function __invoke(Answer $answer)
    {
        $answer->question->acceptBestAnswer($answer);

        return response()->json([
            'message' => "You have accepted this answer as best answer"
        ], 200);
    }
}
