<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Order extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }
    
    public function provinceInfo()
    {
        return $this->belongsTo(Province::class, 'province');
    }

    public function districtInfo()
    {
        return $this->belongsTo(District::class, 'district');
    }

    protected $fillable = [
        'order_code',
        'user_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'province',
        'district',
        'address',
        'payment_method',
        'subtotal', 
        'shipping_fee', 
        'discount', 
        'total'
        // Thêm các trường khác nếu cần
    ];
}
