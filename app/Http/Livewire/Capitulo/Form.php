<?php

namespace App\Http\Livewire\Capitulo;

use App\Models\BaseJuridica;
use App\Models\Capitulo;
use App\Models\LogCrud;
use App\Services\CapituloService;
use App\Services\LogCrudService;
use Exception;
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
    public $baseJuridica;
    public $descricao;

    // @vars
    public $optionsBaseJuridica;
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
        'baseJuridica' => 'required',
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
            $this->numeroRomano = $this->capitulo->numeroRomano;
            $this->status       = $this->capitulo->status;
            $this->baseJuridica = $this->capitulo->base_juridica_id;
            $this->descricao    = $this->capitulo->descricao;
        }
        if (in_array($this->action, ['incluir', 'alterar'])) {
            $this->montaOptionBaseJuridica();
        }else{
            $baseJuridica = BaseJuridica::findOrFail($this->capitulo->base_juridica_id);
            $this->baseJuridica = $baseJuridica->numero . ' / ' . $baseJuridica->ano;
        }
    }

    // monta option base juridica
    public function montaOptionBaseJuridica()
    {
        $basesJuridicas = DB::table('base_juridicas')->where([
            ['status', '=', '1'],
            ['tipo', '=', '1']
        ])->get();
        if (!count($basesJuridicas)) {
            Session::flash('messageFlashData', 'Nenhuma Base Jurídica existente para criar um Capitulo!');
            Session::flash('typeFlashData', 'warning');
            redirect()->route('capituloShow');
        }
        foreach ($basesJuridicas as $bj) {
            $this->optionsBaseJuridica[$bj->id] = $bj->numero . ' / ' . $bj->ano;
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
                'numeroRomano'    => $this->numeroRomano,
                'status'          => $this->status,
                'base_juridica_id' => $this->baseJuridica,
                'descricao'         => $this->descricao
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
        return view('livewire.capitulo.form');
        // return view('layouts.modal');
    }
}
