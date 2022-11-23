<?php

namespace App\Services\Admin;

use App\Models\Inciso;
use App\Enums\RotinasAplicacaoEnum;
use App\Services\Admin\Abstracts\CrudService;

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