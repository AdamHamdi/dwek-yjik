<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medicament extends Model
{

    public function factures(){
        return $this->belongsTo('App\Facture');
    }
    

}
