<?php

namespace App\Services;

use App\Models\Capitulo;

class CapituloService{

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
    }

    public function update(Capitulo &$capitulo, Array $data){
        $this->verificaCamposObrigatorios($data);
        foreach($data as $key => $value){
            $capitulo->$key = $value;
        }
        $capitulo->update();
    }

    public function delete(Capitulo &$capitulo){
        $capitulo->delete();
    }

    public function inativar(Capitulo &$capitulo){
        $capitulo->status = 0;
        $capitulo->save();
    }

    private function verificaCamposObrigatorios(Array $data){
        foreach($this->camposObrigatorios as $key => $campo){
            if(!array_key_exists($key, $data) || empty(trim($data[$key]))){
                throw new \App\Exceptions\CampoObrigatorioException("O campo $campo é de preenchimento obrigatório!");
            }
        }
    }
    
}