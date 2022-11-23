<?php

namespace App\Services\WebSite;

use App\Models\Lead;
use App\Models\Pergunta;
use App\Models\Resposta;

class PerguntaService
{

    public static function getProximaPerguntaDoLead(Lead $lead)
    {
        $perguntas = Pergunta::where([['status', '=', '1']])->orderBy('ordem')->get();
        
        foreach($perguntas as $pergunta){
            $respostaDaPergunta = Resposta::where([
                ['pergunta_id', '=', $pergunta->id],
                ['lead_id', '=', $lead->id]
            ])->first();

            if( is_null($respostaDaPergunta) ){
                return $pergunta;
            }
        }
        
        return null;
    }

}