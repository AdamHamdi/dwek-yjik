<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Commande extends Model
{
    



    public function user(){
        return $this->belongsTo('App\User');
    }
    public function pharmacie(){
        return $this->belongsTo('App\Pharmacie');
    }

    public function factures(){
        return $this->hasMany('App\Facture');
    }
    public function medicaments(){
        return $this->hasMany('App\Medicament');
    }

}
