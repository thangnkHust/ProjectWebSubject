<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Question;
use Auth;

class FavoritesController extends Controller
{
    public function store(Question $question)
    {
        $question->favorites()->attach(Auth::user()->id);
        return response()->json(null, 204);
    }

    public function destroy(Question $question)
    {
        $question->favorites()->detach(Auth::user()->id);   
        return response()->json(null, 204);
    }
}
