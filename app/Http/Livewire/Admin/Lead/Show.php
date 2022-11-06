<?php

namespace App\Http\Livewire\Admin\Lead;

use Livewire\Component;

class Show extends Component
{
    //@params crud
    public $leads = [];
    
    public function mount(){

        \Illuminate\Support\Facades\Session::put('breadcrumbs', [
            [
                'href' => '/' . \App\Enums\RotinasAplicacaoEnum::Lead->value,
                'text' => 'Lead',
                'icon' => 'pasta'
            ]
        ]);

        $this->leads = \App\Models\Lead::all();

        foreach($this->leads as &$lead){
            $lead->renda_tributavel = number_format($lead->renda_tributavel, 2, ',', '.');
            $lead->renda_nao_tributavel = number_format($lead->renda_nao_tributavel, 2, ',', '.');
        }
    }

    public function render()
    {
        return view('livewire.admin.lead.show');
    }
}
