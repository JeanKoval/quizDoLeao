<?php

namespace App\Http\Livewire\WebSite;

use Livewire\Component;

class TermoDePrivacidade extends Component
{
    public function render()
    {
        return view('livewire.web-site.termo-de-privacidade')
            ->layout('layouts.web-site')
            ->slot('main');
    }
}
