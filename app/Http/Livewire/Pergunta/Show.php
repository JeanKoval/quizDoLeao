<?php

namespace App\Http\Livewire\Pergunta;

use App\Models\Pergunta;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Show extends Component
{
    //@params crud
    public $perguntas = [];
    
    public function mount(){
        Session::put('breadcrumbs', [
            [
                'href' => '/pergunta',
                'text' => 'Pergunta',
                'icon' => 'pasta'
            ]
        ]);
        $this->perguntas = Pergunta::all();
    }

    public function render()
    {
        return view('livewire.pergunta.show');
    }
}
