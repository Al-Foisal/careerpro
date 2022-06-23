<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getDiscountTypeAttribute()
    {
        return $this->coupon_type === 1 ? 'Discount in Percentage' : 'Discount in Flat Price';
    }
}
