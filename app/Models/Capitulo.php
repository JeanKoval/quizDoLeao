<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capitulo extends Model
{
    use HasFactory;

    public function getBaseJuridicaAndAno(){
        $bj = BaseJuridica::findOrFail($this->base_juridica_id);
        return "$bj->numero / $bj->ano";
    }
}
