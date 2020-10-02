<?php

namespace App\Http\Controllers;
use App\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CardsController extends Controller
{

   public function pay(Request $request,$id){


    // verfi num
    // select * from cards where cc_number ==
    $result = Card::where('cc_number', $request->cc_number)->first();

    if ($result){

        // date
        if($result->cvv == $request->cvv && $result->solde >= $request->solde){

            $result->solde = $result->solde - $request->solde;
            $result->save();

// update etat commande payée



    $comm = DB::table('commandes')->where('id', $id)->update(['status_commande' => 'payée']);




            return redirect('/client/factures/liste')->with("success", "Le paiement a été efféctué avec success");
        }else{
            return redirect()->back()->with("danger", "Opération échouée");
        }

    }else{
        return redirect()->back()->with("danger", "Opération échouée");
    }

    /*$card= new Card();
     $card->cc_number=$request->cc_number;
     $card->solde=$request->solde;
     $card->cvv=$request->cvv;
     $card->validity=$request->validity;
     $card->save();*/

// }


   }





}
