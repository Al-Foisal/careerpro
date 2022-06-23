<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderCourse extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function singleCourse()
    {
        return $this->belongsTo(Course::class, 'course_id','id');
    }
}
