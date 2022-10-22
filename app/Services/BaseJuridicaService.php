<?php

namespace App\Services;

use App\Enums\RotinasAplicacaoEnum;
use App\Models\BaseJuridica;
use App\Services\Abstracts\CrudService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BaseJuridicaService extends CrudService{

    public function __construct()
    {   
        parent::__construct(
            new BaseJuridica, 
            RotinasAplicacaoEnum::BaseJuridica,
            [
                'status'    => 'Status',
                'numero'    => 'Numéro',
                'revisao'   => 'Revisão',
                'ano'       => 'Ano',
                'tipo'      => 'Tipo'
            ]
        );
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
                ['status', '=', '1'], // 1 = Ativo
                ['tipo', '=', '1']    // 1 - Real
            ])->get();
            if(!count($basesJuridicas)){
                Session::flash('messageFlashData', 'Nenhuma Base real ativa cadastrada para este Ano!');
                Session::flash('typeFlashData', 'warning');
                return false;
            }

            // verifica se não está cadastrando uma alteração com o mesmo numero
            $basesJuridicas = DB::table('base_juridicas')->where([
                    ['ano', '=', $data['ano']],
                    ['status', '=', '1'], // 1 = Ativo
                    ['tipo', '=', '2'],   // 2 - Alteração
                    ['numero', '=', $data['numero']]
                ])->get();
            if(count($basesJuridicas)){
                Session::flash('messageFlashData', 'Já existe uma Base de alteração ativa cadastrada para este Ano e Número!');
                Session::flash('typeFlashData', 'warning');
                return false;
            }
        }
        return true;
    }
}