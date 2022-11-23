<?php

namespace App\Services\Admin;

use App\Enums\RotinasAplicacaoEnum;
use App\Models\Pergunta;
use App\Services\Admin\Abstracts\CrudService;

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
                'campo_manipulacao_lead' => 'Campo de Manipulação do Lead',
                'tipo_relacao' => 'Tipo Relação',
                'relacao_id' => 'Id da Relação'
            ]
        );
    }
}