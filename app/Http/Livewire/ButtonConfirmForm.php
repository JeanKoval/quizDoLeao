<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ButtonConfirmForm extends Component
{
    public $action;

    public function mount($action){
        $this->action = $action;
    }

    public function render()
    {
        return view('livewire.button-confirm-form');
    }
}
