<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class etudiant extends Model
{
    protected $fillable = [
        'nom',
        'prenom',
        'numtel',
        'adresse',
        'frais',
        'date',
    ];

    public $timestamps = false;
    protected $primaryKey = "idetudiant";
    public $incrementing = false;
}

?>