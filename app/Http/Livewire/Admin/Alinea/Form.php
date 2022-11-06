<?php

namespace App\Http\Livewire\Admin\Alinea;

use App\Enums\OptionAlineaEnum;
use App\Enums\OptionIncisoEnum;
use App\Models\Artigo;
use App\Models\BaseJuridica;
use App\Models\Capitulo;
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
    public $baseJuridica;
    public $capitulo;
    public $artigo;
    public $paragrafo;
    public $tipoInciso;
    public $inciso;

    // @options
    public $optionsBaseJuridica = [];
    public $optionsCapitulo = [];
    public $optionsArtigo = [];
    public $optionsParagrafo = [];
    public $optionsInciso = [];
    public $optionsLetra = [
        'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'
    ];

    protected $rules = [
        'letra'         => 'required',
        'tipoRelacao'   => 'required',
        'baseJuridica'  => 'required',
        'capitulo'      => 'required',
        'artigo'        => 'required'
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

            $this->tipoRelacao = OptionAlineaEnum::from($this->alinea->tipo_relacao);

            if($this->tipoRelacao == OptionAlineaEnum::Paragrafo){

                $this->alinea->paragrafo = Paragrafo::findOrFail($this->alinea->relacao_id);
                $this->alinea->artigo = Artigo::findOrFail($this->alinea->paragrafo->artigo_id);
                $this->paragrafo = $this->alinea->paragrafo->numero . "°";

            }else if($this->tipoRelacao == OptionAlineaEnum::Artigo){

                $this->alinea->artigo = Artigo::findOrFail($this->alinea->relacao_id);

            }else{

                $this->qtdeColunasForm = 5;
                $this->alinea->inciso = Inciso::findOrFail($this->alinea->relacao_id);

                if($this->alinea->inciso->tipo_relacao == OptionIncisoEnum::Paragrafo->value){

                    $this->alinea->paragrafo = Paragrafo::findOrFail($this->alinea->inciso->relacao_id);
                    $this->alinea->artigo = Artigo::findOrFail($this->alinea->paragrafo->artigo_id);
                    $this->paragrafo = $this->alinea->paragrafo->numero . "°";
                    $this->tipoInciso = OptionIncisoEnum::Paragrafo->value;
                    
                }else{
                    
                    $this->alinea->artigo = Artigo::findOrFail($this->alinea->inciso->relacao_id);
                    $this->tipoInciso = OptionIncisoEnum::Artigo->value;
                }
                $this->inciso = $this->alinea->inciso->numeroRomano;

            }

            $this->alinea->capitulo = Capitulo::findOrFail($this->alinea->artigo->capitulo_id);
            $this->baseJuridica = $this->alinea->capitulo->getBaseJuridicaAndAno();
            $this->capitulo = $this->alinea->capitulo->numeroRomano;
            $this->artigo = $this->alinea->artigo->numero . "°";
            $this->tipoRelacao = $this->tipoRelacao->value;
        }

        if ($this->action == \App\Enums\OptionCrudEnum::Incluir->value) {
            $this->montaOptionsBaseJuridica();
        }
    }

    public function isInciso(){

        $this->tipoInciso = null;
        
        if(!empty($this->tipoRelacao) && OptionAlineaEnum::from($this->tipoRelacao) == OptionAlineaEnum::Inciso){
            $this->qtdeColunasForm = 5;
        }else{
            $this->qtdeColunasForm = 4;
        }
        
        $this->mostraParagrafo();
    }

    public function incisoBloqueado(){
        if(!empty($this->tipoInciso)){
            if(OptionIncisoEnum::from($this->tipoInciso) == OptionIncisoEnum::Artigo && !empty($this->artigo)){
                return false;
            }else if(OptionIncisoEnum::from($this->tipoInciso) == OptionIncisoEnum::Paragrafo && !empty($this->paragrafo)){
                return false;
            }
        }else{
        }

        return true;
    }
    
    public function mostraParagrafo(){
        
        if(!empty($this->tipoRelacao)){

            if(OptionAlineaEnum::from($this->tipoRelacao) == OptionAlineaEnum::Paragrafo){
                return true;
            }else if(OptionAlineaEnum::from($this->tipoRelacao) == OptionAlineaEnum::Inciso){
                if(!empty($this->tipoInciso) && OptionIncisoEnum::from($this->tipoInciso) == OptionIncisoEnum::Paragrafo){
                    return true;
                }
            }
        }

        return false;
    }

    // monta option Artigo
    public function montaOptionsBaseJuridica(){

        // Monta as opções do select de base juridica
        $bjs = BaseJuridica::where([
            ['status', '=', '1']
        ])->get();
        if (!count($bjs)) {
            Session::flash('messageFlashData', 'Nenhum Base Jurídica existente para criar um Alinea!');
            Session::flash('typeFlashData', 'warning');
            redirect()->route('alineaShow');
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
                Session::flash('messageFlashData', 'Nenhum Capitulo existente para criar um Alinea!');
                Session::flash('typeFlashData', 'warning');
                redirect()->route('alineaShow');
            }

            foreach ($capitulos as $capitulo) {
                $this->optionsCapitulo[$capitulo->id] = $capitulo->numeroRomano;
            }
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
                Session::flash('messageFlashData', 'Nenhum Artigo existente para criar um Alinea!');
                Session::flash('typeFlashData', 'warning');
                redirect()->route('alineaShow');
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

        if(!empty($this->artigo)){
            
            // Monta as opções do select de Paragrafo, amarrados ao capitulo escolhido
            $paragrafos = Paragrafo::where(
                [
                    ['status', '=', '1'],
                    ['artigo_id', '=', $this->artigo]
                ]
            )->get();
            if (!count($paragrafos)) {
                Session::flash('messageFlashData', 'Nenhum Paragrafo existente para criar um Alinea!');
                Session::flash('typeFlashData', 'warning');
                redirect()->route('alineaShow');
            }
            foreach ($paragrafos as $paragrafo) {
                $this->optionsParagrafo[$paragrafo->id] = $paragrafo->numero . '°';
            }
        }
    }

    public function montaOptionsInciso(){

        // se entro neste função é porque o Paragrafo ou Artigo foi alterado, desta forma refaz as opções
        $this->inciso = '';
        $this->optionsInciso = [];
        
        $tipoInciso = OptionIncisoEnum::from($this->tipoInciso);
        $relacaoId = $tipoInciso == OptionIncisoEnum::Artigo ? $this->artigo : $this->capitulo;
        
        // Monta as opções do select de Incisos, amarrados ao tipo de Inciso escolhido
        $incisos = Inciso::where(
            [
                ['status', '=', '1'],
                ['tipo_relacao', '=', $tipoInciso->value],
                ['relacao_id', '=', $relacaoId]
            ]
        )->get();

        if (!count($incisos)) {
            Session::flash('messageFlashData', 'Nenhum Inciso existente para criar um Alinea!');
            Session::flash('typeFlashData', 'warning');
            redirect()->route('alineaShow');
        }

        foreach ($incisos as $inciso) {
            $this->optionsInciso[$inciso->id] = $inciso->numeroRomano;
        }

    }

    // função irá validar se montara as opções de inciso ou paragrafo, pois o inciso pode estar amarrado ao artigo direto.
    public function montaOptionsParagrafoOuInciso(){

        if(!empty($this->tipoInciso)
            &&
           OptionAlineaEnum::from($this->tipoRelacao) == OptionAlineaEnum::Inciso
            &&
           OptionIncisoEnum::from($this->tipoInciso) == OptionIncisoEnum::Artigo
        ){
            $this->montaOptionsInciso();
        }else{
            $this->montaOptionsParagrafo();
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
            $this->tipoRelacao = OptionAlineaEnum::from($this->tipoRelacao);
            $this->relacaoId = match($this->tipoRelacao){
                OptionAlineaEnum::Artigo    => $this->artigo,
                OptionAlineaEnum::Paragrafo => $this->paragrafo,
                OptionAlineaEnum::Inciso    => $this->inciso
            };

            $data = [
                'letra'  => $this->letra,
                'status'        => $this->status,
                'descricao'     => $this->descricao,
                'tipo_relacao'  => $this->tipoRelacao->value,
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
