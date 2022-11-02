<?php

namespace App\Models;

use App\Enums\OptionAlineaEnum;
use App\Enums\OptionIncisoEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alinea extends Model
{
    use HasFactory;

    public function getAlineas($where = []){
        $alineas = Alinea::where($where)->get();
        
        foreach($alineas as &$alinea){
            $tipoRelacao = OptionAlineaEnum::from($alinea->tipo_relacao);
            if($tipoRelacao == OptionAlineaEnum::Artigo){

                $alinea->artigo = Artigo::findOrFail($alinea->relacao_id);

            }else if($tipoRelacao == OptionAlineaEnum::Paragrafo){

                $alinea->paragrafo = Paragrafo::findOrFail($alinea->relacao_id);
                $alinea->artigo = Artigo::findOrFail($alinea->paragrafo->artigo_id);

            }else if($tipoRelacao == OptionAlineaEnum::Inciso){

                $alinea->inciso = Inciso::findOrFail($alinea->relacao_id);
                $tipoRelacaoInciso = OptionIncisoEnum::from($alinea->inciso->tipo_relacao);

                if($tipoRelacaoInciso == OptionIncisoEnum::Artigo){
                    
                    $alinea->artigo = Artigo::findOrFail($alinea->inciso->relacao_id);

                }else if($tipoRelacaoInciso == OptionIncisoEnum::Paragrafo){

                    $alinea->paragrafo = Paragrafo::findOrFail($alinea->inciso->relacao_id);
                    $alinea->artigo = Artigo::findOrFail($alinea->paragrafo->artigo_id);
                    
                }
                $alinea->capitulo = Capitulo::findOrFail($alinea->artigo->capitulo_id);
                $alinea->baseJuridica = $alinea->capitulo->getBaseJuridicaAndAno();
            }
            $alinea->capitulo = Capitulo::findOrFail($alinea->artigo->capitulo_id);
            $alinea->baseJuridica = $alinea->capitulo->getBaseJuridicaAndAno();
        }
        return $alineas;
    }
}
