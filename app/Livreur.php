<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Livreur extends Model
{
    protected $fillable = [
        'name', 'email', 'password',
    ];
    public function pharmacie(){
        return $this->belongsTo('App\Pharmacie');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }

  
}
