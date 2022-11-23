<?php

namespace App\Http\Livewire\Admin\Inciso;

use App\Enums\OptionIncisoEnum;
use App\Models\Artigo;
use App\Models\Capitulo;
use App\Models\Inciso;
use App\Models\Paragrafo;
use App\Services\Admin\IncisoService;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Form extends Component
{
    // @params
    public $action;
    public $inciso;

    // @attributes
    public $status; // [ 0-Inativo | 1-Ativo]
    public $numeroRomano;
    public $descricao;
    public $tipoRelacao;
    public $relacaoId;

    // @options
    public $header = [];
    public $optionInciso = [];
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

    protected $listeners = ['tipoRelacaoUpdated'];

    protected $rules = [
        'numeroRomano' => 'required',
        'tipoRelacao' => 'required',
        'relacaoId' => 'required'
    ];

    public function mount($action, Inciso $inciso)
    {

        Session::put('breadcrumbs', [
            [
                'href' => '/' . \App\Enums\RotinasAplicacaoEnum::Inciso->value,
                'text' => 'Inciso',
                'icon' => 'pasta'
            ],
            [
                'href' => '#',
                'text' => ucfirst($action),
                'icon' => 'page'
            ]
        ]);

        $this->action = $action;
        if ($this->action != 'incluir' && !is_null($inciso->id)) {
            $this->inciso       = $inciso;
            $this->numeroRomano = $this->inciso->numeroRomano;
            $this->status       = $this->inciso->status;
            $this->descricao    = $this->inciso->descricao;
            $this->relacaoId    = $this->inciso->relacao_id;
            $this->tipoRelacao = OptionIncisoEnum::from($inciso->tipo_relacao)->value;
        }
    }

    public function selectedItem($id){
        $this->relacaoId = $id;
    }

    public function tipoRelacaoUpdated(){
        $this->relacaoId = null;
        $this->reset(['header', 'optionInciso']);
        
        if(!empty($this->tipoRelacao)){
            $tipo = OptionIncisoEnum::from($this->tipoRelacao);
            if($tipo == OptionIncisoEnum::Artigo){
                $this->header = [
                    'ID',
                    'Número',
                    'Base Jurídica / Ano',
                    'CAPITULO',
                ];
                $artigos = Artigo::where([['status', '=', '1']])->get();
                foreach($artigos as $artigo){
                    $artigo->capitulo = Capitulo::find($artigo->capitulo_id);
                    
                    $this->optionInciso[$artigo->id] = [
                        'id' => $artigo->id,
                        'numero'       => $artigo->numero . '°',
                        'baseJuridica' => $artigo->capitulo->getBaseJuridicaAndAno(),
                        'capitulo'     => $artigo->capitulo->numeroRomano,
                    ];
                }
            }else if($tipo == OptionIncisoEnum::Paragrafo){
                $this->header = [
                    'ID',
                    'NÚMERO',
                    'BASE JURÍDICA / ANO',
                    'CAPITULO',
                    'ARTIGO',
                ];
                $paragrafos = (new Paragrafo)->getParagrafos([['status', '=', '1']]);
                foreach($paragrafos as $paragrafo){
                    $this->optionInciso[$paragrafo->id] = [
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
        $incisoService = new IncisoService();

        if ($this->action == 'incluir') {
            $this->status = 1;
            $this->tipoRelacao = OptionIncisoEnum::from($this->tipoRelacao);

            $data = [
                'numeroRomano'  => $this->numeroRomano,
                'status'        => $this->status,
                'descricao'     => $this->descricao,
                'tipo_relacao'  => $this->tipoRelacao->value,
                'relacao_id'    => $this->relacaoId
            ];


            $incisoService->create($data);

            $messageFlashData = 'Inciso incluído com Sucesso!';
            $typeFlashData = 'success';
        } elseif ($this->action == 'excluir') {
            $incisoService->delete($this->inciso);

            $messageFlashData = 'Inciso excluído com Sucesso!';
            $typeFlashData = 'success';
        } elseif ($this->action == 'inativar') {
            $incisoService->inativar($this->inciso);

            $messageFlashData = 'Inciso inativado com Sucesso!';
            $typeFlashData = 'success';
        }

        Session::flash('messageFlashData', $messageFlashData);
        Session::flash('typeFlashData', $typeFlashData);
        redirect()->route('incisoShow');
    }

    public function render()
    {
        return view('livewire.admin.inciso.form');
    }
}
