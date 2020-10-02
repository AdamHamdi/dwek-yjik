<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Medicament;
use App\Commande;
use App\Facture;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class MedicamentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medicaments=Medicament::orderBy('created_at','desc')->paginate(5);

            return view('pharmacien.liste-medicaments',['medicament'=> $medicaments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
       //

   $medicament=new Medicament();
   $medicament->nom_med=$request->nom_med;

   $medicament->posologie= $request->posologie;
   $medicament->dispo= $request->dispo;

   if($request->dispo==='oui'){
    $medicament->prix= $request->prix;

   }else{
    $medicament->prix= 0;
   }


   $medicament->facture_id=$request->facture_id;

   $medicament->save();
   $fa=Facture::find($id);
   if($medicament->dispo==='oui'){
   $fact=DB::table('medicaments')->select('factures.montant')->join('factures', 'factures.id', '=', 'medicaments.facture_id')
 ->where('facture_id',$id)->update(['montant' =>$fa->montant+$request->prix]);}
 else{
    $fact=DB::table('medicaments')->select('factures.montant')->join('factures', 'factures.id', '=', 'medicaments.facture_id')
    ->where('facture_id',$id)->update(['montant' =>$fa->montant]);

 }
//dd($fact);


   return redirect()->back()->with('success','Le medicament a été ajouté avec succes');

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
    public function edit($id)
    {
        //
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
    public function destroy(Request $request,$id)
    {
        $med=Medicament::find($id)->delete();
        return redirect()->back()->with('danger', 'Le medicament a été supprimé avec succes ');
    }
    public function search(Request $request){
        $med= DB::table('medicaments')->where('nom_med','like','%'.$request->search.'%')
                                  ->paginate(5);
        return view('pharmacien.medicaments-chercher',['meds'=>$med]);
    }
    public function ajouter($id){
        $fact=Facture::findOrFail($id);

        return view('pharmacien.medicaments-ajouter',['fact'=>$fact]);
    }

}
