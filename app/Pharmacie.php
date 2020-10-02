<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Pharmacie extends Model
{
    

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function factures(){
        return $this->hasMany('App\Facture');
    }
    public function commandes(){
        return $this->hasMany('App\Commande');
    }
    public function livreurs(){
        return $this->hasMany('App\Livreur');
    }

}
