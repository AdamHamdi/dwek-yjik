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
        request()->validate([
            'email' => 'required |regex:/(.+)@(.+)\.(.+)/i',
            'password' => 'required| min:8',
            'nom'=>'required|min:2|max:255',
            'prenom'=>'required|alpha|min:2|max:255',
            'adresse'=>'required',
            'tel'=>'required|min:8|numeric',
            'ddn'=>'before:today',
            ]);
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
    public function index1(){
        $livreur=User::where('id',auth()->user()->id)->get();
        return view('livreur.profile',['livreur'=>$livreur]);
    }
    public function edit($id){
        $livreur=User::find($id);
    return view('livreur.modifier-profile',['livreur'=>$livreur]);

    }
    public function update(Request $request, $id){
        request()->validate([

            'password' => 'required| min:8',
            'nom'=>'required|min:2|max:255',
            'prenom'=>'required|min:2|max:255',
            'adresse'=>'required',
            'tel'=>'required|min:8|numeric',
            'ddn'=>'before:today',
            ]);





        $user=  User::findOrfail($id);
        if($request->hasFile('image')){
            $file=$request->file('image');
            $name=$file->getClientOriginalName();
            $file->move(public_path().'/image/',$name);
            $user->image=$name;}

        $user->nom=$request->get('nom');
        $user->prenom=$request->get('prenom');
        $user->adresse=$request->get('adresse');
        $user->tel=$request->get('tel');
        $user->ddn=$request->get('ddn');
        $user->role=$request->get('role');
        $user->email=$request->get('email');


        $user->password=bcrypt($request->password);

        $user->save();



    return redirect('/livreur/profile')->with("success", "");

    }
}
