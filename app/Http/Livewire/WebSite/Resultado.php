<?php

namespace App\Http\Livewire\WebSite;

use Livewire\Component;

class Resultado extends Component
{
    public $MENSAGEM_SE_SIM = 'PRECISA';
    public $MENSAGEM_SE_NÃO = 'NÃO PRECISA';

    public $opcao;

    public function mount($opcao){
        $this->opcao = base64_decode($opcao);
    }

    public function render()
    {
        return view('livewire.web-site.resultado')
        ->layout('layouts.web-site')
        ->slot('main');
    }
}
