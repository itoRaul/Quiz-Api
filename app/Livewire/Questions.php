<?php

namespace App\Livewire;

use App\Models\AlternativeConfiguration;
use App\Models\Question;
use App\Services\QuestionService;
use Livewire\Component;


class Questions extends Component
{
    public bool $formVisible = false;
    public bool $isEditing = false;
    public $questions = [];
    public $name;
    public $alternatives = [];
    public $correctAlternativeIndex;
    public $question_id;
    public $alternativeConfigurations;

    protected $rules = [
        'name' => 'required|string|max:255',
        'alternatives' => 'required|array|min:4',
        'correctAlternativeIndex' => 'required',
    ];

    public function mount ()
    {
        $this->questions = Question::all();
        $this->alternativeConfigurations = AlternativeConfiguration::where('status', true)->get();
    }

    public function removeAlternative($index)
    {
        unset($this->alternatives[$index]);
        $this->alternatives = array_values($this->alternatives);
    }

    public function create()
    {
        $this->reset(['name', 'alternatives', 'correctAlternativeIndex', 'isEditing', 'formVisible']);
        $this->formVisible = true;
        $this->isEditing = false;
        $this->resetErrorBag();
    }

    public function save()
    {
        $this->validate();
        
        try{
            $questionService = new QuestionService();

            if($this->question_id){
            
                $result = $questionService->update([
                    'name' => $this->name,
                    'alternatives' => $this->alternatives,
                    'correctAlternativeIndex' => $this->correctAlternativeIndex
                ], $this->question_id);

                if ($result['success']) {
                    session()->flash('message', $result['message']);
                    $this->reset();
                    $this->mount();
                } else {
                    session()->flash('error', $result['message']);
                }
                return;

            } else {

                $result = $questionService->store([
                'name' => $this->name,
                'alternatives' => $this->alternatives,
                'correctAlternativeIndex' => $this->correctAlternativeIndex
                ]);

                if ($result['success']) {
                    session()->flash('message', $result['message']);
                    $this->reset();
                    $this->mount();
                } else {
                    session()->flash('error', $result['message']);
                }
            }

        } catch (\Exception $e) {
            
        }
       
    }


    public function render()
    {
        return view('livewire.question', [
            'questions' => Question::all()
        ]);
    }
}
