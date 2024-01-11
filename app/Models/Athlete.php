<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Athlete extends Model
{
    use HasFactory;

    function sports() {
        return $this->belongsToMany(Sport::class, 'classement')
            ->as('classement')
            ->withPivot('rang', 'performance');
    }
}
