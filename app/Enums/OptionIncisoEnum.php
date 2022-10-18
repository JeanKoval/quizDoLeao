<?php

namespace App\Enums;

enum OptionIncisoEnum: string{

    case Artigo         = 'artigo';
    case Paragrafo      = 'paragrafo';

    /**
     * @getOpcoesInciso
     * @Description: Função montará, no Form, o select de opçoẽs de amarração da criação do Inciso.
     * @return array
     */
    public static function getOpcoesInciso(){
        return [
            'artigo' => 'Artigo',
            'paragrafo' => 'Paragrafo'
        ];
    }
}