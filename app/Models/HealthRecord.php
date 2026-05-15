<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class HealthRecord extends Model
{
    protected $fillable = [
        'player_id', 'date', 'weight', 'height',
        'heart_rate', 'blood_pressure_sys', 'blood_pressure_dia',
        'fitness_level', 'injury_status', 'injury_description', 'notes',
    ];

    public function player() { return $this->belongsTo(User::class, 'player_id'); }
}