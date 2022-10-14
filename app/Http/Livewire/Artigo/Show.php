<?php

namespace App\Http\Livewire\Artigo;

use App\Models\Capitulo;
use Livewire\Component;

class Show extends Component
{
    //@params crud
    public $artigos = [];
    
    public function mount(){

        \Illuminate\Support\Facades\Session::put('breadcrumbs', [
            [
                'href' => '/' . \App\Enums\RotinasAplicacaoEnum::Artigo->value,
                'text' => 'Artigo',
                'icon' => 'pasta'
            ]
        ]);

        $this->artigos = \App\Models\Artigo::all();
        foreach($this->artigos as &$artigo){
            $artigo->capitulo = Capitulo::findOrFail($artigo->capitulo_id);
        }
    }

    public function render()
    {
        return view('livewire.artigo.show');
    }
}
