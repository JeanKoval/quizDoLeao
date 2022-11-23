<?php

namespace App\Http\Livewire\WebSite;

use App\Services\WebSite\LeadService;
use Livewire\Component;

class Resultado extends Component
{
    public $MENSAGEM_SE_SIM = 'PRECISA';
    public $MENSAGEM_SE_NÃO = 'NÃO PRECISA';

    public $leadAtual;

    public function render()
    {
        $this->leadAtual = LeadService::getLeadAtual();
        
        if( is_null($this->leadAtual->necessita_declarar) ){
            redirect()->route('perguntaWebSite');
        }
        
        return view('livewire.web-site.resultado')
            ->layout('layouts.web-site')
            ->slot('main');
    }
}
