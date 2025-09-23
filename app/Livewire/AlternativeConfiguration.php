<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\AlternativesConfiguration;

class AlternativeConfiguration extends Component
{
    public bool $formVisible = false;

    public ?int $configId = null;
    public string $name = '';
    public string $color_name = '';
    public string $color_hexadecimal = '';
    public bool $status = true;

    public bool $isEditing = false;

    public function rules()
    {
        return [
            'name' => 'required|string|max:1',
            'color_name' => 'required|string|max:255',
            'color_hexadecimal' => 'required',
            'status' => 'required|boolean',
        ];
    }

    public function resetFields()
    {
        $this->reset(['configId', 'name', 'color_name', 'color_hexadecimal', 'status', 'isEditing', 'formVisible']);
    }

    public function create()
    {
        $this->resetFields(); 
        $this->status = true;
        $this->isEditing = false;
        $this->formVisible = true;
        $this->resetErrorBag();
    }

    public function edit($id)
    {
        $config = AlternativesConfiguration::findOrFail($id);

        $this->configId = $config->id;
        $this->name = $config->name;
        $this->color_name = $config->color_name;
        $this->color_hexadecimal = $config->color_hexadecimal;
        $this->status = $config->status;

        $this->isEditing = true;
        $this->formVisible = true;
        $this->resetErrorBag();
    }
    
    public function cancel()
    {
        $this->resetFields();
    }

    public function save()
    {
        $validatedData = $this->validate();

        AlternativesConfiguration::updateOrCreate(
            ['id' => $this->configId],
            $validatedData
        );

        session()->flash('message', 'Configuração salva com sucesso.');
        $this->resetFields(); 
    }

    public function delete($id)
    {
        AlternativesConfiguration::find($id)?->delete();
        session()->flash('message', 'Configuração deletada com sucesso.');
    }

    public function render()
    {
        return view('livewire.alternative-configuration', [
            'configurations' => AlternativesConfiguration::orderBy('id', 'asc')->get()
        ]);
    }
}