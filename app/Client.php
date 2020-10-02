<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    
    protected $fillable = [
        'name', 'email', 'password',
    ];
   public function user(){
       return $this->belongsTo('App\User');
   }
   public function commandes(){
    return $this->hasMany('App\Commande');
}
public function factures(){
    return $this->hasMany('App\Facture');
}
}
