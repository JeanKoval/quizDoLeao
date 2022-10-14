<?php

namespace App\Enums;

enum RotinasAplicacaoEnum: string{

    case Pergunta       = 'pergunta';
    case BaseJuridica   = 'base-juridica';
    case Capitulo       = 'capitulo';
    case Artigo         = 'artigo';
    case Inciso         = 'inciso';
    case Paragrafo      = 'paragrafo';
    case Alinea         = 'alinea';
    case Lead           = 'lead';

    /**
     * @getOpcoesArtigo
     * @Description: Função montará, no Form, o select de opçoẽs de amarração da criação do Artigo.
     * @return array
     */
    public static function getOpcoesArtigo(){
        return [
            'inciso' => 'Inciso',
            'paragrafo' => 'Paragrafo',
            'alinea' => 'Alinea'
        ];
    }

    /**
     * @getOpcoesParagrafo
     * @Description: Função montará, no Form, o select de opçoẽs de amarração da criação do Paragrafo.
     * @return array
     */
    public static function getOpcoesParagrafo(){
        return [
            'inciso' => 'Inciso',
            'alinea' => 'Alinea'
        ];
    }
}