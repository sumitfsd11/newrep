<?php

namespace App\Http\Controllers;

use App\Models\Picture;
use App\Models\Survey;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function show(Request $request, Survey $survey)
    {
        $pics = Picture::all(['id', 'name'])->pluck('name', 'id');

        return view('results.show', compact('survey', 'pics'));
    }
}
