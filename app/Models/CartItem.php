<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = [
        'player_id', 'product_id', 'quantity', 'size', 'color',
    ];

    public function product() { return $this->belongsTo(Product::class); }
    public function player()  { return $this->belongsTo(User::class, 'player_id'); }
}