<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pharmacien;
use App\User;
class PharmaciensController extends Controller
{
    public function create(){
        return view('auth.inscription-pharmaciens');
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
        $pharmacien=new Pharmacien();
        $pharmacien->user_id=$user->id;

        $pharmacien->save();
        $user->sendEmailVerificationNotification();
        return redirect('/verify')->with("danger", "");

    }
    public function destroypharmacien($id ,Request $request){
        $pharm=User::where('users.id',$id)->delete();
        return redirect()->back()->with('danger','Le compte a été supprimé avec success');
    }
}
