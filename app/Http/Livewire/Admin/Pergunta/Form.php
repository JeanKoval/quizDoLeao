<?php

namespace App\Http\Livewire\Admin\Pergunta;

use App\Enums\OptionAlineaEnum;
use App\Enums\OptionIncisoEnum;
use App\Enums\OptionPerguntaEnum;
use App\Models\Alinea;
use App\Models\Inciso;
use App\Models\Paragrafo;
use App\Models\Pergunta;
use App\Services\PerguntaService;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Form extends Component
{
    // @params
    public $action;
    public $pergunta;
    
    // @attributes
    public $ordem;
    public $status;
    public $revisao;
    public $descricao;
    public $tipoRelacao;
    public $idRelacao;
    
    // @filters
    public $header = [];
    public $optionPergunta = [];

    protected $rules = [
        'ordem'          => 'required',
        'revisao'        => 'required',
        'descricao'      => 'required',
        'tipoRelacao'    => 'required',
        'idRelacao' => 'required'
    ];

    public function mount($action, Pergunta $pergunta)
    {
        Session::put('breadcrumbs', [
            [
                'href' => '/' . \App\Enums\RotinasAplicacaoEnum::Pergunta->value,
                'text' => 'Pergunta',
                'icon' => 'pasta'
            ],
            [
                'href' => '#',
                'text' => ucfirst($action),
                'icon' => 'page'
            ]
        ]);

        $this->action = $action;

        $isRevisao = array_key_exists('revisao', $_GET);
        if($isRevisao) $this->action = 'revisao';

        if ($this->action != 'incluir' && !is_null($this->pergunta->id)) {
            $this->pergunta  = $pergunta;
            $this->ordem     = $this->pergunta->ordem;
            $this->revisao   = $this->pergunta->revisao;
            $this->descricao = $this->pergunta->descricao;
            $this->tipoRelacao = ucfirst($this->pergunta->tipo_relacao);
            $this->idRelacao = $this->pergunta->relacao_id;
            if($isRevisao){
                $this->revisao = str_pad(intval($this->revisao)+1, 3, '0', STR_PAD_LEFT);
            }
        }else{
            $this->ordem = Pergunta::getProximaOrdem();
            $this->revisao = '001';
        }
    }

    public function selectedItem($id){
        $this->idRelacao = $id;
    }
    
    public function tipoRelacaoUpdated(){
        $this->idRelacao = null;
        $this->header = $this->optionPergunta = [];
        
        if(!empty($this->tipoRelacao)){
            $tipo = OptionPerguntaEnum::from($this->tipoRelacao);
            if($tipo == OptionPerguntaEnum::Inciso){
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
            }else if($tipo == OptionPerguntaEnum::Alinea){
                $this->header = [
                    'ID',
                    'LETRA',
                    'TIPO RELAÇÃO',
                    'BASE JURÍDICA / ANO',
                    'CAPITULO',
                    'ARTIGO',
                    'PARAGRAFO',
                    'INCISO'
                ];
                $alineas = (new Alinea)->getAlineas([['status', '=', '1']]);
                foreach($alineas as $alinea){
                    $this->optionPergunta[$alinea->id] = [
                        'id' => $alinea->id,
                        'letra' => $alinea->letra,
                        'tipoRelacao'  => OptionAlineaEnum::from($alinea->tipo_relacao)->name,
                        'baseJuridica' => $alinea->baseJuridica,
                        'capitulo'     => $alinea->capitulo->numeroRomano,
                        'artigo'       => $alinea->artigo->numero . '°',
                        'paragrafo'    => $alinea->paragrafo->numero ?? '',
                        'inciso'       => $alinea->inciso->numeroRomano ?? '',
                    ];
                }
            }else if($tipo == OptionPerguntaEnum::Paragrafo){
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

    public function save()
    {
        $this->validate();

        $messageFlashData = '';
        $perguntaService = new PerguntaService();
        if ($this->action == 'incluir') {
            $perguntaService->create([
                'status' => '1',
                'ordem' => $this->ordem,
                'revisao' => $this->revisao,
                'descricao' => $this->descricao,
                'tipo_relacao' => $this->tipoRelacao,
                'relacao_id' => $this->idRelacao
            ]);
            $messageFlashData = 'Pergunta incluida com Sucesso!';
        } elseif ($this->action == 'revisao') {
            $perguntaService->revisao(
                $this->pergunta,
                [
                    'status' => '1',
                    'ordem' => $this->ordem,
                    'revisao' => $this->revisao,
                    'descricao' => $this->descricao,
                    'tipo_relacao' => $this->tipoRelacao,
                    'relacao_id' => $this->idRelacao
                ]
            );
            $messageFlashData = 'Pergunta revisada com Sucesso!';
        } elseif ($this->action == 'excluir') {
            $perguntaService->delete($this->pergunta);
            $messageFlashData = 'Pergunta excluída com Sucesso!';
        }
        Session::flash('redirect-pergunta', $messageFlashData);
        redirect()->route('perguntaShow');
    }

    public function render()
    {
        return view('livewire.admin.pergunta.form');
    }
}
