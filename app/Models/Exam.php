<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Exam extends Model {
    use HasFactory;

    protected $guarded = [];
    public function quizzes() {
        return $this->hasMany(Quiz::class);
    }

    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function setNameAttribute($value) {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
}
