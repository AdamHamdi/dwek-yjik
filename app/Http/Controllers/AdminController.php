<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $admin=User::where('id',auth()->user()->id)->get();
        return view('admin.profile',['admin'=>$admin]);
    }
    public function edit($id){
        $admin=User::find($id);
    return view('admin.modifier-profile',['admin'=>$admin]);

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



    return redirect('/admin/profile')->with("success", "");

    }
}
