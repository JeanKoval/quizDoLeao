<?php

namespace App\Enums;

enum OptionManipulacaoLeadEnum: string{
    case RendaTributavel                    = 'renda_tributavel';
    case RendaNaoTributavel                 = 'renda_nao_tributavel';
    case GanhoDeCapital                     = 'ganho_de_capital';
    case OperaBolsaDeValores                = 'opera_bolsa_de_valores';
    case ReceitaBrutaAtividadeRural         = 'receita_bruta_atividade_rural';
    case CompensarPrejuizoAtividadeRural    = 'compensar_prejuizo_atividade_rural';
    case BensEDireitos                      = 'bens_e_direitos';
    case ResidenteNoBrasil                  = 'residente_no_brasil';
    case IsencaoImoveis                     = 'isencao_imoveis';
}