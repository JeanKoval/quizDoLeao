<?php

namespace App\Services\Admin;

use App\Models\Capitulo;
use App\Enums\OptionCrudEnum;
use App\Enums\RotinasAplicacaoEnum;
use App\Services\Admin\Abstracts\CrudService;

class CapituloService extends CrudService{

    public function __construct()
    {   
        parent::__construct(
            new Capitulo, 
            RotinasAplicacaoEnum::Capitulo, 
            [
                'status' => 'Status',
                'numeroRomano' => 'Numéro',
                'base_juridica_id' => 'Base Jurídica'
            ]
        );
    }
}