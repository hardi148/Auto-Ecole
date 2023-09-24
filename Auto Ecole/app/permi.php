<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class permi extends Model
{
    protected $fillable = [
        'typepermi',
        'montant',
    ];

    public $timestamps = false;
    protected $primaryKey = "idpermi";
    public $incrementing = false;
}

?>