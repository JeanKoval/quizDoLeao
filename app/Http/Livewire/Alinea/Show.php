<?php

namespace App\Http\Livewire\alinea;

use Livewire\Component;

class Show extends Component
{
    //@params crud
    public $alineas = [];
    
    //@filters
    public $mostraInativos = false;
    
    public function mount(){

        \Illuminate\Support\Facades\Session::put('breadcrumbs', [
            [
                'href' => '/' . \App\Enums\RotinasAplicacaoEnum::Alinea->value,
                'text' => 'Alinea',
                'icon' => 'pasta'
            ]
        ]);

        $this->getAlineas();
    }

    public function getAlineas(){
        
        if(!$this->mostraInativos){
            $this->alineas = \App\Models\Alinea::getAlineas([['status', '=', '1']]);
        }else{
            $this->alineas = \App\Models\Alinea::getAlineas();
        }

        foreach($this->alineas as &$alinea) {
            $alinea->capitulo   = $alinea->capitulo->numeroRomano;
            $alinea->artigo     = $alinea->artigo->numero . "°";
            $alinea->paragrafo  = !$alinea->paragrafo ?: $alinea->paragrafo->numero . '°';
            $alinea->inciso     = !$alinea->inciso ?: $alinea->inciso->numeroRomano;
        }
    }

    public function render()
    {
        return view('livewire.alinea.show');
    }
}
