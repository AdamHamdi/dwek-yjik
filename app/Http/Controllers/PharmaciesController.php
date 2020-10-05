<?php

namespace App\Http\Controllers;
use App\Pharmacie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class PharmaciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $pharmacies = DB::table('pharmacies')->select('pharmacies.adresse', 'pharmacies.name', 'pharmacies.phone','pharmacies.id', 'pharmacies.user_id', 'users.prenom', 'users.nom')->join('users', 'users.id', '=', 'pharmacies.user_id')->where('etat','validée')->paginate(5);

        // $pharmacies=Pharmacie::orderBy('created_at','desc')->paginate(5);

            return view('client.liste-pharmacies',['pharmacies'=> $pharmacies]);
    }
    public function index1()
    {
        $pharmacies = Pharmacie::orderBy('created_at','DESC')->paginate(5);

        // $pharmacies=Pharmacie::orderBy('created_at','desc')->paginate(5);

            return view('admin.liste-pharmacie',['pharmacies'=> $pharmacies]);
    }
    public function index2()
    {
        $pharmacies = Pharmacie::orderBy('created_at','DESC')
        //->where('etat','validée')
        ->where('pharmacies.user_id',auth()->user()->id)->paginate(5);

        // $pharmacies=Pharmacie::orderBy('created_at','desc')->paginate(5);

            return view('pharmacien.pharmacie',['pharmacies'=> $pharmacies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pharmacien.ajouter-pharmacie');
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
    //    $this->validate($request,[

    //     'description'=>'required |max:2000',
    //     'file'=>'required'

    // ]);
   // dd($request->all());

  $pharmacies=new Pharmacie();
  $pharmacies->name=$request->name;
  $pharmacies->user_id = auth()->user()->id;
   //$commande->user_id = Auth()->user()->id;
  $pharmacies->adresse=$request->adresse;
  $pharmacies->phone=$request->phone;
 // $pharmacies->etat=$request->etat;
  $pharmacies->convention_CNAM=$request->convention_CNAM;
  $pharmacies->mat_fiscale=$request->mat_fiscale;
  $pharmacies->code_deontologie=$request->code_deontologie;

  $pharmacies->save();
   return redirect('/pharmacies/pharmacien')->with('success','Pharmacie a été ajouté avec succes');
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
    public function destroy($id ,Request $request){
        $pharm=Pharmacie::where('pharmacies.id',$id)->delete();
        return redirect()->back()->with('danger','Le compte pharmacie a été supprimé avec success');
    }
    public function accepter($id)
    {

        $con = DB::table('pharmacies')->where('id', $id)->update(['etat' => 'validée']);

        return redirect('/pharmacies/admin');
    }
    public function refuser($id)
    {

        $con = DB::table('pharmacies')->where('id', $id)->update(['etat' => 'refusée']);
        return redirect('/pharmacies/admin');
    }
    public function search(Request $request){
        $phar= DB::table('pharmacies')->where('adresse','like','%'.$request->search.'%')
                                  ->paginate(5);
        return view('client.pharmacies-chercher',['phar'=>$phar]);
    }
}
