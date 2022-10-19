<?php

namespace App\Http\Livewire\Inciso;

use App\Enums\OptionIncisoEnum;
use App\Models\Artigo;
use App\Models\Capitulo;
use App\Models\Paragrafo;
use Livewire\Component;

class Show extends Component
{
    //@params crud
    public $incisos = [];
    
    //@filters
    public $mostraInativos = false;
    
    public function mount(){

        \Illuminate\Support\Facades\Session::put('breadcrumbs', [
            [
                'href' => '/' . \App\Enums\RotinasAplicacaoEnum::Inciso->value,
                'text' => 'Inciso',
                'icon' => 'pasta'
            ]
        ]);

        $this->getIncisos();
    }
    
    public function mostraInativos(){
        $this->getIncisos();
    }

    public function getIncisos(){
        
        if(!$this->mostraInativos){
            $this->incisos = \App\Models\Inciso::where([['status', '=', '1']])->get();
        }else{
            $this->incisos = \App\Models\Inciso::all();
        }


        foreach($this->incisos as &$inciso){

            $inciso->tipoRelacao = OptionIncisoEnum::from($inciso->tipo_relacao);

            if($inciso->tipoRelacao == OptionIncisoEnum::Paragrafo){
                $inciso->paragrafo = Paragrafo::findOrFail($inciso->relacao_id);
                $inciso->artigo = Artigo::findOrFail($inciso->paragrafo->artigo_id);
            }else{
                $inciso->artigo = Artigo::findOrFail($inciso->relacao_id);
            }

            $inciso->capitulo = Capitulo::findOrFail($inciso->artigo->capitulo_id);
            $inciso->baseJuridica = $inciso->capitulo->getBaseJuridicaAndAno();
        }
    }

    public function render()
    {
        return view('livewire.inciso.show');
    }
}
