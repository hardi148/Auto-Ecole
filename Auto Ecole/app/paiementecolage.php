<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class paiementecolage extends Model
{
    protected $fillable = [
        'idetudiant',
        'idpermi',
        'montant',
        'datepaiement',
        'date',
    ];

    public $timestamps = false;
    protected $primaryKey = "idpaiement";
    public $incrementing = false;
}

?>