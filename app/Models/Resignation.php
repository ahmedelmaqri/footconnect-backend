<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Resignation extends Model
{
    protected $fillable = [
        'player_id', 'team_id', 'reason', 'requested_date',
        'desired_leave_date', 'status', 'admin_response',
    ];

    public function player() { return $this->belongsTo(User::class, 'player_id'); }
    public function team() { return $this->belongsTo(Team::class); }
}