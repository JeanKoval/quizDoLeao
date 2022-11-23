<?php

namespace App\Http\Livewire\Admin\BaseJuridica;

use App\Models\BaseJuridica;
use App\Services\Admin\BaseJuridicaService;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Form extends Component
{
    // @params
    public $action;
    public $baseJuridica;

    // @attributes
    public $numero;
    public $revisao;
    public $status; // [ 0-Inativo | 1-Ativo]
    public $tipo;   // [ 1-Real    | 2-Alteração]
    public $ano;
    public $descricao;

    // @vars
    public $isRevisao;
    public $optionsAno;
    public $optionsTipo = [
        '1' => 'Real',
        '2' => 'Alteração'
    ];

    protected $rules = [
        'numero'    => 'required|max:6',
        'tipo'      => 'required',
        'ano'       => 'required',
    ];

    public function mount($action, BaseJuridica $baseJuridica)
    {
        Session::put('breadcrumbs', [
            [
                'href' => '/' . \App\Enums\RotinasAplicacaoEnum::BaseJuridica->value,
                'text' => 'Base Jurídica',
                'icon' => 'pasta'
            ],
            [
                'href' => '#',
                'text' => ucfirst($action),
                'icon' => 'page'
                ]
            ]);

        if(in_array($action, ['incluir', 'alterar'])){
            // option Ano
            $this->optionsAno[] = date('Y');
            $this->optionsAno[] = date('Y', strtotime('last year'));
        }
            
        $this->action  = $action;
        $this->revisao = "001"; // por padrão recebe '001'
        $this->status  = 1; // por padrão recebe '1'
        
        $isRevisao = array_key_exists('revisao', $_GET);
        if($isRevisao) $this->action = 'revisao';
        
        if ($this->action != 'incluir' && !is_null($this->baseJuridica->id)) {
            $this->baseJuridica = $baseJuridica;
            $this->numero       = $this->baseJuridica->numero;
            $this->revisao      = $this->baseJuridica->revisao;
            $this->status       = $this->baseJuridica->status;
            $this->tipo         = $this->baseJuridica->tipo;
            $this->ano          = $this->baseJuridica->ano;
            $this->descricao    = $this->baseJuridica->descricao;
            if($isRevisao) 
                $this->revisao = str_pad(intval($this->revisao)+1, 3, '0', STR_PAD_LEFT);
        }
    }
    
    public function submit(){

        $this->validate();

        $typeFlashData = '';
        $messageFlashData = '';
        if ($this->action == 'incluir') {
            $data = [
                'status'    => $this->status,
                'numero'    => $this->numero,
                'revisao'   => $this->revisao,
                'tipo'      => $this->tipo,
                'ano'       => $this->ano,
                'descricao' => $this->descricao
            ];
            $bsService = new BaseJuridicaService();
            if(!$bsService->validate($data)){
                redirect()->route('baseJuridicaShow');
                return false;
            }
            $bsService->create($data);
            $messageFlashData = 'Base Jurídica incluída com Sucesso!';
            $typeFlashData = 'success';
        } elseif ($this->action == 'excluir') {
            (new BaseJuridicaService())->delete($this->baseJuridica);
            $messageFlashData = 'Base Jurídica excluída com Sucesso!';
            $typeFlashData = 'success';
        }elseif ($this->action == 'inativar') {
            (new BaseJuridicaService())->inativar($this->baseJuridica);
            $messageFlashData = 'Base Jurídica inativada com Sucesso!';
            $typeFlashData = 'success';
        } elseif ($this->action == 'revisao') {
            (new BaseJuridicaService())->revisao(
                $this->baseJuridica,
                [
                    'status'    => $this->status,
                    'numero'    => $this->numero,
                    'revisao'   => $this->revisao,
                    'tipo'      => $this->tipo,
                    'ano'       => $this->ano,
                    'descricao' => $this->descricao
                ]
            );
            $messageFlashData = 'Revisão criada com Sucesso!';
            $typeFlashData = 'success';
        }

        Session::flash('messageFlashData', $messageFlashData);
        Session::flash('typeFlashData', $typeFlashData);
        redirect()->route('baseJuridicaShow');
    }

    public function render()
    {
        return view('livewire.admin.base-juridica.form');
    }
}
