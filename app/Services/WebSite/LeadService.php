<?php

namespace App\Services\WebSite;

use App\Http\Middleware\CheckLeadCookie;
use App\Models\Lead;

class LeadService
{
    public static function getLeadAtual(): Lead
    {
        // verifica se existe algum cookie criado
        // se nao, cria um novo cookie uuid
        CheckLeadCookie::verificaCookieDoLead();

        $lead = Lead::getLeadPeloCookie($_COOKIE['UUID_LEAD']);

        if( is_null($lead) ){
            $lead = new Lead;
            $lead->cookie_lead = $_COOKIE['UUID_LEAD'];
            $lead->save();
        }

        return $lead;
    }
}