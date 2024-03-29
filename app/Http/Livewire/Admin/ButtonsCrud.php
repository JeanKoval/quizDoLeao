<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class ButtonsCrud extends Component
{
    public $idData;
    public $actions;
    public $route;

    public function mount($idData = null, $route = null, $actions = ['visualizar', 'revisao', 'inativar']){
        $this->idData  = $idData;
        $this->route   = $route;
        $this->actions = $actions;
    }

    public function render()
    {
        return view('livewire.admin.buttons-crud');
    }
}
