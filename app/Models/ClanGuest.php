<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClanGuest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'clan_id'
    ];
}
