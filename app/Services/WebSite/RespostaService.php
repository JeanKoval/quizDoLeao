<?php

namespace App\Services\WebSite;

use App\Models\Lead;
use App\Models\Pergunta;
use App\Models\Resposta;
use DateTime;
use Illuminate\Support\Facades\DB;

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

    public static function getTempoMedioParaResponderOQuiz()
    {
        $respostas = DB::select('
            SELECT 
            	lead_id, MIN(created_at) as inicio, MAX(created_at) as fim
            FROM 
            	respostas r
            group by 
            	lead_id');

        $leads = 0;
        $mediaSegundos = 0;

        foreach ($respostas as $resposta) {
            $dataHoraInicio = new DateTime($resposta->inicio);
            $dataHoraFim = new DateTime($resposta->fim);
            $diff = $dataHoraInicio->diff($dataHoraFim);

            $segundosDeResposta = 0;

            // segundos
            if ($diff->s > 0) { $segundosDeResposta += $diff->s; }

            // minutos
            if ($diff->i > 0) { $segundosDeResposta += ($diff->i*60); }
            
            // horas
            if ($diff->h > 0) { $segundosDeResposta += ($diff->i*3600); }

            if ($segundosDeResposta > 0) {
                $leads++;
                $mediaSegundos += $segundosDeResposta;
            }
        }

        return intval( round( ($mediaSegundos/60) ) / $leads );
    }
}
