<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['player_id', 'team_id', 'title', 'content', 'status'];
    public function player() { return $this->belongsTo(User::class, 'player_id'); }
    public function team() { return $this->belongsTo(Team::class); }
}