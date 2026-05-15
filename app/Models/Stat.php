<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    protected $table = 'stats';

    protected $fillable = [
        'player_id', 'match_id', 'team_id', 'season',
        'goals', 'assists', 'shots', 'shots_on_target',
        'tackles', 'interceptions', 'minutes_played',
        'distance_km', 'passes', 'pass_accuracy',
        'yellow_cards', 'red_cards', 'rating',
    ];

    public function player()
    {
        return $this->belongsTo(User::class, 'player_id');
    }

    public function match()
    {
        return $this->belongsTo(FootMatch::class, 'match_id');
    }
}