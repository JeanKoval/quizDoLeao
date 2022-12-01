<?php

namespace App\Http\Livewire\Admin;

use App\Models\Lead;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        $totalLeads = sizeof(Lead::all());
        $leadsQueDeclaram = sizeof(Lead::where('necessita_declarar', 1)->get());
        $leadsQueNaoDeclaram = sizeof(Lead::where('necessita_declarar', 0)->get());
        $leadsQueNaoFinalizaram = sizeof(Lead::whereNull('necessita_declarar')->get());

        return view('livewire.admin.home', [
            'totalLeads' => $totalLeads, 
            'leadsQueDeclaram' => $leadsQueDeclaram, 
            'leadsQueNaoDeclaram' => $leadsQueNaoDeclaram, 
            'leadsQueNaoFinalizaram' => $leadsQueNaoFinalizaram
        ]);
    }
}
