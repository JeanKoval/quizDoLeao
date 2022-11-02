<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pergunta extends Model
{
    use HasFactory;

    public static function getProximaOrdem(){
        $pergunta = Pergunta::orderByDesc('ordem')->first();
        $ordem = !is_null($pergunta) ? intval($pergunta->ordem) : 0;
        return str_pad(str(++$ordem), 2, 0, STR_PAD_LEFT);
    }
}
