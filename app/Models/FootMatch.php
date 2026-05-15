<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FootMatch extends Model
{
    protected $table = 'matches';

    protected $fillable = [
        'home_team_id', 'away_team_id',
        'home_score', 'away_score',
        'date', 'venue', 'competition',
        'season', 'status', 'events',
    ];

    protected $casts = [
        'date'   => 'datetime',
        'events' => 'array',
    ];

    public function stats()
    {
        return $this->hasMany(Stat::class, 'match_id');
    }
}