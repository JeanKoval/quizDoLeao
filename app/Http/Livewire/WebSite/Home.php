<?php

namespace App\Http\Livewire\WebSite;

use App\Models\Lead;
use Livewire\Component;

class Home extends Component
{
    public $tempoMedioRealizacaoQuiz = 4;
    public $qtdePessoasReponderam = 1500;

    public function render()
    {
        $this->qtdePessoasReponderam = count(Lead::all());

        return view('livewire.web-site.home')
            ->layout('layouts.web-site')
            ->slot('main');
    }
}
