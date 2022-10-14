<?php

namespace App\Services;

use App\Models\Capitulo;
use App\Enums\OptionCrudEnum;

class CapituloService{

    public $id;
    private $camposObrigatorios = [
        'status' => 'Status',
        'numeroRomano' => 'Numéro',
        'base_juridica_id' => 'Base Jurídica'
    ];

    public function create(Array $data){
        $this->verificaCamposObrigatorios($data);
        $capitulo = new Capitulo();
        foreach($data as $key => $value){
            $capitulo->$key = $value;
        }
        $capitulo->save();
        $this->id = $capitulo->id;
        $this->saveLog(OptionCrudEnum::Incluir);
    }

    public function update(Capitulo &$capitulo, Array $data){
        $this->verificaCamposObrigatorios($data);
        foreach($data as $key => $value){
            $capitulo->$key = $value;
        }
        $capitulo->update();
        $this->id = $capitulo->id;
        $this->saveLog(OptionCrudEnum::Editar);
    }

    public function delete(Capitulo &$capitulo){
        $this->id = $capitulo->id;
        $capitulo->delete();
        $this->saveLog(OptionCrudEnum::Excluir);
    }

    public function inativar(Capitulo &$capitulo){
        $capitulo->status = 0;
        $capitulo->save();
        $this->id = $capitulo->id;
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
        LogCrudService::create(\App\Enums\RotinasAplicacaoEnum::Capitulo->value, $this->id, $action);
    }
    
}