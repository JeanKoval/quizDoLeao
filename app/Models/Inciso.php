<?php

namespace App\Models;

use App\Enums\OptionIncisoEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inciso extends Model
{
    use HasFactory;

    public function getIncisos($where = []){
        $incisos = Inciso::where($where)->get();
        
        foreach($incisos as &$inciso){
            $tipoRelacao = OptionIncisoEnum::from($inciso->tipo_relacao);
            if($tipoRelacao == OptionIncisoEnum::Artigo){
                $inciso->artigo = Artigo::findOrFail($inciso->relacao_id);
            }else if($tipoRelacao == OptionIncisoEnum::Paragrafo){
                $inciso->paragrafo = Paragrafo::findOrFail($inciso->relacao_id);
                $inciso->artigo = Artigo::findOrFail($inciso->paragrafo->artigo_id);
            }
            $inciso->capitulo = Capitulo::findOrFail($inciso->artigo->capitulo_id);
            $inciso->baseJuridica = $inciso->capitulo->getBaseJuridicaAndAno();
        }
        return $incisos;
    }
}
