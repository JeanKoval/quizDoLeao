<?php

namespace App\Http\Livewire\Pergunta;

use App\Models\Pergunta;
use App\Services\PerguntaService;
use Livewire\Component;

class Form extends Component
{
    // @params
    public $action;
    public $pergunta;

    // @attributes
    public $codigo;
    public $descricao;
    public $tooltip;
    public $mensagemTooltip;

    public function mount($action, Pergunta $pergunta){
        $this->action = $action;
        if($action != 'incluir' && !is_null($this->pergunta->id)){
            $this->pergunta         = $pergunta;
            $this->codigo           = $this->pergunta->codigo;
            $this->descricao        = $this->pergunta->descricao;
            $this->mensagemTooltip  = $this->pergunta->mensagem_tooltip;
        }
        $this->mensagemTooltip = $this->mensagemTooltip ?? '';
        $this->tooltip         = !empty($this->mensagemTooltip);
    }
    
    public function limpaMsgTooltip(){
        if(!$this->tooltip){
            $this->mensagemTooltip = '';
        }
    }

    public function save(){
        if($this->action == 'incluir'){
            (new PerguntaService())->create([
                'codigo'           => $this->codigo,
                'descricao'        => $this->descricao,
                'mensagem_tooltip' => $this->mensagemTooltip
            ]);
        }elseif($this->action == 'alterar'){
            (new PerguntaService())->update(
                $this->pergunta, 
                [
                    'codigo'           => $this->codigo,
                    'descricao'        => $this->descricao,
                    'mensagem_tooltip' => $this->mensagemTooltip
                ]
            );
        }elseif($this->action == 'excluir'){
            (new PerguntaService())->delete($this->pergunta);
        }
    }

    public function back(){
        redirect()->route('perguntaShow');
    }
    
    public function render()
    {
        return view('livewire.pergunta.form');
    }
}
