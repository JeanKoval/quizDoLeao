<?php

namespace App\Models;

use App\Enums\OptionAlineaEnum;
use App\Enums\OptionIncisoEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alinea extends Model
{
    use HasFactory;

    public static function getAlineas($where = []){
        $alineas = Alinea::where($where)->get();
        
        foreach($alineas as &$alinea){
            $alinea->tipoRelacao = OptionAlineaEnum::from($alinea->tipo_relacao);
            if($alinea->tipoRelacao == OptionAlineaEnum::Paragrafo){

                $alinea->paragrafo = Paragrafo::findOrFail($alinea->relacao_id);
                $alinea->artigo = Artigo::findOrFail($alinea->paragrafo->artigo_id);

            }else if($alinea->tipoRelacao == OptionAlineaEnum::Inciso){

                $alinea->inciso = Inciso::findOrFail($alinea->relacao_id);
                $alinea->tipoRelacaoInciso = OptionIncisoEnum::from($alinea->inciso->tipo_relacao);

                if($alinea->tipoRelacaoInciso == OptionIncisoEnum::Artigo){
                    
                    $alinea->artigo = Artigo::findOrFail($alinea->inciso->relacao_id);

                }else if($alinea->tipoRelacaoInciso == OptionIncisoEnum::Paragrafo){

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
