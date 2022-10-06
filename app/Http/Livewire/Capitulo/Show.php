<?php

namespace App\Http\Livewire\Capitulo;

use App\Models\BaseJuridica;
use Livewire\Component;

class Show extends Component
{
    //@params crud
    public $capitulos = [];
    
    public function mount(){
        \Illuminate\Support\Facades\Session::put('breadcrumbs', [
            [
                'href' => '/capitulo',
                'text' => 'Capitulo',
                'icon' => 'pasta'
            ]
        ]);
        $this->capitulos = \App\Models\Capitulo::all();

        foreach($this->capitulos as &$capitulo){
            $capitulo->baseJuridica = BaseJuridica::findOrFail($capitulo->base_juridica_id);
        }
        
    }

    public function render()
    {
        return view('livewire.capitulo.show');
    }
}
