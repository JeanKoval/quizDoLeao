<?php

namespace App\Http\Livewire\Pergunta;

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
    //@params crud
    public $perguntas = [];
    
    public function mount(){
        Session::put('breadcrumbs', [
            [
                'href' => '/' . \App\Enums\RotinasAplicacaoEnum::Pergunta->value,
                'text' => 'Pergunta',
                'icon' => 'pasta'
            ]
        ]);
        $this->perguntas = Pergunta::all();
        foreach($this->perguntas as $pergunta){
            $tipoRelacao = OptionPerguntaEnum::from($pergunta->tipo_relacao);

            if($tipoRelacao == OptionPerguntaEnum::Paragrafo){

                $pergunta->paragrafo = Paragrafo::findOrFail($pergunta->relacao_id);
                $pergunta->artigo = Artigo::findOrFail($pergunta->paragrafo->artigo_id);
                
                $pergunta->paragrafo = $pergunta->paragrafo->numero . '°';

            }else if($tipoRelacao == OptionPerguntaEnum::Inciso){

                $pergunta->inciso = Inciso::findOrFail($pergunta->relacao_id);
                $tipoRelacaoInciso = OptionIncisoEnum::from($pergunta->inciso->tipo_relacao);

                if($tipoRelacaoInciso == OptionIncisoEnum::Artigo){

                    $pergunta->artigo = Artigo::findOrFail($pergunta->inciso->artigo_id);
                    
                }else if($tipoRelacaoInciso == OptionIncisoEnum::Paragrafo){
                    
                    $pergunta->paragrafo = Paragrafo::findOrFail($pergunta->inciso->relacao_id);
                    $pergunta->artigo = Artigo::findOrFail($pergunta->paragrafo->artigo_id);

                    $pergunta->paragrafo = $pergunta->paragrafo->numero . '°';
                }
                $pergunta->inciso = $pergunta->inciso->numeroRomano;

            }else if($tipoRelacao == OptionPerguntaEnum::Alinea){

                $pergunta->alinea = Alinea::findOrFail($pergunta->relacao_id);
                $tipoRelacaoAlinea = OptionAlineaEnum::from($pergunta->alinea->tipo_relacao);

                if($tipoRelacaoAlinea == OptionAlineaEnum::Artigo){

                    $pergunta->artigo = Artigo::findOrFail($pergunta->alinea->artigo_id);

                }else if($tipoRelacaoAlinea == OptionAlineaEnum::Paragrafo){

                    $pergunta->paragrafo = Paragrafo::findOrFail($pergunta->alinea->relacao_id);
                    $pergunta->artigo = Artigo::findOrFail($pergunta->paragrafo->artigo_id);

                    $pergunta->paragrafo = $pergunta->paragrafo->numero . '°';

                }else if($tipoRelacaoAlinea == OptionAlineaEnum::Inciso){

                    $pergunta->inciso = Inciso::findOrFail($pergunta->alinea->relacao_id);
                    $tipoRelacaoInciso = OptionIncisoEnum::from($pergunta->inciso->tipo_relacao);
    
                    if($tipoRelacaoInciso == OptionIncisoEnum::Artigo){
    
                        $pergunta->artigo = Artigo::findOrFail($pergunta->inciso->artigo_id);
                        
                    }else if($tipoRelacaoInciso == OptionIncisoEnum::Paragrafo){
                        
                        $pergunta->paragrafo = Paragrafo::findOrFail($pergunta->inciso->relacao_id);
                        $pergunta->artigo = Artigo::findOrFail($pergunta->paragrafo->artigo_id);

                        $pergunta->paragrafo = $pergunta->paragrafo->numero . '°';
                    }
                    $pergunta->inciso = $pergunta->inciso->numeroRomano;
                }
                $pergunta->alinea = $pergunta->alinea->letra;
            }
            
            $pergunta->capitulo = Capitulo::findOrFail($pergunta->artigo->capitulo_id);
            $pergunta->baseJuridica = $pergunta->capitulo->getBaseJuridicaAndAno();

            $pergunta->capitulo = $pergunta->capitulo->numeroRomano;
            $pergunta->artigo = $pergunta->artigo->numero . '°';
        }
    }

    public function render()
    {
        return view('livewire.pergunta.show');
    }
}
