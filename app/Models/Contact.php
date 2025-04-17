<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    // Khai báo các thuộc tính có thể được mass assign
    protected $fillable = [
        'name', 'email', 'phone', 'message'
    ];
}
