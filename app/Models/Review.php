<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'player_id', 'product_id', 'rating', 'comment',
    ];

    public function player()  { return $this->belongsTo(User::class, 'player_id'); }
    public function product() { return $this->belongsTo(Product::class); }
}