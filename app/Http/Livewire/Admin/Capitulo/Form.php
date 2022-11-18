<?php

namespace App\Http\Livewire\Admin\Capitulo;

use App\Models\BaseJuridica;
use App\Models\Capitulo;
use App\Services\CapituloService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Form extends Component
{
    // @params
    public $action;
    public $capitulo;

    // @attributes
    public $status; // [ 0-Inativo | 1-Ativo]
    public $numeroRomano;
    public $descricao;
    public $idBaseJuridica;

    // @filters
    public $header = [];

    // @options
    public $optionsBaseJuridica = [];
    public $optionsNumeroRomano = [
        'I',
        'II',
        'III',
        'IV',
        'V',
        'VI',
        'VII',
        'VIII',
        'IX',
        'X',
        'XI',
        'XII',
        'XIII',
        'XIV',
        'XV',
        'XVI',
        'XVII',
        'XVIII',
        'XIX',
        'XX',
        'XXI',
        'XXII',
        'XXIII',
        'XXIV',
        'XXV',
        'XXVI',
        'XXVII',
        'XXVIII',
        'XXIX',
        'XXX',
        'XXXI',
        'XXXII',
        'XXXIII',
        'XXXIV',
        'XXXV',
        'XXXVI',
        'XXXVII',
        'XXXVIII',
        'XXXIX',
        'XL',
        'XLI',
        'XLII',
        'XLIII',
        'XLIV',
        'XLV',
        'XLVI',
        'XLVII',
        'XLVIII',
        'XLIX',
        'L'
    ];

    protected $rules = [
        'numeroRomano' => 'required',
        'idBaseJuridica' => 'required',
    ];

    public function mount($action, Capitulo $capitulo)
    {
        Session::put('breadcrumbs', [
            [
                'href' => '/' . \App\Enums\RotinasAplicacaoEnum::Capitulo->value,
                'text' => 'Capitulo',
                'icon' => 'pasta'
            ],
            [
                'href' => '#',
                'text' => ucfirst($action),
                'icon' => 'page'
            ]
        ]);

        $this->action = $action;
        if ($this->action != 'incluir' && !is_null($capitulo->id)) {
            $this->capitulo = $capitulo;
            $this->numeroRomano     = $this->capitulo->numeroRomano;
            $this->status           = $this->capitulo->status;
            $this->descricao        = $this->capitulo->descricao;
            $this->idBaseJuridica   = $this->capitulo->base_juridica_id;
        }
        if($this->action == \App\Enums\OptionCrudEnum::Incluir->value) {
            $this->montaOptionBaseJuridica();
        }
    }

    public function selectedItem($id){
        $this->idBaseJuridica = $id;
    }

    // monta option base juridica
    public function montaOptionBaseJuridica()
    {
        $this->header = [
            'ID',
            'Revisão',
            'Número',
            'Ano'
        ];
        $baseJuridicas = BaseJuridica::where([
            ['status', '=', '1'],
            ['tipo', '=', '1']
        ])->get();
        foreach($baseJuridicas as $baseJuridica){
            $this->optionsBaseJuridica[$baseJuridica->id] = [
                'id' => $baseJuridica->id,
                'revisao' => $baseJuridica->revisao,
                'numero'  => $baseJuridica->numero,
                'ano'     => $baseJuridica->ano
            ];
        }
    }

    public function submit()
    {
        $this->validate();

        $typeFlashData = '';
        $messageFlashData = '';
        $capituloService = new CapituloService();

        if ($this->action == 'incluir') {
            $this->status = 1;

            $data = [
                'numeroRomano'      => $this->numeroRomano,
                'status'            => $this->status,
                'descricao'         => $this->descricao,
                'base_juridica_id'  => $this->idBaseJuridica
            ];

            $capituloService->create($data);

            $messageFlashData = 'Capítulo incluído com Sucesso!';
            $typeFlashData = 'success';
        } elseif ($this->action == 'excluir') {
            $capituloService->delete($this->capitulo);

            $messageFlashData = 'Capítulo excluído com Sucesso!';
            $typeFlashData = 'success';
        } elseif ($this->action == 'inativar') {
            $capituloService->inativar($this->capitulo);

            $messageFlashData = 'Capítulo inativado com Sucesso!';
            $typeFlashData = 'success';
        }

        Session::flash('messageFlashData', $messageFlashData);
        Session::flash('typeFlashData', $typeFlashData);
        redirect()->route('capituloShow');
    }

    public function render()
    {
        return view('livewire.admin.capitulo.form');
    }
}
