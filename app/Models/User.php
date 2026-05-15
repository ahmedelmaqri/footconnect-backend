<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'players';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'position',
        'team_id',
        'avatar',
        'date_of_birth',
        'nationality',
    ];

    protected $hidden = ['password', 'remember_token'];

    public function stats()
    {
        return $this->hasMany(Stat::class, 'player_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}