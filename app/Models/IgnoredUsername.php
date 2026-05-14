<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IgnoredUsername extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
    ];

    public function setUsernameAttribute(string $username): void
    {
        $this->attributes['username'] = $username;
        $this->attributes['username_normalized'] = strtolower($username);
    }
}
