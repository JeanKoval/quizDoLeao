<?php

namespace App\Services\Admin;

use App\Models\Artigo;
use App\Enums\OptionCrudEnum;
use App\Enums\RotinasAplicacaoEnum;
use App\Services\Admin\Abstracts\CrudService;

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