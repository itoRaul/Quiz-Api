<?php

namespace App\Services;

use App\Models\Alternative;
use App\Models\Question;
use App\Models\CorrectAlternatives;
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
            ]);
            foreach ($request['alternatives'] as $index => $alternative) {
                Alternative::create([
                    'name' => $alternative['text'],
                    'question_id' => $question->id,
                    'alternatives_configuration_id' => $index,
                ]);
            }
            
            DB::commit();

            return [
                'success' => true,
                'message' => 'Question successfully saved.',
            ];

        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollBack();
            
            return [
                'success' => false,
                'message' => 'An error occurred while saving the question.',
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
            ]);

            $question->correctAlternatives()->delete();
            $question->alternatives()->delete();

            $createdAlternatives = [];
            foreach ($request['alternatives'] as $alternative) {
                $createdAlternatives[] = $question->alternatives()->create([
                    'name' => $alternative['text'],
                    'status' => true,
                ]);
            }

            if (isset($request['correctAlternativeIndex']) && isset($createdAlternatives[$request['correctAlternativeIndex']])) {
                $correctAlternativeId = $createdAlternatives[$request['correctAlternativeIndex']]->id;
                CorrectAlternatives::create([
                    'question_id' => $question->id,
                    'alternative_id' => $correctAlternativeId,
                ]);
            }

            DB::commit();

            return [
                'success' => true,
                'message' => 'Question successfully updated.',
                'question' => $question->load(['alternatives', 'correctAlternatives'])
            ];

        } catch (\Exception $e) {
            DB::rollBack();
            
            return [
                'success' => false,
                'message' => 'An error occurred while updating the question.',
                'error' => $e->getMessage()
            ];
        }
    }
}
