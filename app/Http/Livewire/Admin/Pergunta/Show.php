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
    public $mostraInativos = false;

    protected $listeners = ['render'];

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

        $perguntas = $this->mostraInativos ? Pergunta::getPerguntasShow() : Pergunta::getPerguntasShow([['status', '=', '1']]);

        return view('livewire.admin.pergunta.show', compact('perguntas'));
    }
}
