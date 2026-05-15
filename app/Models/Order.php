<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'player_id', 'order_number', 'total', 'status',
        'payment_method', 'payment_status', 'stripe_payment_id',
        'shipping_address', 'shipping_city', 'shipping_country',
        'shipping_phone', 'notes',
    ];

    public function player() { return $this->belongsTo(User::class, 'player_id'); }
    public function items()  { return $this->hasMany(OrderItem::class); }
}