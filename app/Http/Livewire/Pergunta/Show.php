<?php

namespace App\Http\Livewire\Pergunta;

use App\Models\Pergunta;
use Livewire\Component;

class Show extends Component
{
    //@params crud
    public $perguntas = [];
    
    public function mount(){
        $this->perguntas = Pergunta::all();
    }

    public function render()
    {
        return view('livewire.pergunta.show');
    }
}
