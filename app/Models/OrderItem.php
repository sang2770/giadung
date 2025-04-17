<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    protected $fillable = [
        'order_id',   // 🛠 Thêm dòng này
        'product_id',
        'product_name',
        'price',
        'quantity',
        'subtotal',
        'size',
        'color'
    ];

}
