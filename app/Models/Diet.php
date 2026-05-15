<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Diet extends Model
{
    protected $fillable = [
    'player_id', 'title', 'breakfast', 'lunch',
    'dinner', 'snacks', 'calories_target',
    'notes', 'start_date', 'end_date', 'active', 'image',
];

    protected $casts = [
        'breakfast' => 'array', 'lunch' => 'array',
        'dinner' => 'array', 'snacks' => 'array',
        'active' => 'boolean',
    ];
    public function player() { return $this->belongsTo(User::class, 'player_id'); }
}