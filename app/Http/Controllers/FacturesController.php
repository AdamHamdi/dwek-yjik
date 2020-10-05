<?php

namespace App\Http\Controllers;

use App\Commande;
use Illuminate\Http\Request;
use App\Facture;
use App\Medicament;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FacturesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $factures = DB::table('factures')->select('factures.date_facturation', 'factures.id', 'factures.montant', 'pharmacies.name','factures.user_id', 'factures.commande_id', 'users.prenom', 'users.nom','commandes.status_commande')->join('users', 'users.id', '=', 'factures.user_id')->join('pharmacies', 'pharmacies.id', '=', 'factures.pharmacie_id')->join('commandes', 'commandes.id', '=', 'factures.commande_id')->orderBy('factures.created_at','DESC')->paginate(5);

        return view('pharmacien.factures-liste', ['factures' => $factures]);
    }
    public function indexclient()
    {
        $factures = DB::table('factures')->select('factures.date_facturation', 'factures.id', 'factures.montant', 'pharmacies.name','factures.user_id', 'factures.commande_id', 'users.prenom', 'users.nom','commandes.status_commande')->join('users', 'users.id', '=', 'factures.user_id')->join('pharmacies', 'pharmacies.id', '=', 'factures.pharmacie_id')->join('commandes', 'commandes.id', '=', 'factures.commande_id')->where('factures.user_id',auth()->user()->id)->orderBy('factures.created_at','DESC')->paginate(5);

        return view('client.factures-liste', ['factures' => $factures]);
    }
    public function indexlivreur()
    {
        $factures = DB::table('factures')->select('factures.date_facturation', 'factures.id', 'factures.montant', 'pharmacies.name','factures.user_id', 'factures.commande_id', 'users.prenom', 'users.nom','commandes.status_commande')
        ->join('users', 'users.id', '=', 'factures.user_id')
        ->join('pharmacies', 'pharmacies.id', '=', 'factures.pharmacie_id')
        ->join('commandes', 'commandes.id', '=', 'factures.commande_id')
        ->where('status_commande','payée')
        ->paginate(5);

        return view('livreur.factures-liste', ['factures' => $factures]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     /// nous derige vers l'interface d'ajout d'une facture
    public function create($id)
    {
        $commandes = DB::table('commandes')->select(  'pharmacies.mat_fiscale','pharmacies.name','commandes.id','commandes.user_id','commandes.pharmacie_id', 'users.prenom', 'users.nom')
        ->join('users', 'users.id', '=', 'commandes.user_id')
        ->join('pharmacies', 'pharmacies.id', '=', 'commandes.pharmacie_id')
        ->where('commandes.id',$id)->get();

//dd($commandes);
        //$fact=Medicament::all();
        return view ('pharmacien.creer-facture',['commandes'=>$commandes]);
    }
    // afficher les details des factures pour les client
    public function facture($id)
    {
        $commandes = DB::table('commandes')->select(  'pharmacies.mat_fiscale','pharmacies.name','commandes.id','factures.commande_id','commandes.user_id','commandes.pharmacie_id', 'users.prenom', 'users.nom','factures.id','factures.date_facturation')
        ->join('users', 'users.id', '=', 'commandes.user_id')
        ->join('pharmacies', 'pharmacies.id', '=', 'commandes.pharmacie_id')
        ->join('factures', 'commandes.id', '=', 'factures.commande_id')
        ->where('factures.id',$id)->where('factures.user_id',auth()->user()->id)->get();


        $fact=Medicament::orderBy('created_at','DESC')->where('facture_id',$id)->get();
        return view ('client.facture',['commandes'=>$commandes,'fact'=>$fact]);
    }
    // afficher les details des factures pour les pharmaciens
    public function imprimer($id)
    {
        $commandes = DB::table('commandes')->select(  'pharmacies.mat_fiscale','commandes.id','pharmacies.name','factures.commande_id','commandes.user_id','commandes.pharmacie_id', 'users.prenom', 'users.nom','factures.id','factures.date_facturation')
        ->join('users', 'users.id', '=', 'commandes.user_id')
        ->join('pharmacies', 'pharmacies.id', '=', 'commandes.pharmacie_id')
        ->join('factures', 'commandes.id', '=', 'factures.commande_id')
        ->where('factures.id',$id)->get();


        $fact=Medicament::orderBy('created_at','DESC')->where('facture_id',$id)->get();
        return view ('pharmacien.factures',['commandes'=>$commandes,'fact'=>$fact]);
    }
    public function livraison($id)
    {
        $commandes = DB::table('commandes')->select(  'pharmacies.mat_fiscale','commandes.id','pharmacies.name','factures.commande_id','commandes.user_id','commandes.pharmacie_id', 'users.prenom', 'users.nom','factures.id','factures.date_facturation')
        ->join('users', 'users.id', '=', 'commandes.user_id')
        ->join('pharmacies', 'pharmacies.id', '=', 'commandes.pharmacie_id')
        ->join('factures', 'commandes.id', '=', 'factures.commande_id')
        ->where('factures.id',$id)->get();


        $fact=Medicament::orderBy('created_at','DESC')->where('facture_id',$id)->get();
        return view ('livreur.factures',['commandes'=>$commandes,'fact'=>$fact]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $facture=new Facture();
        $facture->montant=$request->montant;
        $facture->date_facturation=$request->date_facturation;
        $facture->user_id = $request->user_id;
        $facture->commande_id=$request->commande_id;
        $facture->pharmacie_id=$request->pharmacie_id;

         $facture->save();
       return redirect('/factures')->with('success','Votre facture a été crée avec succes');
         //return redirect()->back()->with('success','Votre facture a été crée avec succes');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function paiement($id)
    {
        $facture = DB::table('commandes')->select('factures.commande_id',
        'factures.id','factures.date_facturation','factures.montant')
        ->join('factures', 'commandes.id', '=', 'factures.commande_id')
        ->where('factures.id',$id)->get();
        // $facture=Facture::find($id);
        // dd($facture);
        return view('client.paiement',['facture'=>$facture]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fact=Facture::find($id)->delete();
        return redirect()->back()->with('danger','La facture a été supprimée avec succes');
    }
    public function detail_facture($id){
        $factures = DB::table('factures')->select('factures.date_facturation', 'factures.id', 'factures.montant', 'pharmacies.name','factures.user_id', 'factures.commande_id', 'users.prenom', 'users.nom','commandes.status_commande')
        ->join('users', 'users.id', '=', 'factures.user_id')
        ->join('pharmacies', 'pharmacies.id', '=', 'factures.pharmacie_id')
        ->join('commandes', 'commandes.id', '=', 'factures.commande_id')
        ->where('factures.user_id',auth()->user()->id)->orderBy('factures.created_at','DESC')


        ->where('commandes.id',$id)->paginate(5);



        return view ('client.detail_factures',['facture'=>$factures]);

    }
    public function voir_facture($id){
        $factures = DB::table('factures')->select('factures.date_facturation', 'factures.id', 'factures.montant', 'pharmacies.name','factures.user_id', 'factures.commande_id', 'users.prenom', 'users.nom','commandes.status_commande')
        ->join('users', 'users.id', '=', 'factures.user_id')
        ->join('pharmacies', 'pharmacies.id', '=', 'factures.pharmacie_id')
        ->join('commandes', 'commandes.id', '=', 'factures.commande_id')
        ->orderBy('factures.created_at','DESC')


        ->where('commandes.id',$id)->paginate(5);



        return view ('pharmacien.voir_factures',['facture'=>$factures]);

    }
    public function details_facture($id){
        $factures = DB::table('factures')->select('factures.date_facturation', 'factures.id', 'factures.montant', 'pharmacies.name','factures.user_id', 'factures.commande_id', 'users.prenom', 'users.nom','commandes.status_commande')
        ->join('users', 'users.id', '=', 'factures.user_id')
        ->join('pharmacies', 'pharmacies.id', '=', 'factures.pharmacie_id')
        ->join('commandes', 'commandes.id', '=', 'factures.commande_id')
        ->orderBy('factures.created_at','DESC')


        ->where('commandes.id',$id)->paginate(5);



        return view ('livreur.details_factures',['factures'=>$factures]);

    }
}
