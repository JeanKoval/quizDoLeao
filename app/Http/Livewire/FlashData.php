<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FlashData extends Component
{
    // @params
    public $typeFlashData;
    public $messageFlashData;

    public function mount($typeFlashData, $messageFlashData){
        $this->typeFlashData = $typeFlashData;
        $this->messageFlashData = $messageFlashData;
    }

    public function render()
    {
        return view('livewire.flash-data');
    }
}
