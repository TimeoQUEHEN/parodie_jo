<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    use HasFactory;

    protected $fillable=[
        'nom',
        'description',
        'annee_ajout',
        'nb_disciplines',
        'nb_epreuves',
        'user_id',
    ];

    protected $casts=[
        'date_debut' => 'datetime',
        'date_fin' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    function athletes() {
        return $this->belongsToMany(Athlete::class, 'classement')
            ->as('classement')
            ->withPivot('rang', 'performance');
    }
}
