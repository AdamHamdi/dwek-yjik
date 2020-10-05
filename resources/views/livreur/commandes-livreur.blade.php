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

                    <th style="border:2px solid gray;" class="text-center">Actions</th>

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
                        <td style="border:2px solid gray;" >
                        <a href="{{ url('factures/'.$comm->id.'/details-facture') }}" class="  btn btn-sm btn-info"><i class="fas fa-eye"></i> Voir facture</a>

                        @if($comm->status_commande=='payée')
                              <a href="{{url('commandes/'.$comm->id.'/exedier') }}" class="btn btn-sm btn-warning" style="color:white"><i class="fas fa-eye"></i> Expédier</a>
                              @elseif($comm->status_commande=='expediée')
                        <a href="{{ url('commandes/'.$comm->id.'/recevoir') }}" class="btn btn-sm btn-success" style="color:white"><i class="fas fa-check-square"></i> Confirmer la récéption</a>
                           @endif
                           </td>
                      </tr>
                   @endforeach
                   <div class="float-right">{{ $commandes->links() }}</div>
                </tbody>
              </table>
             
            </div>
          </div>
        </div>
      </div>

    </div>
    @endsection
