<?php

namespace App\Http\Livewire\AmCharts;

use App\Models\Lead;
use Livewire\Component;

class GraficoLeadsFinalizaramXNaoFinalizaram extends Component
{
    public $ID_GRAFICO = 'id_grafico-leads-finalizaram-x-nao-finalizaram';
    public $ID_INPUT = 'input_grafico-leads-finalizaram-x-nao-finalizaram';

    public function render()
    {
        $leadsQueFinalizaram = Lead::whereNotNull('necessita_declarar')->get();
        $leadsQueNaoFinalizaram = Lead::whereNull('necessita_declarar')->get();
        $data = json_encode([
            ['value'=>sizeof($leadsQueFinalizaram), 'category'=>'Finalizaram'],
            ['value'=>sizeof($leadsQueNaoFinalizaram), 'category'=>'Não Finalizaram']
        ]);
        
        return view('livewire.am-charts.grafico-leads-finalizaram-x-nao-finalizaram', compact('data'));
    }
}
