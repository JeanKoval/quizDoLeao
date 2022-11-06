<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class ButtonConfirmForm extends Component
{
    public $action;

    public function mount($action){
        $this->action = $action;
    }

    public function render()
    {
        return view('livewire.admin.button-confirm-form');
    }
}
