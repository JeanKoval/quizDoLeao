<?php

namespace App\Enums;

enum OptionCrudEnum: int{
    case Incluir    = 1;
    case Visualizar = 2;
    case Editar     = 3;
    case Inativar   = 4;
    case Excluir    = 5;
}