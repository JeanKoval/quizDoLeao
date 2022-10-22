<?php

namespace App\Services;

use App\Models\Artigo;
use App\Enums\OptionCrudEnum;
use App\Enums\RotinasAplicacaoEnum;
use App\Services\Abstracts\CrudService;

class ArtigoService extends CrudService{

    public function __construct()
    {   
        parent::__construct(
            new Artigo, 
            RotinasAplicacaoEnum::Artigo, 
            [
                'status' => 'Status',
                'numero' => 'Número',
                'capitulo_id' => 'Capitulo'
            ]
        );
    }
}