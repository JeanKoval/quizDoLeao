<?php

namespace App\Models;

use Generator;
use App\Enums\OptionAlineaEnum;
use App\Enums\OptionIncisoEnum;
use App\Enums\OptionPerguntaEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pergunta extends Model
{
    use HasFactory;

    public static function getProximaOrdem(){
        $pergunta = Pergunta::orderByDesc('ordem')->first();
        $ordem = !is_null($pergunta) ? intval($pergunta->ordem) : 0;
        return str_pad(str(++$ordem), 2, 0, STR_PAD_LEFT);
    }

    public static function getPerguntasShow($where = []): Generator
    {
        foreach(Pergunta::where($where)->get() as $pergunta){
            $pergunta->tipoRelacao = OptionPerguntaEnum::from($pergunta->tipo_relacao);

            if($pergunta->tipoRelacao == OptionPerguntaEnum::Paragrafo){

                $pergunta->paragrafo = Paragrafo::findOrFail($pergunta->relacao_id);
                $pergunta->artigo = Artigo::findOrFail($pergunta->paragrafo->artigo_id);
                
                $pergunta->paragrafo = $pergunta->paragrafo->numero . '°';

            }else if($pergunta->tipoRelacao == OptionPerguntaEnum::Inciso){

                $pergunta->inciso = Inciso::findOrFail($pergunta->relacao_id);
                $tipoRelacaoInciso = OptionIncisoEnum::from($pergunta->inciso->tipo_relacao);

                if($tipoRelacaoInciso == OptionIncisoEnum::Artigo){

                    $pergunta->artigo = Artigo::findOrFail($pergunta->inciso->relacao_id);
                    
                }else if($tipoRelacaoInciso == OptionIncisoEnum::Paragrafo){
                    
                    $pergunta->paragrafo = Paragrafo::findOrFail($pergunta->inciso->relacao_id);
                    $pergunta->artigo = Artigo::findOrFail($pergunta->paragrafo->artigo_id);

                    $pergunta->paragrafo = $pergunta->paragrafo->numero . '°';
                }
                $pergunta->inciso = $pergunta->inciso->numeroRomano;

            }else if($pergunta->tipoRelacao == OptionPerguntaEnum::Alinea){

                $pergunta->alinea = Alinea::findOrFail($pergunta->relacao_id);
                $tipoRelacaoAlinea = OptionAlineaEnum::from($pergunta->alinea->tipo_relacao);

                if($tipoRelacaoAlinea == OptionAlineaEnum::Paragrafo){

                    $pergunta->paragrafo = Paragrafo::findOrFail($pergunta->alinea->relacao_id);
                    $pergunta->artigo = Artigo::findOrFail($pergunta->paragrafo->artigo_id);

                    $pergunta->paragrafo = $pergunta->paragrafo->numero . '°';

                }else if($tipoRelacaoAlinea == OptionAlineaEnum::Inciso){

                    $pergunta->inciso = Inciso::findOrFail($pergunta->alinea->relacao_id);
                    $tipoRelacaoInciso = OptionIncisoEnum::from($pergunta->inciso->tipo_relacao);
    
                    if($tipoRelacaoInciso == OptionIncisoEnum::Artigo){
    
                        $pergunta->artigo = Artigo::findOrFail($pergunta->inciso->relacao_id);
                        
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

            yield $pergunta;
        }
    }
}
