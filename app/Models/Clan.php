<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'user_id',
        'clan_status'
    ];

    protected $with = array('secrets', 'settings');

    public function secrets() {
        return $this->hasMany(ClanSecretKey::class, 'clan_id', 'id');
    }

    public function settings() {
        return $this->hasMany(ClanSetting::class, 'clan_id', 'id');
    }
}
