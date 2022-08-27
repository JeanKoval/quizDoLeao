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
            $basesJuridicas = DB::table('base_juridicas')->where([
                    ['ano', '=', $data['ano']],
                    ['status', '=', '1'],
                ])->get();
            if(count($basesJuridicas)){
                Session::flash('messageFlashData', 'Base já criada para este Ano!');
                Session::flash('typeFlashData', 'warning');
                return false;
            }
        }
        return true;
    }
}