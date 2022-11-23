<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    public static function getLeadPeloCookie(string $uuid)
    {
        return Lead::where([['cookie_lead', '=', $uuid]])->first() ?? null;
    }
}
