<?php

namespace App\Http\Livewire\WebSite;

use Livewire\Component;

class Pergunta extends Component
{
    public $ordem;

    public function mount($ordem){
        $this->ordem = $ordem;
    }

    public function render()
    {
        return view('livewire.web-site.pergunta')
        ->layout('layouts.web-site')
        ->slot('main');
    }
}
