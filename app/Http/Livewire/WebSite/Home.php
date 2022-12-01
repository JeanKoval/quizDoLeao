<?php

namespace App\Http\Livewire\WebSite;

use App\Models\Lead;
use App\Services\WebSite\RespostaService;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        $qtdePessoasReponderam = count(Lead::all());
        $tempoMedioRealizacaoQuiz = RespostaService::getTempoMedioParaResponderOQuiz();

        return view('livewire.web-site.home', compact('qtdePessoasReponderam', 'tempoMedioRealizacaoQuiz'))
            ->layout('layouts.web-site')
            ->slot('main');
    }
}
