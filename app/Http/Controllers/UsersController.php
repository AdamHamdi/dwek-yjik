<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Pharmacie;
use App\Commande;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class UsersController extends Controller

{

    protected function validator(array $data)
    {

    }

    public function register(Request $request){

        $user= new User();
        $user->nom=$request->nom;
        $user->prenom=$request->prenom;
        $user->adresse=$request->adresse;
        $user->tel=$request->tel;
        $user->ddn=$request->ddn;
        $user->role=$request->role;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        $user->save();
        return redirect('/users/login')->with("success", "Vous étes inscrit maintenant !");

    }
    public function create(){
        return view('auth.inscription');
    }
    public function login(){
                return view('auth.login');
    }
    public function auth( Request $request){
         request()->validate([
        'email' => 'required |email',
        'password' => 'required| min:8',
        ]);

        if(Auth::attempt([ 'email' => $request->email, 'password' => $request->password ])){
            if(Auth::check() && Auth::user()->role==='admin'){

                $pharmacies = DB::table('pharmacies')->select('pharmacies.adresse', 'pharmacies.name', 'pharmacies.id','pharmacies.phone','pharmacies.code_deontologie','pharmacies.mat_fiscale','pharmacies.etat', 'pharmacies.user_id', 'users.prenom', 'users.nom')->join('users', 'users.id', '=', 'pharmacies.user_id')->where('etat','en attente')->paginate(5);
                    return  view('admin.pharmacie-admin',['pharmacies'=> $pharmacies]);

                }elseif(Auth::check() && Auth::user()->role==='client'){
                $pharmacies = DB::table('pharmacies')->select('pharmacies.adresse', 'pharmacies.name', 'pharmacies.id','pharmacies.phone', 'pharmacies.user_id', 'users.prenom', 'users.nom')->join('users', 'users.id', '=', 'pharmacies.user_id')->where('etat','validée')->paginate(5);
                 return view('client.liste-pharmacies',['pharmacies'=> $pharmacies]);

            }elseif(Auth::check() && Auth::user()->role==='pharmacien'){
                $commandes = DB::table('pharmacies')->select('commandes.adresse', 'commandes.created_at','commandes.status_commande', 'commandes.id', 'commandes.file','pharmacies.user_id', 'commandes.user_id', 'users.prenom', 'users.nom')
                ->join('users', 'users.id', '=', 'pharmacies.user_id')
                ->join('commandes', 'pharmacies.id', '=', 'commandes.pharmacie_id')->where('status_commande','demandée')->where('pharmacies.user_id',auth()->user()->id)->orderBy('commandes.created_at','DESC')->paginate(5);
                return view('pharmacien.commande-demandée',['commandes'=> $commandes]);
            }else{
                $commandes = DB::table('pharmacies')->select('commandes.adresse', 'commandes.status_commande', 'commandes.id', 'commandes.file','pharmacies.user_id', 'commandes.user_id', 'users.prenom', 'users.nom')
                ->join('users', 'users.id', '=', 'pharmacies.user_id')
                ->join('commandes', 'pharmacies.id', '=', 'commandes.pharmacie_id')->where('status_commande','payée')->orderBy('commandes.created_at','DESC')->paginate(5);

                return view('livreur.commandes-livreur',['commandes'=> $commandes]);

        }
    } else{
        return redirect()->back()->withInput($request->only('email', 'remember'))->with('fail','Email ou mot de passe est incorrect ');

        }
    }
    public function logout(){
        auth::logout();
                return redirect('/');
    }
    public function livreurs(){
    $livreurs=User::where('role','livreur')->paginate(5);
                return view('pharmacien.livreurs-liste', ['livreur' => $livreurs]);
  // dd($livreurs);

    }
    public function pharmaciens(){
        $pharmaciens = DB::table('users')->select('users.adresse','pharmacies.name','users.tel','users.id', 'users.nom','users.prenom')->join('pharmacies', 'users.id', '=', 'pharmacies.user_id')
        ->where('users.role','pharmacien')->paginate(5);

      //  $pharmaciens=User::where('role','pharmacien')->paginate(5);
                    return view('admin.pharmaciens_liste', ['pharmaciens' => $pharmaciens]);


        }

    public function client()
    {
        $commandes = DB::table('commandes')->select('commandes.adresse','pharmacies.name', 'commandes.status_commande', 'commandes.id', 'commandes.file', 'commandes.user_id','pharmacie_id', 'users.prenom', 'users.nom')->join('users', 'users.id', '=', 'commandes.user_id')->join('pharmacies', 'pharmacies.id', '=', 'commandes.pharmacie_id')->where('commandes.user_id',auth()->user()->id)->paginate(5);

        return view('client.commandes', ['commandes' => $commandes]);
    }
    public function add_livreur(Request $request){
        $user= new User();
        $user->nom=$request->nom;
        $user->prenom=$request->prenom;
        $user->adresse=$request->adresse;
        $user->tel=$request->tel;
        $user->ddn=$request->ddn;
        $user->role=$request->role;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        $user->save();
        return redirect('/livreurs')->with("success", "Le compte livreur a été creer avec succès !");

    }
    public function create_livreur(){
        return view('pharmacien.creer-livreur');
    }




    // PUBLIC FUNCTION getUserData() {
    //     $user = User::with('clients')->get();
    //     dd($user);
    // }


    // PUBLIC FUNCTION addClient(Request $request) {
    //     $user = Client::create(['
    //         'first_name'=>$request->first_name,
    //         'last_name'=>$request->last_name,
    //         'email'=>$request->email,
    //     '])->get();
    //     dd($user);
    // }

}
