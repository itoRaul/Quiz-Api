<?php

namespace App\Http\Controllers;

use App\Models\AlternativeConfiguration;
use App\Services\QuestionService;
use Illuminate\Http\Request;

//controller API - questões
class QuestionController extends Controller
{
    public function allQuestions()
    {
        $questionService = new QuestionService();
        $questions = $questionService->getAll();

        return response()->json($questions);
    }

    public function createQuestion(Request $request)
    {
        $name = $request->input('name');
        $alternatives = $request->input('alternatives');
        $sequence = $request->input('sequence');
        $correctAlternativeIndex = $request->input('correctAlternativeIndex');
        $status = $request->input('status');
        $questionService = new QuestionService();
        $result = $questionService->store([
            'name' => $name,
            'alternatives' => $alternatives,
            'sequence' => $sequence,
            'correctAlternativeIndex' => $correctAlternativeIndex,
            'status' => $status ?? true
        ]);

        if ($result['success']) {
            return response()->json($result, 201);
        } else {
            return response()->json($result, 400);
        }
    }

    public function editQuestion($id, Request $request)
    {

        $name = $request->name;
        $alternatives = $request->alternatives;
        $correctAlternativeIndex = $request->correctAlternativeIndex;
        $status = $request->status;
        $questionService = new QuestionService();
        $result = $questionService->update([
            'name' => $name,
            'alternatives' => $alternatives,
            'correctAlternativeIndex' => $correctAlternativeIndex,
            'status' => $status ?? true
        ], $id);

        if ($result['success']) {
            return response()->json($result, 200);
        } else {
            return response()->json($result, 400);
        }
    }

    public function deleteQuestion($id)
    {
        $questionService = new QuestionService();
        $result = $questionService->delete($id);

        if ($result['success']) {
            return response()->json($result, 200);
        } else {
            return response()->json($result, 400);
        }
    }

    public function onlyQuestions()
    {
        try {
            $questionService = new QuestionService();
            $result = $questionService->getOnlyQuestions();

            return response()->json([
                'data' => $result,
                'alternatives_configuration' => AlternativeConfiguration::all(),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao buscar as configurações.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
