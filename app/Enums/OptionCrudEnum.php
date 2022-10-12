<?php

namespace App\Enums;

enum OptionCrudEnum: string{
    case Incluir    = 'incluir';
    case Visualizar = 'visualizar';
    case Editar     = 'editar';
    case Inativar   = 'inativar';
    case Excluir    = 'excluir';
}