<?php

namespace App\Services\Admin;

use App\Enums\RotinasAplicacaoEnum;
use App\Models\Alinea;
use App\Services\Admin\Abstracts\CrudService;

class AlineaService extends CrudService{

    public function __construct()
    {   
        parent::__construct(
            new Alinea, 
            RotinasAplicacaoEnum::Alinea, 
            [
                'status'        => 'Status',
                'letra'         => 'Número',
                'tipo_relacao'  => 'Tipo Relação',
                'relacao_id'    => 'Capitulo'
            ]
        );
    }
}