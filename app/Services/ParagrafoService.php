<?php

namespace App\Services;

use App\Models\Paragrafo;
use App\Enums\OptionCrudEnum;

class ParagrafoService{

    public $id;
    private $camposObrigatorios = [
        'status' => 'Status',
        'numero' => 'Número',
        'artigo_id' => 'Artigo'
    ];

    public function create(Array $data){
        $this->verificaCamposObrigatorios($data);
        $paragrafo = new Paragrafo();
        foreach($data as $key => $value){
            $paragrafo->$key = $value;
        }
        $paragrafo->save();
        $this->id = $paragrafo->id;
        $this->saveLog(OptionCrudEnum::Incluir);
    }

    public function update(Paragrafo &$paragrafo, Array $data){
        $this->verificaCamposObrigatorios($data);
        foreach($data as $key => $value){
            $paragrafo->$key = $value;
        }
        $paragrafo->update();
        $this->id = $paragrafo->id;
        $this->saveLog(OptionCrudEnum::Editar);
    }

    public function delete(Paragrafo &$paragrafo){
        $this->id = $paragrafo->id;
        $paragrafo->delete();
        $this->saveLog(OptionCrudEnum::Excluir);
    }

    public function inativar(Paragrafo &$paragrafo){
        $paragrafo->status = 0;
        $paragrafo->save();
        $this->id = $paragrafo->id;
        $this->saveLog(OptionCrudEnum::Inativar);
    }

    private function verificaCamposObrigatorios(Array $data){
        foreach($this->camposObrigatorios as $key => $campo){
            if(!array_key_exists($key, $data) || empty(trim($data[$key]))){
                throw new \App\Exceptions\CampoObrigatorioException("O campo $campo é de preenchimento obrigatório!");
            }
        }
    }

    // salva log da execução
    public function saveLog($action){
        LogCrudService::create(\App\Enums\RotinasAplicacaoEnum::Paragrafo->value, $this->id, $action);
    }
    
}