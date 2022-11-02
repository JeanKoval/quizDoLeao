<?php

namespace App\Services\Abstracts;

use App\Enums\OptionCrudEnum;
use App\Enums\RotinasAplicacaoEnum;
use App\Services\LogCrudService;
use Illuminate\Database\Eloquent\Model;

abstract class CrudService{

    // @attributes
    protected $id;
    protected Model $model;
    protected RotinasAplicacaoEnum $rotina;
    protected Array $camposObrigatorios = [];

    public function __construct($model, $rotina, $camposObrigatorios)
    {
        $this->model = $model;
        $this->rotina = $rotina;
        $this->camposObrigatorios = $camposObrigatorios;
    }

    public function create(Array $data){
        $this->verificaCamposObrigatorios($data);
        foreach($data as $key => $value){
            $this->model->$key = $value;
        }
        $this->model->save();
        $this->id = $this->model->id;
        $this->saveLog(OptionCrudEnum::Incluir);
    }
    
    public function update(Model &$model, Array $data){
        $this->verificaCamposObrigatorios($data);
        foreach($data as $key => $value){
            $model->$key = $value;
        }
        $model->update();
        $this->id = $model->id;
        $this->saveLog(OptionCrudEnum::Editar);
    }

    public function delete(Model &$model){
        $this->id = $model->id;
        $model->delete();
        $this->saveLog(OptionCrudEnum::Excluir);
    }

    public function inativar(Model &$model){
        $model->status = 0;
        $model->save();
        $this->id = $model->id;
        $this->saveLog(OptionCrudEnum::Inativar);
    }

    public function revisao(Model &$model, Array $data){
        $this->inativar($model);
        $this->create($data);
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
        LogCrudService::create($this->rotina->value, $this->id, $action);
    }
}