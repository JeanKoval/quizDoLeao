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
    public $aceiteDoTermo;

    protected $listeners = ['render'];

    protected $rules = [
        'nome' => 'required|string',
        'email' => 'required|email',
        'telefone' => 'required|min:11|max:11',
        'aceiteDoTermo' => 'required|boolean',
    ];

    public function save()
    {
        $this->validate();

        if(! $this->aceiteDoTermo) {
            $this->emitSelf('render');
            return;
        }
 
        $this->leadAtual->nome = $this->nome;
        $this->leadAtual->email = $this->email;
        $this->leadAtual->telefone = $this->telefone;
        $this->leadAtual->aceite_termo_privacidade = $this->aceiteDoTermo;
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
