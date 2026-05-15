<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table = 'teams';

    protected $fillable = [
        'name',
        'logo',
        'city',
        'country',
        'founded_year',
        'coach',
    ];

    public function players()
    {
        return $this->hasMany(User::class, 'team_id');
    }
}