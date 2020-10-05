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
        request()->validate([
            'email' => 'required |regex:/(.+)@(.+)\.(.+)/i',
            'password' => 'required| min:8',
            'nom'=>'required|min:2|max:255',
            'prenom'=>'required|min:2|max:255',
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
        //afficher les données du client dans la page profile du client
        public function index(){
            $client=User::where('id',auth()->user()->id)->get();
            return view('client.profile',['client'=>$client]);
        }
        public function edit($id){
            $client=User::find($id);
        return view('client.modifier-profile',['client'=>$client]);

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



        return redirect('/clients/profile')->with("success", "");

        }

}
