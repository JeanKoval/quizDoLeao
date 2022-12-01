<?php

namespace App\Http\Livewire\AmCharts;

use App\Models\Lead;
use Livewire\Component;

class GraficoLeadsNecessitamXNaoNecessitamDeclarar extends Component
{
    public $ID_GRAFICO = 'id_grafico-leads-necessitam-x-nao-necessitam-declarar';
    public $ID_INPUT = 'input_grafico-leads-necessitam-x-nao-necessitam-declarar';

    public function render()
    {
        $leadsQueNecessitam = Lead::where('necessita_declarar',1)->get();
        $leadsQueNaoNecessitam = Lead::where('necessita_declarar', 0)->get();
        $data = json_encode([
            ['value'=>sizeof($leadsQueNecessitam), 'category'=>'Necessitam'],
            ['value'=>sizeof($leadsQueNaoNecessitam), 'category'=>'Não Necessitam']
        ]);

        return view('livewire.am-charts.grafico-leads-necessitam-x-nao-necessitam-declarar', compact('data'));
    }
}
