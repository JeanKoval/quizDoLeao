<?php

namespace App\Services;

use App\Models\Pergunta;

class PerguntaService{

    public function create(Array $data){
        $pergunta = new Pergunta();
        foreach($data as $key => $value){
            $pergunta->$key = $value;
        }
        $pergunta->save();
    }

    public function update(Pergunta &$pergunta, Array $data){
        foreach($data as $key => $value){
            $pergunta->$key = $value;
        }
        $pergunta->update();
    }

    public function delete(Pergunta &$pergunta){
        $pergunta->delete();
    }

}