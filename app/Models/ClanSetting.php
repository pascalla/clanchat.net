<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClanSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'clan_id',
        'key',
        'value'
    ];
}
