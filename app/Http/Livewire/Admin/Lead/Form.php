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
    public $rendaTributavel;
    public $rendaNaoTributavel;
    public $anoNascimento;
    public $profissao;
    public $cidade;
    public $estado;

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

        $this->lead                 = $lead;
        $this->nome                 = $lead->nome;
        $this->email                = $lead->email;
        $this->telefone             = $lead->telefone;
        $this->rendaTributavel      = number_format($lead->renda_tributavel, 2, ',', '.');
        $this->rendaNaoTributavel   = number_format($lead->renda_nao_tributavel, 2, ',', '.');
        $this->anoNascimento        = $lead->ano_nascimento;
        $this->profissao            = $lead->profissao;
        $this->cidade               = $lead->cidade;
        $this->estado               = $lead->estado;

    }

    public function render()
    {
        return view('livewire.admin.lead.form');
    }
}
