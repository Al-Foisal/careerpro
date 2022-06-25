<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model {
    use HasFactory;

    protected $guarded = [];

    public function getSelectedApplicatiantAttribute() {
        return $this->selected === 1 ? 'Selected' : 'Rejected';
    }
}
