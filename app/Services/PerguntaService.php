<?php

namespace App\Services;

use App\Enums\RotinasAplicacaoEnum;
use App\Models\Pergunta;
use App\Services\Abstracts\CrudService;

class PerguntaService extends CrudService{

    public function __construct()
    {   
        parent::__construct(
            new Pergunta(), 
            RotinasAplicacaoEnum::Pergunta, 
            [
                'status' => 'Status',
                'ordem' => 'Ordem',
                'revisao' => 'Revisão',
                'descricao' => 'Descrição',
                'tipo_relacao' => 'Tipo Relação',
                'relacao_id' => 'Id da Relação'
            ]
        );
    }
}