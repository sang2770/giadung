<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'size', 'color', 'quantity', 'SKU', 'import_price', 'regular_price', 'sale_price', 'sale'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
