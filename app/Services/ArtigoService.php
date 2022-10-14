<?php

namespace App\Services;

use App\Models\Artigo;
use App\Enums\OptionCrudEnum;

class ArtigoService{

    public $id;
    private $camposObrigatorios = [
        'status' => 'Status',
        'numero' => 'Número',
        'capitulo_id' => 'Capitulo'
    ];

    public function create(Array $data){
        $this->verificaCamposObrigatorios($data);
        $artigo = new Artigo();
        foreach($data as $key => $value){
            $artigo->$key = $value;
        }
        $artigo->save();
        $this->id = $artigo->id;
        $this->saveLog(OptionCrudEnum::Incluir);
    }

    public function update(Artigo &$artigo, Array $data){
        $this->verificaCamposObrigatorios($data);
        foreach($data as $key => $value){
            $artigo->$key = $value;
        }
        $artigo->update();
        $this->id = $artigo->id;
        $this->saveLog(OptionCrudEnum::Editar);
    }

    public function delete(Artigo &$artigo){
        $this->id = $artigo->id;
        $artigo->delete();
        $this->saveLog(OptionCrudEnum::Excluir);
    }

    public function inativar(Artigo &$artigo){
        $artigo->status = 0;
        $artigo->save();
        $this->id = $artigo->id;
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
        LogCrudService::create(\App\Enums\RotinasAplicacaoEnum::Artigo->value, $this->id, $action);
    }
    
}