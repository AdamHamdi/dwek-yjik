@extends('livreur.main-content')
@section('content')
<br><br><br><br>
<div class="container">


<div class="row mt-5">
    <div class="col-md-12">
        <div class="card ">
          <div class="card-header">
            <h4 class="card-title text-dark"> Liste des commandes :</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive" >
              <table class="table tablesorter table-bordered" id="" style="border:2px solid gray;">
                <thead class="text-light bg-primary">
                  <tr >


                    <th style="border:2px solid gray;"class="text-center">Client</th>

                    <th  style="border:2px solid gray;" class="text-center"> Adresse Client </th>
                    <th style="border:2px solid gray;"class="text-center">Télephone</th>

                    <th style="border:2px solid gray;"class="text-center">Statut</th>


                  </tr>
                </thead>
                <tbody>
                    @foreach($commandes as $comm )
                    <tr>


                        <td style="border:2px solid gray;"> {{ App\User::findOrFail($comm->user_id)->nom}} {{ App\User::findOrFail($comm->user_id)->prenom}}</td>
                        <td style="border:2px solid gray;"> {{ $comm->adresse}} </td>
                        <td style="border:2px solid gray;"> {{ App\User::findOrFail($comm->user_id)->tel}}</td>


                        <td style="border:2px solid gray;">{{ $comm->status_commande }}
                        </td>


                      </tr>
                   @endforeach
                   <div class="float-right">{{ $commandes->links() }}</div>
                </tbody>
              </table>
              <a href="{{url()->previous()}}" class="btn btn-sm btn-secondary " style="color:white"><i class="fas fa-arrow-circle-left"></i> Retour</a>
           
            </div>
          </div>
        </div>
      </div>

    </div>
    @endsection
