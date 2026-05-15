<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = [
        'user_id', 'shop_name', 'description',
        'logo', 'banner', 'phone', 'address', 'status',
    ];

    public function user() { return $this->belongsTo(User::class, 'user_id'); }
    public function products() { return $this->hasMany(Product::class); }
}