<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Facture extends Model
{



    public function pharmacie(){
        return $this->belongsTo('App\Pharmacie');
    }
    public function commande(){
        return $this->belongsTo('App\Commande');

    }
    public function medicaments(){
        return $this->hasMany('App\Medicament');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
}
