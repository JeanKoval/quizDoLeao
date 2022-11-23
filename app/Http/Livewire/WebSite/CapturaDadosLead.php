<?php

namespace App\Http\Livewire\WebSite;

use App\Models\Lead;
use App\Services\WebSite\LeadService;
use Livewire\Component;

class CapturaDadosLead extends Component
{
 
    public Lead $leadAtual;

    public $nome;
    public $email;
    public $telefone;

    protected $rules = [
        'nome' => 'required|string',
        'email' => 'required|string',
        'telefone' => 'required|min:11',
    ];

    public function save()
    {
        $this->validate();
 
        $this->leadAtual->nome = $this->nome;
        $this->leadAtual->email = $this->email;
        $this->leadAtual->telefone = $this->telefone;
        $this->leadAtual->update();

        redirect()->route('perguntaWebSite');
    }

    public function render()
    {
        $this->leadAtual = LeadService::getLeadAtual();
        return view('livewire.web-site.captura-dados-lead')
            ->layout('layouts.web-site')
            ->slot('main');
    }
}
