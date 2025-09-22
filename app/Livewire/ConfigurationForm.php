<?php

namespace App\Livewire;

use Livewire\Component;
use App\Livewire\AlternativeConfiguration;
use App\Models\AlternativesConfiguration;

class ConfigurationForm extends Component
{
    public AlternativesConfiguration $configuration;


    protected function rules()
    {
        return [
            'configuration.name' => 'required|string|max:1',
            'configuration.color_name' => 'required|string|max:255',
            'configuration.color_hexadecimal' => 'required',
        ];
    }

    public function mount(AlternativesConfiguration $configuration = null)
    {
        $this->configuration = $configuration ?? new AlternativesConfiguration();

        if (!$this->configuration->exists) {
            $this->configuration->color_hexadecimal = '#000000';
        }
    }

    public function save()
    {
        $this->validate();
        
        $this->configuration->save();

        session()->flash('message', 'Configuration saved sucefully');

        $this->emit('configurationSaved');

        return redirect()->route('configurations.index');
    }



    public function render()
    {
        return view('livewire.configuration-form');
    }
}
