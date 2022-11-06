<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class ButtonBackForm extends Component
{
    public $route;

    public function mount($route){
        $this->route = $route;
    }

    public function render()
    {
        return view('livewire.admin.button-back-form');
    }
}
