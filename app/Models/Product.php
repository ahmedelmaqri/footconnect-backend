<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'vendor_id', 'category_id', 'name', 'slug',
        'description', 'price', 'sale_price', 'stock',
        'images', 'sizes', 'colors', 'brand',
        'is_featured', 'is_active', 'views',
    ];

    protected $casts = [
        'images'      => 'array',
        'sizes'       => 'array',
        'colors'      => 'array',
        'is_featured' => 'boolean',
        'is_active'   => 'boolean',
        'price'       => 'float',
        'sale_price'  => 'float',
    ];

    public function vendor()   { return $this->belongsTo(Vendor::class); }
    public function category() { return $this->belongsTo(Category::class); }
    public function reviews()  { return $this->hasMany(Review::class); }

    public function avgRating()
    {
        return $this->reviews()->avg('rating') ?? 0;
    }
}