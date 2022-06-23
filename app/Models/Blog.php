<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model {
    use HasFactory;
    protected $guarded = [];

    public function setNameAttribute($value) {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value) . Str::random();
    }

    public function instructor() {
        return $this->belongsTo(Instructor::class);
    }
}
