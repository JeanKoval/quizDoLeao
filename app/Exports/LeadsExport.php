<?php

namespace App\Exports;

use App\Models\Lead;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

class LeadsExport implements FromView, WithTitle
{
    public function view(): View
    {
        $leads = Lead::all();

        foreach($leads as &$lead){
            $lead->renda_tributavel                     = $lead->renda_tributavel                   ? "Sim" : "Não";
            $lead->renda_nao_tributavel                 = $lead->renda_nao_tributavel               ? "Sim" : "Não";
            $lead->ganho_de_capital                     = $lead->ganho_de_capital                   ? "Sim" : "Não";
            $lead->opera_bolsa_de_valores               = $lead->opera_bolsa_de_valores             ? "Sim" : "Não";
            $lead->receita_bruta_atividade_rural        = $lead->receita_bruta_atividade_rural      ? "Sim" : "Não";
            $lead->compensar_prejuizo_atividade_rural   = $lead->compensar_prejuizo_atividade_rural ? "Sim" : "Não";
            $lead->bens_e_direitos                      = $lead->bens_e_direitos                    ? "Sim" : "Não";
            $lead->residente_no_brasil                  = $lead->residente_no_brasil                ? "Sim" : "Não";
            $lead->isencao_imoveis                      = $lead->isencao_imoveis                    ? "Sim" : "Não";
            
            if( is_null($lead->necessita_declarar) ){
                $lead->necessita_declarar = 'NULL';
            }else{
                $lead->necessita_declarar = $lead->necessita_declarar ? "Sim" : "Não";
            }
        }

        return view('exports.lead', [
            'leads' => $leads
        ]);
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Leads';
    }
}