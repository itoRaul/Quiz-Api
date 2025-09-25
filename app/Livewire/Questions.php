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

    public function messages(){
        return [
            'name.required' => 'O campo Nome é obrigatório.',
            'name.max' => 'O campo Nome deve ter no máximo 255 caracteres.',
            'alternatives.required' => 'O campo Alternativas é obrigatório.',
            'alternatives.min' => 'O campo Alternativas deve ter no mínimo 4 itens.',
            'correctAlternativeIndex.required' => 'O campo Alternativa Correta é obrigatório.',
        ];
    }

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

    public function edit($id)
    {
        $question = Question::with('alternatives')->findOrFail($id);
        $this->resetErrorBag();

        $this->question_id = $question->id;
        $this->name = $question->name;
        
        $this->alternatives = [];
        foreach ($question->alternatives as $alternative) {
            $this->alternatives[$alternative->alternatives_configuration_id] = [
                'text' => $alternative->name
            ];
        }
        
        $this->correctAlternativeIndex = $question->alternative_correct;
        $this->formVisible = true;
        $this->isEditing = true;
    }

    public function cancelForm()
    {
        $this->reset(['name', 'alternatives', 'correctAlternativeIndex', 'isEditing', 'formVisible', 'question_id']);
        $this->resetErrorBag();
    }


    public function delete($id)
    {
        try {
            $questionService = new QuestionService();
            $result = $questionService->delete($id);

            if ($result['success']) {
                session()->flash('message', $result['message']);
                $this->reset();
                $this->mount();
            } else {
                session()->flash('error', $result['message']);
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Ocorreu um erro ao excluir a questão: ' . $e->getMessage());
        }
    }

    public function save()
    {
        $this->validate();
        
        try {
            $questionService = new QuestionService();

            if ($this->isEditing && $this->question_id) {
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
            session()->flash('error', 'Ocorreu um erro ao salvar a questão: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.question', [
            'questions' => Question::all()
        ]);
    }
}
