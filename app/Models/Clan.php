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

    public function secrets() {
        return $this->hasMany(ClanSecretKey::class, 'clan_id', 'id')->where('guest', '=', 0);
    }

    public function settings() {
        return $this->hasMany(ClanSetting::class, 'clan_id', 'id');
    }

    public function guestEnabled() {
        return $this->settings()->where('key', '=', 'guest')->get()->isNotEmpty();
    }

    public function secretsGuest() {
        return $this->hasMany(ClanSecretKey::class, 'clan_id', 'id')->where('guest', '=', 1);
    }

    public function guests() {
        return $this->hasMany(ClanGuest::class, 'clan_id', 'id');
    }
}
