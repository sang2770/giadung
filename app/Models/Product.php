<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_id', 'producer_id', 'short_description', 'description', 'import_price', 'regular_price', 'sale_price', 'quantity', 'SKU', 'image', 'images', 'stock_status', 'featured', 'has_variants'];

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function producer()
    {
        return $this->belongsTo(Producer::class,'producer_id');
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

}

