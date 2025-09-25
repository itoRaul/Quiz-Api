<?php

namespace App\Http\Controllers;

use App\Services\QuestionService;

class QuestionController extends Controller
{
    public function allQuestions()
    {
        $questionService = new QuestionService();
        $questions = $questionService->getAll();

        return response()->json($questions);
    }
}
