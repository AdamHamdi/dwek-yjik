<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\User;
class ClientController extends Controller
{
    public function create(){
        return view('auth.inscription-client');
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
        $client=new Client();
        $client->user_id=$user->id;

        $client->save();
        $user->sendEmailVerificationNotification();
        return redirect('/verify')->with("danger", "");

    }
    public function clients(){
        $clients=User::where('role','client')->paginate(5);
                    return view('admin.client-liste', ['clients' => $clients]);


        }
        public function destroyclient($id ,Request $request){
            $client=User::where('users.id',$id)->delete();
            return redirect()->back()->with('danger','Le compte a été supprimé avec success');
        }

}
