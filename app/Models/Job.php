<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dates = ['dead_line'];

    public function jobApplications()
    {
        return $this->hasMany(JobApplication::class);
    }
}
