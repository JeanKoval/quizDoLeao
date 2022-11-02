<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paragrafo extends Model
{
    use HasFactory;

    public function getParagrafos($where = []){
        $paragrafos = Paragrafo::where($where)->get();
        
        foreach($paragrafos as &$paragrafo){
            $paragrafo->artigo = Artigo::findOrFail($paragrafo->artigo_id);
            $paragrafo->capitulo = Capitulo::findOrFail($paragrafo->artigo->capitulo_id);
            $paragrafo->baseJuridica = $paragrafo->capitulo->getBaseJuridicaAndAno();
        }

        return $paragrafos;
    }
}
