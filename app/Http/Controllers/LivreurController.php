<?php

namespace App\Http\Controllers;
use App\Livreur;
use App\User;
use App\Pharmacie;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LivreurController extends Controller
{
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
        $livreur=new Livreur();
        $livreur->user_id=$user->id;
        $livreur->pharmacie_id=$request->pharmacie_id;
        $livreur->save();
        $user->sendEmailVerificationNotification();
        return redirect('/livreurs')->with("success", "Le compte livreur a été creer avec succès !");

    }
    public function create_livreur($id){
        $pharm=Pharmacie::find($id);
        return view('pharmacien.creer-livreur',['pharm'=>$pharm]);
    }
    public function index()
    {
        $pharmacies = DB::table('livreurs')->select('pharmacies.name', 'pharmacies.id','livreurs.pharmacie_id' ,'users.prenom', 'users.nom','users.tel')
        ->join('pharmacies', 'pharmacies.id', '=', 'livreurs.pharmacie_id')
        ->join('users', 'users.id', '=', 'livreurs.user_id')
        ->paginate(5);



            return view('pharmacien.livreurs-liste',['pharmacie'=> $pharmacies]);

}
public function destroy(Request $request,$id){
    $liv=DB::table('users')->join('livreurs', 'livreurs.user_id', '=', 'users.id')->delete();
    //$liv=User::find($id)->delete();



    return redirect()->back()->with('danger','Le compte a été supprimé avec success');
}
public function livreurs(){
    //$livreurs=User::where('role','livreur')->paginate(5);
 $livreurs = DB::table('livreurs')->select('users.adresse','pharmacies.name','users.tel','users.id', 'users.nom','users.prenom')
            ->join('users', 'users.id', '=', 'livreurs.user_id')
            ->join('pharmacies', 'pharmacies.id', '=', 'livreurs.pharmacie_id')
            ->where('users.role','livreur')->paginate(5);

                            return view('admin.livreurs-liste', ['livreurs' => $livreurs]);


    }
    public function destroylivreur($id ,Request $request){
        $liv=User::where('users.id',$id)->delete();
        return redirect()->back()->with('danger','Le compte a été supprimé avec success');
    }
}
