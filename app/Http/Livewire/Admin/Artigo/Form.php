<?php

namespace App\Http\Livewire\Admin\Artigo;

use App\Models\Artigo;
use App\Models\Capitulo;
use App\Services\Admin\ArtigoService;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Form extends Component
{
    // @params
    public $action;
    public $argigo;

    // @attributes
    public $status; // [ 0-Inativo | 1-Ativo]
    public $numero;
    public $descricao;
    public $idCapitulo;

    // filters
    public $header = [];

    // options
    public $optionsCapitulo = [];
    public $optionsNumero = [
        '1' => '1°',
        '2' => '2°',
        '3' => '3°',
        '4' => '4°',
        '5' => '5°',
        '6' => '6°',
        '7' => '7°',
        '8' => '8°',
        '9' => '9°',
        '10' => '10°',
        '11' => '11°',
        '12' => '12°',
        '13' => '13°',
        '14' => '14°',
        '15' => '15°',
        '16' => '16°',
        '17' => '17°',
        '18' => '18°',
        '19' => '19°',
        '20' => '20°',
        '21' => '21°',
        '22' => '22°',
        '23' => '23°',
        '24' => '24°',
        '25' => '25°',
        '26' => '26°',
        '27' => '27°',
        '28' => '28°',
        '29' => '29°',
        '30' => '30°',
        '31' => '31°',
        '32' => '32°',
        '33' => '33°',
        '34' => '34°',
        '35' => '35°',
        '36' => '36°',
        '37' => '37°',
        '38' => '38°',
        '39' => '39°',
        '40' => '40°',
        '41' => '41°',
        '42' => '42°',
        '43' => '43°',
        '44' => '44°',
        '45' => '45°',
        '46' => '46°',
        '47' => '47°',
        '48' => '48°',
        '49' => '49°',
        '50' => '50°',
        '51' => '51°',
        '52' => '52°',
        '53' => '53°',
        '54' => '54°',
        '55' => '55°',
        '56' => '56°',
        '57' => '57°',
        '58' => '58°',
        '59' => '59°',
        '60' => '60°',
        '61' => '61°',
        '62' => '62°',
        '63' => '63°',
        '64' => '64°',
        '65' => '65°',
        '66' => '66°',
        '67' => '67°',
        '68' => '68°',
        '69' => '69°',
        '70' => '70°',
        '71' => '71°',
        '72' => '72°',
        '73' => '73°',
        '74' => '74°',
        '75' => '75°',
        '76' => '76°',
        '77' => '77°',
        '78' => '78°',
        '79' => '79°',
        '80' => '80°',
        '81' => '81°',
        '82' => '82°',
        '83' => '83°',
        '84' => '84°',
        '85' => '85°',
        '86' => '86°',
        '87' => '87°',
        '88' => '88°',
        '89' => '89°',
        '90' => '90°',
        '91' => '91°',
        '92' => '92°',
        '93' => '93°',
        '94' => '94°',
        '95' => '95°',
        '96' => '96°',
        '97' => '97°',
        '98' => '98°',
        '99' => '99°',
        '100' => '100°'
    ];

    protected $rules = [
        'numero' => 'required',
        'idCapitulo' => 'required',
    ];

    public function mount($action, Artigo $artigo)
    {
        Session::put('breadcrumbs', [
            [
                'href' => '/' . \App\Enums\RotinasAplicacaoEnum::Artigo->value,
                'text' => 'Artigo',
                'icon' => 'pasta'
            ],
            [
                'href' => '#',
                'text' => ucfirst($action),
                'icon' => 'page'
            ]
        ]);

        $this->action = $action;
        if ($this->action != 'incluir' && !is_null($artigo->id)) {
            $this->artigo       = $artigo;
            $this->numero       = $this->artigo->numero . "°";
            $this->descricao    = $this->artigo->descricao;
            $this->idCapitulo   = $this->artigo->capitulo_id;
        }

        if($this->action == \App\Enums\OptionCrudEnum::Incluir->value) {
            $this->montaOptionCapitulo();
        }
    }

    public function selectedItem($id){
        $this->idCapitulo = $id;
    }

    // monta option capitulo
    public function montaOptionCapitulo()
    {
        $this->header = [
            'ID',
            'Número',
            'Base Jurídica / Ano'
        ];
        $capitulos = Capitulo::where([['status', '=', '1']])->get();
        foreach($capitulos as $capitulo){
            $this->optionsCapitulo[$capitulo->id] = [
                'id' => $capitulo->id,
                'numero'       => $capitulo->numeroRomano,
                'baseJuridica' => $capitulo->getBaseJuridicaAndAno()
            ];
        }
    }

    public function submit()
    {
        $this->validate();

        $typeFlashData = '';
        $messageFlashData = '';
        $artigoService = new ArtigoService();

        if ($this->action == 'incluir') {
            $this->status = 1;

            $data = [
                'numero'        => $this->numero,
                'status'        => $this->status,
                'descricao'     => $this->descricao,
                'capitulo_id'   => $this->idCapitulo
            ];

            $artigoService->create($data);

            $messageFlashData = 'Artigo incluído com Sucesso!';
            $typeFlashData = 'success';
        } elseif ($this->action == 'excluir') {
            $artigoService->delete($this->artigo);

            $messageFlashData = 'Artigo excluído com Sucesso!';
            $typeFlashData = 'success';
        } elseif ($this->action == 'inativar') {
            $artigoService->inativar($this->artigo);

            $messageFlashData = 'Artigo inativado com Sucesso!';
            $typeFlashData = 'success';
        }

        Session::flash('messageFlashData', $messageFlashData);
        Session::flash('typeFlashData', $typeFlashData);
        redirect()->route('artigoShow');
    }

    public function render()
    {
        return view('livewire.admin.artigo.form');
    }
}
