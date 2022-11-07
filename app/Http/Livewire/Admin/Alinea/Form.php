<?php

namespace App\Http\Livewire\Admin\Alinea;

use App\Enums\OptionAlineaEnum;
use App\Enums\OptionIncisoEnum;
use App\Models\Alinea;
use App\Models\Inciso;
use App\Models\Paragrafo;
use App\Services\AlineaService;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Form extends Component
{
    // @params
    public $action;
    public $alinea;
    public $qtdeColunasForm = 4;

    // @attributes
    public $status; // [ 0-Inativo | 1-Ativo]
    public $letra;
    public $descricao;
    public $tipoRelacao;
    public $relacaoId;

    // @filters
    public $header = [];
    public $optionPergunta = [];

    // @options
    public $optionsLetra = [
        'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'
    ];

    protected $rules = [
        'letra'         => 'required',
        'tipoRelacao'   => 'required',
        'relacaoId'     => 'required'
    ];

    public function mount($action, Alinea $alinea)
    {

        Session::put('breadcrumbs', [
            [
                'href' => '/' . \App\Enums\RotinasAplicacaoEnum::Alinea->value,
                'text' => 'Alinea',
                'icon' => 'pasta'
            ],
            [
                'href' => '#',
                'text' => ucfirst($action),
                'icon' => 'page'
            ]
        ]);

        $this->action = $action;
        if ($this->action != 'incluir' && !is_null($alinea->id)) {
            $this->alinea       = $alinea;
            $this->letra        = $this->alinea->letra;
            $this->status       = $this->alinea->status;
            $this->descricao    = $this->alinea->descricao;
            $this->relacaoId    = $this->alinea->relacao_id;
            $this->tipoRelacao = OptionAlineaEnum::from($this->alinea->tipo_relacao)->name;
        }
    }

    public function selectedItem($id){
        $this->relacaoId = $id;
    }

    public function tipoRelacaoUpdated(){
        $this->relacaoId = null;
        $this->header = $this->optionPergunta = [];
        
        if(!empty($this->tipoRelacao)){
            $tipo = OptionAlineaEnum::from($this->tipoRelacao);
            if($tipo == OptionAlineaEnum::Inciso){
                $this->header = [
                    'ID',
                    'NÚMERO ROMANO',
                    'TIPO RELAÇÃO',
                    'BASE JURÍDICA / ANO',
                    'CAPITULO',
                    'ARTIGO',
                    'PARAGRAFO'
                ];
                $incisos = (new Inciso)->getIncisos([['status', '=', '1']]);
                foreach($incisos as $inciso){
                    $this->optionPergunta[$inciso->id] = [
                        'id' => $inciso->id,
                        'numeroRomano' => $inciso->numeroRomano,
                        'tipoRelacao'  => OptionIncisoEnum::from($inciso->tipo_relacao)->name,
                        'baseJuridica' => $inciso->baseJuridica,
                        'capitulo'     => $inciso->capitulo->numeroRomano,
                        'artigo'       => $inciso->artigo->numero . '°',
                        'paragrafo'    => $inciso->paragrafo->numero ?? '',
                    ];
                }
            }else if($tipo == OptionAlineaEnum::Paragrafo){
                $this->header = [
                    'ID',
                    'NÚMERO',
                    'BASE JURÍDICA / ANO',
                    'CAPITULO',
                    'ARTIGO',
                ];
                $paragrafos = (new Paragrafo)->getParagrafos([['status', '=', '1']]);
                foreach($paragrafos as $paragrafo){
                    $this->optionPergunta[$paragrafo->id] = [
                        'id' => $paragrafo->id,
                        'numero'        => $paragrafo->numero . '°',
                        'baseJuridica' => $paragrafo->baseJuridica,
                        'capitulo'     => $paragrafo->capitulo->numeroRomano,
                        'artigo'       => $paragrafo->artigo->numero . '°',
                    ];
                }
            }
        }
    }

    public function submit()
    {
        $this->validate();

        $typeFlashData = '';
        $messageFlashData = '';
        $AlineaService = new AlineaService();

        if ($this->action == 'incluir') {
            $this->status = 1;

            $data = [
                'letra'  => $this->letra,
                'status'        => $this->status,
                'descricao'     => $this->descricao,
                'tipo_relacao'  => $this->tipoRelacao,
                'relacao_id'    => $this->relacaoId
            ];

            $AlineaService->create($data);

            $messageFlashData = 'Alinea incluído com Sucesso!';
            $typeFlashData = 'success';
        } elseif ($this->action == 'excluir') {
            $AlineaService->delete($this->alinea);

            $messageFlashData = 'Alinea excluído com Sucesso!';
            $typeFlashData = 'success';
        } elseif ($this->action == 'inativar') {
            $AlineaService->inativar($this->alinea);

            $messageFlashData = 'Alinea inativado com Sucesso!';
            $typeFlashData = 'success';
        }

        Session::flash('messageFlashData', $messageFlashData);
        Session::flash('typeFlashData', $typeFlashData);
        redirect()->route('alineaShow');
    }

    public function render()
    {
        return view('livewire.admin.alinea.form');
    }
}
