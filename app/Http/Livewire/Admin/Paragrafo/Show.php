<?php

namespace App\Http\Livewire\Admin\Paragrafo;

use Livewire\Component;

class Show extends Component
{
    //@params crud
    public $paragrafos = [];
    
    public function mount(){

        \Illuminate\Support\Facades\Session::put('breadcrumbs', [
            [
                'href' => '/' . \App\Enums\RotinasAplicacaoEnum::Paragrafo->value,
                'text' => 'Paragrafo',
                'icon' => 'pasta'
            ]
        ]);

        $this->paragrafos = \App\Models\Paragrafo::all();
        foreach($this->paragrafos as &$paragrafo){
            $paragrafo->artigo = \App\Models\Artigo::findOrFail($paragrafo->artigo_id);
            $paragrafo->capitulo = \App\Models\Capitulo::findOrFail($paragrafo->artigo->capitulo_id);
        }
    }

    public function render()
    {
        return view('livewire.admin.paragrafo.show');
    }
}
