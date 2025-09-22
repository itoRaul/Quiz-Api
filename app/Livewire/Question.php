<?php

namespace App\Livewire;

use App\Models\Questions;
use Livewire\Component;
use App\Models\CorrectAlternative;
use App\Models\CorrectAlternatives;
use Illuminate\Support\Facades\DB;

class Question extends Component
{

    public $name;
    public $alternatives = [];
    public $correctAlternativeIndex;

    protected $rules = [
        'name' => 'required|string|max:255',
        'alternatives' => 'required|array|min:2',
        'alternatives.*' => 'required|string|max:255',
        'correctAlternativeIndex' => 'required',
    ];

    public function mount ()
    {
        $this->alternatives = [
            ['text' => ''],
            ['text' => ''],
            ['text' => ''],
            ['text' => ''],
        ];
    }

    public function removeAlternative($index)
    {
        unset($this->alternatives[$index]);
        $this->alternatives = array_values($this->alternatives);
    }

    public function save()
    {
        $this->validate();

        try{
            DB::beginTransaction();
            $question = Questions::create([
                'name' => $this->name,
            ]);

            $createdAlternatives = [];
            foreach ($this->alternatives as $alternative) {
                $createdAlternatives[] = $question->alternatives()->create([
                    'text' => $alternative['text'],
                ]);
            }
            $correctAlternativeId = $createdAlternatives[$this->correctAlternativeIndex]->id;
            CorrectAlternatives::create([
                'question_id' => $question->id,
                'alternative_id' => $correctAlternativeId,
            ]);

            DB::commit();
            session()->flash('message', 'Question successfully saved.');
            $this->reset();
            $this->mount();

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'An error occurred while saving the question.');
            return;
        }
    }



    public function render()
    {
        return view('livewire.question');
    }
}
