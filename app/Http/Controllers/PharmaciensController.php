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
        request()->validate([
            'email' => 'required |regex:/(.+)@(.+)\.(.+)/i',
            'password' => 'required| min:8',
            'nom'=>'required|alpha|min:2|max:255',
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
    public function index(){
        $pharmacien=User::where('id',auth()->user()->id)->get();
       
        return view('pharmacien.profile',['pharmacien'=>$pharmacien]);
    }
    public function edit($id){
        $pharmacien=User::find($id);
    return view('pharmacien.modifier-profile',['pharmacien'=>$pharmacien]);

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



    return redirect('/pharmacien/profile')->with("success", "");

    }
}
