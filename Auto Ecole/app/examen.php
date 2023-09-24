<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class examen extends Model
{
    protected $fillable = [
        'idetudiant',
        'idpermi',
        'typeexamen',
        'dateexamen',
        'droitexamen',
        'date',
    ];

    public $timestamps = false;
    protected $primaryKey = "idexamen";
    public $incrementing = false;
}

?>