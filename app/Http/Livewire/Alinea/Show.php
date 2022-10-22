<?php

namespace App\Http\Livewire\alinea;

use App\Enums\OptionAlineaEnum;
use App\Enums\OptionIncisoEnum;
use App\Models\Artigo;
use App\Models\Capitulo;
use App\Models\Inciso;
use App\Models\Paragrafo;
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
    
    public function mostraInativos(){
        $this->getAlineas();
    }

    public function getAlineas(){
        
        if(!$this->mostraInativos){
            $this->alineas = \App\Models\Alinea::where([['status', '=', '1']])->get();
        }else{
            $this->alineas = \App\Models\Alinea::all();
        }


        foreach($this->alineas as &$alinea){

            $alinea->tipoRelacao = OptionAlineaEnum::from($alinea->tipo_relacao);

            if($alinea->tipoRelacao == OptionAlineaEnum::Paragrafo){

                $alinea->paragrafo = Paragrafo::findOrFail($alinea->relacao_id);
                $alinea->artigo = Artigo::findOrFail($alinea->paragrafo->artigo_id);
                $alinea->paragrafo = $alinea->paragrafo->numero . "°";

            }else if($alinea->tipoRelacao == OptionAlineaEnum::Artigo){

                $alinea->artigo = Artigo::findOrFail($alinea->relacao_id);

            }else{

                $alinea->inciso = Inciso::findOrFail($alinea->relacao_id);

                if($alinea->inciso->tipo_relacao == OptionIncisoEnum::Paragrafo->value){

                    $alinea->paragrafo = Paragrafo::findOrFail($alinea->inciso->relacao_id);
                    $alinea->artigo = Artigo::findOrFail($alinea->paragrafo->artigo_id);
                    $alinea->paragrafo = $alinea->paragrafo->numero . "°";

                }else{

                    $alinea->artigo = Artigo::findOrFail($alinea->inciso->relacao_id);
                }
                $alinea->inciso = $alinea->inciso->numeroRomano;

            }

            $alinea->capitulo = Capitulo::findOrFail($alinea->artigo->capitulo_id);
            $alinea->baseJuridica = $alinea->capitulo->getBaseJuridicaAndAno();
            $alinea->capitulo = $alinea->capitulo->numeroRomano;
            $alinea->artigo = $alinea->artigo->numero . "°";
        }
    }

    public function render()
    {
        return view('livewire.alinea.show');
    }
}
