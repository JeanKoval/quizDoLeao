<?php

namespace App\Http\Livewire\Admin\Pergunta;

use App\Enums\OptionAlineaEnum;
use App\Enums\OptionIncisoEnum;
use App\Enums\OptionPerguntaEnum;
use App\Models\Alinea;
use App\Models\Artigo;
use App\Models\Capitulo;
use App\Models\Inciso;
use App\Models\Paragrafo;
use App\Models\Pergunta;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Optional;
use Livewire\Component;

class Show extends Component
{
   
    public function mount(){
        Session::put('breadcrumbs', [
            [
                'href' => '/' . \App\Enums\RotinasAplicacaoEnum::Pergunta->value,
                'text' => 'Pergunta',
                'icon' => 'pasta'
            ]
        ]);
    }
    
    public function render()
    {
        $perguntas = Pergunta::getPerguntasShow();

        return view('livewire.admin.pergunta.show', compact('perguntas'));
    }
}
