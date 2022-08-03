<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ButtonBackForm extends Component
{
    public $route;

    public function mount($route){
        $this->route = $route;
    }

    public function render()
    {
        return view('livewire.button-back-form');
    }
}
