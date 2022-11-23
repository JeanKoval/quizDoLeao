<?php

namespace App\Http\Livewire\Admin\Lead;

use Livewire\Component;

class Form extends Component
{
    // @params
    public $action;
    public $lead;

    // @attributes
    public $nome;
    public $email;
    public $telefone;
    public $necessitaDeclarar;
    public $rendaTributavel;
    public $rendaNaoTributavel;
    public $ganhoDeCapital;
    public $operaBolsaDeValores;
    public $receitaBrutaAtividadeRural;
    public $compensarPrejuizoAtividadeRural;
    public $bensEDireitos;
    public $residenteNoBrasil;
    public $isencaoImoveis;

    public function mount(\App\Models\Lead $lead)
    {

        \Illuminate\Support\Facades\Session::put('breadcrumbs', [
            [
                'href' => '/' . \App\Enums\RotinasAplicacaoEnum::Lead->value,
                'text' => 'Lead',
                'icon' => 'pasta'
            ],
            [
                'href' => '#',
                'text' => ucfirst(\App\Enums\OptionCrudEnum::Visualizar->value),
                'icon' => 'page'
            ]
        ]);

        $this->lead                             = $lead;
        $this->nome                             = $lead->nome;
        $this->email                            = $lead->email;
        $this->telefone                         = $lead->telefone;
        $this->rendaTributavel                  = $lead->renda_tributavel                   ? "Sim" : "Não";
        $this->rendaNaoTributavel               = $lead->renda_nao_tributavel               ? "Sim" : "Não";
        $this->ganhoDeCapital                   = $lead->ganho_de_capital                   ? "Sim" : "Não";
        $this->operaBolsaDeValores              = $lead->opera_bolsa_de_valores             ? "Sim" : "Não";
        $this->receitaBrutaAtividadeRural       = $lead->receita_bruta_atividade_rural      ? "Sim" : "Não";
        $this->compensarPrejuizoAtividadeRural  = $lead->compensar_prejuizo_atividade_rural ? "Sim" : "Não";
        $this->bensEDireitos                    = $lead->bens_e_direitos                    ? "Sim" : "Não";
        $this->residenteNoBrasil                = $lead->residente_no_brasil                ? "Sim" : "Não";
        $this->isencaoImoveis                   = $lead->isencao_imoveis                    ? "Sim" : "Não";
        
        if( is_null($lead->necessita_declarar) ){
            $this->necessitaDeclarar = 'NULL';
        }else{
            $this->necessitaDeclarar = $lead->necessita_declarar ? "Sim" : "Não";
        }
    }

    public function render()
    {
        return view('livewire.admin.lead.form');
    }
}
