<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    protected $fillable = [
        'team_id', 'player_id', 'title', 'description',
        'date', 'start_time', 'end_time', 'location',
        'type', 'status',
    ];

    public function team() { return $this->belongsTo(Team::class); }
    public function player() { return $this->belongsTo(User::class, 'player_id'); }
}