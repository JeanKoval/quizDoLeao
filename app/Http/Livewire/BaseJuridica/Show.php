<?php

namespace App\Http\Livewire\BaseJuridica;

use App\Models\BaseJuridica;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Show extends Component
{
    //@params crud
    public $basesJuridicas = [];
    
    public function mount(){
        Session::put('breadcrumbs', [
            [
                'href' => '/' . \App\Enums\RotinasAplicacaoEnum::BaseJuridica->value,
                'text' => 'Base Jurídica',
                'icon' => 'pasta'
            ]
        ]);
        $this->basesJuridicas = BaseJuridica::all();
    }

    public function render()
    {
        return view('livewire.base-juridica.show');
    }
}
