<?php

namespace App\Services;

use App\Models\Alternative;
use App\Models\Question;
use App\Models\CorrectAlternative;
use Illuminate\Support\Facades\DB;


class QuestionService
{

    public function store($request)
    {
        try {
            DB::beginTransaction();

            $question = Question::create([
                'name' => $request['name'],
                'sequence' => 1,
                'alternative_correct' => isset($request['correctAlternativeIndex']) ? $request['correctAlternativeIndex'] : null,
                'status' => true,
            ]);

            $createdAlternatives = [];
            foreach ($request['alternatives'] as $configId => $alternative) {
                $createdAlternatives[$configId] = Alternative::create([
                    'name' => $alternative['text'],
                    'question_id' => $question->id,
                    'alternatives_configuration_id' => $configId,
                    'status' => true,
                ]);
            }

            if (isset($request['correctAlternativeIndex']) && isset($createdAlternatives[$request['correctAlternativeIndex']])) {
                CorrectAlternative::create([
                    'question_id' => $question->id,
                    'alternative_id' => $createdAlternatives[$request['correctAlternativeIndex']]->id,
                ]);
            }
            
            DB::commit();

            return [
                'success' => true,
                'message' => 'Questão salva com sucesso.',
                'question' => $question->load(['alternatives', 'correctAlternatives'])
            ];

        } catch (\Exception $e) {
            DB::rollBack();
            
            return [
                'success' => false,
                'message' => 'Ocorreu um erro ao salvar a questão.',
                'error' => $e->getMessage()
            ];
        }
    }

    public function update($request, $id)
    {
        try {
            DB::beginTransaction();

            $question = Question::findOrFail($id);

            $question->update([
                'name' => $request['name'],
                'alternative_correct' => isset($request['correctAlternativeIndex']) ? $request['correctAlternativeIndex'] : null,
            ]);

            $question->correctAlternatives()->delete();
            $question->alternatives()->delete();

            $createdAlternatives = [];
            foreach ($request['alternatives'] as $configId => $alternative) {
                $createdAlternatives[$configId] = $question->alternatives()->create([
                    'name' => $alternative['text'],
                    'alternatives_configuration_id' => $configId,
                    'status' => true,
                ]);
            }

            if (isset($request['correctAlternativeIndex']) && isset($createdAlternatives[$request['correctAlternativeIndex']])) {
                CorrectAlternative::create([
                    'question_id' => $question->id,
                    'alternative_id' => $createdAlternatives[$request['correctAlternativeIndex']]->id,
                ]);
            }

            DB::commit();

            return [
                'success' => true,
                'message' => 'Questão editada com sucesso.',
                'question' => $question->load(['alternatives', 'correctAlternatives'])
            ];

        } catch (\Exception $e) {
            DB::rollBack();
            
            return [
                'success' => false,
                'message' => 'Ocorreu um erro ao editar a questão.',
                'error' => $e->getMessage()
            ];
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();

            $question = Question::findOrFail($id);
            
            $question->correctAlternatives()->delete();
            
            $question->alternatives()->delete();
            
            $question->delete();

            DB::commit();

            return [
                'success' => true,
                'message' => 'Questão excluída com sucesso.',
            ];

        } catch (\Exception $e) {
            DB::rollBack();
            
            return [
                'success' => false,
                'message' => 'Ocorreu um erro ao excluir a questão.',
                'error' => $e->getMessage()
            ];
        }
    }

    public function getAll()
    {
        return Question::with(['alternatives', 'correctAlternatives'])->get()->map(function ($question) {
            return [
                'id' => $question->id,
                'question' => $question->name,
                'options' => $question->alternatives->map(function ($alt) {
                    return [
                        'id' => $alt->alternativeConfiguration->name ?? '',
                        'text' => $alt->name,
                        'color_name' => $alt->alternativeConfiguration->color_name,
                        'color' => $alt->alternativeConfiguration->color_hexadecimal,
                    ];
                })->toArray(),
                'correctAnswer' => $question->alternative_correct,
            ];
        });
    }
}
