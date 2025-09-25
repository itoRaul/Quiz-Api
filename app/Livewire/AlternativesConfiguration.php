<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\AlternativeConfiguration;
use App\Services\ConfigurationService;

class AlternativesConfiguration extends Component
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

    public function messages(){
        return [
            'name.required' => 'O campo Nome é obrigatório.',
            'name.max' => 'O campo Nome deve ter no máximo 1 caractere.',
            'color_name.required' => 'O campo Nome da Cor é obrigatório.',
            'color_name.max' => 'O campo Nome da Cor deve ter no máximo 255 caracteres.',
            'color_hexadecimal.required' => 'O campo Cor Hexadecimal é obrigatório.',
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
        $config = AlternativeConfiguration::findOrFail($id);

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

        $configurationService = new ConfigurationService();

        if ($this->isEditing) {
            $result = $configurationService->update($validatedData, $this->configId);
        } else {
            $result = $configurationService->store($validatedData);
        }

        if ($result['success']) {
            session()->flash('message', $result['message']);
        } else {
            session()->flash('error', $result['message']);
        }

        $this->resetFields();
    }

    public function delete($id)
    {
        AlternativeConfiguration::find($id)?->delete();
        session()->flash('message', 'Configuração deletada com sucesso.');
    }

    public function render()
    {
        return view('livewire.alternative-configuration', [
            'configurations' => AlternativeConfiguration::orderBy('id', 'asc')->get()
        ]);
    }
}