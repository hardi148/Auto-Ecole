<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class parcour extends Model
{
    protected $fillable = [
        'idetudiant',
        'idpermi',
        'nbtranche',
        'nbcode',
        'nbconduite',
        'date',
    ];

    public $timestamps = false;
    protected $primaryKey = "idparcour";
    public $incrementing = false;
}

?>