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
            if( is_null($lead->necessita_declarar) ){
                $lead->necessita_declarar = 'NULL';
            }else{
                $lead->necessita_declarar = $lead->necessita_declarar ? "Sim" : "Não";
            }
        }
    }

    public function render()
    {
        return view('livewire.admin.lead.show');
    }
}
