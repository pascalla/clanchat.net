<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClanSecretKey extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nickname',
        'clan_id',
        'key',
        'guest'
    ];

    public function clan() {
        return $this->belongsTo(Clan::class);
    }
}
