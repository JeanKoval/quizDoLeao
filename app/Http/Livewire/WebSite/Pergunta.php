<?php

namespace App\Http\Livewire\WebSite;

use App\Services\WebSite\LeadService;
use App\Services\WebSite\PerguntaService;
use App\Services\WebSite\RespostaService;
use Livewire\Component;

class Pergunta extends Component
{
    public $perguntaAtual;
    public $leadAtual;

    protected $listeners = ['render'];

    public function enviaResposta(bool $resposta)
    {
        RespostaService::saveRespostaDoLead($this->perguntaAtual, $this->leadAtual, $resposta);

        if ($resposta) {
            $this->leadAtual->necessita_declarar = $resposta;
            $this->leadAtual->update();
            redirect()->route('resultadoWebSite');
        } else {
            $this->perguntaAtual = PerguntaService::getProximaPerguntaDoLead($this->leadAtual);
            $this->emitSelf('render');
        }
    }

    public function render()
    {
        $this->leadAtual = LeadService::getLeadAtual();
        if ($this->leadAtual->necessita_declarar) {
            redirect()->route('resultadoWebSite');
        }else if( is_null($this->leadAtual->nome) ){
            redirect()->route('capturaDadosLeadWebSite');
        }

        $this->perguntaAtual = PerguntaService::getProximaPerguntaDoLead($this->leadAtual);

        
        if (is_null($this->perguntaAtual)) {
            // se respondeu todas as perguntas e não precisou declarar
            // seta como não declarante e direciona para tela de resultado
            $this->leadAtual->necessita_declarar = false;
            $this->leadAtual->update();
            redirect()->route('resultadoWebSite');
        }

        return view('livewire.web-site.pergunta')
            ->layout('layouts.web-site')
            ->slot('main');
    }
}
