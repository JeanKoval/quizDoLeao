<?php

namespace App\Services;

use App\Models\LogCrud;
use Illuminate\Support\Facades\Auth;
use App\Enums\OptionCrudEnum;

class LogCrudService{

    private $rotina;
    private $idRegistro;
    private $acao;

    public static function create($rotina, $idRegistro, OptionCrudEnum $acao){
        $log = new LogCrud();
        $log->rotina = $rotina;
        $log->registro_id = $idRegistro;
        $log->acao = $acao->value;
        $log->user_id = Auth::user()->id;
        $log->save();
    }

}