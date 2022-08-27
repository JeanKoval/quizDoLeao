<?php

namespace App\Services;

use App\Models\BaseJuridica;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BaseJuridicaService{

    public function create(Array $data){
        $baseJuridica = new BaseJuridica();
        foreach($data as $key => $value){
            $baseJuridica->$key = $value;
        }
        $baseJuridica->save();
    }

    public function update(BaseJuridica &$baseJuridica, Array $data){
        foreach($data as $key => $value){
            $baseJuridica->$key = $value;
        }
        $baseJuridica->update();
    }

    public function delete(BaseJuridica &$baseJuridica){
        $baseJuridica->delete();
    }

    public function revisao(BaseJuridica &$baseJuridica, Array $data){
        $this->inativar($baseJuridica);
        $this->create($data);
    }

    public function inativar(BaseJuridica &$baseJuridica){
        $baseJuridica->status = 0;
        $baseJuridica->save();
    }
    
    public function validate(Array $data): bool
    {
        if($data['tipo'] == '1'){ // 1 == Real 
            // verifica se tem base juridica para aquela ano e ativa cadastrada
            $basesJuridicas = DB::table('base_juridicas')->where([
                    ['ano', '=', $data['ano']],
                    ['status', '=', '1'],
                ])->get();
            if(count($basesJuridicas)){
                Session::flash('messageFlashData', 'Base já criada para este Ano!');
                Session::flash('typeFlashData', 'warning');
                return false;
            }
        }else if($data['tipo'] == '2'){ // 2 == Alteração
            // verifica se tem base juridica Real ativa para aquele ano cadastrada
            $basesJuridicas = DB::table('base_juridicas')->where([
                ['ano', '=', $data['ano']],
                ['status', '=', '1'],
                ['tipo', '=', '1']
            ])->get();
            if(!count($basesJuridicas)){
                Session::flash('messageFlashData', 'Nenhuma Base real ativa cadastrada para este Ano!');
                Session::flash('typeFlashData', 'warning');
                return false;
            }

            // verifica se não está cadastrando uma alteração com o mesmo numero
            $basesJuridicas = DB::table('base_juridicas')->where([
                    ['ano', '=', $data['ano']],
                    ['status', '=', '1'],
                    ['tipo', '=', '2'],
                    ['numero', '=', $data['numero']]
                ])->get();
            if(!count($basesJuridicas)){
                Session::flash('messageFlashData', 'Já existe uma Base de alteração ativa cadastrada para este Ano e Número!');
                Session::flash('typeFlashData', 'warning');
                return false;
            }
        }
        return true;
    }
}