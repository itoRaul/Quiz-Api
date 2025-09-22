<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\AlternativesConfiguration;

class AlternativeConfiguration extends Component
{

    protected $listeners = ['configurationSaved' => '$refresh'];

    public function delete($id)
    {
        AlternativesConfiguration::find($id)?->delete();
        session()->flash('message', 'Configuration deleted successfully.');
    }

    public function render()
    {
        return view('livewire.alternative-configuration', [
            'configurations' => AlternativesConfiguration::all()
        ]);
    }
}
