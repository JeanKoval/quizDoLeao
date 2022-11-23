<?php

namespace App\Services\WebSite;

use App\Models\Lead;
use App\Models\Pergunta;
use App\Models\Resposta;

class RespostaService
{
    public static function saveRespostaDoLead(Pergunta $pergunta, Lead $lead, bool $respostaDoLead)
    {
        //salva a resposta do lead
        $resposta = new Resposta;
        $resposta->resposta = $respostaDoLead;
        $resposta->pergunta_id = $pergunta->id;
        $resposta->lead_id = $lead->id;
        $resposta->save();

        //manipula o lead conforme resposta e campo a ser alterado
        $campo = $pergunta->campo_manipulacao_lead;
        $lead->$campo = $respostaDoLead;
        $lead->update();
    }
}