<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Vendor extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'vendors';

    protected $fillable = [
        'name', 'email', 'password',
        'shop_name', 'description',
        'logo', 'banner', 'phone', 'address', 'status',
    ];

    protected $hidden = ['password'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // relation vide pour éviter l'erreur
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }
}