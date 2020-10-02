<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pharmacien extends Model
{
    protected $fillable = [
        'name', 'email', 'password',
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

  
}
