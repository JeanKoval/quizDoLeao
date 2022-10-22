<?php

namespace App\Services;

use App\Enums\OptionCrudEnum;
use App\Models\Alinea;

class AlineaService{

    public $id;
    private $camposObrigatorios = [
        'status'        => 'Status',
        'letra'         => 'Número',
        'tipo_relacao'  => 'Tipo Relação',
        'relacao_id'    => 'Capitulo'
    ];

    public function create(Array $data){
        $this->verificaCamposObrigatorios($data);
        $alinea = new Alinea();
        foreach($data as $key => $value){
            $alinea->$key = $value;
        }
        $alinea->save();
        $this->id = $alinea->id;
        $this->saveLog(OptionCrudEnum::Incluir);
    }

    public function update(Alinea &$alinea, Array $data){
        $this->verificaCamposObrigatorios($data);
        foreach($data as $key => $value){
            $alinea->$key = $value;
        }
        $alinea->update();
        $this->id = $alinea->id;
        $this->saveLog(OptionCrudEnum::Editar);
    }

    public function delete(Alinea &$alinea){
        $this->id = $alinea->id;
        $alinea->delete();
        $this->saveLog(OptionCrudEnum::Excluir);
    }

    public function inativar(Alinea &$alinea){
        $alinea->status = 0;
        $alinea->save();
        $this->id = $alinea->id;
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
        LogCrudService::create(\App\Enums\RotinasAplicacaoEnum::Alinea->value, $this->id, $action);
    }
    
}