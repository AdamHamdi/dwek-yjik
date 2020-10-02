<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Commande;
use App\Pharmacie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class CommandesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function index()
    {
        $commandes = DB::table('pharmacies')->select('commandes.adresse','commandes.created_at' ,'commandes.status_commande', 'commandes.id', 'commandes.file','pharmacies.user_id', 'commandes.user_id', 'users.prenom', 'users.nom')
        ->join('users', 'users.id', '=', 'pharmacies.user_id')
        ->join('commandes', 'pharmacies.id', '=', 'commandes.pharmacie_id')->where('status_commande','acceptée')->orwhere('status_commande','demandée')->orwhere('status_commande','expediée')->orwhere('status_commande','refusée')->orwhere('status_commande','reçue')->orwhere('status_commande','en cours')->orwhere('status_commande','payée')->where('pharmacies.user_id',auth()->user()->id)->orderBy('created_at','DESC')->paginate(5);
        return view('pharmacien.commandes-liste',['commandes'=> $commandes]);
    }
    public function index1()
    {
        $commandes = DB::table('pharmacies')->select('commandes.adresse', 'commandes.status_commande', 'commandes.id', 'commandes.file','pharmacies.user_id', 'commandes.user_id', 'users.prenom', 'users.nom')->join('users', 'users.id', '=', 'pharmacies.user_id')->join('commandes', 'pharmacies.id', '=', 'commandes.pharmacie_id')->where('pharmacies.user_id',auth()->user()->id)->paginate(5);

        return view('client.commandes-liste', ['commandes' => $commandes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id){
        $pharm=Pharmacie::find($id);
        return view('client.creer-commande',['pharm'=>$pharm]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       //
       $this->validate($request,[


        'file'=>'required'

    ]);
   // dd($request->all());
   $file=$request->file('file');
   $name=$file->getClientOriginalName();
   $file->move(public_path().'/ordonnance/',$name);
   $commande=new Commande();
   $commande->adresse=$request->adresse;
   $commande->user_id = auth()->user()->id;
   //$commande->user_id = Auth()->user()->id;
   $commande->pharmacie_id=$request->pharmacie_id;
   $commande->file=$name;
   $commande->save();
   return redirect('/commandes/client')->with('success','Votre commande a été ajouté avec succes');
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
        $comm=Commande::find($id);
        return view('client.modifier-commande',['comm'=>$comm]);
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
        $this->validate($request,[

            'adresse'=>'required |max:2000',
            'file'=>'required'

        ]);
       // dd($request->all());
       $file=$request->file('file');
       $name=$file->getClientOriginalName();
       $file->move(public_path().'/ordonnance/',$name);
       $commande= Commande::find($id);
       $commande->adresse=$request->adresse;
       $commande->status_commande='demandée';
       $commande->user_id = auth()->user()->id;
       $commande->pharmacie_id=$request->pharmacie_id;
       $commande->file=$name;
       $commande->save();
       return redirect('/commandes/client')->with('warning','La commande a été modifier avec succes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comm=Commande::findorFail($id);
         $comm->delete();//
        //dd($comm);
        return redirect('/commandes/client')->with('danger','La commande a été supprimée avec succes');

    }
    public function delete($id)
    {
        $comm=Commande::findorFail($id);
         $comm->delete();//
        //dd($comm);
        return redirect('commandes/')->with('danger','La commande a été supprimée avec succes');

    }
    public function livreur(){
        $commandes = DB::table('pharmacies')->select('commandes.adresse', 'commandes.status_commande', 'commandes.id', 'commandes.file','pharmacies.user_id', 'commandes.user_id', 'users.prenom', 'users.nom')
                ->join('users', 'users.id', '=', 'pharmacies.user_id')
                ->join('commandes', 'pharmacies.id', '=', 'commandes.pharmacie_id')
                ->where('status_commande','expediée')
                ->orwhere('status_commande','reçue')
               ->paginate(5);

                return view('livreur.commandes-livreur',['commandes'=> $commandes]);
    }
    public function livreur2(){
        $commandes = DB::table('pharmacies')->select('commandes.adresse', 'commandes.status_commande', 'commandes.id', 'commandes.file','pharmacies.user_id', 'commandes.user_id', 'users.prenom', 'users.nom')
                ->join('users', 'users.id', '=', 'pharmacies.user_id')
                ->join('commandes', 'pharmacies.id', '=', 'commandes.pharmacie_id')
                ->where('status_commande','expediée')
                ->orwhere('status_commande','reçue')
               ->paginate(5);

                return view('livreur.commande-recue',['commandes'=> $commandes]);
    }
    public function details($id)
    {
        $commandes=Commande::findOrFail($id);


        return view('pharmacien.details-commande', ['commandes' => $commandes]);
    }
    public function accepter($id)
    {

        $comm = DB::table('commandes')->where('id', $id)->update(['status_commande' => 'acceptée']);

        return redirect('/commandes/client');
    }
    public function refuser($id)
    {

        $comm = DB::table('commandes')->where('id', $id)->update(['status_commande' => 'refusée']);
        return redirect('/commandes/client');
    }
    public function traiter($id)
    {

        $comm = DB::table('commandes')->where('id', $id)->update(['status_commande' => 'en cours']);
        return redirect('/commandes');
    }
    public function recevoir($id)
    {

        $comm = DB::table('commandes')->where('id', $id)->update(['status_commande' => 'reçue']);
        return redirect('/commandes/livreur/reçue');
    }
    public function expedier($id)
    {

        $comm = DB::table('commandes')->where('id', $id)->update(['status_commande' => 'expediée']);
        return redirect('/commandes');
    }

}
