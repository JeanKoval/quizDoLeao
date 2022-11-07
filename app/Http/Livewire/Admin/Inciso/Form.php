<?php

namespace App\Http\Livewire\Admin\Inciso;

use App\Enums\OptionIncisoEnum;
use App\Models\Artigo;
use App\Models\BaseJuridica;
use App\Models\Capitulo;
use App\Models\Inciso;
use App\Models\Paragrafo;
use App\Services\IncisoService;
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

    // @filters
    public $baseJuridica;
    public $capitulo;
    public $artigo;
    public $paragrafo;

    // @options
    public $optionsBaseJuridica = [];
    public $optionsCapitulo = [];
    public $optionsArtigo = [];
    public $optionsParagrafo = [];
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
        'tipoRelacao' => 'required',
        'baseJuridica' => 'required',
        'capitulo' => 'required',
        'artigo' => 'required'
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

            $this->tipoRelacao = OptionIncisoEnum::from($inciso->tipo_relacao);

            if($this->tipoRelacao == OptionIncisoEnum::Paragrafo){
                $this->paragrafo = Paragrafo::findOrFail($this->inciso->relacao_id);
                $this->artigo = Artigo::findOrFail($this->paragrafo->artigo_id);
                $this->paragrafo = $this->paragrafo->numero . "°";
            }else{
                $this->artigo = Artigo::findOrFail($this->inciso->relacao_id);
            }

            $this->capitulo = Capitulo::findOrFail($this->artigo->capitulo_id);
            $this->baseJuridica = $this->capitulo->getBaseJuridicaAndAno();

            $this->tipoRelacao = $this->tipoRelacao->name;
            $this->capitulo = $this->capitulo->numeroRomano;
            $this->artigo = $this->artigo->numero . "°";

        }

        if ($this->action == \App\Enums\OptionCrudEnum::Incluir->value) {
            $this->montaOptionsBaseJuridica();
        }
    }

    // monta option Artigo
    public function montaOptionsBaseJuridica(){

        // Monta as opções do select de base juridica
        $bjs = BaseJuridica::where([
            ['status', '=', '1']
        ])->get();
        if (!count($bjs)) {
            Session::flash('messageFlashData', 'Nenhum Base Jurídica existente para criar um Inciso!');
            Session::flash('typeFlashData', 'warning');
            redirect()->route('incisoShow');
        }
        foreach ($bjs as $bj) {
            $this->optionsBaseJuridica[$bj->id] = $bj->numero . " / " . $bj->ano;
        }
    }

    public function montaOptionsCapitulo(){

        // se entro neste função é porque a Base Juridica foi alterada, forma refaz as opções
        $this->capitulo = '';
        $this->optionsCapitulo = [];

        if(!empty($this->baseJuridica)){
            
            // Monta as opções do select de Capitulo, amarrados a base juridica escolhida
            $capitulos = Capitulo::where([
                    ['status', '=', '1'],
                    ['base_juridica_id', '=', $this->baseJuridica]
                ]
            )->get();
            if (!count($capitulos)) {
                Session::flash('messageFlashData', 'Nenhum Capitulo existente para criar um Inciso!');
                Session::flash('typeFlashData', 'warning');
                redirect()->route('incisoShow');
            }
            foreach ($capitulos as $capitulo) {
                $this->optionsCapitulo[$capitulo->id] = $capitulo->numeroRomano;
            }
            // $this->artigo = null;
        }
    }

    public function montaOptionsArtigo(){

        // se entro neste função é porque a Base Juridica foi alterada, forma refaz as opções
        $this->artigo = '';
        $this->optionsArtigo = [];

        if(!empty($this->capitulo)){
            
            // Monta as opções do select de Capitulo, amarrados a base juridica escolhida
            $artigos = Artigo::where([
                    ['status', '=', '1'],
                    ['capitulo_id', '=', $this->capitulo]
                ]
            )->get();
            if (!count($artigos)) {
                Session::flash('messageFlashData', 'Nenhum Artigo existente para criar um Inciso!');
                Session::flash('typeFlashData', 'warning');
                redirect()->route('incisoShow');
            }
            foreach ($artigos as $artigo) {
                $this->optionsArtigo[$artigo->id] = $artigo->numero . "°";
            }
        }
    }

    public function montaOptionsParagrafo(){

        // se entro neste função é porque o Paragrafo foi alterado, desta forma refaz as opções
        $this->paragrafo = '';
        $this->optionsParagrafo = [];

        if(!empty($this->artigo) && $this->tipoRelacao == OptionIncisoEnum::Paragrafo->value){
            
            // Monta as opções do select de Paragrafo, amarrados ao capitulo escolhido
            $paragrafos = Paragrafo::where(
                [
                    ['status', '=', '1'],
                    ['artigo_id', '=', $this->artigo]
                ]
            )->get();
            if (!count($paragrafos)) {
                Session::flash('messageFlashData', 'Nenhum Paragrafo existente para criar um Inciso!');
                Session::flash('typeFlashData', 'warning');
                redirect()->route('incisoShow');
            }
            foreach ($paragrafos as $paragrafo) {
                $this->optionsParagrafo[$paragrafo->id] = $paragrafo->numero . '°';
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
            $this->relacaoId = $this->tipoRelacao == OptionIncisoEnum::Artigo ? $this->artigo : $this->capitulo;

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
        // return view('layouts.modal');
    }
}
