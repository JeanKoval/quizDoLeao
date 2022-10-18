<?php

namespace App\Services;

use App\Models\Inciso;
use App\Enums\OptionCrudEnum;

class IncisoService{

    public $id;
    private $camposObrigatorios = [
        'status' => 'Status',
        'numeroRomano' => 'Número',
        'relacao_id' => 'Capitulo'
    ];

    public function create(Array $data){
        $this->verificaCamposObrigatorios($data);
        $inciso = new Inciso();
        foreach($data as $key => $value){
            $inciso->$key = $value;
        }
        $inciso->save();
        $this->id = $inciso->id;
        $this->saveLog(OptionCrudEnum::Incluir);
    }

    public function update(Inciso &$inciso, Array $data){
        $this->verificaCamposObrigatorios($data);
        foreach($data as $key => $value){
            $inciso->$key = $value;
        }
        $inciso->update();
        $this->id = $inciso->id;
        $this->saveLog(OptionCrudEnum::Editar);
    }

    public function delete(Inciso &$inciso){
        $this->id = $inciso->id;
        $inciso->delete();
        $this->saveLog(OptionCrudEnum::Excluir);
    }

    public function inativar(Inciso &$inciso){
        $inciso->status = 0;
        $inciso->save();
        $this->id = $inciso->id;
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
        LogCrudService::create(\App\Enums\RotinasAplicacaoEnum::Inciso->value, $this->id, $action);
    }
    
}