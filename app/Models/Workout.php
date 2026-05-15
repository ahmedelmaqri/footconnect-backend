<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    protected $fillable = [
    'player_id', 'title', 'description', 'exercises',
    'difficulty', 'duration_minutes', 'assigned_date',
    'completed', 'notes', 'image',
];

    protected $casts = ['exercises' => 'array', 'completed' => 'boolean'];
    public function player() { return $this->belongsTo(User::class, 'player_id'); }
}