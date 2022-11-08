<?php

namespace App\Services;

use App\Models\Inciso;
use App\Enums\RotinasAplicacaoEnum;
use App\Services\Abstracts\CrudService;

class IncisoService extends CrudService{

    public function __construct()
    {   
        parent::__construct(
            new Inciso, 
            RotinasAplicacaoEnum::Inciso, 
            [
                'status' => 'Status',
                'numeroRomano' => 'Número',
                'relacao_id' => 'Id Relação'
            ]
        );
    }
}